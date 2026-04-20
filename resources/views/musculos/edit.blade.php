@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Músculo</h2>

    {!! Form::model($musculo, ['route' => ['musculos.update', $musculo->id], 'method' => 'put','files'=>true]) !!}
        @include('musculos.form')
        {!! Form::submit('Actualizar', ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
</div>
@endsection