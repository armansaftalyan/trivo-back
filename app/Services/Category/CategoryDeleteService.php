<?php

namespace App\Services\Category;

use App\Models\Category;

class CategoryDeleteService
{
    public function __construct(protected $id)
    {
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $product = Category::query()->findOrFail($this->id);
        $product->delete();
    }
}
