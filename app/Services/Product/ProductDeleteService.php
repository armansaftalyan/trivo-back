<?php

namespace App\Services\Product;

use App\Models\Product;

class ProductDeleteService
{
    public function __construct(protected $id)
    {
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $product = Product::query()->findOrFail($this->id);
        $product->delete();
    }
}
