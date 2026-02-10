<!-- Nombre Ejercicio Field -->
<div class="col-sm-12">
    {!! Form::label('nombre_ejercicio', 'Nombre Ejercicio:') !!}
    <p>{{ $ejercicio->nombre_ejercicio }}</p>
</div>

<!-- Musculo Objetivo Field -->
<div class="col-sm-12">
    {!! Form::label('musculo_objetivo', 'Musculo Objetivo:') !!}
    <p>{{ $ejercicio->musculo_objetivo }}</p>
</div>

<!-- Equipo Field -->
<div class="col-sm-12">
    {!! Form::label('equipo', 'Equipo:') !!}
    <p>{{ $ejercicio->equipo }}</p>
</div>

<!-- Nivel Dificultad Field -->
<div class="col-sm-12">
    {!! Form::label('nivel_dificultad', 'Nivel Dificultad:') !!}
    <p>{{ $ejercicio->nivel_dificultad }}</p>
</div>

<!-- Video Url Field -->
<div class="col-sm-12">
    {!! Form::label('video_url', 'Video Url:') !!}
    <p>{{ $ejercicio->video_url }}</p>
</div>

