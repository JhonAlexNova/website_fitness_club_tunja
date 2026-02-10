<!-- Manilla Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('manilla_id', 'Manilla Id:') !!}
    {!! Form::text('manilla_id', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Cantidad Actual Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad_actual', 'Cantidad Actual:') !!}
    {!! Form::number('cantidad_actual', null, ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Anterior Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad_anterior', 'Cantidad Anterior:') !!}
    {!! Form::number('cantidad_anterior', null, ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    {!! Form::number('cantidad', null, ['class' => 'form-control']) !!}
</div>