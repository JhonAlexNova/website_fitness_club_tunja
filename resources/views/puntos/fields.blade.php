<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Punto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_punto', 'Tipo Punto:') !!}
    {!! Form::text('tipo_punto', null, ['class' => 'form-control','maxlength' => 20,'maxlength' => 20]) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Puntos Field -->
<div class="form-group col-sm-6">
    {!! Form::label('puntos', 'Puntos:') !!}
    {!! Form::number('puntos', null, ['class' => 'form-control']) !!}
</div>