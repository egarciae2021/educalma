<?php
ob_start(); 
session_start();

    require_once '../../database/databaseConection.php';

    /*=============================================
                 PARA Inscribirse en un curso
    ===============================================*/

    error_reporting(0);

        $idCurso= $_GET['id'];
        $idUser = $_SESSION['codUsuario'];

        if(isset($idUser)){
            $pdo = Database::connect();  
            $veri="INSERT INTO cursoinscrito (curso_id,usuario_id) values ('$idCurso','$idUser') ";
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


 ?>   
   