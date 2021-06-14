<?php

namespace App\Http\Controllers;

use App\Models\Proceeding;
use Illuminate\Support\Facades\Auth;
use App\Services\Admin\ProceedingService;
use App\Services\Admin\UserService;

class ProceedingController extends Controller
{
    protected $proceedingService;
    protected $userService;

    public function __construct()
    {
        $this->proceedingService = new ProceedingService;
        $this->userService = new UserService;
    }

    public function index()
    {
        $user = $this->userService->getUserById(Auth::id());
        
        $proceedings = $this->proceedingService->getUserProceedings($user->id);
            
        return view('proceedings.show', compact('proceedings'));
    }
    

   
}
