@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Editar Cliente</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        @include('adminlte-templates::common.errors')
            {!! Form::model($cliente, ['route' => ['clientes.update', $cliente->id], 'method' => 'patch',"files"=>true]) !!}
                @include('clientes.fields')

                <div class="row">
                    <div class="col-md-12 form-group">
                        {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('clientes.index') }}" class="btn btn-default">Cancelar</a>
                    </div>
                </div>
            {!! Form::close() !!}
    </div>
@endsection
