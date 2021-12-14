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

    // function enviar(evento){
    //     evento.preventDefault();
    //     var datos = new FormData($("#formEnviarEmail")[0]);
        
    //     $.ajax({
    //         url: './includes/Login/checkenviar.php',
    //         type: 'POST',
    //         data: datos,
    //         contentType: false,
    //         processData: false,
            
    //         success: function(data){
    //             alert(data);
    //             console.log(data);
    //             if(data==1){                    
    //                 Swal.fire({
    //                     title: 'Enlace de recuperacion enviado!',
    //                     text: 'Revise su bandeja de entrada',
    //                     icon: 'success',
    //                 }).then(()=>{
    //                     //window.location.href = "../../agregarCategorias.php";                    
    //                 })
                                       
    //             }else if(data == 2){                    
    //                 Swal.fire({
    //                     icon: 'error',
    //                     title: 'Error al enviar!!',
    //                     text: 'Ocurrio un problema al enviar el email',
    //                 }) 
    //             }else if(data == 0){                    
    //                 Swal.fire({
    //                     icon: 'error',
    //                     title: 'Error al enviar!!',
    //                     text: 'No hay una cuenta con el correo proporcionado',
    //                 }) 
    //             }else{
    //                 alert(data);
    //             }

    //         }
    //     })

    // }




});