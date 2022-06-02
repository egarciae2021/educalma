<?php
    //iniciar componentes de sesión
    ob_start(); 
    session_start();
    
    //  require_once "Mail.php";

    // $from = "notificaciones.mail.1S@gmail.com";
    // $to = 'garcia4014@gmail.com';

    // $host = "ssl://smtp.gmail.com";
    // $port = "465";
    // $username = 'notificaciones.mail.1S@gmail.com';
    // $password = 'amaterasu1';

    // $variable = "te quelo";

    // $subject = "test";
    $body = "<h1>HOLA LOCO<h1>";

    // $headers = array ('From' => $from, 'To' => $to,'Subject' => $subject,'Content-type'=>'text/html');
    

    // $smtp = Mail::factory('smtp',
    // array ('host' => $host,
    // 'port' => $port,
    // 'auth' => true,
    // 'username' => $username,
    // 'password' => $password));

    // $mail = $smtp->send($to, $headers, $body);

    // if (PEAR::isError($mail)) {
    // echo($mail->getMessage());
    // } 
     
    $num_filas=0;
    if(isset($_POST["email_user"])){
        $enlace = new mysqli('20.226.29.168', 'root', '', 'educalma');
        if($enlace){
        $email_user = $_POST["email_user"];
        $querys=("Select * from usuarios where email =.$email_user.");

        $resultado = mysqli_query($enlace,$querys);
        $num_filas = mysqli_num_rows($resultado);
        if($num_filas=1){
            
            echo 1;
        
        }
        else {echo 0; }
        

        }
    }



    ob_end_flush();
?>
