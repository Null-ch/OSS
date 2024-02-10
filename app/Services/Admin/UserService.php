<?php

namespace App\Services\Admin;

use App\Models\User;

class UserService
{
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
    public function getRoles()
    {
        return User::$role;
    }
    public function getGenders()
    {
        return User::$gender;
    }
    public function getUser(int $id)
    {
        return User::find($id);
    }
    
}
