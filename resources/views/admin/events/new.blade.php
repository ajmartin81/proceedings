@extends('adminlte::page')

@section('title', 'Añadir nueva nota al expediente')

@section('content_header')

    <div class="row">
        <div class="col-md-12">
            <h1>Añadir nuevo evento al expediente {{ $proceeding->reference }}</h1>
        </div>
    </div>
    
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('event.store', ['proceedingId' => $proceeding->id]) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-9">
                        <div class="form-group">
                            <input type="text" class="form-control" name="titulo" placeholder="Título *" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="date" class="form-control" name="fecha_inicio" placeholder="Fecha de inicio" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea type="text" class="form-control" name="descripcion" placeholder="Descripción" rows="10"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="row d-flex justify-content-center">
                    <div class="col-md-4 ">
                        <input type="submit" class="btn btn-primary w-100" value="Añadir evento">
                    </div>
                </div>
                
            </form>
            
        </div>
    </div>
    
@stop

@section('js')

@stop
