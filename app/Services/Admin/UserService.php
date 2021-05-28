<?php

namespace App\Services\Admin;

use App\Repository\Admin\UserRepository;

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
        return $this->userRepository->addUser($data, $rol);
    }
}