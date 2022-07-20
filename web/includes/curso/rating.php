<?php 
    if(isset($_GET['rating'])&& $_GET['coment']){
        //echo "guardado";
        $pdo2 = Database::connect();
        try{
            $id =$_SESSION['codUsuario'];
            $idCurso = $_GET['id'];
            $estrellas = $_GET['rating'];
            $comentario_var = $_GET['coment'];
            $sql ="INSERT INTO puntaje_curso (id_user, id_curso, numero_estrellas, comentario) VALUES (?,?,?,?)";
            $pdo->prepare($sql)->execute([$id, $idCurso, $estrellas,$comentario_var]);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        Database::disconnect();
    }
?>