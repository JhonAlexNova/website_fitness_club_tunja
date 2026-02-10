<!-- Nombre Field -->
<div class="col-sm-12">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{{ $producto->nombre }}</p>
</div>

<!-- Descripcion Field -->
<div class="col-sm-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    <p>{{ $producto->descripcion }}</p>
</div>

<!-- Precio Field -->
<div class="col-sm-12">
    {!! Form::label('precio', 'Precio:') !!}
    <p>{{ $producto->precio }}</p>
</div>

<!-- Stock Field -->
<div class="col-sm-12">
    {!! Form::label('stock', 'Stock:') !!}
    <p>{{ $producto->stock }}</p>
</div>

<!-- Icono Field -->
<div class="col-sm-12">
    {!! Form::label('icono', 'Icono:') !!}
    <p>{{ $producto->icono }}</p>
</div>

<!-- Categoria Id Field -->
<div class="col-sm-12">
    {!! Form::label('categoria_id', 'Categoria Id:') !!}
    <p>{{ $producto->categoria_id }}</p>
</div>

