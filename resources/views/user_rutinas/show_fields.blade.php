<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $userRutina->user_id }}</p>
</div>

<!-- Id Rutina Field -->
<div class="col-sm-12">
    {!! Form::label('id_rutina', 'Id Rutina:') !!}
    <p>{{ $userRutina->id_rutina }}</p>
</div>

<!-- Fecha Inicio Field -->
<div class="col-sm-12">
    {!! Form::label('fecha_inicio', 'Fecha Inicio:') !!}
    <p>{{ $userRutina->fecha_inicio }}</p>
</div>

<!-- Fecha Fin Field -->
<div class="col-sm-12">
    {!! Form::label('fecha_fin', 'Fecha Fin:') !!}
    <p>{{ $userRutina->fecha_fin }}</p>
</div>

