<?php

namespace App\Infrastructure\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendRegistrationEmail;
use Illuminate\Support\Facades\Hash;
use App\Infrastructure\Interfaces\LogInterface;

class UserService
{
    /**
     * Model: User
     *
     * @var object
     */

     protected $user;
    /**
     * LogInterface implementation
     *
     * @var object
     */

     protected $logger;

    /**
     * Construct user service
     *
     * @param User $user
     * @param LogInterface $logger
     * 
     */
    public function __construct(User $user, LogInterface $logger)
    {
        (object) $this->user = $user;
        (object) $this->logger = $logger;
    }

    /**
     * Getting all users
     *
     * @return object
     * 
     */
    public function getUsers(int $count): ?object
    {
        try {
            $users = $this->user::paginate($count);
        } catch (\Exception $e) {
            $this->logger->error('Error fetching users: ' . $e->getMessage());
            return null;
        }

        return $users;
    }

    /**
     * Getting roles
     *
     * @return array
     * 
     */
    public function getRoles(): ?array
    {
        try {
            return $this->user::$role;
        } catch (\Exception $e) {
            $this->logger->error('Error when getting roles: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Getting genders
     *
     * @return array
     * 
     */
    public function getGenders(): ?array
    {
        try {
            return $this->user::$gender;
        } catch (\Exception $e) {
            $this->logger->error('Error when getting genders: ' . $e->getMessage());
            return null;
        }
    }
    /**
     * Get user gender
     *
     * @return string
     * 
     */
    public function getGender(): ?string
    {
        try {
            return $this->user->gender;
        } catch (\Exception $e) {
            $this->logger->error('Error when getting genders: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Get current user
     * 
     * @return object
     * 
     */
    public function getCurrentUser(): ?object
    {
        try {
            (object) $user = auth()->user();
        } catch (\Exception $e) {
            $this->logger->error('The user was not found: ' . $e->getMessage());
            return null;
        }

        return $user;
    }

}
