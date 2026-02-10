<!-- Factura Id Field -->
<div class="col-sm-12">
    {!! Form::label('factura_id', 'Factura Id:') !!}
    <p>{{ $detalleFactura->factura_id }}</p>
</div>

<!-- Precio Id Field -->
<div class="col-sm-12">
    {!! Form::label('precio_id', 'Precio Id:') !!}
    <p>{{ $detalleFactura->precio_id }}</p>
</div>

<!-- Producto Id Field -->
<div class="col-sm-12">
    {!! Form::label('producto_id', 'Producto Id:') !!}
    <p>{{ $detalleFactura->producto_id }}</p>
</div>

<!-- Cantidad Field -->
<div class="col-sm-12">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    <p>{{ $detalleFactura->cantidad }}</p>
</div>

<!-- Total Field -->
<div class="col-sm-12">
    {!! Form::label('total', 'Total:') !!}
    <p>{{ $detalleFactura->total }}</p>
</div>

