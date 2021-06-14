<?php

namespace App\Services\Admin;

use App\Mail\ActivateUserMail;
use App\Mail\ErrorNotificationMail;
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

    public function getNewUsersSinceLastLogin($userId)
    {
        return $this->userRepository->getNewUsersSinceLastLogin($userId);
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
            try{
                Mail::to($user->email)->send(new ActivateUserMail($user));
            } catch(\Exception $e) {
                $adminMail = env('MAIL_FROM_ADDRESS');
                Mail::to($adminMail)->send(new ErrorNotificationMail($user));
            }
            return $user;
        }
        return null;
    }

    public function updateUser($userId, $data, $rol = null)
    {       
        $user = $this->userRepository->updateUser($userId, $data, $rol);

        return $user;
    }

    public function isUserActivated($userId)
    {
        $user = $this->userRepository->isUserActivated($userId);

        return $user;
    }

    public function updateLastLoginDate($userId)
    {
        return $this->userRepository->updateLastLoginDate($userId);
    }
}