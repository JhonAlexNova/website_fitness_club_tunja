@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reservas clases</h1>
                </div>
                <div class="col-sm-6">
                    <!-- <a class="btn btn-primary float-right"
                       href="{{ route('clientes.create') }}">
                        Add New
                    </a> -->
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-header p-2">
                <div class="row">
                    <div class="col-md-4">
                        <label for="filtroNombreClase" class="mb-1">Buscar por nombre de clase</label>
                        <input type="text" id="filtroNombreClase" class="form-control" placeholder="Ej: Yoga, Spinning...">
                    </div>
                    <div class="col-md-3">
                        <label for="filtroFechaClase" class="mb-1">Buscar por fecha de clase</label>
                        <input type="date" id="filtroFechaClase" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="filtroHoraClase" class="mb-1">Buscar por hora de clase</label>
                        <input type="time" id="filtroHoraClase" class="form-control">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" id="btnLimpiarFiltros" class="btn btn-secondary w-100">
                            Limpiar filtros
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body p-2">
                @include('admin.reservas.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- modal -->
     <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="modalClientesClase" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Usuarios inscritos en: <b class="nameClase"></b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="usuarios-clase"></div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push("page_scripts")
<script>
    $(document).ready(function() {

        // Evento click para los botones de clase 'btn-inscritos'
        $(document).on('click', '.btn-inscritos', function(e) {
            e.preventDefault();

            let fechaReserva = $(this).data('fecha_reserva');

            $.get("/admon/inscritos-clase", { fecha_reserva: fechaReserva })
                .done(function(data) {
                    $(".usuarios-clase").html(data);
                    $("#modalClientesClase").modal("show");
                })
                .fail(function() {
                    console.error('Error al obtener los datos de inscritos.');
                });
        });

        // --- FILTROS DE LA TABLA DE RESERVAS ---
        function getReservasTable() {
            var tabla = $('#tableReservasClases');
            if (tabla.length && $.fn.DataTable.isDataTable(tabla)) {
                return tabla.DataTable();
            }
            return null;
        }

        // Filtro por nombre de clase (columna 0)
        function aplicarFiltroNombre() {
            var dt = getReservasTable();
            if (dt) {
                dt.column(0).search($('#filtroNombreClase').val()).draw();
            }
        }

        // Filtro combinado de fecha + hora (columna 1)
        function aplicarFiltroFechaHora() {
            var dt = getReservasTable();
            if (!dt) return;

            var fecha = $('#filtroFechaClase').val(); // YYYY-MM-DD
            var hora  = $('#filtroHoraClase').val();  // HH:MM

            if (!fecha && !hora) {
                dt.column(1).search('').draw();
                return;
            }

            // Construimos el término de búsqueda combinando lo que el usuario haya llenado
            // Ej: solo fecha -> "2025-01-15"
            //     solo hora  -> "18:00"
            //     ambos      -> "2025-01-15 18:00" (usamos regex para que coincida aunque haya segundos u otro separador)
            var termino;
            if (fecha && hora) {
                // regex: permite cualquier caracter entre fecha y hora (espacio, T, etc.)
                termino = fecha.replace(/[-]/g, '-') + '.*' + hora;
                dt.column(1).search(termino, true, false).draw();
            } else if (fecha) {
                dt.column(1).search(fecha, true, false).draw();
            } else {
                // solo hora: buscamos esa hora en cualquier parte de la celda
                dt.column(1).search(hora, true, false).draw();
            }
        }

        $('#filtroNombreClase').on('keyup change', aplicarFiltroNombre);
        $('#filtroFechaClase').on('change', aplicarFiltroFechaHora);
        $('#filtroHoraClase').on('change', aplicarFiltroFechaHora);

        // Limpiar filtros
        $('#btnLimpiarFiltros').on('click', function() {
            $('#filtroNombreClase').val('');
            $('#filtroFechaClase').val('');
            $('#filtroHoraClase').val('');
            var dt = getReservasTable();
            if (dt) {
                dt.columns().search('').draw();
            }
        });
    });
</script>
@endpush