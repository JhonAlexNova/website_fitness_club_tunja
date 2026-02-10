<!-- Manilla Id Field -->
<div class="col-sm-12">
    {!! Form::label('manilla_id', 'Manilla Id:') !!}
    <p>{{ $stockManilla->manilla_id }}</p>
</div>

<!-- Cantidad Actual Field -->
<div class="col-sm-12">
    {!! Form::label('cantidad_actual', 'Cantidad Actual:') !!}
    <p>{{ $stockManilla->cantidad_actual }}</p>
</div>

<!-- Cantidad Anterior Field -->
<div class="col-sm-12">
    {!! Form::label('cantidad_anterior', 'Cantidad Anterior:') !!}
    <p>{{ $stockManilla->cantidad_anterior }}</p>
</div>

<!-- Cantidad Field -->
<div class="col-sm-12">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    <p>{{ $stockManilla->cantidad }}</p>
</div>

