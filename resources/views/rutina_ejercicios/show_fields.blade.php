<!-- Id Rutina Field -->
<div class="col-sm-12">
    {!! Form::label('id_rutina', 'Id Rutina:') !!}
    <p>{{ $rutinaEjercicio->id_rutina }}</p>
</div>

<!-- Id Ejercicio Field -->
<div class="col-sm-12">
    {!! Form::label('id_ejercicio', 'Id Ejercicio:') !!}
    <p>{{ $rutinaEjercicio->id_ejercicio }}</p>
</div>

<!-- Repeticiones Field -->
<div class="col-sm-12">
    {!! Form::label('repeticiones', 'Repeticiones:') !!}
    <p>{{ $rutinaEjercicio->repeticiones }}</p>
</div>

<!-- Series Field -->
<div class="col-sm-12">
    {!! Form::label('series', 'Series:') !!}
    <p>{{ $rutinaEjercicio->series }}</p>
</div>

<!-- Descanso Segundos Field -->
<div class="col-sm-12">
    {!! Form::label('descanso_segundos', 'Descanso Segundos:') !!}
    <p>{{ $rutinaEjercicio->descanso_segundos }}</p>
</div>

