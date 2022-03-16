<?php
    //iniciar componentes de sesión
    ob_start(); 
    session_start();

    require_once '../../database/databaseConection.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../assets/lib/PHPMailer/Exception.php';
    require '../../assets/lib/PHPMailer/PHPMailer.php';
    require '../../assets/lib/PHPMailer/SMTP.php';




    if(isset($_POST['email_user'])){ 
        $usercor = $_POST['email_user'];
    }else{
        $usercor = '';
    }
    

    $pdo = Database::connect();
    $sql = "SELECT * FROM usuarios WHERE email = '$usercor'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $dato=$q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    
    // $usercor = $_POST['email_user'];
    // echo $usercor;

    if (!empty($dato['estado'])) {

        $user_id = $dato['id_user'];
        $user_nombre = $dato['nombres'];

        $token = generaTokenPass($user_id);

        // $url = 'http://'.$_SERVER["SERVER_NAME"].'/restablecer_pass.php?id='.$user_id.'&token='.$token;]
        $url = 'https://educalma.fundacioncalma.org/restablecer_pass.php?id='.$user_id.'&token='.$token;		
        $asunto = 'Recuperar password - Sistema de Usuarios';

        // $cuerpo = "Estimado $user_nombre: <br /><br />para restablecer la contraseña haga clic en el siguiente enlace <a href='$url'>Activar Cuenta</a>";
        $cuerpo = "<div style='width: 50%;'>
                        Hola $user_nombre: <br />
                        <p>Estás recibiendo este correo porque hiciste una solicitud de recuperacion de password para tu cuenta.</p>
                        
                            <div style='margin: auto; width: 50%; padding: 60px;'>
                                <a style='text-decoration: none;
                                        padding: 10px;
                                        font-weight: 600;
                                        font-size: 20px;
                                        color: #ffffff;
                                        background-color: #85c1e9;
                                        border-radius: 6px;' 
                                        href='$url'>Cambiar contraseña
                            </a>
                        </div>
                        <p>Si no realizaste esta solicitud, no se requiere realizar ninguna otra acción..</p>
                        <hr>
                        <p>Si el boton no funciona haga clic en el siguiente enlace </p>
                        <a href='$url'>$url </a>
                    </div>";


        $condicion = enviarEmail($usercor, $asunto, $cuerpo);

        if($condicion){
            echo 1;
            // echo 'correo enviado';
            //header('Location:iniciosesion.php');
        }else{
            echo 2;
            //echo 'error al enviar correoo';
            //header('Location:recuperar.php');
        }

    }else{
        echo 0;
        // echo 'error al enviar correo"';
        //header('Location:recuperar.php');
    }

    //Funciones

    function generaTokenPass($user_id){
        
        $token = generateToken();

        $pdo = Database::connect();
        $respuesta =$pdo->query("UPDATE usuarios SET token_password='$token', password_request=1 WHERE id_user=$user_id");

        Database::disconnect();

        return $token;
    }

    function generateToken(){
        $gen = md5(uniqid(mt_rand(), false));	
        return $gen;
    }

    function enviarEmail($email, $asunto, $cuerpo){

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                                       //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'fundacioncalma5@gmail.com';                     //SMTP username
            $mail->Password   = '3face2021calma$$';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('fundacioncalma5@gmail.com', 'Fundacion calma');
            $mail->addAddress($email);
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $asunto;
            $mail->Body    = $cuerpo;
        
            //$mail->send();

            if($mail->send()){
                return true;
            }else{
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
        
    }


ob_end_flush();
?>
