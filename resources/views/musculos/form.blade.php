<div class="form-group">
    {!! Form::label('nombre', 'Nombre del músculo') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group">
    <label>Imagen</label>
    <input type="file" name="file_imagen" class="form-control">
</div>