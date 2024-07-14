<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendRegistrationEmail;
use Illuminate\Support\Facades\Hash;
use App\Infrastructure\Services\UserService;
use App\Infrastructure\Interfaces\LogInterface;

class AdminUserService extends UserService
{
    /**
     * Model: User
     *
     * @var object
     */

    protected  $user;
    /**
     * LogInterface implementation
     *
     * @var object
     */

    protected  $logger;

    /**
     * Construct user service
     *
     * @param User $user
     * @param LogInterface $logger
     * 
     */
    public function __construct(User $user, LogInterface $logger)
    {
        parent::__construct($user, $logger);
    }


    /**
     * Get current user
     *
     * @param int $id
     * 
     * @return object
     * 
     */
    public function getUserById(int $id): ?object
    {
        try {
            (object) $user = $this->user::findOrFail($id);
        } catch (\Exception $e) {
            $this->logger->error('The user was not found: ' . $e->getMessage());
            return null;
        }

        return $user;
    }

    /**
     * Create new user
     *
     * @param array $data
     * 
     */
    public function createUser(array $data)
    {
        (string) $password = $data['password'];
        $data['password'] = Hash::make($password);
        DB::beginTransaction();

        try {
            (object) $user = $this->user::create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when creating a user: ' . $e->getMessage());
            return;
        }

        try {
            dispatch(new SendRegistrationEmail($user, $password));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when sending an email after registration: ' . $e->getMessage());
        }
    }

    /**
     * Update current user
     *
     * @param array $data
     * @param int $id
     * 
     */
    public function updateUser(array $data, int $id)
    {
        $user = $this->getUserById($id);

        if ($user) {
            try {
                $user->update($data);
            } catch (\Exception $e) {
                $this->logger->error('User update was failed: ' . $e->getMessage());
            }
        } else {
            $this->logger->error('The user with ID ' . $id . ' was not found.');
        }
    }

    /**
     * Delete current user
     *
     * @param int $id
     * 
     */
    public function destroy(int $id)
    {
        try {
            $this->user::destroy($id);
        } catch (\Exception $e) {
            $this->logger->error('Error when deleting a user: ' . $e->getMessage());
        }
    }

    /**
     * Func for chenge activity of user
     *
     * @param int $id
     * @return string
     */
    public function toggleActivity(int $id): ?string
    {
        $user = $this->getUserById($id);
        if ($user) {
            $user->is_active == 1 ? $user->is_active = 0 : $user->is_active = 1;
            $user->save();

            return 'Активность изменена';
        } else {
            return null;
        }
    }
}
