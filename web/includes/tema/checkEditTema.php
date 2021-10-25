<?php 

require_once '../../database/databaseConection.php';


$idCurso= $_GET['idCurso'];
$idModulo = $_GET['id_mo'];


$idtema=$_POST['idtema'];
$nombreTema=$_POST['temas_agregar'];
$descripcionTema = $_POST['descripcio_tema'];
$link = $_POST['link'];

$pdo = Database::connect();  
$verif=$pdo->prepare("UPDATE tema SET nombreTema='$nombreTema', descripcionTema='$descripcionTema', link_video='$link' WHERE idTema='$idtema'");

$verif->execute(array(
    ':id_tema'=> $idtema,
    ':temas_agregar'=>$nombreTema,
    ':descripcio_tema'=>$descripcionTema,
    ':link'=>$link,
));
Database::disconnect();
echo'
        <script>
            alert ("Tema Actualizado exitosamente ");
            window.location = "../../agregartema.php?idCurso='.$idCurso.'&id_mo='.$idModulo.'";
        </script>
        
        ';
        



?>