document.addEventListener('DOMContentLoaded', function() {
    $("#formEnviarEmail").submit(ingresar);
    $("#cambiarpass").submit(restablecer);

    function ingresar(evento) {
        evento.preventDefault();
        var datos = new FormData($("#formEnviarEmail")[0]);

        $.ajax({
            url: 'includes/Login/checkenviar.php',
            type: 'POST',
            data: datos,
            contentType: false,
            processData: false,

            success: function(data) {
                if (data == 1) {
                    Swal.fire({
                        title: 'Enlace de recuperacion enviado!',
                        text: 'Revise su bandeja de entrada',
                        icon: 'success',
                    }).then(() => {
                        window.location.href = "./iniciosesion.php";
                    })

                } else if (data == 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al enviar!!',
                        text: 'Ocurrio un problema al enviar el email',
                    })
                } else if (data == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al enviar!!',
                        text: 'No hay una cuenta con el correo proporcionado',
                    })
                }
            }
        })

    }


    function restablecer(evento) {
        evento.preventDefault();
        var datos = new FormData($("#cambiarpass")[0]);

        $.ajax({
            url: 'includes/Login/checkcambiar.php',
            type: 'POST',
            data: datos,
            contentType: false,
            processData: false,

            success: function(data) {
                if (data == 1) {
                    Swal.fire({
                        title: 'Se cambio la contraseña!',
                        text: 'inicie sesion con su nueva contraseña',
                        icon: 'success',
                    }).then(() => {
                        window.location.href = "./iniciosesion.php";
                    })

                } else if (data == 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'No se pudo cambiar la contraseña!!',
                        text: 'Ocurrio un problema al cambiar la contraseña',
                    })
                } else if (data == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Las contraseñas no coinciden!!',
                        text: 'Vuelva introducir las contraseñas',
                    })
                }
            }
        })

    }


});



function enviar(evento) {
    evento.preventDefault();
    var datos = new FormData($("#formEnviarEmail")[0]);

    $.ajax({
        url: './includes/Login/checkenviar.php',
        type: 'POST',
        data: datos,
        contentType: false,
        processData: false,

        success: function(data) {
            if (data == 1) {
                Swal.fire({
                    title: 'Enlace de recuperacion enviado!',
                    text: 'Revise su bandeja de entrada',
                    icon: 'success',
                }).then(() => {
                    //window.location.href = "../../agregarCategorias.php";                    
                })

            } else if (data == 2) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error al enviar!!',
                    text: 'Ocurrio un problema al enviar el email',
                })
            } else if (data == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error al enviar!!',
                    text: 'No hay una cuenta con el correo proporcionado',
                })
            }
        }
    })

}

// Función Actualizar Mi Cuenta : Password
function actualizarPass() {
    var email_user = document.getElementById('cuentaEmail1').value;

    Swal.fire({
        title: '¿SEGURO QUE DESEA ACTUALIZAR SU CONTRASEÑA?',
        text: "Se le enviara un enlace a su correo para cambiar la contraseña",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Actualizar',
        cancelButtonText: 'Cancelar'
    }).then(function() {
        $.ajax({
            url: "./includes/Login/checkenviar.php",
            type: "POST",
            dataType: 'json',
            data: {
                email_user: email_user,
            },
            cache: false,
            success: function(data) {
                if (data == 1) {
                    Swal.fire({
                        title: 'Enlace para cambiar contraseña enviado',
                        text: 'revise su bandeja de entrada o spam',
                        icon: 'success',
                    }).then(function() {
                        window.location.href = 'includes/login/logout.php'
                            //window.location.href = './login.php'
                    });

                } else if (data == 2) {
                    Swal.fire("Falló al enviar", "Ocurrio un problema al enviar el email", "error");
                } else if (data == 0) {
                    Swal.fire("Falló al enviar", "Ocurrio un problema al enviar el email", "error");
                } else if (data == 3) {
                    Swal.fire("El enlace de recuperacion ya fue enviado", "Por favor revice su bandeja de entrada y/o spam", "error");
                }
                // swal({
                //     title: 'Contraseña Actualizada',
                //     text: 'Se ha actualizado la contraseña de su cuenta satisfactoriamente. Debe iniciar sesión nuevamente.',
                //     icon: 'success',
                // }).then(function(){ 
                //     window.location.href = 'includes/login/logout.php'
                // });
            }
        })


    }, function(dismiss) {
        if (dismiss === 'cancel') {}
    })
}

function cargandoEnviar() {
    Swal.fire({
        title: "Enviado mensaje...",
        allowEscapeKey: false,
        allowOutsideClick: false,
        text: "Espere unos segundos por favor.",
        showConfirmButton: false,
        timer: 25000,
    });
}