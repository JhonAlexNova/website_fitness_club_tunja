<!-- Clase Id Field -->
<div class="col-sm-12">
    {!! Form::label('clase_id', 'Clase Id:') !!}
    <p>{{ $horarioClaseUnica->clase_id }}</p>
</div>

<!-- Instructor Id Field -->
<div class="col-sm-12">
    {!! Form::label('instructor_id', 'Instructor Id:') !!}
    <p>{{ $horarioClaseUnica->instructor_id }}</p>
</div>

<!-- Fecha Hora Field -->
<div class="col-sm-12">
    {!! Form::label('fecha_hora', 'Fecha Hora:') !!}
    <p>{{ $horarioClaseUnica->fecha_hora }}</p>
</div>

<!-- Cupo Maximo Field -->
<div class="col-sm-12">
    {!! Form::label('cupo_maximo', 'Cupo Maximo:') !!}
    <p>{{ $horarioClaseUnica->cupo_maximo }}</p>
</div>

<!-- Cupos Disponibles Field -->
<div class="col-sm-12">
    {!! Form::label('cupos_disponibles', 'Cupos Disponibles:') !!}
    <p>{{ $horarioClaseUnica->cupos_disponibles }}</p>
</div>

