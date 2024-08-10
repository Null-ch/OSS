<?php

namespace App\Infrastructure\Services;

use App\Helpers\Helpers;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Interfaces\UserInterface;
use App\Infrastructure\Validation\UserValidator;

class UserService implements UserInterface
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
     * userValidator
     *
     * @var object
     */
    protected $userValidator;
    /**
     * messageService
     *
     * @var object
     */
    protected $messageService;

    /**
     * helpers
     *
     * @var mixed
     */
    protected $helpers;

    /**
     * __construct
     *
     * @param User $user
     * @param LogInterface $logger
     * @param UserValidator $userValidator
     * @param MessageService $messageService
     */
    public function __construct(
        User $user,
        LogInterface $logger,
        UserValidator $userValidator,
        MessageService $messageService,
        Helpers $helpers
    ) {
        $this->user = $user;
        $this->logger = $logger;
        $this->userValidator = $userValidator;
        $this->messageService = $messageService;
        $this->helpers = $helpers;
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
    public function getAuthUser(): ?object
    {
        try {
            (object) $user = auth()->user();
        } catch (\Exception $e) {
            $this->logger->error('The user was not found: ' . $e->getMessage());
            return null;
        }

        return $user;
    }

    /**
     * createUser
     *
     * @param  array $data
     * @return object
     */
    public function createUser(array $data): ?object
    {
        DB::beginTransaction();
        try {
            $existingUser = $this->user::where('email', $data['email'])->first();
            if ($existingUser) {
                DB::commit();
                return $existingUser;
            }
            $validatedData = $this->userValidator->validate($data);
            $randomPassword = Str::random(8);
            $validatedData['password'] = Hash::make($randomPassword);
            $user = $this->user->create($validatedData);
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when create user object: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * getUser
     *
     * @param  int $id
     * @return object
     */
    public function getUser(int $id): object|null
    {
        try {
            $user = $this->user::find($id);
        } catch (\Exception $e) {
            $this->logger->error('Error get user object: ' . $e->getMessage());
            return null;
        }

        return $user;
    }

    /**
     * generateUserDetails
     *
     * @param  int $id
     * @return array
     */
    public function generateUserDetails(int $id): ?array
    {
        try {
            $user = $this->getUser($id);
            $userDetails = $this->helpers->prepareUserDetailsData($user);
        } catch (\Exception $e) {
            $this->logger->error('Error generateUserDetails: ' . $e->getMessage());
            return null;
        }

        return $userDetails;
    }
}
