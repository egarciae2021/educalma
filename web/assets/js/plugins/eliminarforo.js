//eliminacion de todos los comentarios de ese curso
function AlertEliminaTodo(idtodo) {
    Swal.fire({
        title: 'Estas seguro?',
        text: 'Eliminarás todo los comentarios',
        icon: 'warning',
        showCancelButton: true,
        heightAuto: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete'
    }).then((result) => {
        if (result.isConfirmed) {
            var c="uno";
            $.ajax({
                url: 'includes/curso/foro_delete.php',
                type: 'POST',
                data: {"idCurso":idtodo,"identi":c,
                },
            })
            .done(function(arr) {
                Swal.fire(
                    'Borrado!',
                    arr,
                    'success'
                )
            })
        }
    })
};
//eliminar los comentarios por individual
function AlertEliminacion(id) {
    Swal.fire({
        title: 'Estas seguro hola?',
        text: 'Eliminarás el comentario',
        icon: 'warning',
        showCancelButton: true,
        heightAuto: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete'
    }).then((result) => {
        if (result.isConfirmed) {
            var c="dos";
            $.ajax({
                url: 'includes/curso/foro_delete.php',
                type: 'POST',
                data: {"idComen":id,"identi":c,},
            })
            .done(function(arr) {
                Swal.fire(
                    'Borrado!',
                    arr,
                    'success'
                )
            })
        }
    })
};
/*Eliminar los subComentarios*/
function AlertElimiSubComen(idSub) {
    Swal.fire({
        title: 'Estas seguro prueba?',
        text: 'Eliminarás este comentario por siempre',
        icon: 'warning',
        showCancelButton: true,
        heightAuto: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete'
    }).then((result) => {
        if (result.isConfirmed) {
            var sc="tres";
            //var ruta = "idsubComen=" + idSub+",subcomen="+sc;

            $.ajax({
                url: 'includes/curso/foro_delete.php',
                type: 'POST',
                data: {"idsubComen":idSub,"identi":sc,},
            })
            .done(function(arr) {
                Swal.fire(
                    'Borrado!',
                    arr,
                    'success'
                )
            })
        }
    })
}