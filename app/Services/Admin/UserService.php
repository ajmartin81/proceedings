<?php

namespace App\Services\Admin;

use App\Mail\ActivateUserMail;
use App\Repository\Admin\UserRepository;
use Illuminate\Support\Facades\Mail;

class UserService {
    protected $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }

    public function getUsers(){
        return $this->userRepository->getUsers();
    }

    public function getUserById($userId){
        return $this->userRepository->getUserById($userId);
    }

    public function getRoles()
    {
        return $this->userRepository->getRoles();
    }

    public function addUser($data, $rol)
    {       
        $user = $this->userRepository->addUser($data, $rol);

        if($user){
            Mail::to($user->email)->send(new ActivateUserMail($user));
        }
        
        return $user;
    }

    public function updateUser($userId, $data, $rol)
    {       
        $user = $this->userRepository->updateUser($userId, $data, $rol);

        return $user;
    }
}