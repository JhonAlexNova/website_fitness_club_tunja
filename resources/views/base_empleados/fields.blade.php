<!-- Empleado Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('empleado_id', 'Empleado:') !!}
    {!! Form::select('empleado_id', $empleados->pluck('primer_nombre','id'), null,  ['class' => 'form-control','required'=>true]) !!}
</div>

<!-- Valor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valor', 'Valor:') !!}
    {!! Form::text('valor', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'required'=>true]) !!}
</div>