<!-- Producto Id Field -->
<div class="col-sm-12">
    {!! Form::label('producto_id', 'Producto Id:') !!}
    <p>{{ $variacionProducto->producto_id }}</p>
</div>

<!-- Valor Caracteristica Id Field -->
<div class="col-sm-12">
    {!! Form::label('valor_caracteristica_id', 'Valor Caracteristica Id:') !!}
    <p>{{ $variacionProducto->valor_caracteristica_id }}</p>
</div>

<!-- Precio Field -->
<div class="col-sm-12">
    {!! Form::label('precio', 'Precio:') !!}
    <p>{{ $variacionProducto->precio }}</p>
</div>

<!-- Stock Field -->
<div class="col-sm-12">
    {!! Form::label('stock', 'Stock:') !!}
    <p>{{ $variacionProducto->stock }}</p>
</div>

