<?php
ob_start();
session_start();

require_once '../../database/databaseConection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../../assets/lib/PHPMailer/Exception.php';
require_once '../../assets/lib/PHPMailer/PHPMailer.php';
require_once '../../assets/lib/PHPMailer/SMTP.php';

/*=============================================
                 PARA Inscribirse en un curso de EMPRESA
    =============================================== */
$json = file_get_contents('php://input');
$datos = json_decode($json, true);

error_reporting(0);

if (is_array($datos)) {

    $id_trans = $datos['details']['id'];
    $status = $datos['details']['status'];
    $monto = $datos['details']['purchase_units'][0]['amount']['value'];
    $fecha = $datos['details']['update_time'];
    $fecha_nueva = date("Y-m-d H:i:s", strtotime($fecha));
    $email = $datos['details']['payer']['email_address'];
    $id_cliente = $datos['details']['payer']['payer_id'];
    $id = $_GET['id'];

    // $idUser = $_SESSION['codUsuario'];

    if (isset($id) && $status == 'COMPLETED') {
        $pdo = Database::connect();

        $veriS = "SELECT * FROM usuarios WHERE id_user = $id";
        $qS = $pdo->prepare($veriS);
        $qS->execute(array());
        $datoS = $qS->fetch(PDO::FETCH_ASSOC);

    
            try {
                // $veri="INSERT INTO cursoinscrito (curso_id, usuario_id, cod_curso, curso_obt, cantidad_respuestas) VALUES ($idCurso, $idUser, '', 1, 0)";
                $veri2 = "UPDATE usuarios SET estado=1 WHERE id_user = $id ";
                $q2 = $pdo->prepare($veri2);
                $q2->execute();

                $veri3=$pdo->prepare("DELETE FROM temp WHERE cod_empre=$id");
                $veri3->execute();

                $veriT = "INSERT INTO `transaccion_paypal` (`idTran`,`monto`,`status`,`fecha`,`email`,`idClientPay`,`idCliente`, `idCurso`) 
                    VALUES (:id_trans,:monto,:status,:fecha_nueva,:email,:id_cliente,:idUser,null)";
                $qT = $pdo->prepare($veriT);
                $qT->bindParam(":id_trans", $id_trans, PDO::PARAM_STR);
                $qT->bindParam(":monto", $monto);
                $qT->bindParam(":status", $status, PDO::PARAM_STR);
                $qT->bindParam(":fecha_nueva", $fecha_nueva);
                $qT->bindParam(":email", $email, PDO::PARAM_STR);
                $qT->bindParam(":id_cliente", $id_cliente, PDO::PARAM_STR);
                $qT->bindParam(":idUser", $id, PDO::PARAM_INT);
                // $qT->bindParam(":idCurso", $idCurso, PDO::PARAM_INT);

                $qT->execute();

                 //Enviar correo de confirmacion de compra

                 $user_id = $id;
                 $user_nombre = $datoS['nombres']." ".$datoS['apellido_pat']." ".$datoS['apellido_mat'];
                 $nombre_comp = strtoupper($user_nombre);
                 $usercor = $datoS['email'];
 
                 //$CursoNombres = cursosNombres($idcursos);
             
                 $asunto = 'ENVIO AUTOMATICO - CONSTANCIA DE PAGO';
 
                 $cuerpo = "  <div style='width: 50%;'>
                                 <h1> Confirmacion de pedido</h1>
                                 <p>Factura: $id_trans<br>
                                 Usuario: $nombre_comp<br>
                                 Fecha: $fecha_nueva<br>
                                 Cursos: todos<br>
                                 Pagado desde: $email<br>
                                 Monto pagado: $ $monto</p>
                             </div>";
 
 
                 $condicion = enviarEmail($usercor, $asunto, $cuerpo);
 
 
                 //fin enviar correo
 

                 $veriT = "INSERT INTO `factura`(`codigo`, `descripcion`, `email`, `Monto`, `FormaPago`) 
                            VALUES (:codigo,'Paquete de cursos',:email,:monto,:FormaPago)";
                $qT2 = $pdo->prepare($veriT);
                $qT2->bindParam(":codigo", $id_trans, PDO::PARAM_STR);
                $qT2->bindParam(":email", $usercor, PDO::PARAM_STR);
                $qT2->bindParam(":monto", $monto);
                $qT2->bindParam(":FormaPago", $email, PDO::PARAM_STR);

                $qT2->execute();

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            Database::disconnect();

    } else {
        echo '
                <script>
                    alert ("Necesita Loguearse");
                    // window.location = "../../detallecurso.php?id=' . $idCurso . '";
                    // window.location = "../../index.php"
                </script>
            ';
    }
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
        $mail->Username   = 'pe.fundacion.calma@gmail.com';                     //SMTP username
        $mail->Password   = 'Fundacion@17';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('pe.fundacion.calma@gmail.com', 'Fundacion calma');
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