/* validar configuracion */
$(document).ready(function() {

    $("#formEditConfiguracion").validate({
      rules: {
        direccion: "required",
        telefono: "required",
        celular: "required",
        correo: {
          required: true,
          email: true
        },
        nit: "required",
        razon_social: "required"
      },
      messages: {
        direccion: "Por favor ingresa la dirección",
        telefono: "Por favor ingresa el teléfono",
        celular: "Por favor ingresa el celular",
        correo: {
          required: "Por favor ingresa el correo",
          email: "Por favor ingresa un correo válido"
        },
        nit: "Por favor ingresa el NIT",
        razon_social: "Por favor ingresa la razón social"
      }
/*       submitHandler: function(form) {
        $(this).submit();
      } */
    });

    /* VALIDAR CREAR EMPLEADOS */
    $("#formEditEmpleado, #formCreateEmpleado").validate({
        rules: {
            username: "required",
            primer_nombre: "required",
            primer_apellido: "required",
            segundo_apellido: "required",
            celular: "required",
            estado: "required",
            email: {
                required: true,
                email: true
            },
            documento: "required"
        },
        messages: {
            username: "Por favor ingresa el nombre de usuario",
            primer_nombre: "Por favor ingresa el primer nombre",
            segundo_nombre: "Por favor ingresa el segundo nombre",
            primer_apellido: "Por favor ingresa el primer apellido",
            segundo_apellido: "Por favor ingresa el segundo apellido",
            celular: "Por favor ingresa el número de celular",
            estado: "Por favor selecciona un estado",
            email: {
                required: "Por favor ingresa el correo electrónico",
                email: "Por favor ingresa un correo válido"
            },
            documento: "Por favor ingresa el número de documento",
        }
      });
    /* VALIDAR CATEGORIAS  */

    $("#formCreateCategoria, #formEditCategoria").validate({
      rules: {
          nombre: "required",
          descripcion: "required"
      },
      messages: {
          nombre: "Por favor ingresa el nombre de usuario",
          descripcion: "Por favor ingresa la descripcion"
      }
    });


    $('.datatableSimple').DataTable({
      responsive: true,
      dom: 'Bfrtip', 
      buttons: [
        'excelHtml5'      
      ],

    });


  });


  /* datatables */
