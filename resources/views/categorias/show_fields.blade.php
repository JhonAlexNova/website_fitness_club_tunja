<!-- Nombre Field -->
<div class="col-sm-12">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{{ $categoria->nombre }}</p>
</div>

<!-- Descripcion Field -->
<div class="col-sm-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    <p>{{ $categoria->descripcion }}</p>
</div>

<!-- Icono Field -->
<div class="col-sm-12">
    {!! Form::label('icono', 'Icono:') !!}
    <p>{{ $categoria->icono }}</p>
</div>

