<?php

namespace App\Services\Product;

use App\Models\Product;

class ProductUpdateService
{
    public function __construct(protected $data,protected $id)
    {
    }

    /**
     * @return int
     */
    public function handle(): int
    {
        return Product::query()->where('id',$this->id)->update($this->data);
    }
}
