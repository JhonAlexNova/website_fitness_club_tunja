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

<!-- Cantidad Anterior Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad_anterior', 'Cantidad Anterior:') !!}
    {!! Form::text('cantidad_anterior', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Cantidad Actual Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad_actual', 'Cantidad Actual:') !!}
    {!! Form::text('cantidad_actual', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>