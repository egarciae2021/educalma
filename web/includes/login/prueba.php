<?php

require_once "Mail.php";
    
  
    
    $tok = '1111111';
    $from = 'garcia4014@gmail.com';
    $to = '73246932@certus.edu.pe';

    $host = "smtp-relay.sendinblue.com";
    $port = "587";
    $username = 'garcia4014@gmail.com';
    $password = 'xsmtpsib-0c133d4e0985fcf1cb9032796695f9084443f760333022d7f2c1950244d13d34-PBqXz5Dh9m6cVGxr';
 

    $subject = "test";
  

    $body = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <header>
            <!--Con word-wrap: break-word; evitamos el desbordamiento del contenido del div.-->
            <div style="color: white; text-align: center; font-family: arial; background-color: #7c83fd; padding: 30px; word-wrap: break-word; font-size: 25px;">
                <span>Solicitud de restablecimiento de contraseña</span>
            </div>
        </header>
        <section>
            <div>
                <p style="padding: 20px; font-size: 18px;">
                    Hola,
                    <br><br><br>
                    Alguien ha solicitado una nueva contraseña para tu cuenta de EduCalma.
                    <br><br><br>
                    Haga clic en el botón para completar el proceso.
                </p>
    
                <div style="text-align: center; background-color: #7c83fd; padding: 10px; width: 180px; margin-left: 20px;">
                    <a style="text-decoration: none; color: white; padding: 10px;" href=http://20.226.29.168/cambiar_contrase%C3%B1a.php?token='.$tok.' class="es-button" target="_blank">Restablecer contraseña</a>
                </div>
                
                <p style="color: #BBBBBB; font-family: arial; font-size: 14px; margin-left: 20px; margin-bottom: 20px;"><i>Ignore este correo electrónico si no solicitó un cambio de contraseña.</i></p>
            </div>
    
        </section>
        <footer>
            <div style="background-color: #7c83fd; padding: 30px 120px 30px; text-align: center;"><span>Company &#169; All Rights Reserved</span> </div>
        </footer>
        
    </body>
    </html>';



    $headers = array ('From' => $from, 'To' => $to,'Subject' => $subject,'Content-type'=>'text/html');
    

    $smtp = Mail::factory('smtp',
    array ('host' => $host,
    'port' => $port,
    'auth' => true,
    'username' => $username,
    'password' => $password));

    $mail = $smtp->send($to, $headers, $body);

    if (PEAR::isError($mail)) {
    echo($mail->getMessage());
    }  

    else {echo "Todo ok ";}

    ?>