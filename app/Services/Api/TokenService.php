<?php

namespace App\Services\Api;

use App\Models\User;
use App\Services\LogInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class TokenService
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

    /**
     * Generate api token
     *
     * @param array $data
     * 
     * @return array
     * 
     */
    public function generateToken(array $data): array
    {
        $user = $this->user::where('email', $data['email'])->first();

        if (!$user || !$this->hash::check($data['password'], $user->password)) {
            return [
                'result' => false,
                'token' => 'Incorrect email or password'
            ];
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return [
            'result' => true,
            'token' => $token
        ];
    }
}
