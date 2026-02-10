$(document).ready(function() {
    $("#miFormulario").validate({
      rules: {
        logo: "required",
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
        logo: "Por favor ingresa el logo",
        direccion: "Por favor ingresa la dirección",
        telefono: "Por favor ingresa el teléfono",
        celular: "Por favor ingresa el celular",
        correo: {
          required: "Por favor ingresa el correo",
          email: "Por favor ingresa un correo válido"
        },
        nit: "Por favor ingresa el NIT",
        razon_social: "Por favor ingresa la razón social"
      },
      submitHandler: function(form) {
        // Tu lógica de envío aquí
      }
    });
  });