<?php 
require_once '../../database/databaseConection.php';
    /*=====================
        AGREGAR CATEGORIAS
    =======================*/
    if(isset($_POST['categoria_agregar'])){
        $nomb=$_POST['categoria_agregar'];

        $pdo = Database::connect();
        $sql = "SELECT * FROM categorias WHERE nombreCategoria='$nomb'";
        $q = $pdo->prepare($sql);
        $q->execute(array());
        $dato=$q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    
        if(empty($dato)){
            $pdo = Database::connect();
            $verif=$pdo->prepare("INSERT INTO categorias (nombreCategoria) VALUES ('$nomb')");
            $verif->execute();
            Database::disconnect();
            echo 0;
        }else{
            echo 1;
        }

    }

    /*=====================
        ELIMINAR CATEGORIA
    =======================*/
    else if (isset($_POST['id'])){
        
        $id=$_POST['id'];
        $pdo = Database::connect();  
        $veri="DELETE FROM categorias WHERE idCategoria = '$id' ";
        $q = $pdo->prepare($veri);
        $q->execute(array());
        $dato=$q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        echo'
            <script>
                alert ("Eliminado exitosamente");
                window.location = "../../agregarCategorias.php";
            </script>
        ';
        
    }
    

?>