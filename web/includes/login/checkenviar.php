<?php
    //iniciar componentes de sesión
    ob_start(); 
    session_start();
    
    require_once "Mail.php";
    
    function enviar_correo($t,$em){ 
    
    $tok = $t;
    $from = "notificaciones.mail.1S@gmail.com";
    $to = $em;

    $host = "ssl://smtp.gmail.com";
    $port = "465";
    $username = 'notificaciones.mail.1S@gmail.com';
    $password = 'amaterasu1';
 

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
        <span class="es-button-border"><a href=http://20.226.29.168/educalma/cambiar_contrase%C3%B1a.php?token='.$tok.' class="es-button" target="_blank">RESET PASSWORD</a></span>
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
    }

    $num_filas=0;
            if(isset($_POST["email_user"])){
                $enlace = new mysqli('20.226.29.168', 'root', '', 'educalma');
                if($enlace){
                    $email_user = $_POST["email_user"];
                    $querys=("Select * from usuarios where email ='".$email_user."'");
                    $querys2= ("Update recover_password SET Estado = 0 where Estado = 1 and correo='".$email_user."'");
                    $resultado=$enlace->query($querys2);
                    $resultado = $enlace->query($querys); 
                    $num_filas = mysqli_num_rows($resultado);

                        if($num_filas==0){
                            echo 0;
                        }

                        elseif($num_filas==1) {
                            $token = bin2hex(random_bytes(50)); 
                            $querys= ("INSERT INTO recover_password (`token`,`correo`) VALUES ('".$token."','".$email_user."')");
                            $enlace->query($querys); 
                            enviar_correo($token,$email_user);
                            echo 1;
                        }
                }
            }

    ob_end_flush();
?>
