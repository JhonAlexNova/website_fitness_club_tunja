<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $detalleDevolucion->id }}</p>
</div>

<!-- Devolucion Id Field -->
<div class="col-sm-12">
    {!! Form::label('devolucion_id', 'Devolucion Id:') !!}
    <p>{{ $detalleDevolucion->devolucion_id }}</p>
</div>

<!-- Producto Id Field -->
<div class="col-sm-12">
    {!! Form::label('producto_id', 'Producto Id:') !!}
    <p>{{ $detalleDevolucion->producto_id }}</p>
</div>

<!-- Cantidad Unidades Devolucion Field -->
<div class="col-sm-12">
    {!! Form::label('cantidad_unidades_devolucion', 'Cantidad Unidades Devolucion:') !!}
    <p>{{ $detalleDevolucion->cantidad_unidades_devolucion }}</p>
</div>

<!-- Valor Unit De Cambio Field -->
<div class="col-sm-12">
    {!! Form::label('valor_unit_de_cambio', 'Valor Unit De Cambio:') !!}
    <p>{{ $detalleDevolucion->valor_unit_de_cambio }}</p>
</div>

<!-- Total Devuelto Field -->
<div class="col-sm-12">
    {!! Form::label('total_devuelto', 'Total Devuelto:') !!}
    <p>{{ $detalleDevolucion->total_devuelto }}</p>
</div>

<!-- Total Ganancia Field -->
<div class="col-sm-12">
    {!! Form::label('total_ganancia', 'Total Ganancia:') !!}
    <p>{{ $detalleDevolucion->total_ganancia }}</p>
</div>

<!-- Createt At Field -->
<div class="col-sm-12">
    {!! Form::label('createt_at', 'Createt At:') !!}
    <p>{{ $detalleDevolucion->createt_at }}</p>
</div>

