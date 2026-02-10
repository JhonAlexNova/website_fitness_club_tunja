<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $medicion->user_id }}</p>
</div>

<!-- Fecha Medicion Field -->
<div class="col-sm-12">
    {!! Form::label('fecha_medicion', 'Fecha Medicion:') !!}
    <p>{{ $medicion->fecha_medicion }}</p>
</div>

<!-- Peso Field -->
<div class="col-sm-12">
    {!! Form::label('peso', 'Peso:') !!}
    <p>{{ $medicion->peso }}</p>
</div>

<!-- Talla Field -->
<div class="col-sm-12">
    {!! Form::label('talla', 'Talla:') !!}
    <p>{{ $medicion->talla }}</p>
</div>

<!-- Grasa Field -->
<div class="col-sm-12">
    {!! Form::label('grasa', 'Grasa:') !!}
    <p>{{ $medicion->grasa }}</p>
</div>

<!-- Musculo Field -->
<div class="col-sm-12">
    {!! Form::label('musculo', 'Musculo:') !!}
    <p>{{ $medicion->musculo }}</p>
</div>

<!-- Perimetro Abdominal Field -->
<div class="col-sm-12">
    {!! Form::label('perimetro_abdominal', 'Perimetro Abdominal:') !!}
    <p>{{ $medicion->perimetro_abdominal }}</p>
</div>

