<?php

require_once '../../database/databaseConection.php';
 //foro
@session_start();
/*=======================
Agregar mensaje de Foro
====================== */
if(isset($_POST['mensaje']))
{
    $mensaje = $_POST['mensaje'];
    $nombre = $_SESSION['nombres'];
    $idUser = $_SESSION['codUsuario'];

    $idcurso = $_POST['id'];

    $pdo = Database::connect();
    try{
        // $veri="INSERT INTO comentarioforo (comentario,idcurso,nombreUser,fecha_ingreso,estado,iduser) VALUES ('$mensaje','$idcurso','$nombre',now(),1,'$idUser')";
        $veri="INSERT INTO `comentarioforo`(`comentario`,`idcurso`,`nombreUser`,fecha_ingreso,estado,`iduser`) VALUES (:mensaje,:idcurso,:nombre,now(),1,:idUser)";
        $q = $pdo->prepare($veri);
        $q->bindParam(":mensaje",$mensaje,PDO::PARAM_STR);
        $q->bindParam(":idcurso",$idcurso,PDO::PARAM_INT);
        $q->bindParam(":nombre",$nombre,PDO::PARAM_INT);
        $q->bindParam(":idUser",$idUser,PDO::PARAM_INT);
        $q->execute();         
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    Database::disconnect();
    
    echo'
    <script>
        //alert ("guardado exitosamente");
       window.location = "../../foro.php?id='.$idcurso.'";
    </script>
    ';
}
if(isset($_POST['submensaje'])){
    $idcomen=$_POST['id_comenta'];
    $submensaje=$_POST['submensaje'];
    $idcurso = $_POST['id'];
    $nombre = $_SESSION['nombres'];
    $idUser = $_SESSION['codUsuario'];

    
    try{
        $pdo = Database::connect();  
        $veri="INSERT INTO `sub_come_foro`(`subcomentario`,`id_curso`,`user_men`,`idcomentario`,fecha_ingreso,estado,`iduser`) VALUES (:submensaje,:idcurso,:nombre,:idcomen,now(),1,:idUser)";
        $q = $pdo->prepare($veri);
        $q->bindParam(":submensaje",$submensaje,PDO::PARAM_STR);
        $q->bindParam(":idcurso",$idcurso,PDO::PARAM_INT);
        $q->bindParam(":nombre",$nombre,PDO::PARAM_STR);
        $q->bindParam(":idcomen",$idcomen,PDO::PARAM_INT);
        $q->bindParam(":idUser",$idUser,PDO::PARAM_INT);
        $q->execute();   
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    Database::disconnect();

    echo'
    <script>
        //alert ("subcomentario guardado exitosamente");
       window.location = "../../foro.php?id='.$idcurso.'";
    </script>
    ';
}
 
?>