@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Editar Producto</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')
        @include('flash::message')

            {!! Form::model($producto, ['route' => ['productos.update', $producto->id], 'method' => 'patch','files'=>true]) !!}
                @include('productos.fields')
                <div class="row">
                    <div class="col-md-12 form-group">
                        <button type="submit" class='btn btn-primary'><i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar</button>
                        <a href="{{ route('productos.index') }}" class="btn btn-default"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Volver</a>
                    </div>
                </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
@push('page_scripts')
@include("shared.ckeditor")
<script>
    var producto = @json($producto);
    $(document).on("click",".btnAddVariacion",function(e){
        let caracteristica_id = $(this).attr("data-id");
        /* obtener valores caracteristica */
        $.get('/admon/valores-caracteristica/'+caracteristica_id, function(data) {
           
            var valoresCaracteristica = "";

            $.each(data, function(el){  
                valoresCaracteristica+=`
                    <option value="${this.id}">  ${this.valor} </option>
                `;
            });

            var html = `
                <div class="col-md-12">
                    <label>Seleccionar </label>
                    <select name="valor_caracteristica_id" class="form-control">
                        ${valoresCaracteristica}
                    </select>
                </div>

                <div class="col-md-12">
                    <label>Precio venta variación </label>
                    <input type="number" class="form-control" name="precio">
                </div>
            `; 

            $("#modalNewVariacionProducto .modal-body .row").html(html);
            $("input[name=precio]").val(producto.precio_venta);
            $("#modalNewVariacionProducto").modal("show");
        }).fail(function() {
            // Manejo de errores
            console.error('Error al realizar la solicitud.');
        });
        
    });


    $('.enviarVariacion').on('click', function() {
        // Obtener el valor seleccionado
        var valorCaracteristicaId = $('select[name="valor_caracteristica_id"]').val();
        var precio = $("input[name=precio]").val();

        // Datos que se enviarán en el POST
        var data = {
            valor_caracteristica_id: valorCaracteristicaId,
            producto_id:producto.id,
            precio:precio,
            // Agrega otros datos que necesites enviar
            _token: $('meta[name="csrf-token"]').attr('content') // Incluye el token CSRF de Laravel
        };

        // Realizar la solicitud POST
        $.post('/admon/variacionProductos', data, function(response) {
            // Manejo de la respuesta exitosa
            
            $('#modalNewVariacionProducto').modal('hide');

            
            let caracteristicaId = $("#modalNewVariacionProducto input[name=caracteristica_id]").val();
            let data = {
                caracteristica_id:caracteristicaId,
                producto_id:producto.id
            }
            
            getVariacionesProducto(data);

        }).fail(function(error) {
            // Manejo de errores
            console.error('Error al crear la variación del producto:', error);
            alert('Ocurrió un error al crear la variación del producto.');
        });
    });

    $('#accordion').on('show.bs.collapse', '.collapse', function () {
        // Obtén el ID desde el atributo data-id del elemento que se está expandiendo
        let caracteristicaId = $(this).data('id');
        let data = {
            caracteristica_id:caracteristicaId,
            producto_id:producto.id
        }

        $("#modalNewVariacionProducto input[name=caracteristica_id]").val(caracteristicaId);

        getVariacionesProducto(data);

    });

    function getVariacionesProducto(data){
        // Supongamos que tienes los valores de producto_id y caracteristica_id
        let producto_id = 1; // Cambia esto al ID de producto real
        let caracteristica_id = 2; // Cambia esto al ID de característica real

        // Realiza la solicitud GET a la ruta
        $.get(`/admon/variaciones-producto/${data.producto_id}/${data.caracteristica_id}`, function(response) {
            var html = "";
            $.each(response,function(index){
                console.log(this);
                html+= `
                    <tr>
                        <td> ${this.valor_caracteristica.valor}  </td>
                        <td> ${this.precio}  </td>
                    </tr>
                `;
            });
            
            $(`.collapse${data.caracteristica_id} table tbody`).html(html);
        }).fail(function() {
            console.error("Error al obtener las variaciones del producto");
        });

    }


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
                           // $(this).prop('disabled', true); // Deshabilita la opción si ya fue seleccionada
                        } else {
                           // $(this).prop('disabled', false); // Habilita la opción si no ha sido seleccionada
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


<script>
   // Mostrar la imagen de portada
   function mostrarPortada(event) {
      const portadaContainer = document.getElementById('portadaContainer');
      const vistaPreviaPortada = document.getElementById('vistaPreviaPortada');
      const placeholderPortada = document.getElementById('placeholderPortada');
      const archivo = event.target.files[0];
      
      if (archivo) {
         vistaPreviaPortada.src = URL.createObjectURL(archivo);
         vistaPreviaPortada.style.display = 'block';
         placeholderPortada.style.display = 'none';
      }
   }

   // Agregar imágenes a la galería
   function agregarImagenesGaleria(event) {
      const galeriaContainer = document.getElementById('galeriaContainer');
      const uploadPlaceholder = document.getElementById('uploadPlaceholder');

      Array.from(event.target.files).forEach((archivo) => {
         const reader = new FileReader();
         reader.onload = function(e) {
            const col = document.createElement('div');
            col.classList.add('col-md-3', 'position-relative', 'd-flex', 'align-items-center', 'justify-content-center', 'border', 'rounded');
            col.style.height = '120px';
            
            col.innerHTML = `
               <img src="${e.target.result}" alt="Imagen de galería" class="img-fluid rounded" style="width: 100%; height: 100%; object-fit: cover;">
               <button type="button" class="btn btn-danger btn-sm position-absolute" style="top: 5px; right: 5px;" onclick="eliminarImagenGaleria(this)">X</button>
            `;
            
            galeriaContainer.insertBefore(col, uploadPlaceholder);
         };
         reader.readAsDataURL(archivo);
      });
   }

   // Eliminar una imagen de la galería
   function eliminarImagenGaleria(button) {
      const col = button.closest('.col-md-3');
      const imagenId = col.getAttribute('data-id'); // Obtener el ID si existe

      if (imagenId) {
         // Si la imagen ya está en la base de datos, agregar su ID al campo oculto
         const imagenesEliminadas = document.getElementById('imagenesEliminadas');
         const idsEliminados = imagenesEliminadas.value ? imagenesEliminadas.value.split(',') : [];
         
         if (!idsEliminados.includes(imagenId)) {
            idsEliminados.push(imagenId);
            imagenesEliminadas.value = idsEliminados.join(',');
         }
      }
      
      // Eliminar el elemento de la galería del DOM
      col.remove();
   }
</script>

@endpush