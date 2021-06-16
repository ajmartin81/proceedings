<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DocumentService;
use App\Services\Admin\EventService;
use Illuminate\Support\Facades\Auth;
use App\Services\Admin\ProceedingService;
use App\Services\Admin\UserService;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index(){
        $userId = Auth::id();

        $userService = new UserService;
        $proceedingService = new ProceedingService;
        $userProceedings = $proceedingService->getUserActiveProceedings($userId);

        if(!session()->exists('newProceedginsSinceLastLogin')){
            $ProceedginsSinceLastLogin = $proceedingService->getNewProceedginsSinceLastLogin($userId);
            session(['newProceedginsSinceLastLogin' => $ProceedginsSinceLastLogin]);
        }
        
        if(!session()->exists('newUsersSinceLastLogin')){
            $UsersSinceLastLogin = $userService->getNewUsersSinceLastLogin($userId);
            session(['newUsersSinceLastLogin' => $UsersSinceLastLogin]);
        }

        if(!session()->exists('newDocumentsSinceLastLogin')){
            $documentService = new DocumentService;
            $DocumentsSinceLastLogin = $documentService->getDocumentsSinceLastLogin($userId);
            session(['newDocumentsSinceLastLogin' => $DocumentsSinceLastLogin]);
        }

        if(!session()->exists('newEventsSinceLastLogin')){
            $eventService = new EventService;
            $EventsSinceLastLogin = $eventService->getEventeSinceLastLogin($userId);
            session(['newEventsSinceLastLogin' => $EventsSinceLastLogin]);
        }

        $newProceedginsSinceLastLogin = session('newProceedginsSinceLastLogin'); 
        $newUsersSinceLastLogin = session('newUsersSinceLastLogin');
        $newDocumentsSinceLastLogin = session('newDocumentsSinceLastLogin');
        $newEventsSinceLastLogin = session('newEventsSinceLastLogin');
        
        $updateUserLastLogin = $userService->updateLastLoginDate($userId);
        
        return view('admin.index', compact('userProceedings','newProceedginsSinceLastLogin','newUsersSinceLastLogin','newDocumentsSinceLastLogin','newEventsSinceLastLogin'));
    }
}
