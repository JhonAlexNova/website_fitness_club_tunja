<!-- Logo Field -->
<div class="form-group col-sm-12">
    {!! Form::label('logo', 'Logo:') !!} <small class="nota-input">Imagen recomendada 500x500px</small>
    @if(isset($configuracion))
        {!! Form::file('file_logo', ['id'=>'file_logo', 'class' => 'form-control hide']) !!}
        <label for='file_logo'   class="input-file-logo">
            <div class="imagen">
                    <img src="/storage/{{$configuracion->logo}}" alt="">
            </div>
        </label>
    @else 
        {!! Form::file('file_logo', ['id'=>'file_logo', 'class' => 'form-control']) !!}
    @endif
</div>

<!-- Logo Field -->
<div class="form-group col-sm-12">
    {!! Form::label('logo', 'Portada login:') !!} <small class="nota-input">Imagen recomendada 500x500px</small>
    @if(isset($configuracion))
        {!! Form::file('file_portada_login', ['id'=>'file_login_portada', 'class' => 'form-control hide']) !!}
        <label for='file_login_portada'   class="input-file-logo">
            <div class="imagen">
                    <img src="/storage/{{$configuracion->portada_login}}" alt="">
            </div>
        </label>
    @else 
        {!! Form::file('file_portada_login', ['id'=>'file_login_portada', 'class' => 'form-control']) !!}
    @endif
</div>


<!-- Direccion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('direccion', 'Tipo negocio:') !!}
    <select name="tipo_negocio_id" class='form-control'>
        <option value=""></option>
        @foreach($tipos_negocio as $tipo)
            <option value="{{$tipo->id}}" @if($configuracion->tipo_negocio_id==$tipo->id) selected @endif> {{ $tipo->nombre }} </option>
        @endforeach
    </select>
</div>

<!-- Direccion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('direccion', 'Direccion:') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Telefono Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telefono', 'Telefono:') !!}
    {!! Form::number('telefono', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Celular Field -->
<div class="form-group col-sm-6">
    {!! Form::label('celular', 'Celular:') !!}
    {!! Form::text('celular', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Correo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('correo', 'Correo:') !!}
    {!! Form::email('correo', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Nit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nit', 'Nit:') !!}
    {!! Form::text('nit', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Nit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nit', 'Iva %:') !!}
    {!! Form::text('iva', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Razon Social Field -->
<div class="form-group col-sm-6">
    {!! Form::label('razon_social', 'Razon Social:') !!}
    {!! Form::text('razon_social', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Razon Social Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('chico', 'Valor chico:') !!}
    {!! Form::text('valor_chico', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div> -->

<!-- Razon Social Field -->
<div class="form-group col-sm-12">
    {!! Form::label('chico', 'Politicas de privacidad:') !!}
    {!! Form::textarea('politicas_de_privacidad', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>
