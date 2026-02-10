<!-- Foto Perfil Field -->
<div class="col-sm-12">
    {!! Form::label('foto_perfil', 'Foto Perfil:') !!}
    <p>{{ $empleado->foto_perfil }}</p>
</div>

<!-- Username Field -->
<div class="col-sm-12">
    {!! Form::label('username', 'Username:') !!}
    <p>{{ $empleado->username }}</p>
</div>

<!-- Primer Nombre Field -->
<div class="col-sm-12">
    {!! Form::label('primer_nombre', 'Primer Nombre:') !!}
    <p>{{ $empleado->primer_nombre }}</p>
</div>

<!-- Segundo Nombre Field -->
<div class="col-sm-12">
    {!! Form::label('segundo_nombre', 'Segundo Nombre:') !!}
    <p>{{ $empleado->segundo_nombre }}</p>
</div>

<!-- Primer Apellido Field -->
<div class="col-sm-12">
    {!! Form::label('primer_apellido', 'Primer Apellido:') !!}
    <p>{{ $empleado->primer_apellido }}</p>
</div>

<!-- Segundo Apellido Field -->
<div class="col-sm-12">
    {!! Form::label('segundo_apellido', 'Segundo Apellido:') !!}
    <p>{{ $empleado->segundo_apellido }}</p>
</div>

<!-- Celular Field -->
<div class="col-sm-12">
    {!! Form::label('celular', 'Celular:') !!}
    <p>{{ $empleado->celular }}</p>
</div>

<!-- Estado Field -->
<div class="col-sm-12">
    {!! Form::label('estado', 'Estado:') !!}
    <p>{{ $empleado->estado }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $empleado->email }}</p>
</div>

<!-- Documento Field -->
<div class="col-sm-12">
    {!! Form::label('documento', 'Documento:') !!}
    <p>{{ $empleado->documento }}</p>
</div>

<!-- Email Verified At Field -->
<div class="col-sm-12">
    {!! Form::label('email_verified_at', 'Email Verified At:') !!}
    <p>{{ $empleado->email_verified_at }}</p>
</div>

<!-- Password Field -->
<div class="col-sm-12">
    {!! Form::label('password', 'Password:') !!}
    <p>{{ $empleado->password }}</p>
</div>

<!-- Remember Token Field -->
<div class="col-sm-12">
    {!! Form::label('remember_token', 'Remember Token:') !!}
    <p>{{ $empleado->remember_token }}</p>
</div>

