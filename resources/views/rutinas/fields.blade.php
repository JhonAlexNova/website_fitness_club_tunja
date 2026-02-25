<!-- Nombre Rutina Field -->
<div class="form-group {{Route::is('rutinas.edit')?'col-md-12':'col-md-6'}}">
    {!! Form::label('nombre_rutina', 'Nombre Rutina:') !!}
    {!! Form::text('nombre_rutina', null, ['class' => 'form-control','maxlength' => 100,'maxlength' => 100]) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control',"rows"=>3]) !!}
</div>

<!-- Duracion Semanas Field -->
<div class="form-group {{Route::is('rutinas.edit')?'col-md-12':'col-md-6'}}">
    {!! Form::label('duracion_semanas', 'Duracion Semanas:') !!}
    {!! Form::number('duracion_semanas', null, ['class' => 'form-control']) !!}
</div>


<!-- Es General Field -->
<div class="form-group col-md-6">
    {!! Form::label('es_general', '¿Rutina general para todos?') !!}
    <div class="form-check">
        {!! Form::checkbox('es_general', 1, null, ['class' => 'form-check-input', 'id' => 'es_general']) !!}
        {!! Form::label('es_general', 'Sí', ['class' => 'form-check-label']) !!}
    </div>
</div>

<!-- User Id Field -->
<div class="form-group {{Route::is('rutinas.edit')?'col-md-12':'col-md-6'}}" id="user_id_container">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::select('user_id', $clientes->pluck('full_name',"id"), null, ['class' => 'form-control', 'placeholder' => 'Seleccione un usuario']) !!}
</div>

<select name="" id=""></select>

