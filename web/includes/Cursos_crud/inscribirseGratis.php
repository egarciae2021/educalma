<?php
ob_start(); 
session_start();

    require_once '../../database/databaseConection.php';

    /*=============================================
                  PARA Inscribirse en un curso Gratis
    ===============================================*/
    $idCurso= $_GET['id'];
    $idUser = $_SESSION['codUsuario'];

    $pdo = Database::connect(); 
    $veriS="SELECT * FROM cursoinscrito WHERE curso_id = $idCurso AND usuario_id='$idUser'";
    $qS = $pdo->prepare($veriS);
    $qS->execute(array());
    $datoS=$qS->fetch(PDO::FETCH_ASSOC);
    if (empty($datoS['id_cursoInscrito'])){
        try{
            // $veri="INSERT INTO cursoinscrito (curso_id, usuario_id, cod_curso, curso_obt, cantidad_respuestas) VALUES ($idCurso, $idUser, '', 1, 0)";
            $veri="INSERT INTO `cursoinscrito` (`curso_id`, `usuario_id`, `cod_curso`, `curso_obt`, `cantidad_respuestas`, `nota`, `solicitudcertificado`) VALUES (:idCurso, :idUser, '', 1, 0, 0, '')";
            $q = $pdo->prepare($veri);
            $q->bindParam(":idCurso", $idCurso, PDO::PARAM_INT);
            $q->bindParam(":idUser", $idUser, PDO::PARAM_INT);
            $q->execute();
            //echo $e->getMessage();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        Database::disconnect();
    }
    echo'
                <script>
                    //alert ("Necesita Loguearse");
                    window.location = "../../sidebarCursos.php";
                </script>
            ';
?>