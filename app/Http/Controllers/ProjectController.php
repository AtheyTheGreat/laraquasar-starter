<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Http\Controllers\AttachmentController;
use App\Models\Project;
use App\Models\Service;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\Console\Input\Input;

class ProjectController extends BaseController
{
    public function __construct()
    {
        $this->model = Project::class;
        $this->relation = ['attachments','tags'];
        $this->allowedFilters = [];
        $this->allowedIncludes = [];
        $this->allowedSorts = ['-id'];
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
                'cover_image' => $item->getFirstMediaUrl('cover_image'),
                'title' => $item->title,
                'project_year' => $item->project_year,
                'project_area' => $item->project_area,
                'client_name' => $item->client_name,
                'desc' => $item->desc,
                'tags' => $item->tags,
                'images' => $item->getMedia('images')->map(function ($media) {
                    return $media->getUrl();
                }),
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
            'cover_image' => $data->getFirstMediaUrl('cover_image'),
            'title' => $data->title,
            'project_year' => $data->project_year,
            'project_area' => $data->project_area,
            'client_name' => $data->client_name,
            'desc' => $data->desc,
            'tags' => $data->tags,
            'images' => $data->getMedia('images')->map(function ($media) {
                return $media->getUrl();
            }),
        ];

        return response()->json($formattedData);
    }

    public function edit($id)
    {
        $project = QueryBuilder::for(Project::where('id', $id))->firstOrFail();
        $tags = Tag::all();
        return view('projects.edit', compact('project','tags'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $model = app()->make($this->model);
        $modelData = $model->findOrFail($id);
        $validatedData = $request->validate($model->updateRules($id));

        $modelData->update($validatedData);

        if ($request->hasFile('cover_image')) {
            $modelData->clearMediaCollection('cover_image');
            $modelData->addMediaFromRequest('cover_image')->toMediaCollection('cover_image');
        }

        if ($images = $request->file('images')) {
            $modelData->clearMediaCollection('images');
            foreach ($images as $image) {
                $modelData->addMedia($image)->toMediaCollection('images');
            }
        }

        if ($request->has('tag_id')) {
            $tagId = $request->input('tag_id.value');
            $modelData->tags()->sync($tagId);
        } else {
            $modelData->tags()->detach();
        }

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $file_name = str_replace(' ', '_', $file->getClientOriginalName());
                $file->storeAs('public/uploads', $file_name);
                $filePath = ('public/uploads/' . $file_name);

                $newAttachment = Attachment::create([
                    'file' => $filePath,
                    'project_id' => $modelData->id,
                ]);

                $attachmentIds[] = $newAttachment->id;
            }

        }
        return response()->json($modelData);
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $model = app()->make($this->model);
        $validatedData = $request->validate($model->storeRules());

        $data = $model::create($validatedData);

        if ($request->hasFile('cover_image')) {
            $data->addMediaFromRequest('cover_image')->toMediaCollection('cover_image');
        }

        if ($images = $request->file('images')) {
            foreach ($images as $image) {
                $data->addMedia($image)->toMediaCollection('images');
            }
        }

        if ($request->has('tag_id')) {
            $tagId = $request->input('tag_id.value');
            $data->tags()->syncWithoutDetaching($tagId);
        }

        return response()->json($data);

    }

    public function getProjectsByTag(Request $request)
    {
        // Validate the input
        $request->validate([
            'tag' => 'required|exists:tags,tags',
        ]);

        // Get the tag name from the request
        $tagName = $request->input('tag');

        // Query projects with the specified tag
        $projects = QueryBuilder::for(Project::class)
            ->whereHas('tags', function ($query) use ($tagName) {
                $query->where('tags', $tagName);
            })
            ->get();

        $tags = Tag::whereHas('projects')->get();
        $services = Service::all();

        // You can customize the response as needed
        return view('projects', compact('projects','tags','services'));
    }

}

