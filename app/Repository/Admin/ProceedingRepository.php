<?php

namespace App\Repository\Admin;

use App\Models\Proceeding;
use App\Repository\Admin\UserRepository;

class ProceedingRepository {

    public function getProceedings()
    {
        $proceedings = Proceeding::all();
        return $proceedings;
    }

    public function getProceedingById($proceedingId)
    {
        $proceeding = Proceeding::where('id', $proceedingId)->first();
        return $proceeding;
    }

    public function getUserProceedings($userId)
    {
        $user = new UserRepository;
        return $user->getUserById($userId)->proceedings;
    }

    public function addProceeding($data, $users)
    {
        $newProceeding = Proceeding::updateOrCreate($data);
        
        $newProceeding->users()->sync($users);
        
    }
    
}