<!-- Precio Full Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio_full', 'Precio Full:') !!}
    {!! Form::number('precio_full', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Precio Reducido Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio_reducido', 'Precio Reducido:') !!}
    {!! Form::number('precio_reducido', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Hora Corte Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hora_corte', 'Hora Corte:') !!}
    {!! Form::time('hora_corte', null, ['class' => 'form-control']) !!}
</div>