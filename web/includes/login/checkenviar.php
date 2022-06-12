<?php
    //iniciar componentes de sesión
    ob_start(); 
    session_start();
    
    require_once "Mail.php";
    
    function enviar_correo($t,$em){ 
    
    $tok = $t;
    $from = 'notificaciones.mail.1s@gmail.com';
    $to = $em;

     $host = "smtp-relay.sendinblue.com";
    $port = "587";
    $username = 'notificaciones.mail.1s@gmail.com';
    $password = 'pwqKXgG1QtZyvr0a';
 

    $subject = "Recupera tu accceso a EduCalma";
  

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
    }

    $num_filas=0;
            if(isset($_POST["email_user"])){
                $enlace = new mysqli('20.226.29.168', 'root', 'T3$t1ng.C4lm4', 'educalma');
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
