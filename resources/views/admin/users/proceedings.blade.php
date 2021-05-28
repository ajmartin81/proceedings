@extends('adminlte::page')

@section('title', 'Listado de expedientes')

@section('content_header')

    <div class="row">
        <div class="col-md-10">
            <h1>{{ $user->name}} {{ $user->surname }}</h1>
        </div>
        <div class="col-md-2 d-flex justify-content-end">
            <a href="{{ route('proceeding.create', ['userId' => $user->id]) }}" class="btn btn-primary mr-2" title="Añadir expediente">Añadir expediente</a>
            <a href="#" type="button" class="btn btn-secondary" title="Editar cliente"><i class="fas fa-user-cog"></i></a>
        </div>
    </div>
    
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="expedientes">
                <thead>
                    <th>Referencia</th>
                    <th>Título</th>
                    <th>Estado</th>
                    <th>Fecha inicio</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($proceedings as $proceeding)
                        <tr>
                            
                            <td>{{ $proceeding->reference }}</td>
                            <td>{{ $proceeding->title }}</td>
                            <td>{{ $proceeding->status }}</td>
                            <td>{{ substr($proceeding->begin_at,0,10) }}</td>
                            <td class="d-flex justify-content-end">
                                <a href="#" type="button" class="btn btn-success mr-2" title="Subir documentación"><i class="fas fa-file-upload"></i></a>
                                <a href="#" type="button" class="btn btn-secondary mr-2" title="Añadir anotación"><i class="fas fa-file-alt"></i></a>
                                <a href="#" type="button" class="btn btn-secondary mr-2" title="Añadir evento"><i class="fas fa-calendar-plus"></i></a>
                                <a href="#" type="button" class="btn btn-info" title="Ver expediente"><i class="fas fa-folder-open"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@stop

@section('js')

    <script>
        $('#expedientes').DataTable({
            responsive: {
                details: false
            },
            columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: -1 },
                { orderable: false, targets: -1 }
            ],
            autoWidth: false
        });
    </script>
@stop
