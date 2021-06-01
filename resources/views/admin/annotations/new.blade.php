@extends('adminlte::page')

@section('title', 'Añadir nueva nota al expediente')

@section('content_header')

    <div class="row">
        <div class="col-md-12">
            <h1>Añadir nueva nota al expediente {{ $proceeding->reference }}</h1>
        </div>
    </div>
    
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('annotation.store', ['proceedingId' => $proceeding->id]) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" class="form-control" name="titulo" placeholder="Título *" required>
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
                        <input type="submit" class="btn btn-primary w-100" value="Añadir nota">
                    </div>
                </div>
                
            </form>
            
        </div>
    </div>
    
@stop

@section('js')

@stop
