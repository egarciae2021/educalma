<?php 

require_once '../../database/databaseConection.php';

     /*=============================================
                 PARA Agregar MODULO 
    ===============================================*/
    if(isset($_POST['modulo_agregar'])){
        $nombreModulo=$_POST['modulo_agregar'];
        $idCurso= $_GET['id'];

        $pdo = Database::connect();
        try{
            // $verif=$pdo->prepare("INSERT INTO modulo (id_curso,nombreModulo, estado)VALUES ('$idCurso','$nombreModulo',1) ");
            $verif=$pdo->prepare("INSERT INTO `modulo` (`id_curso`,`nombreModulo`, estado)VALUES (:idCurso,:nombreModulo,1)");
            $verif->bindParam(":idCurso",$idCurso,PDO::PARAM_INT);
            $verif->bindParam(":nombreModulo",$nombreModulo,PDO::PARAM_STR);
            $verif->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        Database::disconnect();
        echo'
            <script>
                window.location = "../../agregarModulos.php?id='.$idCurso.'";
            </script>
        ';
    }
    /*=============================================
                 PARA Editar MODULO 
    ===============================================*/
    if(isset($_POST['actu_nomb_agregar'])){
        $actu_Modulo=$_POST['actu_nomb_agregar'];
        $idCurso= $_GET['id'];
        $idmodulo=$_POST['idmodulo'];


        $pdo = Database::connect();  
        $verif=$pdo->prepare("UPDATE modulo SET nombreModulo='$actu_Modulo' WHERE idModulo='$idmodulo'");

        $verif->execute(array());
        Database::disconnect();

        //echo
        //$idModu=$_SESSION['iddelmodulo'];
        //echo 
        //$idCurs=$_SESSION['iddelcurso']; //id_modulo=4&id_curso=7
        echo'
            <script>
                window.location = "../../agregarModulos.php?id='.$idCurso.'";
            </script>
        ';
    }
    /*=============================================
                 PARA Eliminar MODULO 
    ===============================================*/
    if(isset($_GET['id_curso'])){
        $idCurso= base64_decode($_GET['id_curso']);
        $idModulo = base64_decode($_GET['id_modulo']);

        /* Eliminar todos los temas del modulo*/
        $pdo1 = Database::connect();  
            $verif1=$pdo1->prepare("DELETE FROM tema where id_modulo = '$idModulo'");

        $verif1->execute(array());
        Database::disconnect();


        /*Eliminar el modulo*/
        $pdo = Database::connect();  
        $verif=$pdo->prepare("DELETE FROM modulo where idModulo = '$idModulo'");

        $verif->execute(array());
        Database::disconnect();
        echo'
            <script>
                window.location = "../../agregarModulos.php?id='.$idCurso.'";
            </script>
            ';
    }
?>