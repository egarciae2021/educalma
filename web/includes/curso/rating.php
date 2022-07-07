<?php 
ob_start();
@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$id =$_SESSION['codUsuario'];
            $idCurso = $_POST['id'];
            $estrellas = $_POST['rating'];
            $comentario_var = $_POST['coment'];
    if(isset($_POST['rating'])&& $_POST['coment']){
        echo "guardado";
        $pdo2 = Database::connect();
        try{
            
            $sql ="INSERT INTO puntaje_curso (id_user, id_curso, numero_estrellas, comentario) VALUES (?,?,?,?)";
            $pdo->prepare($sql)->execute([$id, $idCurso, $estrellas,$comentario_var]);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        Database::disconnect();
    }else{
        echo "no se guardó";
        echo $id;
        echo $idCurso;
        echo $estrellas;
        echo $comentario;
    }

    
?>