<!-- Clase Id Field -->
<div class="col-sm-12">
    {!! Form::label('clase_id', 'Clase Id:') !!}
    <p>{{ $claseRecurrente->clase_id }}</p>
</div>

<!-- Instructor Id Field -->
<div class="col-sm-12">
    {!! Form::label('instructor_id', 'Instructor Id:') !!}
    <p>{{ $claseRecurrente->instructor_id }}</p>
</div>

<!-- Dia Semana Field -->
<div class="col-sm-12">
    {!! Form::label('dia_semana', 'Dia Semana:') !!}
    <p>{{ $claseRecurrente->dia_semana }}</p>
</div>

<!-- Hora Field -->
<div class="col-sm-12">
    {!! Form::label('hora', 'Hora:') !!}
    <p>{{ $claseRecurrente->hora }}</p>
</div>

<!-- Duracion Field -->
<div class="col-sm-12">
    {!! Form::label('duracion', 'Duracion:') !!}
    <p>{{ $claseRecurrente->duracion }}</p>
</div>

<!-- Cupo Maximo Field -->
<div class="col-sm-12">
    {!! Form::label('cupo_maximo', 'Cupo Maximo:') !!}
    <p>{{ $claseRecurrente->cupo_maximo }}</p>
</div>

