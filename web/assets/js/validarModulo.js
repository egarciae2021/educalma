var $registrationFormEdit = $('#form-leditcursos');

if($registrationFormEdit.length){
  $registrationFormEdit.validate({
      rules:{
          //username is the name of the textbox
          nomb_actu_cursos: {
              required: true,
              minlength:2
          },
          publi_cursos: {
            required: true,
            minlength:4
          },
          desc_curso: {
              required: true,
              minlength:6
          },
          intRR_cursos: {
            required: true,
            minlength: 6
          }
          
      },
      messages:{
        nomb_actu_cursos: {
              //error message for the required field
              required: 'Por favor, Ingrese el Nombre!',
              minlength: "Nombre debe ser de por lo menos 2 caracteres"
          },
          publi_cursos: {
            required: 'Por favor, Ingrese el Público que se Dirige!',
            minlength: "Público debe ser de por lo menos 4 caracteres"
          },
          desc_curso: {
              required: 'Por favor, Ingrese la Descripción del Curso!',
              minlength: 'Descripción debe ser de por lo menos 6 caracteres'
          },
          intRR_cursos: {
              required: 'Por favor, Ingrese la Introducción del Curso!',
              minlength: "Introducción debe ser de por lo menos 6 caracteres"
          }
          
      },
  });
}

$("#salir_agregar").click(function () {

    Swal.fire({
        title: '<br>¿Seguro que quieres salir de modulos?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Si',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.href ="./user-sidebar.php";
        }
      })
      
});

// Actualizado 

$("#salir_public").click(function () {

  Swal.fire({
      title: '¿Seguro que quieres finalizar la edición del curso?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Si',
      cancelButtonColor: '#FF0000',
      cancelButtonText: 'No',
    }).then((result) => {
      if (result.isConfirmed) {
          window.location.href ="publicarcursos.php?pag=1";
      }
    })
    
});