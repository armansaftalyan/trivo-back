<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RegisterService
{
    /**
     * @param $data
     */
    public function __construct(protected $data)
    {

    }

    /**
     * @return Model|Builder
     */
    public function handle(): Model|Builder
    {
        return User::query()->create($this->data);
    }
}
