<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CategoryApiController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $categories = Category::withCount('ads')->get();
        return CategoryResource::collection($categories)
            ->additional(['message' => 'success', 'status' => 'OK']);
    }

    public function store(CategoryStoreRequest $request): CategoryResource
    {
        $category = Category::create($request->validated());
        $category->loadCount('ads');
        return CategoryResource::make($category)
            ->additional(['message' => 'success', 'status' => 'OK']);
    }

    public function show(Category $category): CategoryResource
    {
        $category->loadCount('ads');
        return CategoryResource::make($category)
            ->additional(['message' => 'success', 'status' => 'OK']);
    }

    public function update(CategoryUpdateRequest $request, Category $category): CategoryResource
    {
        $category->update($request->validated());
        $category->loadCount('ads');
        return CategoryResource::make($category)
            ->additional(['message' => 'success', 'status' => 'OK']);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response(['message' => 'Category Deleted Successfully', 'status' => 'OK'], Response::HTTP_ACCEPTED);
    }
}
