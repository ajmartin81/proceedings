@extends('adminlte::page')

@section('title', 'Eliminar expediente')

@section('content_header')

    <div class="row">
        <div class="col-md-10">
            <h1>Eliminar expediente {{ $proceeding->reference }}</h1>
        </div>
        <div class="col-md-2">
            <a href="{{ url()->previous() }}" class="btn btn-danger w-100" title="Volver sin guardar"><i class="fas fa-undo"></i>&nbsp;Volver</a>
        </div>
    </div>
    
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <form action="{{ route('proceeding.destroy', ['proceedingId' => $proceeding->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="alert alert-info" role="alert">
                            <h4 class="alert-heading">Confirme que desea eliminar el expediente con ref: {{ $proceeding->reference }}</h4>
                            <p>Esta acción es irreversible y borrará el contenido del expediente asi como la documentación adjunta</p>
                            <hr>
                            <p class="mb-0">Introduzca la referencia del expediente confirmar la eliminación</p>
                            <div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="confirm" placeholder="Referencia" required>
                                </div>
                            </div>
                        </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-danger w-100" value="Eliminar expediente">
                    </div>
                </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
    
@stop
