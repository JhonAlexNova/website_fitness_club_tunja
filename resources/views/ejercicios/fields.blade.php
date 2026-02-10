<!-- Nombre Ejercicio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre_ejercicio', 'Nombre Ejercicio:') !!}
    {!! Form::text('nombre_ejercicio', null, ['class' => 'form-control','maxlength' => 100,'maxlength' => 100]) !!}
</div>

<!-- Musculo Objetivo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('musculo_objetivo', 'Musculo Objetivo:') !!}
    {!! Form::text('musculo_objetivo', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50]) !!}
</div>

<!-- Equipo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('equipo', 'Equipo:') !!}
    {!! Form::text('equipo', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('nivel_dificultad', 'Nivel Dificultad:') !!}
    {!! Form::select('nivel_dificultad', [
        'Principiante' => 'Principiante',
        'Intermedio' => 'Intermedio',
        'Avanzado' => 'Avanzado',
    ], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una opción']) !!}
</div>

<!-- Video Url Field -->
{{-- <div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('video_url', 'Video Url:') !!}
    {!! Form::textarea('video_url', null, ['class' => 'form-control']) !!}
</div> --}}
<div class="form-group col-sm-6">
    {!! Form::label('video', 'Video:') !!}
    {!! Form::file('file_video', ['class' => 'form-control']) !!}
</div>
{{-- @if(isset($ejercicio)) 
<div class="col-md-12"></div>
    <div class="form-group col-sm-2"> <hr>
        <video src="{{url('storage',$ejercicio->video_url)}}" controls width="100%"></video>
    </div>
@endif

 --}}
