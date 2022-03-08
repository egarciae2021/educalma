$("#salir_agregar").click(function () {

    Swal.fire({
        title: '<br>¿Seguro que quieres salir de modulos?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Si',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.href ="ListaCursos.php";
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