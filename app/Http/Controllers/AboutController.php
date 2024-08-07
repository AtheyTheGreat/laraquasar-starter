<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Attachment;
use Spatie\QueryBuilder\QueryBuilder;

class AboutController extends BaseController
{
    public function __construct()
    {
        $this->model = About::class;
        $this->relation = ['attachments'];
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
                'desc' => $item->desc,
                'image' => $item->getFirstMediaUrl('about'),
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
            'desc' => $data->desc,
            'image' => $data->getFirstMediaUrl('about'),
        ];

        return response()->json($formattedData);
    }

    public function edit($id)
    {
        $about = QueryBuilder::for(About::where('id', $id))->firstOrFail();
        return view('abouts.edit', compact('about'));
    }

    public function update(Request $request, $id)
    {

        $model = app()->make($this->model);
        $modelData = $model->findOrFail($id);
        $validatedData = $request->validate($model->updateRules());
        $data = $modelData->update($validatedData);
        if ($request->hasFile('about')) {
            $modelData->clearMediaCollection('about');
            $modelData->addMediaFromRequest('about')->toMediaCollection('about');
        }

        return response()->json($data);

    }

    public function store(Request $request)
    {
        $model = app()->make($this->model);
        $validatedData = $request->validate($model->storeRules());
        $validatedData['title'] = 'About';
        $data = $model->create($validatedData);

        if ($request->hasFile('about')) {
            $data->addMediaFromRequest('about')->toMediaCollection('about');
        }

        return response()->json($data);

    }
}
