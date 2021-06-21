@extends('adminlte::page')

@section('title', 'Expediente '.$proceeding->reference )

@section('css')
    <style>
        .show-read-more .more-text{
            display: none;
        }
    </style>
@stop
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
                
                                    <p class="show-read-more">
                                        {{ $proceeding->description }}
                                    </p>
                                    <p>
                                        @if(count($proceedingClients) > 1)
                                            <strong>Clientes: </strong>
                                        @else
                                            <strong>Cliente: </strong> 
                                        @endif
                
                                        @foreach($proceedingClients as $user)
                                            @if(!$loop->first && $loop->count > 1)
                                                ,
                                            @endif
                                                {{ $user->name }} {{ $user->surname }}
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
                                        <div class="row" id="annotation{{ $annotation->id }}">
                                            <div class="col-10">
                                                <strong>{{ $annotation->title }} :</strong>
                                                <span class="show-read-more">
                                                     {{ $annotation->description}}
                                                </span>
                                            </div>
                                            <div class="col-1">
                                                @if(Auth::id() == $annotation->user_id || auth()->user()->can('annotation.edit'))
                                                    <a href="{{ route('annotation.edit', ['annotationId' => $annotation->id]) }}" class="text-secondary" title="Modificar anotación"><i class="fas fa-edit"></i></a>
                                                @endif
                                            </div>
                                            <div class="col-1">
                                                @if(Auth::id() == $annotation->user_id || auth()->user()->can('annotation.destroy'))
                                                    <a href="{{ route('annotation.delete', ['annotationId' => $annotation->id]) }}" class="text-danger delete-confirm" data-id="annotation{{ $annotation->id }}" title="Eliminar anotación"><i class="fas fa-trash-alt"></i></a>
                                                @endif
                                            </div>
                                        </div>
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
                                        <div class="row" id="event{{ $event->id }}">
                                            <div class="col-10">
                                                <strong>{{ $event->start }} | {{ $event->title }}</strong>
                                                @if($event->description)
                                                <p class="show-read-more">
                                                    {{ $event->description }}
                                                </p>
                                                    
                                                @endif
                                            </div>
                                            <div class="col-1">
                                                @if(Auth::id() == $event->user_id || auth()->user()->can('event.edit'))
                                                    <a href="{{ route('event.edit', ['eventId' => $event->id]) }}" class="text-secondary" title="Modificar evento"><i class="fas fa-edit"></i></a>
                                                @endif
                                            </div>
                                            <div class="col-1">
                                                @if(Auth::id() == $event->user_id || auth()->user()->can('event.destroy'))
                                                    <a href="{{ route('event.delete', ['eventId' => $event->id]) }}" class="text-danger delete-confirm" data-id="event{{ $event->id }}" title="Eliminar evento"><i class="fas fa-trash-alt"></i></a>
                                                @endif
                                            </div>
                                        </div>
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
                                                @if(!$document->visible || auth()->user()->can('document.hide'))
                                                    <tr id="document{{ $document->id }}">
                                                        <td><a href="{{ route('document.show', ['documentId' => $document->id]) }}" title="Descargar documento">{{ $document->title }}</a></td>
                                                        <td class="d-flex justify-content-end">
                                                            
                                                            @can('document.hide')
                                                                <a href="{{ route('document.update', ['documentId' => $document->id]) }}" class="text-primary update-document" data-id="document{{ $document->id }}hide" id="document{{ $document->id }}hide" title="Mostrar/ocultar a los clientes">
                                                                    @if($document->visible)
                                                                        <i class="fas fa-eye-slash"></i>
                                                                    @else
                                                                        <i class="far fa-eye"></i>
                                                                    @endif
                                                                </a>
                                                            @endcan
                                                            @if(Auth::id() == $document->user_id || auth()->user()->can('admin'))
                                                                <a href="{{ route('document.delete', ['documentId' => $document->id]) }}" class="text-danger delete-confirm ml-3" data-id="document{{ $document->id }}" title="Eliminar documento"><i class="fas fa-trash-alt"></i></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
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
    $(document).ready(function(){
        var maxLength = 200;
        $(".show-read-more").each(function(){
            var myStr = $(this).text();
            if(myStr.length > maxLength){
                var newStr = myStr.substring(0, maxLength);
                var removedStr = myStr.substring(maxLength, myStr.length);
                $(this).empty().html(newStr);
                $(this).append(' <a href="javascript:void(0);" class="read-more">ver más...</a>');
                $(this).append('<span class="more-text">' + removedStr + '</span>');
            }
        });
        $(".read-more").click(function(){
            $(this).siblings(".more-text").contents().unwrap();
            $(this).remove();
        });
    });

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
          timer: 1500,
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

    $('.delete-confirm').on('click', function (event) {
        event.preventDefault();
        const event_url = $(this).attr('href');
        const current_event = '#' + $(this).attr('data-id');
        Swal.fire({
            title: '¿Deseas continuar?',
            text: 'La entrada se borrará de forma permanente',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                url: event_url,
                type: "DELETE",
                data:{
                    _token: "{{ csrf_token() }}",
                },
                success: function(response){
                    $(current_event).remove();
                    
                    Toast.fire({
                        icon: 'success',
                        title: 'Eliminado'
                    })
                    
                },
                error: function(response){
                    Toast.fire({
                        icon: 'error',
                        title: 'Error'
                    })
                }
            })
            }
        });
    });
    @can('document.hide')
        $('.update-document').on('click', function (event) {
            event.preventDefault();
            const document_url = $(this).attr('href');
            const current_document = '#' + $(this).attr('data-id');
            $.ajax({
                url: document_url,
                type: "PUT",
                data:{
                    _token: "{{ csrf_token() }}",
                },
                success: function(response){
                    if($(current_document).html().includes('slash')){
                        $(current_document).html('<i class="far fa-eye"></i>');
                    }else{
                        $(current_document).html('<i class="far fa-eye-slash"></i>');
                    }
                    
                    Toast.fire({
                        icon: 'success',
                        title: 'Actualizado'
                    })
                    
                },
                error: function(response){
                    Toast.fire({
                        icon: 'error',
                        title: 'Error'
                    })
                }
            })
        });
    @endcan
</script>
@stop
