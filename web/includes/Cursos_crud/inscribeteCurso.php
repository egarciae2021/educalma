<?php
ob_start(); 
session_start();

    require_once '../../database/databaseConection.php';

    /*=============================================
                 PARA Inscribirse en un curso
    ===============================================*/
    $json= file_get_contents('php://input');
    $datos = json_decode($json,true);

    error_reporting(0);

    if(is_array($datos)){

        $id_trans = $datos['details']['id'];
        $status = $datos['details']['status'];
        $monto = $datos['details']['purchase_units'][0]['amount']['value'];
        $fecha = $datos['details']['update_time'];
        $fecha_nueva = date("Y-m-d H:i:s", strtotime($fecha));
        $email = $datos['details']['payer']['email_address'];
        $id_cliente = $datos['details']['payer']['payer_id'];
        $idCurso= $_GET['id'];
        $idUser = $_SESSION['codUsuario'];

        if(isset($idUser) && $status == 'COMPLETED'){
            $pdo = Database::connect(); 

            $veriS="SELECT * FROM cursoinscrito WHERE curso_id = $idCurso AND usuario_id='$idUser'";
            $qS = $pdo->prepare($veriS);
            $qS->execute(array());
            $datoS=$qS->fetch(PDO::FETCH_ASSOC);

            if (empty($datoS['id_cursoInscrito'])){
                try{
                    // $veri="INSERT INTO cursoinscrito (curso_id, usuario_id, cod_curso, curso_obt, cantidad_respuestas) VALUES ($idCurso, $idUser, '', 1, 0)";
                    $veri="INSERT INTO `cursoinscrito` (`curso_id`, `usuario_id`, `cod_curso`, `curso_obt`, `cantidad_respuestas`, `nota`, `fechaInscripcion`) VALUES (:idCurso, :idUser, '', 1, 0, 0, NOW())";
                    $q = $pdo->prepare($veri);
                    $q->bindParam(":idCurso", $idCurso, PDO::PARAM_INT);
                    $q->bindParam(":idUser", $idUser, PDO::PARAM_INT);
                    $q->execute();

                    $veriT="INSERT INTO `transaccion_paypal` (`idTran`,`monto`,`status`,`fecha`,`email`,`idClientPay`,`idCliente`, `idCurso`) 
                    VALUES (:id_trans,:monto,:status,:fecha_nueva,:email,:id_cliente,:idUser,:idCurso)";
                    $qT = $pdo->prepare($veriT);
                    $qT->bindParam(":id_trans", $id_trans, PDO::PARAM_STR);
                    $qT->bindParam(":monto", $monto);
                    $qT->bindParam(":status", $status, PDO::PARAM_STR);
                    $qT->bindParam(":fecha_nueva", $fecha_nueva);
                    $qT->bindParam(":email", $email, PDO::PARAM_STR);
                    $qT->bindParam(":id_cliente", $id_cliente, PDO::PARAM_STR);
                    $qT->bindParam(":idUser", $idUser, PDO::PARAM_INT);
                    $qT->bindParam(":idCurso", $idCurso, PDO::PARAM_INT);
                    $qT->execute();
                }catch(PDOException $e){
                    echo $e->getMessage();
                }
                Database::disconnect();
            }
        }else{
            echo'
                <script>
                    alert ("Necesita Loguearse");
                    window.location = "../../sidebarCursos.php";
                </script>
            ';
        }
    }
 ?>   
   