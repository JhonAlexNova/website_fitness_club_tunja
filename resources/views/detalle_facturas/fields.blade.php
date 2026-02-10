<!-- Factura Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('factura_id', 'Factura Id:') !!}
    {!! Form::number('factura_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Precio Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio_id', 'Precio Id:') !!}
    {!! Form::number('precio_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Producto Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('producto_id', 'Producto Id:') !!}
    {!! Form::number('producto_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    {!! Form::text('cantidad', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total', 'Total:') !!}
    {!! Form::text('total', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>