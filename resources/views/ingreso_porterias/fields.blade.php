<!-- Cliente Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cliente_id', 'Cliente Id:') !!}
    {!! Form::number('cliente_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Manilla Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('manilla_id', 'Manilla Id:') !!}
    {!! Form::number('manilla_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Valor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valor', 'Valor:') !!}
    {!! Form::text('valor', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>