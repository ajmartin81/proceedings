@extends('adminlte::page')

@section('title', 'Listado de usuarios')

@section('content_header')

    <div class="row">
        <div class="col-md-12">
            <h1>Expediente {{ $proceeding->reference }}</h1>
        </div>
    </div>
    
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Selecciona los usuarios a añadir</h4>
        </div>
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
                                <a href="#" class="btn btn-info mr-3" onclick="adduser({{$user->id}})" title="Añadir usuario al expediente"><i class="fas fa-user-plus"></i></a>
                                <a href="#" class="btn btn-danger mr-3" onclick="deleteuser({{$user->id}})" title="Borrar usuario del expediente"><i class="fas fa-user-minus"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        function adduser(user){
            $.ajax({
                url:"{{ route('proceeding.users.add', ['proceedingId' => $proceeding->id]) }}",
                type: "POST",
                data:{
                    user_id: user,
                    _token: "{{ csrf_token() }}",
                },
                success: function(response){
                    Toast.fire({
                        icon: 'success',
                        title: 'Añadido al expediente'
                    })
                },
                statusCode: {
                    221: function(response){
                        Toast.fire({
                            icon: 'info',
                            title: 'Ya está en el expediente'
                        })
                    }
                },
                error: function(response){
                    Toast.fire({
                        icon: 'error',
                        title: 'No se añadió al expediente'
                    })
                }
            })
        }

        function deleteuser(user){
            $.ajax({
                url:"{{ route('proceeding.users.delete', ['proceedingId' => $proceeding->id]) }}",
                type: "DELETE",
                data:{
                    user_id: user,
                    _token: "{{ csrf_token() }}",
                },
                success: function(response){
                    Toast.fire({
                        icon: 'success',
                        title: 'Borrado del expediente'
                    })
                },
                statusCode: {
                    221: function(response){
                        Toast.fire({
                            icon: 'info',
                            title: 'No está en el expediente'
                        })
                    }
                },
                error: function(response){
                    Toast.fire({
                        icon: 'error',
                        title: 'No se borró al expediente'
                    })
                }
            })
        }
        
    </script>
    
@stop