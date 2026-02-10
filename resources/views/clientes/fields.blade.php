<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <strong>Datos Personales</strong><hr>
            </div>

             <!-- Foto Perfil Field -->
             <div class="form-group col-sm-6">
                {!! Form::label('foto_perfil', 'Foto Perfil:') !!}
                {!! Form::file('file_foto_perfil', ['class' => 'form-control', 'maxlength' => 255]) !!}
            </div>

            <!-- Primer Nombre Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('primer_nombre', 'Primer Nombre:') !!}
                {!! Form::text('primer_nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su primer nombre']) !!}
            </div>

            <!-- Segundo Nombre Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('segundo_nombre', 'Segundo Nombre:') !!}
                {!! Form::text('segundo_nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su segundo nombre']) !!}
            </div>

            <!-- Primer Apellido Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('primer_apellido', 'Primer Apellido:') !!}
                {!! Form::text('primer_apellido', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su primer apellido']) !!}
            </div>

            <!-- Segundo Apellido Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('segundo_apellido', 'Segundo Apellido:') !!}
                {!! Form::text('segundo_apellido', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su segundo apellido']) !!}
            </div>

            <!-- Celular Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('celular', 'Celular:') !!}
                {!! Form::text('celular', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su número de celular']) !!}
            </div>

            <!-- Documento Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('documento', 'Documento:') !!}
                {!! Form::text('documento', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su número de documento']) !!}
            </div>

            <!-- Correo Field para creación de cliente -->
            @if(Route::is("clientes.create"))
                <div class="form-group col-sm-6">
                    {!! Form::label('correo', 'Correo:') !!}
                    {!! Form::text('email', null, ['class' => 'form-control', 'maxlength' => 100, 'placeholder' => 'Ingrese su correo electrónico']) !!}
                </div>
            @endif
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <strong>Datos del Gimnasio</strong><hr>
            </div>

            <!-- Fecha Inscripcion Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('fecha_inscripcion', 'Fecha Inscripción:') !!}
                {!! Form::date('fecha_inscripcion', isset($cliente) ? $cliente->fecha_inscripcion : null, ['class' => 'form-control', 'id' => 'fecha_inscripcion']) !!}
            </div>

            <!-- Talla Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('talla', 'Talla:') !!}
                {!! Form::number('talla', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su talla en cm']) !!}
            </div>

            <!-- Peso Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('peso', 'Peso:') !!}
                {!! Form::text('peso', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su peso en kg']) !!}
            </div>

            <!-- Perímetro Abdominal Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('perimetro_abdominal', 'Perímetro Abdominal:') !!}
                {!! Form::number('perimetro_abdominal', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su perímetro abdominal en cm']) !!}
            </div>

            <!-- Porcentaje Grasa Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('porcentaje_grasa', 'Porcentaje Grasa:') !!}
                {!! Form::number('porcentaje_grasa', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su porcentaje de grasa corporal']) !!}
            </div>

            <!-- Porcentaje Musculo Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('porcentaje_musculo', 'Porcentaje Músculo:') !!}
                {!! Form::number('porcentaje_musculo', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su porcentaje de músculo corporal']) !!}
            </div>

            <!-- Estado Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('estado', 'Estado:') !!}
                {!! Form::select('estado', ['activo' => 'Activo', 'inactivo' => 'Inactivo'], null, ['class' => 'form-control',"placeholder"=>"Seleccionar"]) !!}
            </div>
        </div>
    </div>
</div>

@if(Route::is("clientes.edit"))
    <div class="card mt-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <strong>Datos de Acceso</strong><hr>
                </div>
                <!-- Correo Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('correo', 'Correo:') !!}
                    {!! Form::text('email', null, ['class' => 'form-control', 'maxlength' => 100, 'placeholder' => 'Ingrese su correo electrónico']) !!}
                </div>

                <!-- Contraseña Field -->
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
