$("#salir_agregar").click(function () {

    Swal.fire({
        title: '¿Seguro que quieres salir de modulos?',
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar'
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.href ="listaCursos.php";
        }
      })
      
});