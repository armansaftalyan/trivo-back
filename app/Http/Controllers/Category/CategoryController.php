<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\Category\CategoryCreateService;
use App\Services\Category\CategoryDeleteService;
use App\Services\Category\CategoryUpdateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $searchTerm = $request->input('search');

        $categories = Category::query()->where('name', 'like', '%' . $searchTerm . '%')
            ->get();

        return response()->json($categories);
    }

    public function store(CategoryRequest $request): JsonResponse
    {
        $service = new CategoryCreateService($request->all());
        $category = $service->handle();
        return $this->toJson($category->toArray());
    }

    public function show($id)
    {
        return Category::findOrFail($id);
    }

    public function update(CategoryRequest $request, $id): JsonResponse
    {
        $service = new CategoryUpdateService($request->all(),$id);
        $service->handle();
        return $this->toJson([]);
    }

    public function destroy($id): JsonResponse
    {
        $service = new CategoryDeleteService($id);
        $service->handle();
        return $this->toJson([]);
    }
}
