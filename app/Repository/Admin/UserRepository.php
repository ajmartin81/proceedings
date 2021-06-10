<?php

namespace App\Repository\Admin;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRepository {

    public function getUsers()
    {
        $users = User::all();
        return $users;
    }

    public function getUserById($userId)
    {
        $user = User::where('id', $userId)->first();
        return $user;
    }

    public function getRoles()
    {
        return $roles = Role::all();
    }

    public function addUser($data, $rol)   
    {
        $isEmailRegistered = User::where('email', $data['email'])->first();
        $isNifRegistred = User::where('nif', $data['nif'])->first();

        if(!$isEmailRegistered && !$isNifRegistred){
            $newUser = User::updateOrCreate($data);
            $newUser->roles()->Sync($rol);

            return $newUser;
        }
        
        return null;
    }

    public function updateUser($userId, $data, $rol)   
    {
        $user = $this->getUserById($userId);
        $user->update($data);
        $user->roles()->Sync($rol);
        
        return $user;
    }
}