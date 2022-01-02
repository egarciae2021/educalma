//Función para el dropdown en header
function dropdown(){
    document.getElementById("menu_dropdown").classList.toggle("show");
}
// Cerrar el dropdown si se hace click fuera
window.onclick = function(event) {
    if (!event.target.matches('.btn-dropdown')) {
      var dropdowns = document.getElementsByClassName("content_dropdown");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }

//función de  mensaje cargando
function onload(){
  swal({title: "Iniciando Sesión...",allowEscapeKey: false,allowOutsideClick:false,text: "Espere unos segundos por favor.",showConfirmButton: false,timer: 25000});
}

// $("#actucurso").click(function(){
//   // var param = $('#form-leditcursos').serialize();
//   var param= new FormData($('#form-leditcursos')[0]);
//   // var ft= document.getElementById('#file-upload');
//   alert(param);
//   $.ajax({
//     data: param,
//     url:"includes/Cursos_crud/Cursos_CRUD.php", 
//     type: 'POST',
//     contentType: false,
//     processData: false,
//     success: function(){
//         alert("funcion");
//         //swal({title: "Curso Actualizado",allowEscapeKey: false,allowOutsideClick:false,text: "El curso se actualizó correctamente.",showConfirmButton: false,timer: 1000});
        
//     }
//   });
// });