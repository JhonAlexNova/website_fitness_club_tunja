@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Músculo</h2>

    {!! Form::open(['route' => 'musculos.store']) !!}
        @include('musculos.form')
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
</div>
@endsection