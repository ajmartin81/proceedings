<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Admin\UserService;
use App\Services\Admin\ProceedingService;

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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
