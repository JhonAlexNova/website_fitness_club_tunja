<!-- Clase Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('clase_id', 'Clase Id:') !!}
    {!! Form::select('clase_id', $clases->pluck("nombre","id"),null, ['class' => 'form-control',"placeholder"=>"Seleccionar","required"=>true]) !!}
</div>

<!-- Instructor Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('instructor_id', 'Instructor Id:') !!}
    {!! Form::select('instructor_id', $instructores, null, ['class' => 'form-control',"placeholder"=>"Seleccionar","required"=>true]) !!}
</div> -->

<!-- Dia Semana Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dia_semana', 'Dia Semana', ['class' => 'form-check-label']) !!}
    {!! Form::select('dia_semana', $diasSemana, null,['class' => 'form-control',"placeholder"=>"Seleccionar","required"=>"true"]) !!}

</div>


<!-- Hora Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hora', 'Hora:') !!}
    {!! Form::time('hora', null, ['class' => 'form-control',"required"=>true]) !!}
</div>

<!-- Duracion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duracion', 'Duracion:') !!}
    {!! Form::number('duracion', null, ['class' => 'form-control',"required"=>true]) !!}
</div>

<!-- Cupo Maximo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cupo_maximo', 'Cupo Maximo:') !!}
    {!! Form::number('cupo_maximo', null, ['class' => 'form-control',"required"=>true]) !!}
</div>