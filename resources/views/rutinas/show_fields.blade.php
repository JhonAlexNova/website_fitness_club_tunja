<!-- Nombre Rutina Field -->
<div class="col-sm-12">
    {!! Form::label('nombre_rutina', 'Nombre Rutina:') !!}
    <p>{{ $rutina->nombre_rutina }}</p>
</div>

<!-- Descripcion Field -->
<div class="col-sm-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    <p>{{ $rutina->descripcion }}</p>
</div>

<!-- Duracion Semanas Field -->
<div class="col-sm-12">
    {!! Form::label('duracion_semanas', 'Duracion Semanas:') !!}
    <p>{{ $rutina->duracion_semanas }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $rutina->user_id }}</p>
</div>

