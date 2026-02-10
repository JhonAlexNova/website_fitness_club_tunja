@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Editar Instructor</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')
        {!! Form::model($instructor, ['route' => ['instructors.update', $instructor->id], 'method' => 'patch',"files"=>true]) !!}
                @include('instructors.fields')
            <div class="card-footer">
                {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('instructors.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}
    </div>
@endsection
