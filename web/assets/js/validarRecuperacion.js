document.addEventListener('DOMContentLoaded', function() {
    $("#formEnviarEmail").submit(ingresar);
    $("#cambiarpass").submit(restablecer);
    
    function ingresar(evento){
        evento.preventDefault();
        var datos = new FormData($("#formEnviarEmail")[0]);
        
        $.ajax({
            url: 'includes/Login/checkenviar.php',
            type: 'POST',
            data: datos,
            contentType: false,
            processData: false,
            
            success: function(data){
                if(data==1){                    
                    Swal.fire({
                        title: 'Enlace de recuperacion enviado!',
                        text: 'Revise su bandeja de entrada',
                        icon: 'success',
                    }).then(()=>{
                        //window.location.href = "../../agregarCategorias.php";                    
                    })
                                       
                }else if(data == 2){                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al enviar!!',
                        text: 'Ocurrio un problema al enviar el email',
                    }) 
                }else if(data == 0){                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al enviar!!',
                        text: 'No hay una cuenta con el correo proporcionado',
                    }) 
                }
            }
        })

    }


    function restablecer(evento){
        evento.preventDefault();
        var datos = new FormData($("#cambiarpass")[0]);
        
        $.ajax({
            url: 'includes/Login/checkcambiar.php',
            type: 'POST',
            data: datos,
            contentType: false,
            processData: false,
            
            success: function(data){
                if(data==1){                    
                    Swal.fire({
                        title: 'Se cambio la contraseña!',
                        text: 'inicie sesion con su nueva contraseña',
                        icon: 'success',
                    }).then(()=>{
                        //window.location.href = "../../agregarCategorias.php";                    
                    })
                                       
                }else if(data == 2){                    
                    Swal.fire({
                        icon: 'error',
                        title: 'No se pudo cambiar la contraseña!!',
                        text: 'Ocurrio un problema al cambiar la contraseña',
                    }) 
                }else if(data == 0){                    
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



    function enviar(evento){
        evento.preventDefault();
        var datos = new FormData($("#formEnviarEmail")[0]);
        
        $.ajax({
            url: './includes/Login/checkenviar.php',
            type: 'POST',
            data: datos,
            contentType: false,
            processData: false,
            
            success: function(data){
                if(data==1){                    
                    Swal.fire({
                        title: 'Enlace de recuperacion enviado!',
                        text: 'Revise su bandeja de entrada',
                        icon: 'success',
                    }).then(()=>{
                        //window.location.href = "../../agregarCategorias.php";                    
                    })
                                       
                }else if(data == 2){                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al enviar!!',
                        text: 'Ocurrio un problema al enviar el email',
                    }) 
                }else if(data == 0){                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al enviar!!',
                        text: 'No hay una cuenta con el correo proporcionado',
                    }) 
                }
            }
        })

    }
