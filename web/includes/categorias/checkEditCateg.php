<?php 

require_once '../../database/databaseConection.php';

    $id=$_GET['idCategoria'];
    $no=$_POST['nombreCategoria'];

    $pdo2 = Database::connect();  
    //$veri2="UPDATE categorias SET nombreCategoria='$nomb' WHERE idCategoria = '$id' ";
    $veri2="UPDATE categorias SET nombreCategoria='$no' WHERE idCategoria='$id'"; //prueba
    $q2 = $pdo2->prepare($veri2);
    $q2->execute();

    Database::disconnect();
    echo'
        <script>
            alert ("Actualizado exitosamente");
            window.location = "../../agregarCategorias.php";
        </script>
    ';

?>