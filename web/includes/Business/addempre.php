<?php
ob_start();
session_start();

require_once '../../database/databaseConection.php';

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

        $veriS = "SELECT estado FROM usuarios WHERE id_user = $id";
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
