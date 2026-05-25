<div class="form-group">
    {!! Form::label('nombre', 'Nombre del músculo') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('categoria', 'Categoría') !!}
    {!! Form::select('categoria', [
        'cuerpo_superior' => 'Cuerpo Superior',
        'cuerpo_inferior' => 'Cuerpo Inferior',
    ], null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group">
    <label>Imagen</label>
    <input type="file" name="file_imagen" class="form-control">
</div>





<div class="form-group">
    <label>Modelo 3D (opcional)</label>
    <input type="file" name="file_modelo_3d" class="form-control">

    @if(isset($musculo) && $musculo->modelo_3d)
        <small class="form-text text-muted">
            Archivo actual: 
            <a href="{{ asset('storage/'.$musculo->modelo_3d) }}" target="_blank">Ver</a>
        </small>
    @endif
</div>
