

/*
$("#newUserForm").on("click", function(e){

e.preventDefault();


})
*/
    

    var $registrationForm = $('#newUserForm');

if($registrationForm.length){
  $registrationForm.validate({
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
          }
      },
      messages:{
          nombres_agrecursos: {
              //error message for the required field
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
          }
      },
  });
}

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

var $registrationForm3 = $('#form-agretemas2');

if($registrationForm3.length){
  $registrationForm3.validate({
      rules:{
          //username is the name of the textbox
          temas_agregar: {
              required: true,
              minlength:2
          },
          link:{
              required: true,
              minlength:4
          },
          descripcio_tema:{
              required: true,
              minlength:5
          }
      },
      messages:{
        temas_agregar: {
              //error message for the required field
              required: 'Por favor, Ingrese el Nombre del Tema!',
              minlength: "Nombre del Tema debe ser de por lo menos 2 caracteres"
          },
          link:{
            required: 'Por favor, Ingrese el Link',
            minlength:'Link debe ser de por lo menos 4 caracteres'
        },
        descripcio_tema:{
            required: 'Por favor, Ingrese una Descripción',
            minlength: 'Descripción debe ser de por lo menos 5 caracteres'
        }
      },
  });
}

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