<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\UserService;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService;
    }

    public function index()
    {
        $users = $this->userService->getUsers();
        return view('admin.users.show',compact('users'));
    }

    public function create()
    {
        $roles = $this->userService->getRoles();
        return view('admin.users.add',compact('roles'));
    }

    public function store(Request $request)
    {
        $data['email']      = $request->get('email');
        $data['password']   = bcrypt(uniqid());
        $data['name']       = $request->get('nombre');
        $data['surname']    = $request->get('apellidos');
        $data['address']    = $request->get('direccion');
        $data['phone']      = $request->get('telefono');
        $data['nif']        = $request->get('nif');
        $rol                = $request->get('rol');

        $user = $this->userService->addUser($data, $rol);

        if($user){
            return redirect()->route('user.proceedings', ['userId' => $user->id]);
        }
        
        return redirect()->back();
    }

    public function edit($userId)
    {
        $user = $this->userService->getUserById($userId);
        $roles = $this->userService->getRoles();

        return view('admin.users.edit', compact('user','roles'));
    }

    public function update(Request $request, $userId)
    {
        $data['email']      = $request->get('email');
        $data['name']       = $request->get('nombre');
        $data['surname']    = $request->get('apellidos');
        $data['address']    = $request->get('direccion');
        $data['phone']      = $request->get('telefono');
        $data['nif']        = $request->get('nif');
        $rol                = $request->get('rol');

        $user = $this->userService->updateUser($userId, $data, $rol);

        if($user){
            return redirect()->route('user.proceedings', ['userId' => $user->id]);
        }
        
        return redirect()->back()->with('error','No se pudo actualizar la informaci??n');
    }
}
