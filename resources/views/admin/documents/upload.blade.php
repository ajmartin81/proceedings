@extends('adminlte::page')

@section('title', 'Añadir documento')

@section('content_header')

    <div class="row">
        <div class="col-md-12">
            <h1>Añadir nuevo documento al expediente {{ $proceeding->reference }}</h1>
        </div>
    </div>
    
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('document.store', ['proceedingId' => $proceeding->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" class="form-control" name="titulo" placeholder="Titulo *" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <input type="file" class="form-control" name="documento" placeholder="Dependencias" required>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-4 ">
                        <input type="submit" class="btn btn-primary w-100" value="Añadir documento">
                    </div>
                </div>
                
            </form>
            
        </div>
    </div>
    
@stop

@section('js')

@stop
