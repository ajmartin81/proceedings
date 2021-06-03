<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Admin\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService;
    }
    public function index()
    {
        $user = $this->userService->getUserById(Auth::id());
        //dd($user);
        if($user->isClient()){
            return view('dashboard');
        }else{
            return redirect()->route('admin');
        }
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
