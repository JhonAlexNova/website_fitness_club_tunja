<!-- Id Rutina Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_rutina', 'Id Rutina:') !!}
    {!! Form::number('id_rutina', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Ejercicio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_ejercicio', 'Id Ejercicio:') !!}
    {!! Form::number('id_ejercicio', null, ['class' => 'form-control']) !!}
</div>

<!-- Repeticiones Field -->
<div class="form-group col-sm-6">
    {!! Form::label('repeticiones', 'Repeticiones:') !!}
    {!! Form::number('repeticiones', null, ['class' => 'form-control']) !!}
</div>

<!-- Series Field -->
<div class="form-group col-sm-6">
    {!! Form::label('series', 'Series:') !!}
    {!! Form::number('series', null, ['class' => 'form-control']) !!}
</div>

<!-- Descanso Segundos Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descanso_segundos', 'Descanso Segundos:') !!}
    {!! Form::number('descanso_segundos', null, ['class' => 'form-control']) !!}
</div>