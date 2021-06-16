@extends('adminlte::page')

@section('title', 'Modificar evento')

@section('content_header')

    <div class="row">
        <div class="col-md-10">
            <h1>Modificar evento</h1>
        </div>
        <div class="col-md-2">
            <a href="{{ url()->previous() }}" class="btn btn-danger w-100" title="Volver sin guardar"><i class="fas fa-undo"></i>&nbsp;Volver</a>
        </div>
    </div>
    
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('event.update', ['eventId' => $event->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="titulo" placeholder="Título *" value="{{ $event->title }}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="datetime-local" class="form-control" name="fecha_inicio" placeholder="Fecha de inicio" value="{{ substr(date("c", strtotime($event->start)),0,16) }}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="datetime-local" class="form-control" name="fecha_fin" placeholder="Fecha de fin" value="{{ substr(date("c", strtotime($event->end)),0,16) }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea type="text" class="form-control" name="descripcion" placeholder="Descripción" rows="10">{{ $event->description }}</textarea>
                        </div>
                    </div>
                </div>
                
                <div class="row d-flex justify-content-center">
                    <div class="col-md-4 ">
                        <input type="submit" class="btn btn-primary w-100" value="Actualizar evento">
                    </div>
                </div>
                
            </form>
            
        </div>
    </div>
    
@stop

@section('js')

@stop
