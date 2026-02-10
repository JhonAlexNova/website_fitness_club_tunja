<!-- Empleado Id Field -->
<div class="form-group col-sm-4">
    {!! Form::label('empleado_id', 'Empleado:') !!}
    <select name="empleado_id" class='form-control'>
        <option value=""></option>
        @foreach($empleados as $empleado)
            <option value="{{$empleado->id}}"> 
                {{$empleado->primer_nombre}}  {{$empleado->segundo_apellido }} {{$empleado->primer_apellido }} {{$empleado->segundo_apellido }}
            </option>
        @endforeach
    </select>
</div>

<!-- Cantidad Field -->
<div class="form-group col-sm-4">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    {!! Form::text('cantidad', null, ['class' => 'form-control cantidad','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Valor Field -->
<div class="form-group col-sm-4">
    {!! Form::label('valor', 'Valor:') !!}
    {!! Form::text('valor', null, ['class' => 'form-control total precio','maxlength' => 255,'maxlength' => 255,'readonly'=>true]) !!}
</div>