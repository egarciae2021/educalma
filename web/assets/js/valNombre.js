function valNombre(e) {
    var key = e.keyCode || e.which,
      tecla = String.fromCharCode(key).toLowerCase(),
      letras = " áéíóúabcdefghijklmnñopqrstuvwxyz",
      especiales = [8, 37, 39, 46],
      tecla_especial = false;

    for (var i in especiales) {
      if (key == especiales[i]) {
        tecla_especial = true;
        break;
      }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
      return false;
    }
  }

  $('#validacion').validate({
    rules:{
        //username is the name of the textbox
        nomCompleto: {
          required: true,
          minlength:10
        },
        txtEmail:{
          required: true,
        },
        txtEmpresa:{
          required: true,
          minlength: 5
        },
        txtTelMovil:{
          required: true,
        },
        txtTamEmpresa: {
          required: true
        },
        suscripNum:{
          required: true,
        },
        objEmpresa: {
            required: true,
            minlength:6
        }
    },
    messages:{
        nomCompleto: {
            required: 'Por favor, Ingrese su Nombre!',
            minlength: "Nombre debe ser de por lo menos 10 caracteres"
        },
        txtEmail: {
          required: 'Por favor, Ingrese su Correo!',
        },
        txtEmpresa:{
          required: 'Por favor, Ingrese el Nombre de la Empresa!',
          minlength: "Nombre debe ser de por lo menos 5 caracteres"
        },
        txtTelMovil:{
          required:'Por favor, Ingrese su Teléfono!'
        },
        txtTamEmpresa: {
          required: 'Por favor, Seleccionar una Categoría!'
        },
        suscripNum:{
          required: 'Por favor,Ingrese la Cantidad de Suscriptores!'
        },
        objEmpresa: {
            required: 'Por favor, Ingrese un Comentario!',
            minlength: 'Descripción debe ser de por lo menos 6 caracteres'
        }
    }
});
