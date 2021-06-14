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
                                            <strong>Clientes: </strong>
                                        @else
                                            <strong>Cliente: </strong> 
                                        @endif
                
                                        @foreach($proceeding->users as $user)
                                            @if($user->hasRole('Cliente'))
                                                {{ $user->name }} {{ $user->surname }}
                                                @if($loop->count > 1 && !$loop->last && $user->hasRole('Cliente'))
                                                    ,
                                                @endif
                                            @endif
                                        @endforeach
                                    </p>
                                    @if($proceeding->site)
                                        <p><strong>Dependencias:</strong> {{ $proceeding->site}} </p>
                                    @endif
                                    <p><strong>Estado:</strong><span id="estado_actual"> {{ $proceeding->status}} </span></p>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-4">
                                            @can('status.edit')
                                                <button type="button" class="btn btn-warning w-100 mb-2" data-toggle="modal" data-target="#cambiar_estado"><i class="fas fa-unlock-alt"></i>&nbsp;Estado</button>
                                            @endcan
                                        </div>
                                        @can('admin')
                                            <div class="col-md-4">
                                                @if($proceeding->status != 'Cerrado')
                                                    <a href="{{ route('proceeding.users.show', ['proceedingId' => $proceeding->id]) }}" class="btn btn-warning w-100 mb-2" title="Editar clientes"><i class="fas fa-user-edit"></i>&nbsp;Usuarios</a>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                @if($proceeding->status != 'Cerrado')
                                                    <a href="{{ route('proceeding.edit', ['proceedingId' => $proceeding->id]) }}" class="btn btn-warning w-100 mb-2" title="Editar clientes"><i class="fas fa-edit"></i>&nbsp;Modificar</a>
                                                @endif
                                            </div>
                                        @endcan
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
                                            @if($proceeding->status != 'Cerrado')
                                                <a href="{{ route('annotation.create', ['proceedingId' => $proceeding->id]) }}" class="btn btn-info w-100" title="Añadir anotación"><i class="fas fa-file-alt"></i>&nbsp;Añadir nota</a>
                                            @endif
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
                                            <strong>{{ $event->start }} | {{ $event->title }}</strong>
                                            @if($event->description)
                                            <br>
                                                {{ $event->description }}
                                            @endif
                                        </p>
                                    @endforeach
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            @can('event.add')
                                                @if($proceeding->status != 'Cerrado')
                                                    <a href="{{ route('event.create', ['proceedingId' => $proceeding->id]) }}" class="btn btn-secondary w-100" title="Añadir evento"><i class="fas fa-calendar-plus"></i>&nbsp;Añadir evento</a>
                                                @endif
                                            @endcan
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
                                                        <a href="{{ route('document.show', ['documentId' => $document->id]) }}" class="btn btn-success mr-2" title="Descargar documentación"><i class="fas fa-file-download"></i></a>
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
                                            @if($proceeding->status != 'Cerrado')
                                                <a href="{{ route('document.create', ['proceedingId' => $proceeding->id]) }}" class="btn btn-success w-100" title="Subir documentación"><i class="fas fa-file-upload"></i>&nbsp;Subir documentación</a>
                                            @endif
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
        <!-- Status Modal -->
        <div class="modal fade" id="cambiar_estado" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Modificar estado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                
                    <div class="modal-body justify-content-center">
                        <select name="estado" id="estado" class="form-control">
                            <option value="Abierto">Abierto</option>
                            <option value="Presentado">Presentado</option>
                            <option value="Pendiente de documentación">Pendiente de documentación</option>
                            <option value="Pendiente de respuesta">Pendiente de respuesta</option>
                            <option value="Reclamado">Reclamado</option>
                            <option value="Cerrado">Cerrado</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="actualizar_estado()">Guardar</button>
                    </div>
                
            </div>
            </div>
        </div>
    </div>
    





    
@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })
    @can('status.edit')
        function actualizar_estado() {
            $("#cambiar_estado").modal("hide");
            setInterval(function(){ 
                $('.modal-backdrop').hide();
                $("body").removeClass("modal-open");
            }, 200);
            
            $.ajax({
                url:"{{ route('status.update', ['proceedingId' => $proceeding->id]) }}",
                type: "POST",
                data:{
                    status: $("#estado").val(),
                    _token: "{{ csrf_token() }}",
                },
                success: function(response){
                    $("#estado_actual").text($("#estado").val());

                    Toast.fire({
                        icon: 'success',
                        title: 'Estado actualizado'
                    })
                    
                },
                error: function(response){
                    Toast.fire({
                        icon: 'error',
                        title: 'No se actualizó el estado'
                    })
                }
            })
        }
    @endcan
</script>
@stop
