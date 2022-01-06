<?php 

require_once '../../database/databaseConection.php';

if(isset($_GET['idCurso'])){
    $idCurso= $_GET['idCurso'];
    $idModulo = $_GET['id_mo'];


    $nombreTema=$_POST['temas_agregar'];
    $descripcionTema = $_POST['descripcio_tema'];
    $link = $_POST['link'];

    $pdo = Database::connect();
    try{
        // $verif=$pdo->prepare("INSERT INTO tema (id_modulo, nombreTema, descripcionTema, link_video, encuestaTema) VALUES ('$idModulo','$nombreTema','$descripcionTema','$link','activo')");
        $verif=$pdo->prepare("INSERT INTO `tema` (`id_modulo`, `nombreTema`, `descripcionTema`, `link_video`, encuestaTema) VALUES (:idModulo,:nombreTema,:descripcionTema,:link,'activo')");
        $verif->bindParam(":idModulo",$idModulo,PDO::PARAM_INT);
        $verif->bindParam(":nombreTema",$nombreTema,PDO::PARAM_STR);
        $verif->bindParam(":descripcionTema",$descripcionTema,PDO::PARAM_STR);
        $verif->bindParam(":link",$link,PDO::PARAM_STR);
        $verif->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    Database::disconnect();
    echo'
            <script>
                // alert ("Tema inscrito exitosamente ");
                window.location = "../../agregartema.php?idCurso='.$idCurso.'&id_mo='.$idModulo.'";
            </script>
            
            ';
        
}

    /*
        EDITAR TEMA
    */

if(isset($_POST['actu_tema'])){

    $idCurso= $_GET['idCur'];
    $idModulo= $_GET['id_mod'];

    $nombreTema=$_POST['actu_tema'];
    $descripcionTema = $_POST['descripcionT'];
    $link = $_POST['linkT'];
    $idTema= $_POST['idTema'];

    $pdo = Database::connect();  
    $veri="UPDATE tema SET nombreTema='$nombreTema', descripcionTema ='$descripcionTema', link_video= '$link' WHERE idTema = '$idTema'";
    $q = $pdo->prepare($veri);
    $q->execute(array());
    $dato=$q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    echo'
        <script>
        window.location = "../../agregartema.php?idCurso='.$idCurso.'&id_mo='.$idModulo.'";
        </script>
    ';
}

/*
    ELIMINAR TEMA
*/
if(isset($_POST['idTemas'])){
    $idCurso= $_GET['idCurs'];
    $idModulo= $_GET['id_mod'];

    $idTema= $_POST['idTemas'];

    /* Eliminar todos los temas del modulo*/
    $pdo1 = Database::connect();  
    $verif1=$pdo1->prepare("DELETE FROM tema where idTema = '$idTema'");

    $verif1->execute(array());
    Database::disconnect();

    echo'
        <script>
            window.location = "../../agregartema.php?idCurso='.$idCurso.'&id_mo='.$idModulo.'";
        </script>
    ';
}


if(isset($_POST['respu_correcta'])){
    $idpregunta=$_GET['idpregunta'];
    $id_modulo=$_GET['id_modulo'];
    $pregunta=$_GET['pregunta'];

    $respuesta=$_POST['respu_correcta'];

    $pdo1 = Database::connect();  
    $verif1=$pdo1->prepare("UPDATE respuestas SET estado='0' WHERE id_Pregunta='$idpregunta'");
    $verif1->execute(array());
    Database::disconnect();

    $pdo2 = Database::connect();
    $sql2 = "SELECT * FROM respuestas WHERE idRespuesta='$respuesta'";
    $q2 = $pdo2->prepare($sql2);
    $q2->execute(array());
    $registro2 = $q2->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    $pdo3 = Database::connect();  
    $verif3=$pdo3->prepare("UPDATE respuestas SET estado='1' WHERE respuesta='$registro2[respuesta]'");
    $verif3->execute(array());
    Database::disconnect();

    echo'
        <script>
            // alert ("respuesta correcta -- escogida");
            window.location = "../../Form_respue_cuestionario.php?id='.$_GET['id'].'&id_pregunta='.$idpregunta.'&id_modulo='.$id_modulo.'&pregunta='.$pregunta.'";
        </script>
    ';
}
?>