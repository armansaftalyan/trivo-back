<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Auth\AttemptService;
use App\Services\Auth\LoginService;
use App\Services\Auth\RegisterService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @throws AuthenticationException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $attempt = new AttemptService($request->all());
        $user = $attempt->handle();

        $login = new LoginService($user);
        $user = $login->handle();

        return $this->toJson($user->toArray());
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $service = new RegisterService($request->all());
        $user = $service->handle();

        $login = new LoginService($user);
        $user = $login->handle();

        return $this->toJson($user);
    }

    public function logout(Request $request): void
    {
        $request->user()->currentAccessToken()->delete();
    }
}
