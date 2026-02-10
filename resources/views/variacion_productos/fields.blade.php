<!-- Producto Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('producto_id', 'Producto Id:') !!}
    {!! Form::number('producto_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Valor Caracteristica Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valor_caracteristica_id', 'Valor Caracteristica Id:') !!}
    {!! Form::number('valor_caracteristica_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Precio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio', 'Precio:') !!}
    {!! Form::number('precio', null, ['class' => 'form-control']) !!}
</div>

<!-- Stock Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stock', 'Stock:') !!}
    {!! Form::number('stock', null, ['class' => 'form-control']) !!}
</div>