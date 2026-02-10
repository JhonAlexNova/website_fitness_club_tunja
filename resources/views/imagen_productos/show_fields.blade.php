<!-- Producto Id Field -->
<div class="col-sm-12">
    {!! Form::label('producto_id', 'Producto Id:') !!}
    <p>{{ $imagenProducto->producto_id }}</p>
</div>

<!-- Url Field -->
<div class="col-sm-12">
    {!! Form::label('url', 'Url:') !!}
    <p>{{ $imagenProducto->url }}</p>
</div>

<!-- Es Portada Field -->
<div class="col-sm-12">
    {!! Form::label('es_portada', 'Es Portada:') !!}
    <p>{{ $imagenProducto->es_portada }}</p>
</div>

