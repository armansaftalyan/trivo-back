<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AttemptService
{
    public function __construct(protected $data)
    {
    }

    /**
     * @throws AuthenticationException
     */
    public function handle(): null|Model
    {
        if (!Auth::attempt($this->data)) {
            throw new AuthenticationException('invalid Credentials');
        }

        return User::query()->where('email',$this->data['email'])->first();
    }
}
