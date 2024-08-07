<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class GalleryController extends BaseController
{
    public function __construct()
    {
        $this->model = Gallery::class;
        $this->relation = [];
        $this->allowedFilters = [];
        $this->allowedIncludes = [];
        $this->allowedSorts = ['id'];
    }

    public function index()
    {
        $queryData =  QueryBuilder::for($this->model)
            ->with($this->relation)
            ->allowedFilters($this->allowedFilters)
            ->allowedIncludes($this->allowedIncludes)
            ->allowedSorts($this->allowedIncludes)
            ->defaultSorts("-id")
            ->simplePaginate('10');

        $itemsCollection = collect($queryData->items());

        $formattedData = $itemsCollection->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'cover_image' => $item->getFirstMediaUrl('gallery'),
            ];
        });

        return [
            'current_page' => $queryData->currentPage(),
            'data' => $formattedData,
            'first_page_url' => $queryData->url(1),
            'from' => $queryData->firstItem(),
            'next_page_url' => $queryData->nextPageUrl(),
            'prev_page_url' => $queryData->previousPageUrl(),
            'path' => $queryData->url(1),
            'per_page' => $queryData->perPage(),
            'to' => $queryData->lastItem(),
        ];
    }

    public function show($id)
    {
        $data = $this->model::with($this->relation)->findOrFail($id);

        $formattedData = [
            'id' => $data->id,
            'title' => $data->title,
            'cover_image' => $data->getFirstMediaUrl('gallery'),
        ];

        return response()->json($formattedData);
    }

    public function update(Request $request, $id)
    {
        $model = app()->make($this->model);
        $modelData = $model->findOrFail($id);
        $validatedData = $request->validate($model->updateRules());

        $modelData->update($validatedData);

        if ($request->hasFile('gallery')) {
            $modelData->clearMediaCollection('gallery');
            $modelData->addMediaFromRequest('gallery')->toMediaCollection('gallery');
        }

        return response()->json($modelData);

    }


    public function store(Request $request)
    {
        $model = app()->make($this->model);
        $validatedData = $request->validate($model->storeRules());

        $data = $model::create($validatedData);

        if ($request->hasFile('gallery')) {
            $data->addMediaFromRequest('gallery')->toMediaCollection('gallery');
        }

        return response()->json($data);
    }
}
