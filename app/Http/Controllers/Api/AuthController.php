<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Services\Api\Auth\AuthService;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Документация проекта OSS",
     *      description="Справочник API эндпоинтов",
     *      @OA\Contact(
     *          email="t4r.code@yandex.ru"
     *      ),
     * )
     */
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

    /**
     * @OA\Post(
     *      path="/api/login",
     *      tags={"Авторизация"},
     *      description="Авторизация в системе по почте и паролю",
     *      @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Email пользователя",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="Пароль пользователя",
     *         required=true,
     *         @OA\Schema(type="string")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Успешно авторизирован! Возвращает токен в переменной 'token'",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=419,
     *          description="Проблемы с CSRF токеном"
     *      )
     *     )
     */
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
