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
                    $veri="INSERT INTO `cursoinscrito` (`curso_id`, `usuario_id`, cod_curso, curso_obt, cantidad_respuestas) VALUES (:idCurso, :idUser, '', 1, 0)";
                    $q = $pdo->prepare($veri);
                    $q->bindParam(":idCurso", $idCurso, PDO::PARAM_INT);
                    $q->bindParam(":idUser", $idUser, PDO::PARAM_INT);
                    $q->execute();
                }catch(PDOException $e){
                    echo $e->getMessage();
                }
                Database::disconnect();
            }
        }else{
            echo'
                <script>
                    alert ("Necesita Loguearse");
                    window.location = "../../detallecurso.php?id='.$idCurso.'";
                </script>
            ';
        }
    }
 ?>   
   