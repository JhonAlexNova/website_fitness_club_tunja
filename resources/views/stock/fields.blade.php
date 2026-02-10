<!-- Nombre Field -->
<!-- Foto Perfil Field -->
<div class="form-group col-sm-12">
    <div class="foto">
        <img src="{{url('storage/',$producto->icono)}}" class='img-producto' alt="">
    </div>
</div>


<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255, 'disabled'=>true]) !!}
</div>


<!-- Precio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio', 'Precio entrada:') !!}
    {!! Form::number('precio', null, ['class' => 'form-control',  'disabled'=>true]) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('cantidad', 'Cantidad actual:') !!}
    {!! Form::number('cantidad_actual', $producto->historial_producto->cantidad_actual, ['class' => 'form-control', 'disabled'=>true]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('precio', 'Precio de venta:') !!}
    {!! Form::text('precio_venta', number_format($producto->historial_precio->precio_venta), ['class' => 'form-control precio',  'disabled'=>true]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('precio', 'Precio de entrada:') !!}
    {!! Form::text('precio_entrada', number_format($producto->historial_producto->precio_entrada), ['class' => 'form-control precio']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    {!! Form::number('cantidad', $producto->historial_producto->cantidad_actual, ['class' => 'form-control input-cantidad']) !!}
</div>
