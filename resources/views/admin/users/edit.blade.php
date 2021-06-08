@extends('adminlte::page')

@section('title', 'Editar usuario')

@section('content_header')

    <div class="row">
        <div class="col-md-10">
            <h1>Editar usuario</h1>
        </div>
        <div class="col-md-2">
            <a href="{{ url()->previous() }}" class="btn btn-danger w-100" title="Volver sin guardar"><i class="fas fa-undo"></i>&nbsp;Volver</a>
        </div>
    </div>
    
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('user.update', ['userId' => $user->id]) }}" method="POST">
                @csrf
                @method("PUT")
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Correo electrónico *" value="{{ $user->email }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre *" value="{{ $user->name}}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="apellidos" placeholder="Apellidos *" value="{{ $user->surname}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" class="form-control" name="direccion" placeholder="Dirección" value="{{ $user->address }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control" name="telefono" placeholder="Teléfono" value="{{ $user->phone }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nif" placeholder="DNI/CIF/NIE/Pasaporte" value="{{ $user->nif }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="rol" class="form-control" required>
                                <option value="" disabled selected hidden>Tipo de usuario *</option>
                                @foreach($roles as $rol)
                                    <option value="{{ $rol->id }}" {{ $user->hasRole($rol) ? 'selected' : '' }}> {{ $rol->name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-4 ">
                        <input type="submit" class="btn btn-primary w-100" value="Modificar usuario">
                    </div>
                </div>
                
            </form>
            
        </div>
    </div>
    
@stop

@section('js')

@stop
