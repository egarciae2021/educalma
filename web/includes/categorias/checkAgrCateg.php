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
            echo'
                <script>
                    alert ("Categoria Agregada ");
                    window.location = "../../agregarCategorias.php";
                </script>
                ';
        }else{
            echo'
                <script>
                    alert ("Ya existe dicha categoría");
                    window.location = "../../agregarCategorias.php";
                </script>
            ';
        }

    }

    /*=====================
        EDITAR CATEGORIA
    =======================*/
    else if(isset($_POST['categoria_editar'])){
        $id=isset($_POST['idCategoria']);
        $nomb=isset($_POST['nombreCategoria']);

        $pdo2 = Database::connect();  
        //$veri2="UPDATE categorias SET nombreCategoria='$nomb' WHERE idCategoria = '$id' ";
        $veri2="UPDATE categorias SET nombreCategoria='gatos' WHERE idCategoria = '$id' "; //prueba
        $q2 = $pdo2->prepare($veri2);
        $q2->execute(array());
        $dato2=$q2->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        
        echo'
            <script>
                alert ("Actualizado exitosamente");
                window.location = "../../agregarCategorias.php";
            </script>
        ';
    }
    /*=====================
        ELIMINAR CATEGORIA
    =======================*/
    else if (isset($_GET['categoria_eliminar'])){
        
        $id=$_GET['categoria_eliminar'];
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