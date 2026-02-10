<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50]) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control','rows'=>3]) !!}
</div>

<!-- Costo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('costo', 'Costo:') !!}
    {!! Form::number('costo', null, ['class' => 'form-control']) !!}
</div>

<!-- Duracion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duracion', 'Duracion:') !!}
    {!! Form::number('duracion', null, ['class' => 'form-control']) !!}
</div>

<!-- Servicios seleccionables -->
<div class="form-group col-sm-12">
    {!! Form::label('servicios', 'Servicios incluidos:') !!}
    <div class="row">
        @if(Route::is("membresias.create"))
            @foreach($servicios as $servicio)
            <div class="col-md-4">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" name="servicios[]" value="{{ $servicio->id }}" class="form-check-input">
                        {{ $servicio->nombre }}
                    </label>
                </div>
            </div>
            @endforeach
        @else
            @foreach ($servicios as $servicio)
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" name="servicios[]" value="{{ $servicio->id }}"
                            {{ in_array($servicio->id, $serviciosSeleccionados) ? 'checked' : '' }}>
                        {{ $servicio->nombre }}
                    </label>
                </div>
            @endforeach

        @endif
    </div>
</div>