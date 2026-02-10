<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre de la plantilla:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'maxlength' => 100]) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12">
    {!! Form::label('content', 'Contenido del SMS:') !!}

    <div class="mb-2">
        <small class="text-muted">Puedes usar etiquetas como:</small><br>
        <span class="badge badge-secondary">[nombres]</span>
        <span class="badge badge-secondary">[apellidos]</span>
        <span class="badge badge-secondary">[telefono]</span>
        <span class="badge badge-secondary">[email]</span>
        {{-- Agrega más si lo deseas --}}
    </div>

    {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Ej: Hola [nombres], gracias por registrarte.']) !!}
</div>
