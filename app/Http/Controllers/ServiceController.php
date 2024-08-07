<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Tag;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ServiceController extends BaseController
{
    public function __construct()
    {
        $this->model = Service::class;
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
                'service_name' => $item->service_name,
                'service_desc' => $item->service_desc,
                'service_cover' => $item->getFirstMediaUrl('service_cover'),
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
            'service_name' => $data->service_name,
            'service_desc' => $data->service_desc,
            'service_cover' => $data->getFirstMediaUrl('service_cover'),
        ];

        return response()->json($formattedData);
    }

    public function edit($id)
    {
        $service = QueryBuilder::for(Service::where('id', $id))->firstOrFail();
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $model = app()->make($this->model);
        $modelData = $model->findOrFail($id);
        $validatedData = $request->validate($model->updateRules());
        $data = $modelData->update($validatedData);
        if ($request->hasFile('service_img')) {
            $modelData->clearMediaCollection('service_img');
            $modelData->addMediaFromRequest('service_img')->toMediaCollection('service_img');
        }
        if ($request->hasFile('service_cover')) {
            $modelData->clearMediaCollection('service_cover');
            $modelData->addMediaFromRequest('service_cover')->toMediaCollection('service_cover');
        }
        return redirect('/services-crud');
    }

    public function store(Request $request)
    {
        $model = app()->make($this->model);
        $validatedData = $request->validate($model->storeRules());

        $data = $model->create($validatedData);

        if ($request->hasFile('service_img')) {
            $data->addMediaFromRequest('service_img')->toMediaCollection('service_img');
        }

        if ($request->hasFile('service_cover')) {
            $data->addMediaFromRequest('service_cover')->toMediaCollection('service_cover');
        }

        return response()->json($data);

    }
}
