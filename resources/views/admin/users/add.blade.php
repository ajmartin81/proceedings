@extends('adminlte::page')

@section('title', 'Añadir nuevo usuario')

@section('content_header')

    <div class="row">
        <div class="col-md-12">
            <h1>Añadir nuevo usuario</h1>
        </div>
    </div>
    
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Correo electrónico *" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre *" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="apellidos" placeholder="Apellidos *" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" class="form-control" name="direccion" placeholder="Dirección">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control" name="telefono" placeholder="Teléfono">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nif" placeholder="DNI/CIF/NIE/Pasaporte">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="rol" class="form-control" required>
                                <option value="" disabled selected hidden>Tipo de usuario *</option>
                                @foreach($roles as $rol)
                                    <option value="{{ $rol->id }}"> {{ $rol->name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-4 ">
                        <input type="submit" class="btn btn-primary w-100" value="Añadir usuario">
                    </div>
                </div>
                
            </form>
            
        </div>
    </div>
    
@stop

@section('js')

@stop
