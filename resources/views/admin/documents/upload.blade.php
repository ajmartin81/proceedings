@extends('adminlte::page')

@section('title', 'Añadir documento')

@section('content_header')

    <div class="row">
        <div class="col-md-10">
            <h1>Añadir nuevo documento al expediente {{ $proceeding->reference }}</h1>
        </div>
        <div class="col-md-2">
            <a href="{{ url()->previous() }}" class="btn btn-danger w-100" title="Volver sin guardar"><i class="fas fa-undo"></i>&nbsp;Volver</a>
        </div>
    </div>
    
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('document.store', ['proceedingId' => $proceeding->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    
                    @if($errors->any())
                        <div class="col-12">
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" class="form-control" name="titulo" placeholder="Titulo *" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <input type="file" class="form-control" name="documento" accept=".jpg,.png,.pdf,.doc,.docx" required>
                            <small id="fileHelp" class="form-text text-muted">Máx. 5Mb. Formatos permitidos: jpg, png, doc, pdf.</small>
                        </div>
                    </div>

                    @can('document.hide')
                        <div class="col-12">
                            <div class="form-group">
                                <input type="checkbox" name="visible" id="visible" value="1">
                                <label for="visible" class="font-weight-light">Ocultar a los clientes</label>
                            </div>
                        </div>
                    @endcan
                    
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-4">
                        <input type="submit" class="btn btn-primary w-100" value="Añadir documento">
                    </div>
                </div>
            </form>
            
        </div>
    </div>
    
@stop

@section('js')

    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 5000);
    </script>
@stop
