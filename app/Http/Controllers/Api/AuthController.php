<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Api\Auth\AuthService;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    private $authService;
    /**
     * init AuthService
     *
     * @param AuthService $AuthService
     * 
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $token = $this->authService->login($data);

        return response()->json([
            'result' => 'succsess',
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $this->authService->logout($user);
        return response()->json([
            'message' => 'Вы успешно вышли из системы'
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function isAuthenticated()
    {
        $isAuthenticated = $this->authService->isAuthenticated();
        if ($isAuthenticated) {
            return response()->json(['is_authenticated' => true]);
        }
    }
}
