<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\TagStoreRequest;
use App\Http\Requests\Tag\TagUpdateRequest;
use App\Http\Resources\Tag\TagResource;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TagApiController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $tags = Tag::withCount('ads')->get();
        return TagResource::collection($tags)
            ->additional(['message' => 'success', 'status' => 'OK']);
    }

    public function store(TagStoreRequest $request): TagResource
    {
        $tag = Tag::create($request->validated());
        $tag->loadCount('ads');
        return TagResource::make($tag)
            ->additional(['message' => 'success', 'status' => 'OK']);
    }

    public function show(Tag $tag): TagResource
    {
        $tag->loadCount('ads');
        return TagResource::make($tag)
            ->additional(['message' => 'success', 'status' => 'OK']);
    }

    public function update(TagUpdateRequest $request, Tag $tag): TagResource
    {
        $tag->update($request->validated());
        $tag->loadCount('ads');
        return TagResource::make($tag)
            ->additional(['message' => 'success', 'status' => 'OK']);
    }

    public function destroy(Tag $tag): Response|Application|ResponseFactory
    {
        $tag->delete();
        return response(['message' => 'Tag Deleted Successfully', 'status' => 'OK'], Response::HTTP_ACCEPTED);
    }
}
