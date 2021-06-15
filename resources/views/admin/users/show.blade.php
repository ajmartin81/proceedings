@extends('adminlte::page')

@section('title', 'Listado de usuarios')

@section('content_header')

    <div class="row">
        <div class="col-md-10">
            <h1>Listado de usuarios</h1>
        </div>
        <div class="col-md-2">
            @can('user.add')
                <a href="{{ route('user.create') }}" class="btn btn-primary w-100" >Añadir usuario</a>
            @endcan
        </div>
    </div>
    
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="usuarios">
                <thead>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }} {{ $user->surname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td class="d-flex justify-content-end">
                                @can('proceeding.add')
                                    @if($user->hasRole('Cliente'))
                                        <a href="{{ route('proceeding.create', ['userId' => $user->id]) }}" class="text-success mr-3 title="Crear nuevo expediente"><i class="fas fa-folder-plus"></i></a>
                                    @endif
                                @endcan
                                <a href="{{ route('user.proceedings', ['userId' => $user->id]) }}" class="text-info mr-3" title="Ver expedientes"><i class="fas fa-folder-open"></i></a>
                                <a href="{{ route('user.edit', ['userId' => $user->id]) }}" type="button" class="text-secondary" title="Editar cliente"><i class="fas fa-user-cog"></i></a>
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
        $('#usuarios').DataTable({
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
