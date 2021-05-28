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

    public function getUserProceedings($userId){
        return $this->proceedingRepository->getUserProceedings($userId);

    }

    public function addProceeding($data, $users)
    {
        $this->proceedingRepository->addProceeding($data, $users);
    }
}