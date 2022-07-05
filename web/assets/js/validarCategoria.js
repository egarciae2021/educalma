

/*
$("#newUserForm").on("click", function(e){

e.preventDefault();


})
*/

$.validator.addMethod("yturl", function(_value,_element,_parameter){
    const reg = /^(https?:\/\/)?(www\.)?((?:youtube\.com)|(?:youtu(?:\.)be))(?:\/)(?:(?:watch\?(v=))|(?:embed\/))?([\w\-]{11,11})(?:&[\w\?=]*)?$/gm;
    if(reg.test(_value)) return true;
    else return false;
},"El Link del vídeo no es válido")

//Validación Formulario AgregarCurso - RegistroDeCursoNuevo

$('#newUserForm').validate({
    rules:{
        //username is the name of the textbox
        nombres_agrecursos: {
            required: true,
            minlength:2
        },
        categoria: {
            required: true
        },
        descripcio_curso: {
            required: true,
            minlength:6
        },
        intro_curso: {
            required: true,
            minlength: 6
        },
        publico_dirigido: {
            required: true,
            minlength:4
        },
        link_trailer:{
            required: true,
            yturl: true
        }
    },
    messages:{
        nombres_agrecursos: {
            required: 'Por favor, Ingrese el Nombre!',
            minlength: "Nombre debe ser de por lo menos 2 caracteres"
        },
        categoria: {
            required: 'Por favor, Seleccionar una Categoría!'
        },
        descripcio_curso: {
            required: 'Por favor, Ingrese la Descripción del Curso!',
            minlength: 'Descripción debe ser de por lo menos 6 caracteres'
        },
        intro_curso: {
            required: 'Por favor, Ingrese la Introducción del Curso!',
            minlength: "Introducción debe ser de por lo menos 6 caracteres"
        },
        publico_dirigido: {
            required: 'Por favor, Ingrese el Público que se Dirige!',
            minlength: "Público debe ser de por lo menos 4 caracteres"
        },
        link_trailer: {
            required: 'Por favor, Ingrese el Link del vídeo!'
        }
    }
});

var $registrationForm2 = $('#form-agretemas');

if($registrationForm2.length){
  $registrationForm2.validate({
      rules:{
          //username is the name of the textbox
          modulo_agregar: {
              required: true,
              minlength:2
          }
      },
      messages:{
        modulo_agregar: {
              //error message for the required field
              required: 'Por favor, Ingrese el Nombre del Módulo!',
              minlength: "Nombre de Módulo debe ser de por lo menos 2 caracteres"
          }
      },
  });
}

//Validación Formulario AgregarTema

$('#form-agretemas2').validate({
    rules:{
        //username is the name of the textbox
        temas_agregar: {
            required: true,
            minlength: 2
        },
        link: {
            required: true,
            yturl: true//function(){return $('#link').val()}
        },
        descripcio_tema: {
            required: true,
            minlength: 6
        }
    },
    messages:{
        temas_agregar: {
            required: 'Por favor, Ingrese el Nombre del Tema!',
            minlength: "Nombre del Tema debe ser de por lo menos 2 caracteres"
        },
        link: {
            required: 'Por favor, Ingrese el Link del vídeo!',
        },
        descripcio_tema: {
            required: 'Por favor, Ingrese la Descripción del Tema!',
            minlength: "La Descripción debe ser de por lo menos 6 caracteres"
        }
    }
});


var $registrationForm4 = $('#form-agretemas3');

if($registrationForm4.length){
  $registrationForm4.validate({
      rules:{
          //username is the name of the textbox
          actu_nomb_agregar: {
              required: true,
              minlength:2
          }
          },
      messages:{
        actu_nomb_agregar: {
              //error message for the required field
              required: 'Por favor, Ingrese el Nombre Nuevo del Modulo!',
              minlength: "Nombre del Modulo debe ser de por lo menos 2 caracteres"
          }
      },
  });
}

var $registrationForm5 = $('#preguntas_cuestionario');

if($registrationForm5.length){
  $registrationForm5.validate({
      rules:{
          //username is the name of the textbox
          pregunta: {
              required: true,
              minlength:3
          }
          },
      messages:{
        pregunta: {
              //error message for the required field
              required: 'Por favor, Ingrese una Pregunta!',
              minlength: "Pregunta debe ser de por lo menos 3 caracteres"
          }
      },
  });
}

var $registrationForm6 = $('#respuestas_cuestionario');

if($registrationForm6.length){
  $registrationForm6.validate({
      rules:{
          //username is the name of the textbox
          respuesta: {
              required: true
          }
          },
      messages:{
        respuesta: {
              //error message for the required field
              required: 'Por favor, Ingrese una Respuesta!'
          }
      },
  });
}

var $registrationForm7 = $('#editando_preguntas');

if($registrationForm7.length){
  $registrationForm7.validate({
      rules:{
          //username is the name of the textbox
          actuali_pregunta: {
              required: true,
              minlength:3
          }
          },
      messages:{
        actuali_pregunta: {
              //error message for the required field
              required: 'Por favor, Ingrese una Pregunta!',
              minlength:'Pregunta debe ser de por lo menos 3 caracteres'
          }
      },
  });
}

var $registrationForm8 = $('#editando_respuestas');

if($registrationForm8.length){
  $registrationForm8.validate({
      rules:{
          //username is the name of the textbox
          actu_respuesta: {
              required: true
          }
          },
      messages:{
        actu_respuesta: {
              //error message for the required field
              required: 'Por favor, Ingrese una Respuesta!'
          }
      },
  });
}