@extends('adminlte::page')

@section('title', 'Listado de usuarios')

@section('content_header')

    <div class="row">
        <div class="col-md-10">
            <h1>Listado de usuarios</h1>
        </div>
        <div class="col-md-2">
            <a href="{{ route('user.create') }}" class="btn btn-primary w-100" >Añadir usuario</a>
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
                                <a href="{{ route('proceeding.create', ['userId' => $user->id]) }}" class="btn btn-success mr-3" title="Crear nuevo expediente"><i class="fas fa-folder-plus"></i></a>
                                <a href="{{ route('user.proceedings', ['userId' => $user->id]) }}" class="btn btn-info mr-3" title="Ver expedientes"><i class="far fa-folder-open"></i></a>
                                <a href="#" type="button" class="btn btn-secondary" title="Editar cliente"><i class="fas fa-user-cog"></i></a>
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
            autoWidth: false
        });
    </script>
@stop
