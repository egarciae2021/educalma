<?php 

require_once '../../database/databaseConection.php';

     /*=============================================
                 PARA Agregar MODULO 
    ===============================================*/
    if(isset($_POST['modulo_agregar'])){
        $nombreModulo=$_POST['modulo_agregar'];
        $idCurso= $_GET['id'];

        $pdo = Database::connect();  
        $verif=$pdo->prepare("INSERT INTO modulo (id_curso,nombreModulo, estado)VALUES ('$idCurso','$nombreModulo',1) ");

        $verif->execute();
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
        $idCurso= $_GET['id_curso'];
        $idModulo = $_GET['id_modulo'];

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