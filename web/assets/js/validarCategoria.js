

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