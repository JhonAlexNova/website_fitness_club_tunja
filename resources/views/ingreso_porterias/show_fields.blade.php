<!-- Cliente Id Field -->
<div class="col-sm-12">
    {!! Form::label('cliente_id', 'Cliente Id:') !!}
    <p>{{ $ingresoPorteria->cliente_id }}</p>
</div>

<!-- Manilla Id Field -->
<div class="col-sm-12">
    {!! Form::label('manilla_id', 'Manilla Id:') !!}
    <p>{{ $ingresoPorteria->manilla_id }}</p>
</div>

<!-- Valor Field -->
<div class="col-sm-12">
    {!! Form::label('valor', 'Valor:') !!}
    <p>{{ $ingresoPorteria->valor }}</p>
</div>

