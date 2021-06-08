@extends('adminlte::page')

@section('title', 'Añadir nuevo expediente')

@section('content_header')

    <div class="row">
        <div class="col-md-10">
            <h1>Editar expediente {{ $proceeding->reference }}</h1>
        </div>
        <div class="col-md-2">
            <a href="{{ url()->previous() }}" class="btn btn-danger w-100" title="Volver sin guardar"><i class="fas fa-undo"></i>&nbsp;Volver</a>
        </div>
    </div>
    
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('proceeding.update', ['proceedingId' => $proceeding->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="referencia" placeholder="Referencia *" value="{{ $proceeding->reference }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="dependencias" placeholder="Dependencias" value="{{ $proceeding->site }}" >
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" class="form-control" name="titulo" placeholder="Título *" value="{{ $proceeding->title }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea type="text" class="form-control" name="descripcion" placeholder="Descripción" rows="10">{{ $proceeding->description }}</textarea>
                        </div>
                    </div>
                </div>
                
                <div class="row d-flex justify-content-center">
                    <div class="col-md-4 ">
                        <input type="submit" class="btn btn-primary w-100" value="Modificar expediente">
                    </div>
                </div>
                
            </form>
            
        </div>
    </div>
    
@stop

@section('js')

@stop
