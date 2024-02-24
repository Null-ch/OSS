<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\TokenService;
use App\Http\Requests\Api\TokenCreateRequest;

class TokenController
{
    private $tokenService;
    /**
     * init tokenService
     *
     * @param TokenService $tokenService
     * 
     */
    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    public function __invoke(TokenCreateRequest $request)
    {
        $data = $request->validated();
        $response = $this->tokenService->generateToken($data);
        return response()->json($response);
    }
}
