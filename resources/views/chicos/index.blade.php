@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chicos</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right {{is_null($cierreGlobal->fecha_fin) && !is_null($cierreGlobal->cierre_caja)?'disabled':''}}"
                       href="{{ route('chicos.create') }}">
                        Crear
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
                @include('chicos.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
