<!-- Producto Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('producto_id', 'Producto Id:') !!}
    {!! Form::number('producto_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('url', 'Url:') !!}
    {!! Form::text('url', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Es Portada Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('es_portada', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('es_portada', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('es_portada', 'Es Portada', ['class' => 'form-check-label']) !!}
    </div>
</div>
