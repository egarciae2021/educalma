<?php
    require_once '../../database/databaseConection.php';

    $variable=$_POST['identi'];
    switch ($variable) {
        case 'uno':
            $id = $_POST['idCurso'];

            $pdo = Database::connect();  
            $verif=$pdo->prepare("DELETE FROM sub_come_foro where id_curso = '$id'");
            $verif->execute(array(
                ':id' => $id,
            ));
            Database::disconnect();
        
            $pdo1 = Database::connect();  
            $verif1=$pdo1->prepare("DELETE FROM comentarioforo where idcurso = '$id'");
            $verif1->execute(array(
                ':id' => $id,
            ));
            Database::disconnect();
            echo 'Se elimino Perfectamente';
            break;
        break;  
        case 'dos':
            $id = $_POST['idComen'];

            $pdo = Database::connect();  
            $verif=$pdo->prepare("DELETE FROM sub_come_foro where idcomentario = '$id'");
            $verif->execute(array(
                ':id' => $id,
            ));
            Database::disconnect();
        
            $pdo1 = Database::connect();  
            $verif1=$pdo1->prepare("DELETE FROM comentarioforo where idcomentario = '$id'");
            $verif1->execute(array(
                ':id' => $id,
            ));
            Database::disconnect();
            echo 'Se elimino Perfectamente';
            break;
                 
        default:
            $idsub = $_POST['idsubComen'];
            
            $pdo1 = Database::connect();  
            $verif1=$pdo1->prepare("DELETE FROM sub_come_foro where idsubcomentario = '$idsub'");
            $verif1->execute(array(
                ':idsub' => $idsub,
            ));
            Database::disconnect();

            echo 'Se elimino Perfectamente';
            break;
    }
?>