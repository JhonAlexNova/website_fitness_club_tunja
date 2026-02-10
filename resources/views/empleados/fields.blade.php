<!-- Foto Perfil Field -->
<div class="form-group col-sm-6">
    {!! Form::label('foto_perfil', 'Foto Perfil:') !!}
    {!! Form::file('file', ['class' => 'form-control']) !!}
</div>

<!-- Username Field -->
<div class="form-group col-sm-6">
    {!! Form::label('username', 'Username:') !!}
    {!! Form::text('username', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Primer Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('primer_nombre', 'Primer Nombre:') !!}
    {!! Form::text('primer_nombre', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Segundo Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('segundo_nombre', 'Segundo Nombre:') !!}
    {!! Form::text('segundo_nombre', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Primer Apellido Field -->
<div class="form-group col-sm-6">
    {!! Form::label('primer_apellido', 'Primer Apellido:') !!}
    {!! Form::text('primer_apellido', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Segundo Apellido Field -->
<div class="form-group col-sm-6">
    {!! Form::label('segundo_apellido', 'Segundo Apellido:') !!}
    {!! Form::text('segundo_apellido', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Celular Field -->
<div class="form-group col-sm-6">
    {!! Form::label('celular', 'Celular:') !!}
    {!! Form::number('celular', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Estado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado', 'Estado:') !!}
    <select name="estado" id="estado" class='form-control'>
        <option value="activo" @if(isset($empleado) && $empleado->estado=='activo')  selected @endif>Activo</option>
        <option value="inactivo" @if(isset($empleado) && $empleado->estado=='inactivo')  selected @endif>Inactivo</option>
    </select>
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Documento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('documento', 'Documento:') !!}
    {!! Form::number('documento', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

