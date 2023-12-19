<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\Product\ProductCreateService;
use App\Services\Product\ProductDeleteService;
use App\Services\Product\ProductUpdateService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $searchTerm = $request->input('search');

        $products = Product::with('category')
            ->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('category', function ($q) use ($searchTerm) {
                        $q->where('name', 'like', '%' . $searchTerm . '%');
                    });
            })
            ->get();

        return $this->toJson($products->toArray());
    }

    public function store(ProductRequest $request): JsonResponse
    {
        $service = new ProductCreateService($request->all());
        $product = $service->handle();
        return $this->toJson($product->toArray());
    }

    public function show($id)
    {
        return Product::findOrFail($id);
    }

    public function update(ProductRequest $request, $id): JsonResponse
    {
        $service = new ProductUpdateService($request->all(),$id);
        $service->handle();
        return $this->toJson([]);
    }

    public function destroy($id): JsonResponse
    {
        $service = new ProductDeleteService($id);
        $service->handle();
        return $this->toJson([]);
    }

}
