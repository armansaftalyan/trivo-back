<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ProductCreateService
{
    public function __construct(protected $data)
    {
    }

    /**
     * @return Builder|Model
     */
    public function handle(): Builder|Model
    {
        return Product::query()->create($this->data);
    }
}
