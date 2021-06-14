<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DocumentService;
use App\Services\Admin\EventService;
use Illuminate\Support\Facades\Auth;
use App\Services\Admin\ProceedingService;
use App\Services\Admin\UserService;

class AdminHomeController extends Controller
{
    public function index(){
        $userId = Auth::id();

        $proceedingService = new ProceedingService;
        $userProceedings = $proceedingService->getUserActiveProceedings($userId);

        $newProceedginsSinceLastLogin = $proceedingService->getNewProceedginsSinceLastLogin($userId);

        $userService = new UserService;
        $newUsersSinceLastLogin = $userService->getNewUsersSinceLastLogin($userId);

        $documentService = new DocumentService;
        $newDocumentsSinceLastLogin = $documentService->getDocumentsSinceLastLogin($userId);

        $eventService = new EventService;
        $newEventsSinceLastLogin = $eventService->getEventeSinceLastLogin($userId);

        $updateUserLastLogin = $userService->updateLastLoginDate($userId);
        
        return view('admin.index', compact('userProceedings','newProceedginsSinceLastLogin','newUsersSinceLastLogin','newDocumentsSinceLastLogin','newEventsSinceLastLogin'));
    }
}
