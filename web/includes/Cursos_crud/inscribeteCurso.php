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
            $veri="INSERT INTO cursoinscrito (curso_id, usuario_id, cod_curso, curso_obt, cantidad_respuestas) VALUES ($idCurso, $idUser, '', 1, 0)";
            $q = $pdo->prepare($veri);
            $q->execute(array());
            Database::disconnect();
            echo'
                <script>
                    alert ("Curso inscrito satisfactoriamente");
                    window.location = "../../curso.php?id='.$idCurso.'";
                </script>
            ';
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
   