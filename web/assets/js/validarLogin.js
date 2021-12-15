document.addEventListener('DOMContentLoaded', function() {
    //$("#form_enviar").submit(enviar);
    var $registrationForm = $('#form_login');

    if($registrationForm.length){
    $registrationForm.validate({
        rules:{
            //username is the name of the textbox
            email_user_login: {
                required: true,
            },
            pass_login: {
                required: true
            }
        },
        messages:{
            email_user_login: {
                //error message for the required field
                required: 'Por favor, Ingrese su Correo!'
            },
            pass_login: {
                required: 'Por favor, Ingrese su Contraseña!'
            }
        },
    });
    }

});

$(document).ready(function(){
    $("#form_login").submit(loguear);
    
    function loguear(evento){
        evento.preventDefault();
        var datos = new FormData($("#form_login")[0]);
        
        $.ajax({
            url: 'includes/login/checklogin.php',
            type: 'POST',
            data: datos,
            contentType: false,
            processData: false,
            
            success: function(data){

                if(data==0){
                    Swal.fire({
                        title: 'Ingreso Exitoso!',
                        icon: 'success',
                        timer: 900,
                        showConfirmButton: false,
                    }).then(()=>{
                        window.location.href = "index.php";
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Fallo al Iniciar Sesión!!',
                        text: 'Correo o Contraseña incorrectos',
                        timer: 1000,
                        showConfirmButton: false,
                    })
                }
            }
        })
    }
})