<?php

namespace App\Services\Category;

use App\Models\Category;

class CategoryUpdateService
{
    public function __construct(protected $data,protected $id)
    {
    }

    /**
     * @return int
     */
    public function handle(): int
    {
        return Category::query()->where('id',$this->id)->update($this->data);
    }
}
