<?php 

require_once '../../database/databaseConection.php';

if(isset($_GET['idCurso'])){
    $idCurso= $_GET['idCurso'];
    $idModulo = $_GET['id_mo'];


    $nombreTema=$_POST['temas_agregar'];
    $descripcionTema = $_POST['descripcio_tema'];
    $link = $_POST['link'];

    $pdo = Database::connect();  
    $verif=$pdo->prepare("INSERT INTO tema (id_Modulo, nombreTema, descripcionTema, link_video, encuestaTema) VALUES ('$idModulo','$nombreTema','$descripcionTema','$link','activo') ");

    $verif->execute();
    Database::disconnect();
    echo'
            <script>
                // alert ("Tema inscrito exitosamente ");
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
            window.location = "../../Form_respue_cuestionario.php?id_pregunta='.$idpregunta.'&id_modulo='.$id_modulo.'&pregunta='.$pregunta.'";
        </script>
    ';
}
?>