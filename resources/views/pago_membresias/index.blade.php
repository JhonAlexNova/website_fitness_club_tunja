@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pago Membresias</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('pagoMembresias.create') }}">
                        Add New
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-header">
                <form method="GET" action="{{ route('pagoMembresias.index') }}" class="form-inline">
                    <div class="form-group mr-2">
                        <label for="fecha_desde" class="mr-2">Desde:</label>
                        <input type="date" name="fecha_desde" id="fecha_desde"
                               class="form-control"
                               value="{{ $fechaDesde ?? '' }}">
                    </div>

                    <div class="form-group mr-2">
                        <label for="fecha_hasta" class="mr-2">Hasta:</label>
                        <input type="date" name="fecha_hasta" id="fecha_hasta"
                               class="form-control"
                               value="{{ $fechaHasta ?? '' }}">
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">
                        <i class="fas fa-search"></i> Filtrar
                    </button>

                    @if(($fechaDesde ?? null) || ($fechaHasta ?? null))
                        <a href="{{ route('pagoMembresias.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Limpiar
                        </a>
                    @endif
                </form>
            </div>

            <div class="card-body p-0">
                @include('pago_membresias.table')

                <div class="card-footer clearfix">
                    <div class="float-right">

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection