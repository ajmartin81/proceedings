<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Services\Admin\UserService;
use App\Services\Admin\ProceedingService;
use App\Http\Requests\ValidateUserRequest;

class UserController extends Controller
{
    protected $userService;
    protected $proceedingService;

    public function __construct()
    {
        $this->userService = new UserService;
        $this->proceedingService = new ProceedingService;
    }
    
    public function index()
    {
        $user = $this->userService->getUserById(Auth::id());
        //dd($user);
        if($user->isAdmin()){
            return redirect()->route('admin');
        }

        $proceedings = $this->proceedingService->getUserProceedings($user->id);
            
        return view('proceedings', compact('proceedings'));
    }

    public function verifyUser($userId)
    {
        $isAlreadyActivated = $this->userService->isUserActivated($userId);
        $currentUser = Auth::user();

        if(!$isAlreadyActivated && !$currentUser){
            return view('user.activation', compact('userId'));
        }

        return view('user.active');
    }

    public function updateVerifiedUser(ValidateUserRequest $request, $userId)
    {
        $password = $request->get('password');

        $data['password']      = bcrypt($password);
        $data['rgpd_accept_at']       = now();
        $data['email_verified_at']    = now();

        $user = $this->userService->updateUser($userId, $data);

        if($user){
            return redirect()->route('user.proceedings');
        }
        
        return redirect()->back()->with('error','No se pudo completar el registro');
    }
}
