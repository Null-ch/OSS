<?php

namespace App\Services\Api\Auth;

use App\Models\User;
use App\Services\LogInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Model: User
     *
     * @var object
     */

    private $user;

    /**
     * Hash object init
     *
     * @var object
     */
    private $hash;

    /**
     * Api token service
     *
     * @param User $user
     * @param LogInterface $logger
     * 
     */
    public function __construct(User $user, Hash $hash)
    {
        (object) $this->user = $user;
        (object) $this->hash = $hash;
    }

    public function login(array $data)
    {
        $user = $this->user::where('email', $data['email'])->first();

        if (!$user || !$this->hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => 'Email или пароль не верны!'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return $token;
    }

    public function logout($user)
    {
        $user->currentAccessToken()->delete();
    }

    public function isAuthenticated()
    {
        return Auth::check();
    }
}
