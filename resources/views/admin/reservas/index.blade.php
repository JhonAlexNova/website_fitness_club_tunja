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
        $('.btn-inscritos').click(function(e) {
            e.preventDefault();

            // Obtener la fecha de reserva del data-atributo
            let fechaReserva = $(this).data('fecha_reserva');

            // Realizar la solicitud $.get con la fecha de reserva
            $.get("/admon/inscritos-clase", { fecha_reserva: fechaReserva })
                .done(function(data) {
                    $(".usuarios-clase").html(data);
                    $("#modalClientesClase").modal("show");
                    // Aquí puedes actualizar la vista o mostrar los datos en un modal
                })
                .fail(function() {
                    console.error('Error al obtener los datos de inscritos.');
                });
        });
    });
</script>
@endpush

