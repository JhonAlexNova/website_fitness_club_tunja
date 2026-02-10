<!-- Nombre Field -->
<div class="col-sm-12">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{{ $membresia->nombre }}</p>
</div>

<!-- Descripcion Field -->
<div class="col-sm-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    <p>{{ $membresia->descripcion }}</p>
</div>

<!-- Costo Field -->
<div class="col-sm-12">
    {!! Form::label('costo', 'Costo:') !!}
    <p>{{ $membresia->costo }}</p>
</div>

<!-- Duracion Field -->
<div class="col-sm-12">
    {!! Form::label('duracion', 'Duracion:') !!}
    <p>{{ $membresia->duracion }}</p>
</div>

