<?php 
require_once '../../database/databaseConection.php';

    $nomb=$_POST['categoria_agregar'];

    $pdo = Database::connect();
    $sql = "SELECT * FROM categorias WHERE nombreCategoria='$nomb'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $dato=$q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    if($dato['nombreCategoria']!=$nomb){
        $pdo = Database::connect();  
        $verif=$pdo->prepare("INSERT INTO categorias (nombreCategoria) VALUES ('$nomb') ");

        $verif->execute(array(
            ':categoria_agregar' => $nomb,
        ));
        Database::disconnect();
        echo'
        <script>
            alert ("Categoria Agregada ");
            window.location = "../../agregarCategorias.php?idCateg='.$dato['idCategoria'].'";
        </script>
        ';
    }
    else{
        echo'
        <script>
            alert ("No se pudo agregar");
            window.location = "../../agregarCategorias.php";
        </script>
        ';
    }

?>