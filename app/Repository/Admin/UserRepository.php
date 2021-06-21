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

    public function getNewUsersSinceLastLogin($userId)
    {
        $user = User::where('id', $userId)->first();
        $dateFrom = $user->last_login?$user->last_login:"2000-01-01";

        $newUsers = User::where('created_at','>=',$dateFrom)->get()->count();

        return $newUsers;
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
        $isNifRegistered = User::where('nif', $data['nif'])->first();

        if(!$isEmailRegistered && !$isNifRegistered){
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

        if($rol){
            $user->roles()->Sync($rol);
        }
        
        return $user;
    }

    public function isUserActivated($userId)
    {
        $user = $this->getUserById($userId);

        if($user->last_login || $user->rgpd_accept_at || $user->email_verified_at){
            return true;
        }
        
        return false;
    }

    public function updateLastLoginDate($userId)
    {
        $user = $this->getUserById($userId);

        $user->last_login = now();
        $user->save();
        return $user;
    }
}