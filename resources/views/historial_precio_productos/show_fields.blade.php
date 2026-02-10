<!-- Producto Id Field -->
<div class="col-sm-12">
    {!! Form::label('producto_id', 'Producto Id:') !!}
    <p>{{ $historialPrecioProducto->producto_id }}</p>
</div>

<!-- Precio Field -->
<div class="col-sm-12">
    {!! Form::label('precio', 'Precio:') !!}
    <p>{{ $historialPrecioProducto->precio }}</p>
</div>

<!-- Fecha Actualizacion Field -->
<div class="col-sm-12">
    {!! Form::label('fecha_actualizacion', 'Fecha Actualizacion:') !!}
    <p>{{ $historialPrecioProducto->fecha_actualizacion }}</p>
</div>

