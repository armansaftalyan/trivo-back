<?php

namespace App\Services\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CategoryCreateService
{
    public function __construct(protected $data)
    {
    }

    /**
     * @return Builder|Model
     */
    public function handle(): Builder|Model
    {
        return Category::query()->create($this->data);
    }
}
