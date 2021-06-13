<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Admin\ProceedingService;

class AdminHomeController extends Controller
{
    public function index(){
        $userId = Auth::id();

        $proceedingService = new ProceedingService;
        $userProceedings = $proceedingService->getUserActiveProceedings($userId);

        return view('admin.index', compact('userProceedings'));
    }
}
