<!-- Nombre Ejercicio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre_ejercicio', 'Nombre Ejercicio:') !!}
    {!! Form::text('nombre_ejercicio', null, ['class' => 'form-control', 'maxlength' => 100]) !!}
</div>

<!-- Equipo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('equipo', 'Equipo:') !!}
    {!! Form::text('equipo', null, ['class' => 'form-control', 'maxlength' => 50]) !!}
</div>

<!-- Nivel Dificultad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nivel_dificultad', 'Nivel Dificultad:') !!}
    {!! Form::select('nivel_dificultad', [
        'Principiante' => 'Principiante',
        'Intermedio'   => 'Intermedio',
        'Avanzado'     => 'Avanzado',
    ], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una opción']) !!}
</div>

<!-- Video Field -->
<div class="form-group col-sm-6">
    {!! Form::label('file_video', 'Video:') !!}
    {!! Form::file('file_video', ['class' => 'form-control']) !!}
</div>

<!-- Descripción Field -->
<div class="form-group col-sm-12">
    {!! Form::label('descripcion', 'Descripción / Instrucciones:') !!}
    {!! Form::textarea('descripcion', null, [
        'class'       => 'form-control',
        'rows'        => 4,
        'placeholder' => 'Describe cómo realizar el ejercicio correctamente...'
    ]) !!}
</div>

{{-- ================= MÚSCULOS ================= --}}

@php
    $principalSeleccionado = isset($ejercicio)
        ? optional($ejercicio->musculos->firstWhere('pivot.es_principal', true))->id
        : null;

    $secundariosSeleccionados = isset($ejercicio)
        ? $ejercicio->musculos->where('pivot.es_principal', false)->pluck('id')->toArray()
        : [];
@endphp

<!-- Músculo Principal -->
<div class="form-group col-sm-6">
    {!! Form::label('musculo_principal', 'Músculo Principal (Categoría):') !!}
    <select name="musculo_principal" class="form-control" required>
        <option value="">Seleccione...</option>
        @foreach($musculos as $musculo)
            <option value="{{ $musculo->id }}"
                {{ $principalSeleccionado == $musculo->id ? 'selected' : '' }}>
                {{ $musculo->nombre }}
            </option>
        @endforeach
    </select>
</div>

<!-- Músculos Secundarios -->
<div class="form-group col-sm-6">
    {!! Form::label('musculos_secundarios', 'Músculos Secundarios:') !!}
    <select name="musculos_secundarios[]" class="form-control" multiple>
        @foreach($musculos as $musculo)
            <option value="{{ $musculo->id }}"
                {{ in_array($musculo->id, $secundariosSeleccionados) ? 'selected' : '' }}>
                {{ $musculo->nombre }}
            </option>
        @endforeach
    </select>
    <small class="form-text text-muted">
        Mantén presionada Ctrl para seleccionar varios.
    </small>
</div>