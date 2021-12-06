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