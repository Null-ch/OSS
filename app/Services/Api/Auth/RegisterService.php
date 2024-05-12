<?php

namespace App\Services\Api\Auth;

use App\Models\User;
use App\Services\LogInterface;
use Illuminate\Support\Facades\Hash;

class RegisterService
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


    public function register(array $data)
    {

        $user = $this->user::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $this->hash::make($data['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}
