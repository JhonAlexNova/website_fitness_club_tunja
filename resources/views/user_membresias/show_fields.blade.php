<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $userMembresia->user_id }}</p>
</div>

<!-- Membresia Id Field -->
<div class="col-sm-12">
    {!! Form::label('membresia_id', 'Membresia Id:') !!}
    <p>{{ $userMembresia->membresia_id }}</p>
</div>

<!-- Fecha Inicio Field -->
<div class="col-sm-12">
    {!! Form::label('fecha_inicio', 'Fecha Inicio:') !!}
    <p>{{ $userMembresia->fecha_inicio }}</p>
</div>

<!-- Fecha Vencimiento Field -->
<div class="col-sm-12">
    {!! Form::label('fecha_vencimiento', 'Fecha Vencimiento:') !!}
    <p>{{ $userMembresia->fecha_vencimiento }}</p>
</div>

<!-- Estado Field -->
<div class="col-sm-12">
    {!! Form::label('estado', 'Estado:') !!}
    <p>{{ $userMembresia->estado }}</p>
</div>

