<?php 
    if(isset($_POST['rating'])&& $_POST['coment']){
        echo "guardado";
        $pdo2 = Database::connect();
        try{
            $id =$_SESSION['codUsuario'];
            $idCurso = $_POST['id'];
            $estrellas = $_POST['rating'];
            $comentario_var = $_POST['coment'];
            $sql ="INSERT INTO puntaje_curso (id_user, id_curso, numero_estrellas, comentario) VALUES (?,?,?,?)";
            $pdo->prepare($sql)->execute([$id, $idCurso, $estrellas,$comentario_var]);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        Database::disconnect();
    }else{
        echo "no se guardó";
    }
?>