<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $punto->user_id }}</p>
</div>

<!-- Tipo Punto Field -->
<div class="col-sm-12">
    {!! Form::label('tipo_punto', 'Tipo Punto:') !!}
    <p>{{ $punto->tipo_punto }}</p>
</div>

<!-- Descripcion Field -->
<div class="col-sm-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    <p>{{ $punto->descripcion }}</p>
</div>

<!-- Puntos Field -->
<div class="col-sm-12">
    {!! Form::label('puntos', 'Puntos:') !!}
    <p>{{ $punto->puntos }}</p>
</div>

