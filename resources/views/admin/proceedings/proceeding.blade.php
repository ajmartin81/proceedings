@extends('adminlte::page')

@section('title', 'Expediente '.$proceeding->reference )

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-gradient-primary">
                    <h1>Expediente {{ $proceeding->reference }}</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card card-outline card-warning">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-11">
                                            <h3>Resumen</h3>
                                        </div>
                                        <div class="col-1">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
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
                                            @if(!$user->hasRole('Colaborador') && !$user->hasRole('Abogado'))
                                                {{ $user->name }} {{ $user->surname }}
                                                @if($loop->count > 1 && !$loop->last)
                                                    ,
                                                @endif
                                            @endif
                                        @endforeach
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="{{ route('proceeding.users.show', ['proceedingId' => $proceeding->id]) }}" type="button" class="btn btn-warning w-100 mb-2" title="Editar clientes"><i class="fas fa-unlock-alt"></i>&nbsp;Estado</a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{ route('proceeding.users.show', ['proceedingId' => $proceeding->id]) }}" type="button" class="btn btn-warning w-100 mb-2" title="Editar clientes"><i class="fas fa-user-edit"></i>&nbsp;Usuarios</a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{ route('proceeding.edit', ['proceedingId' => $proceeding->id]) }}" type="button" class="btn btn-warning w-100 mb-2" title="Editar clientes"><i class="fas fa-edit"></i>&nbsp;Modificar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-outline card-info">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-11">
                                            <h3>Anotaciones</h3>
                                        </div>
                                        <div class="col-1">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @foreach($proceeding->annotations as $annotation)
                                        <p>
                                            <strong>{{ $annotation->title }} :</strong>
                                            {{ $annotation->description}}
                                        </p>
                                        
                                    @endforeach
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <a href="{{ route('annotation.create', ['proceedingId' => $proceeding->id]) }}" type="button" class="btn btn-info w-100" title="Añadir anotación"><i class="fas fa-file-alt"></i>&nbsp;Añadir nota</a>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-outline card-secondary">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-11">
                                            <h3>Eventos</h3>
                                        </div>
                                        <div class="col-1 align-content-end">
                                            <button type="button" class="btn btn-tool " data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @foreach($proceeding->events as $event)
                                        <p>
                                            <strong>{{ substr($event->event_date,0,10) }} | {{ $event->title }} :</strong>
                                            {{ $event->description}}
                                        </p>
                                    @endforeach
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <a href="{{ route('event.create', ['proceedingId' => $proceeding->id]) }}" type="button" class="btn btn-secondary w-100" title="Añadir evento"><i class="fas fa-calendar-plus"></i>&nbsp;Añadir evento</a>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card card-outline card-success">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-11">
                                            <h3>Documentación</h3>
                                        </div>
                                        <div class="col-1">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
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
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <a href="{{ route('document.create', ['proceedingId' => $proceeding->id]) }}" type="button" class="btn btn-success w-100" title="Subir documentación"><i class="fas fa-file-upload"></i>&nbsp;Subir documentación</a>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
