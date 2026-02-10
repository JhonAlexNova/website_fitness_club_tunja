@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Crear Producto</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'productos.store', 'files'=>true]) !!}

            <div class="card-body">

                <div class="row">
                    @include('productos.fields')
                </div>

            </div>

            <div class="card-footer">
            <button type="submit" class='btn btn-primary'><i class="fa fa-floppy-o" aria-hidden="true"></i> Crear</button>
                <a href="{{ route('productos.index') }}" class="btn btn-default"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Volver</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
