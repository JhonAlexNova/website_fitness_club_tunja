@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Editar Empleado</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($administrador, ['route' => ['administradores.update', $administrador->id], 'method' => 'patch','files'=>true,'id'=>'formEditEmpleado']) !!}

            <div class="card-body">
                <div class="row">
                    @include('administradores.fields')
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class='btn btn-primary'><i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar</button>

                <a href="{{ route('administradores.index') }}" class="btn btn-default"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Volver</a>
            </div>


            {!! Form::close() !!}

        </div>
    </div>
@endsection
