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

        $proceeding = $this->proceedingService->addProceeding($data, $userId);
        
        $proceedingClients = [];
        foreach($proceeding->users as $client){
            if($client->hasRole('Cliente')){
                array_push($proceedingClients,$client);
            }
        }

        return view('admin.proceedings.proceeding', compact('proceeding','proceedingClients'));
    }

    public function show($proceedingId)
    {
        $proceeding = $this->proceedingService->getProceedingById($proceedingId);

        $proceedingClients = [];
        foreach($proceeding->users as $client){
            if($client->hasRole('Cliente')){
                array_push($proceedingClients,$client);
            }
        }

        return view('admin.proceedings.proceeding', compact('proceeding','proceedingClients'));
    }

    
    public function edit($proceedingId)
    {
        $proceeding = $this->proceedingService->getProceedingById($proceedingId);

        return view('admin.proceedings.edit', compact('proceeding'));
    }

    public function update(Request $request, $proceedingId)
    {
        $data['reference']      = $request->get('referencia');
        $data['title']          = $request->get('titulo');
        $data['site']           = $request->get('dependencias');
        $data['description']    = $request->get('descripcion');

        $proceeding = $this->proceedingService->updateProceeding($data, $proceedingId);

        $proceedingClients = [];
        foreach($proceeding->users as $client){
            if($client->hasRole('Cliente')){
                array_push($proceedingClients,$client);
            }
        }

        return view('admin.proceedings.proceeding', compact('proceeding','proceedingClients'));
    }

    public function delete($proceedingId)
    {
        $proceeding = $this->proceedingService->getProceedingById($proceedingId);

        return view('admin.proceedings.delete', compact('proceeding'));
    }

    public function destroy(Request $request, $proceedingId)
    {
        $confirm = $request->get('confirm');

        $proceeding = $this->proceedingService->getProceedingById($proceedingId);
        $deletedProceeding = null;

        if($proceeding->reference == $confirm){
            $deletedProceeding = $this->proceedingService->deleteProceeding($proceeding);
        }
        
        if($deletedProceeding){
            return redirect()->route('dashboard');
        }

        return redirect()->back();
    }

    public function listUsersForProceeding($proceedingId)
    {
        $proceeding = $this->proceedingService->getProceedingById($proceedingId);
        $users = $this->userService->getUsers();

        return view('admin.proceedings.users', compact('proceeding','users'));
    }

    public function addUserToProceeding(Request $request, $proceedingId)
    {
        $proceeding = $this->proceedingService->getProceedingById($proceedingId);
        $user = $this->userService->getUserById($request->get('user_id'));

        if(!$proceeding->Users->contains($user)){
            $proceeding->Users()->attach($user);
            return response('Usuario añadido al expediente', 200)
                  ->header('Content-Type', 'text/plain');
        }
        
        return response('El usuario ya esta en el expediente', 221)
                ->header('Content-Type', 'text/plain');
        
    }

    public function deleteUserFromProceeding(Request $request, $proceedingId)
    {
        $proceeding = $this->proceedingService->getProceedingById($proceedingId);
        $user = $this->userService->getUserById($request->get('user_id'));

        if($proceeding->Users->contains($user)){
            $proceeding->Users()->detach($user);
            return response('Usuario borrado del expediente', 200)
                  ->header('Content-Type', 'text/plain');
        }
        
        return response('No se elimino del expediente', 221)
                ->header('Content-Type', 'text/plain');
    }

    public function updateStatus(Request $request, $proceedingId)
    {
        $status = $request->get('status');

        $status = $this->proceedingService->setStatus($status, $proceedingId);
        if($status){
            return response('Expediente actualizado', 200)
                  ->header('Content-Type', 'text/plain');
        }
        return response('No se actualizó el expediente', 222)
                ->header('Content-Type', 'text/plain');
    }
}
