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
    public function getUsers()
    {
        $users = collect();
        User::chunk(100, function ($results) use ($users) {
            foreach ($results as $user) {
                $users->push($user);
            }
        });
        return $users;
    }
    /**
     * Getting roles
     *
     * @return array
     * 
     */
    public function getRoles()
    {
        return User::$role;
    }
    /**
     * Getting genders
     *
     * @return array
     * 
     */
    public function getGenders()
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
    public function getUser(int $id)
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
    public function createUser(array $data)
    {
        $password = $data['password'];
        $data['password'] = Hash::make($password);
        $user = User::create($data);
        
        dispatch(new SendRegistrationEmail($user, $password));
        return $user;
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
    public function updateUser(array $data, int $id)
    {
        $user = User::find($id);
        $user->update($data);
        return $user;
    }
}
