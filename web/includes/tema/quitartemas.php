<?php 


require_once '../../database/databaseConection.php';

$idCurso= $_GET['id_curso'];
$idModulo = $_GET['id_modulo'];
$idtema= $_GET['id_tema'];

/* Eliminar todos los temas del modulo*/
    $pdo1 = Database::connect();  
    $verif1=$pdo1->prepare("DELETE FROM tema where idTema = '$idtema'");

    $verif1->execute(array(
    ':idTema' => $idtema,

    
));
Database::disconnect();

        echo'
        <script>
            window.location = "../../agregartema.php?idCurso='.$idCurso.'&id_mo='.$idModulo.'";
        </script>
        
        ';

//https://www.youtube.com/watch?v=BjC0KUxiMhc&ab_channel=thestrokesVEVO

/*Eliminar el modulo
$pdo = Database::connect();  
$verif=$pdo->prepare("DELETE FROM modulo where idModulo = '$idModulo'");

$verif->execute(array(
    ':idModulo' => $idModulo,
));
Database::disconnect();
echo'
        <script>
            window.location = "../../agregarModulos.php?id='.$idCurso.'";
        </script>
        
        ';
        
*/

?>