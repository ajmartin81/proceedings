@extends('adminlte::page')

@section('title', 'Expediente '.$proceeding->reference )

@section('content_header')

    <div class="row">
        <div class="col-md-12">
            <h1>Expediente {{ $proceeding->reference }}</h1>
        </div>
    </div>
    
@stop

@section('content')

    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h3>Resumen</h3>
                </div>
                <div class="card-body">
                    <h4>{{ $proceeding->title }}</h4>

                    <p>
                        {{ $proceeding->description }}
                    </p>
                    <p>
                        @if($proceeding->users->count() > 1)
                            <span>Clientes: </span>
                        @else
                            <span>Cliente: </span> 
                        @endif

                        @foreach($proceeding->users as $user)
                            @if(!$user->hasRole('Colaborador'))
                                {{ $user->name }} {{ $user->surname }}
                                @if($loop->count > 1 && !$loop->last)
                                    ,
                                @endif
                            @endif
                        @endforeach
                    </p>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Anotaciones</h3>
                </div>
                <div class="card-body">
                    @foreach($proceeding->annotations as $annotation)
                        <p>
                            <strong>{{ $annotation->title }} :</strong>
                            {{ $annotation->description}}
                        </p>
                        
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Eventos</h3>
                </div>
                <div class="card-body">
                    @foreach($proceeding->events as $event)
                        <p>
                            <strong>{{ substr($event->event_date,0,10) }} | {{ $event->title }} :</strong>
                            {{ $event->description}}
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h3>Documentación</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="documentos">
                        <thead>
                            <th>Nombre</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($proceeding->documents as $document)
                                <tr>
                                    <td>{{ $document->title }}</td>
                                    <td class="d-flex justify-content-end">
                                        <a href="{{ route('document.show', ['documentId' => $document->id]) }}" type="button" class="btn btn-success mr-2" title="Descargar documentación"><i class="fas fa-file-download"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    
@stop

@section('js')
<script>
    $('#documentos').DataTable({
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
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
