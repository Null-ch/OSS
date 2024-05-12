<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
use App\Services\Api\Auth\RegisterService;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController
{
    private $registerService;
    /**
     * init RegisterService
     *
     * @param RegisterService $registerService
     * 
     */
    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $userData = $this->registerService->register($data);
        $token = $userData['token'];
        $cookie = cookie('auth_token', $token, 60 * 24);

        return response()->json([
            'user' => new UserResource($userData['user']),
        ])->withCookie($cookie);
    }
}
