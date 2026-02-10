<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $factura->id }}</p>
</div>

<!-- Empleado Id Field -->
<div class="col-sm-12">
    {!! Form::label('empleado_id', 'Empleado Id:') !!}
    <p>{{ $factura->empleado_id }}</p>
</div>

<!-- Total Field -->
<div class="col-sm-12">
    {!! Form::label('total', 'Total:') !!}
    <p>{{ $factura->total }}</p>
</div>

