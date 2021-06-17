@extends('adminlte::page')

@section('title', 'Panel de control')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="small-box bg-gradient-warning text-white">
            <div class="inner">
              <h3>{{ $newProceedginsSinceLastLogin }}</h3>
              <p>Nuevos expedientes</p>
            </div>
            <div class="icon">
              <i class="fas fa-folder-open"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box bg-gradient-primary">
            <div class="inner">
              <h3>{{ $newUsersSinceLastLogin }}</h3>
              <p>Nuevos usuarios</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-plus"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box bg-gradient-success">
            <div class="inner">
              <h3>{{ $newDocumentsSinceLastLogin }}</h3>
              <p>Nuevos documentos</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-alt"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box bg-gradient-secondary">
            <div class="inner">
              <h3>{{ $newEventsSinceLastLogin }}</h3>
              <p>Nuevos eventos</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card card-outline card-warning">
            <div class="card-header">
              <h3 class="card-title">Expedientes abiertos</h3>
          
              <div class="card-tools">
                
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              </div>
              
            </div>
            
            <div class="card-body">
              <table class="table table-striped table-sm" id="expedientes">
                <thead>
                    <th>Referencia</th>
                    <th>Título</th>
                    <th>Fecha inicio</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($userProceedings as $proceeding)
                        <tr>
                            
                            <td>{{ $proceeding->reference }}</td>
                            <td>{{ $proceeding->title }}</td>
                            <td>{{ substr($proceeding->begin_at,0,10) }}</td>
                            <td class="d-flex justify-content-end">
                                <a href="{{ route('proceeding.show', ['proceedingId' => $proceeding->id]) }}" class="text-info" title="Ver expediente"><i class="fas fa-folder-open"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            
          </div>
    </div>
    <div class="col-md-6">
        <div class="card card-outline card-secondary" id="eventos">
            <div class="card-header">
              <h3 class="card-title">Mi calendario</h3>
          
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              </div>
              
            </div>
            
            <div class="card-body">
                <div id='calendario'></div>
            </div>
          </div>
          
    </div>
</div>
  
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.2/main.min.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.2/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.2/locales/es.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $.ajaxSetup({
                headers:{
                    'X-CRSF-TOKEN' : $('meta[name="crsf-token"]').attr('content')
                }
            });

          var calendario = document.getElementById('calendario');
          var calendar = new FullCalendar.Calendar(calendario, {
            headerToolbar:{
                left:'',
                center:'title',
                right:'',
            },
            footerToolbar:{
                left:'dayGridMonth,dayGridWeek,dayGridDay',
                center:'',
                right:'prev,next today',
            },
            events:'{{ route('user.events') }}',
            themeSystem: 'bootstrap',
            initialView: 'dayGridWeek',
            locale: 'es',
            contentHeight:"auto",
            expandRows:true,
            fixedWeekCount:false,
            eventClick: function(info) {
              let start = info.event.start;
              var startTime =
                ("0" + start.getHours()).slice(-2) + ":" +
                ("0" + start.getMinutes()).slice(-2);
              let end = info.event.end;
              var endTime =
                ("0" + end.getHours()).slice(-2) + ":" +
                ("0" + end.getMinutes()).slice(-2);
              swal.fire(
                startTime+"/"+endTime+" - "+info.event.title
              )
            }
          });
          
          calendar.render();
          
        });

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
