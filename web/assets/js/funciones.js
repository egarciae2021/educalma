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
// function agregarDatos(curso,usuario){
//   cadena="curso="+curso+"&usuario="+usuario;
//   $.ajax({
//     type:"POST",
//     url:"includes/Business/addcurso.php",
//     data:cadena,
//     success:function(r){
//       if(r==1){
//         $('#tabla').load('includes/Business/cursosEmp.php');
//         // swal({title: "Curso Agregado",allowEscapeKey: false,allowOutsideClick:false,text: "El curso se agregó correctamente.",showConfirmButton: false,timer: 1000});
//         alert("Curso Agregado");
//         // $('#form-leditcursos')[0].reset();
//       }else{
//         // swal({title: "Curso No Agregado",allowEscapeKey: false,allowOutsideClick:false,text: "El curso no se agregó correctamente.",showConfirmButton: false,timer: 1000});
//         alert("Curso No Agregado");
//       }
//     }
//   })
// }
var clipboard = new ClipboardJS('.portapapeles');
clipboard.on('success',function(e){
  // alert("Copiado al portapapeles");
})
clipboard.on('error',function(e){
  alert("No se pudo copiar al portapapeles");
})