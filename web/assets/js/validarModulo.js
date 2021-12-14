$("#salir_agregar").click(function () {

    Swal.fire({
        title: '<br>¿Seguro que quieres salir de modulos?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Si',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.href ="listaCursos.php";
        }
      })
      
});