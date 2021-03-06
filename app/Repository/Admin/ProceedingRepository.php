<?php

namespace App\Repository\Admin;

use App\Models\Proceeding;
use App\Repository\Admin\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function getNewProceedginsSinceLastLogin($userId)
    {
        $userRepository = new UserRepository;
        $user = $userRepository->getUserById($userId);
        
        $dateFrom = $user->last_login?$user->last_login:"2000-01-01";

        $newProceedings = Proceeding::where('created_at','>=',$dateFrom)->get()->count();
        return $newProceedings;
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

    public function deleteProceeding(Proceeding $proceeding)
    {
        if(Storage::deleteDirectory('public/'.$proceeding->id)){
            $deletedProceeding = $proceeding->delete();

            return $deletedProceeding;
        }
        
        return null;
    }

    public function setStatus($status, $proceedingId)
    {
        $proceeding = $this->getProceedingById($proceedingId);
        $newStatus['status'] = $status;

        if($status == 'Cerrado'){
            $newStatus['end_at'] = now();
        }

        $proceeding->update($newStatus);

        return $proceeding;
    }
    
}