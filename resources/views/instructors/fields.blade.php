<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="form-group col-sm-12">
                <h6>Información básica</h6>
                <hr>
            </div>

            <!-- Foto Perfil Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('foto_perfil', 'Foto Perfil:') !!}
                {!! Form::file('file_foto_perfil', ['class' => 'form-control', 'maxlength' => 255]) !!}
            </div>

            <!-- Primer Nombre Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('primer_nombre', 'Primer Nombre:') !!}
                {!! Form::text('primer_nombre', null, ['class' => 'form-control', 'maxlength' => 255, 'placeholder' => 'Ingrese su primer nombre']) !!}
            </div>

            <!-- Segundo Nombre Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('segundo_nombre', 'Segundo Nombre:') !!}
                {!! Form::text('segundo_nombre', null, ['class' => 'form-control', 'maxlength' => 255, 'placeholder' => 'Ingrese su segundo nombre']) !!}
            </div>

            <!-- Primer Apellido Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('primer_apellido', 'Primer Apellido:') !!}
                {!! Form::text('primer_apellido', null, ['class' => 'form-control', 'maxlength' => 255, 'placeholder' => 'Ingrese su primer apellido']) !!}
            </div>

            <!-- Segundo Apellido Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('segundo_apellido', 'Segundo Apellido:') !!}
                {!! Form::text('segundo_apellido', null, ['class' => 'form-control', 'maxlength' => 255, 'placeholder' => 'Ingrese su segundo apellido']) !!}
            </div>

            <!-- Celular Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('celular', 'Celular:') !!}
                {!! Form::text('celular', null, ['class' => 'form-control', 'maxlength' => 255, 'placeholder' => 'Ingrese su número de celular']) !!}
            </div>

            <!-- Estado Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('estado', 'Estado:') !!}
                {!! Form::select('estado', ["activo" => "Activo", "inactivo" => "Inactivo"], null, ['class' => 'form-control', 'placeholder' => 'Seleccione el estado']) !!}
            </div>

            @if(Route::is("instructors.create"))
            <div class="form-group col-sm-6">
                {!! Form::label('email', 'Correo:') !!}
                {!! Form::email('email', null, ['class' => 'form-control', 'maxlength' => 255, 'placeholder' => 'Ingrese su correo electrónico']) !!}
            </div>
            @endif

            <!-- Documento Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('documento', 'Documento:') !!}
                {!! Form::text('documento', null, ['class' => 'form-control', 'maxlength' => 255, 'placeholder' => 'Ingrese su documento de identidad', 'readonly' => isset($instructor) && Route::is("instructor.edit") ? 'readonly' : null]) !!}
            </div>

        </div>
    </div>
</div>

@if(Route::is("instructors.edit"))
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="form-group col-sm-12">
                <h6>Datos de acceso</h6>
                <hr>
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('email', 'Correo:') !!}
                {!! Form::email('email', null, ['class' => 'form-control', 'maxlength' => 255, 'placeholder' => 'Ingrese su correo electrónico', 'readonly' => isset($instructor) && Route::is("instructors.edit") ? 'readonly' : null]) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('password', 'Contraseña:') !!} <span class="nota-input">Deje este campo en blanco si no desea realizar cambios en la contraseña.</span>
                {!! Form::password('new-password', [
                    'class' => 'form-control',
                    'maxlength' => 255,
                    'autocomplete' => 'new-password',
                    'placeholder' => 'Ingrese una nueva contraseña si desea cambiarla'
                ]) !!}
            </div>
        </div>
    </div>
</div>
@endif
