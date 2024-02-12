<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Jobs\SendRegistrationEmail;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Getting all users
     *
     * @return object
     * 
     */
    public function getUsers(): object
    {
        $users = collect();
        User::chunk(100, function ($results) use ($users) {
            foreach ($results as $user) {
                $users->push($user);
            }
        });
        return (object) $users;
    }
    /**
     * Getting roles
     *
     * @return array
     * 
     */
    public function getRoles(): array
    {
        return User::$role;
    }
    /**
     * Getting genders
     *
     * @return array
     * 
     */
    public function getGenders(): array
    {
        return User::$gender;
    }
    /**
     * Get current user
     *
     * @param int $id
     * 
     * @return object
     * 
     */
    public function getUser(int $id): object
    {
        return User::find($id);
    }
    /**
     * Create new user
     *
     * @param array $data
     * 
     * @return object
     * 
     */
    public function createUser(array $data): object
    {
        (string) $password = $data['password'];
        $data['password'] = Hash::make($password);
        (object) $user = User::create($data);
        
        dispatch(new SendRegistrationEmail($user, $password));
        return (object) $user;
    }
    /**
     * Update current user
     *
     * @param array $data
     * @param int $id
     * 
     * @return object
     * 
     */
    public function updateUser(array $data, int $id): object
    {
        (object) $user = User::find($id);
        $user->update($data);
        return (object) $user;
    }

    /**
     * Delete current user
     *
     * @param int $id
     * 
     * @return [type]
     * 
     */
    public function destroy(int $id)
    {
        User::destroy($id);
    }
}
