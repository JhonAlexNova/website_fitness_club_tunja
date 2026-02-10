@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Crear Producto</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

            {!! Form::open(['route' => 'productos.store', 'files'=>true]) !!}


                @include('productos.fields')
            

            <div class="card-footer">
            <button type="submit" class='btn btn-primary'><i class="fa fa-floppy-o" aria-hidden="true"></i> Crear</button>
                <a href="{{ route('productos.index') }}" class="btn btn-default"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Volver</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection


@push('page_scripts')
@include("shared.ckeditor")
<script>
     function disableEnterKey(event) {
            if (event.keyCode === 13) { // 13 es el código de tecla para Enter
                event.preventDefault(); // Previene la acción por defecto (enviar el formulario)
            }
        }

        $(document).ready(function() {
        // Mostrar y ocultar secciones al activar checkbox
        $('.caracteristica').change(function() {
            var target = $(this).data('target');
            $(target).slideToggle(this.checked);
        });

        // Lógica para agregar otra variación de cualquier característica
        $(document).on('click', '.agregar-variacion', function() {
            // Clonar la última fila de variación dentro del contenedor correspondiente
            var contenedor = $(this).closest('.valores').find('.variaciones');
            var nuevaVariacion = contenedor.find('.variacion:last').clone();

            // Vaciar los campos de la nueva variación
            nuevaVariacion.find('select').val('');
            nuevaVariacion.find('input[type="text"]').val('');
            nuevaVariacion.find('input[type="number"]').val('');

            // Agregar la nueva variación al contenedor correspondiente
            contenedor.append(nuevaVariacion);

            // Actualizar las opciones deshabilitadas para todas las características
            actualizarOpciones();
        });

        // Función para actualizar las opciones de todas las características
        function actualizarOpciones() {
            // Para cada contenedor de variaciones (una por cada característica)
            $('.variaciones').each(function() {
                var opcionesSeleccionadas = [];

                // Obtener todas las opciones seleccionadas dentro de este contenedor
                $(this).find('select').each(function() {
                    var seleccion = $(this).val();
                    if (seleccion) {
                        opcionesSeleccionadas.push(seleccion); // Almacena las opciones seleccionadas
                    }
                });

                // Deshabilitar las opciones seleccionadas dentro del mismo contenedor
                $(this).find('select').each(function() {
                    var selectActual = $(this);
                    selectActual.find('option').each(function() {
                        var valor = $(this).val();

                        // Verifica si esta opción ha sido seleccionada en otra variación
                        if (opcionesSeleccionadas.includes(valor) && valor !== "") {
                            $(this).prop('disabled', true); // Deshabilita la opción si ya fue seleccionada
                        } else {
                            $(this).prop('disabled', false); // Habilita la opción si no ha sido seleccionada
                        }
                    });
                });
            });
        }

        // Actualizar opciones cada vez que se selecciona una opción en cualquier característica
        $(document).on('change', 'select', function() {
            actualizarOpciones(); // Actualiza las opciones deshabilitadas
        });
    });




  
</script>
@endpush