<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ClientController extends BaseController
{
    public function __construct()
    {
        $this->model = Client::class;
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
                'name' => $item->name,
                'testimonial' => $item->testimonial,
                'testimonial_giver' => $item->testimonial_giver,
                'testimonial_giver_position' => $item->testimonial_giver_position,
                'logo' => $item->getFirstMediaUrl('logo'),
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
            'name' => $data->name,
            'testimonial' => $data->testimonial,
            'testimonial_giver' => $data->testimonial_giver,
            'testimonial_giver_position' => $data->testimonial_giver_position,
            'logo' => $data->getFirstMediaUrl('logo'),
        ];

        return response()->json($formattedData);
    }

    public function create()
    {
        return view('clients.create');
    }

    public function edit($id)
    {
        $client = QueryBuilder::for(Client::where('id', $id))->firstOrFail();
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $model = app()->make($this->model);
        $modelData = $model->findOrFail($id);
        $validatedData = $request->validate($model->updateRules());
        $data = $modelData->update($validatedData);
        if ($request->hasFile('logo')) {
            $modelData->clearMediaCollection('logo');
            $modelData->addMediaFromRequest('logo')->toMediaCollection('logo');
        }
        return response()->json($data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $model = app()->make($this->model);
        $validatedData = $request->validate($model->storeRules());
        
        $data = $model::create($validatedData);
        
        if($request->hasFile('logo')){
            $data->addMediaFromRequest('logo')->toMediaCollection('logo');
        }

        return response()->json($data);
    }

}
