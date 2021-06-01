<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proceeding;
use App\Services\Admin\ProceedingService;
use App\Services\Admin\UserService;
use Illuminate\Http\Request;

class AdminProceedingController extends Controller
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
        $proceedings = $this->proceedingService->getProceedings();
        return view('admin.proceedings.show',compact('proceedings'));
    }

    public function userProceedings($userId)
    {
        $proceedings = $this->proceedingService->getUserProceedings($userId);
        $user = $this->userService->getUserById($userId);
        return view('admin.users.proceedings',compact('proceedings','user'));
    }

    public function create($userId)
    {
        $user = $this->userService->getUserById($userId);
        return view('admin.proceedings.new', compact('user'));
    }

    public function store(Request $request, $userId)
    {
        $data['reference']      = $request->get('referencia');
        $data['title']          = $request->get('titulo');
        $data['site']           = $request->get('dependencias');
        $data['description']    = $request->get('descripcion');
        $data['status']         = "Abierto";
        $data['begin_at']       = $request->get('fecha_inicio');
        $data['end_at']         = null;

        $this->proceedingService->addProceeding($data, $userId);
        return redirect()->route('proceedings');
    }

    public function show($proceedingId)
    {
        $proceeding = $this->proceedingService->getProceedingById($proceedingId);

        return view('admin.proceedings.proceeding', compact('proceeding'));
    }

    public function edit(Proceeding $proceeding)
    {
        //
    }

    public function update(Request $request, Proceeding $proceeding)
    {
        //
    }

    public function destroy(Proceeding $proceeding)
    {
        //
    }
}
