@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Clientes</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('clientes.create') }}">
                        Agregar nuevo
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-3">

                <div class="mb-3">
                    <button id="btn-filtro-codigo" class="btn btn-outline-info btn-sm" type="button">
                        <i class="fas fa-tag mr-1"></i>
                        Ver solo con código de creador
                    </button>
                    <span id="filtro-badge" class="badge badge-info ml-2" style="display:none;">
                        Filtro activo
                    </span>
                </div>

                @include('clientes.table')

                <div class="card-footer clearfix">
                    <div class="float-right"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
<script>
$(document).ready(function () {

    var filtroActivo = false;

    // Registrar filtro personalizado en DataTables
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        // Solo aplica a esta tabla
        if (settings.nTable.id !== 'clientes-table') return true;
        if (!filtroActivo) return true;

        // Columna 14 = Código Invitación
        // data[14] contiene el texto plano de la celda
        var texto = data[14] ? data[14].trim() : '';
        return texto !== '' && texto !== '—';
    });

    $('#btn-filtro-codigo').on('click', function () {
        filtroActivo = !filtroActivo;

        // Redibujar la tabla con el filtro aplicado
        $('#clientes-table').DataTable().draw();

        if (filtroActivo) {
            $(this).removeClass('btn-outline-info').addClass('btn-info');
            $(this).html('<i class="fas fa-times mr-1"></i> Quitar filtro');
            $('#filtro-badge').show();
        } else {
            $(this).removeClass('btn-info').addClass('btn-outline-info');
            $(this).html('<i class="fas fa-tag mr-1"></i> Ver solo con código de creador');
            $('#filtro-badge').hide();
        }
    });

});
</script>
@endpush