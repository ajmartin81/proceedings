<?php

namespace App\Repository\Admin;

use App\Models\Proceeding;
use App\Repository\Admin\UserRepository;
use Illuminate\Support\Facades\Auth;

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

    public function getUserActiveProceedings($userId)
    {
        $user = new UserRepository;
        return $user->getUserById($userId)->proceedings->where('status','!=','Cerrado');
    }

    public function addProceeding($data, $users)
    {
        $newProceeding = Proceeding::updateOrCreate($data);
        
        $newProceeding->users()->sync($users);
        $newProceeding->users()->attach(Auth::user());
        
        return $newProceeding;
    }

    public function updateProceeding($data, $proceedingId)
    {
        $proceeding = $this->getProceedingById($proceedingId);

        $proceeding->update($data);

        return $proceeding;
    }

    public function setStatus($status, $proceedingId)
    {
        $proceeding = $this->getProceedingById($proceedingId);
        $newStatus = ['status' => $status];

        $proceeding->update($newStatus);

        return $proceeding;
    }
    
}