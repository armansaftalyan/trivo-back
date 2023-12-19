<?php

namespace App\Services\Auth;

class LoginService
{
    public function __construct(protected $user)
    {
    }

    /**
     * @return mixed
     */
    public function handle(): mixed
    {
        $this->user->token = $this->user->createToken('token')->plainTextToken;
        return $this->user;
    }
}
