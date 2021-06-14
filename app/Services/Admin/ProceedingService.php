<?php

namespace App\Services\Admin;

use App\Repository\Admin\ProceedingRepository;

class ProceedingService {
    protected $proceedingRepository;

    public function __construct()
    {
        $this->proceedingRepository = new ProceedingRepository;
    }

    public function getProceedings(){
        return $this->proceedingRepository->getProceedings();

    }

    public function getProceedingById($proceedingId){
        return $this->proceedingRepository->getProceedingById($proceedingId);

    }

    public function getUserProceedings($userId){
        return $this->proceedingRepository->getUserProceedings($userId);

    }

    public function getUserActiveProceedings($userId){
        return $this->proceedingRepository->getUserActiveProceedings($userId);

    }

    public function getNewProceedginsSinceLastLogin($userId)
    {
        return $this->proceedingRepository->getNewProceedginsSinceLastLogin($userId);
    }

    public function addProceeding($data, $users)
    {
        return $this->proceedingRepository->addProceeding($data, $users);
    }

    public function updateProceeding($data, $proceedingId)
    {
        return $this->proceedingRepository->updateProceeding($data, $proceedingId);
    }

    public function setStatus($status, $proceedingId)
    {
        return $this->proceedingRepository->setStatus($status, $proceedingId);
    }
}