<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Jobs\SendRegistrationEmail;
use Illuminate\Support\Facades\Hash;

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
        return (object) $users;
    }
    public function getRoles()
    {
        return (array) User::$role;
    }
    public function getGenders()
    {
        return (array) User::$gender;
    }
    public function getUser(int $id)
    {
        return (object) User::find($id);
    }
    public function createUser(array $data)
    {
        (string) $password = $data['password'];
        $data['password'] = Hash::make($password);
        (object) $user = User::create($data);
        
        dispatch(new SendRegistrationEmail($user, $password));
        return (object) $user;
    }
    public function updateUser(array $data, int $id)
    {
        (object) $user = User::find($id);
        (object) $user->update($data);
        return (object) $user;
    }
}
