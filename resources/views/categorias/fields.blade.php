<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Icono Field -->
<div class="form-group col-sm-6">
    {!! Form::label('icono', 'Icono:') !!}
    {!! Form::file('file', ['class' => 'form-control']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('descripcion', 'Descripción:') !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'rows' => 3]) !!}
</div>

<!-- Categoria Padre Field (solo muestra categorías principales, no subcategorías) -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_id', 'Categoría padre:') !!}
    <span class="badge badge-secondary ml-1">Opcional</span>
    {!! Form::select(
        'parent_id',
        $categorias->whereNull('parent_id')->pluck('nombre', 'id'),
        isset($categoria) ? $categoria->parent_id : null,
        ['class' => 'form-control', 'placeholder' => '— Sin padre (categoría principal) —']
    ) !!}
    <small class="form-text text-muted">
        Deja vacío para crear una categoría principal. Selecciona una para crear una subcategoría.
    </small>
</div>