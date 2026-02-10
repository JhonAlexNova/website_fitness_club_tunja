<!-- Producto Id Field -->
<div class="col-sm-12">
    {!! Form::label('producto_id', 'Producto Id:') !!}
    <p>{{ $historialProducto->producto_id }}</p>
</div>

<!-- Cantidad Field -->
<div class="col-sm-12">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    <p>{{ $historialProducto->cantidad }}</p>
</div>

<!-- Cantidad Anterior Field -->
<div class="col-sm-12">
    {!! Form::label('cantidad_anterior', 'Cantidad Anterior:') !!}
    <p>{{ $historialProducto->cantidad_anterior }}</p>
</div>

<!-- Cantidad Actual Field -->
<div class="col-sm-12">
    {!! Form::label('cantidad_actual', 'Cantidad Actual:') !!}
    <p>{{ $historialProducto->cantidad_actual }}</p>
</div>

