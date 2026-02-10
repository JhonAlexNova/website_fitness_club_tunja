@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Crear Clase</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'admon.clases.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('clases.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Crear', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('admon.clases.index') }}" class="btn btn-default">Volver</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
