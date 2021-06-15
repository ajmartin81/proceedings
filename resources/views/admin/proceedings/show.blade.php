@extends('adminlte::page')

@section('title', 'Listado de expedientes')

@section('content_header')

    <div class="row">
        <div class="col-md-12">
            <h1>Listado de expedientes</h1>
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
                    <th>Clientes</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($proceedings as $proceeding)
                        <tr>
                            <td>{{ $proceeding->reference }}</td>
                            <td>{{ $proceeding->title }}</td>
                            <td>
                                @foreach($proceeding->users as $user)
                                {{ $user->name }} {{ $user->surname }}
                                        @if($loop->count > 1 && !$loop->last)
                                            <br>
                                        @endif
                                @endforeach
                            </td>
                            <td class="d-flex justify-content-end">
                                <a href="{{ route('document.create', ['proceedingId' => $proceeding->id]) }}" class="btn btn-success btn-sm mr-2" title="Subir documentación"><i class="fas fa-file-upload"></i></a>
                                <a href="{{ route('annotation.create', ['proceedingId' => $proceeding->id]) }}" class="btn btn-secondary btn-sm mr-2" title="Añadir anotación"><i class="fas fa-file-alt"></i></a>
                                <a href="{{ route('event.create', ['proceedingId' => $proceeding->id]) }}" class="btn btn-secondary btn-sm mr-2" title="Añadir evento"><i class="fas fa-calendar-plus"></i></a>
                                <a href="{{ route('proceeding.show', ['proceedingId' => $proceeding->id]) }}" class="btn btn-info btn-sm" title="Ver expediente"><i class="fas fa-folder-open"></i></a>
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
            autoWidth: false,
            language: { 
            processing: "Procesando...",
            lengthMenu: "Mostrar _MENU_ ",
            zeroRecords: "No se encontraron resultados",
            emptyTable: "Ningún dato disponible en esta tabla",
            infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            search: "_INPUT_",
            searchPlaceholder: "Buscar...",
            infoThousands: ",",
            loadingRecords: "Cargando...",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            info: "Mostrando de _START_ a _END_ de _TOTAL_ entradas"
        }
        });
    </script>
@stop
