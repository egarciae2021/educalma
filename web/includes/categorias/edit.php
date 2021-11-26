<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/agregarCategoria.css">
    <link rel="stylesheet" href="assets/css/agretemas.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body>

<?php
// Este codigo hace validacion para que no se pueda acceder a cualquier pagina sin estar logueado
 if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
?>

<!-- Contenido -->
    <div class="container_cate">
        <div class="title">
            <div class="mb-4">
                <center>
                    <i class="fas fa-plus-circle"></i> Agregar <strong>Categoría </strong>
                    <i class="fas fa-plus-circle"></i>
                </center>
            </div>
        </div>
    </div>

<!-- codigo --->
<div class="container-contformulario">
    <div class="contformulario" id="contformulario">
        <div class="row">
            <div class="image">
                <img src="./assets/images/donar07.png" alt="">
            </div>
            
            <?php
                require_once 'database/databaseConection.php';
                $idCategoria= $_GET['idCategoria'];

                $pdo2 = Database::connect();
                $sql2 = "SELECT * FROM categorias WHERE idCategoria='$idCategoria'";
                $q2 = $pdo2->prepare($sql2);
                $q2->execute(array());
                $dato2=$q2->fetch(PDO::FETCH_ASSOC)
            ?>
            <!--
                                        ======================================
                                                    Editar Categoria
                                        ======================================              
            -->

            <form id="form-agretemas" action="includes/categorias/checkEditCategoria.php?idCategoria=<?php echo $idCategoria?>"
                    target="dummyframe" method="POST">
                    <div class="inputBox">
                        <h3>Editar Categoria: <strong>"<?php echo $dato2['nombreCategoria'];?>"</strong></h3>
                        <input type="hidden" name="idtema" value="<?php echo $dato2['idCategoria']?>">
                    </div>
                    <div class="inputBox">
                        <input type="text"  id="tema-agregar" value="<?php echo $dato2['nombreCategoria']?>" aria-label="TemaAgr" aria-describedby="temaAgr-addon" required>
                    </div>
                    <div class="inputBox">
                        <button type="submit" class="boton1"><i class="fas fa-redo"></i> Actualizar Categoria</button>
                    </div>
                    <div class="inputBox">
                    <div style="text-align: right;">
                    <a href="agregarCategoria.php?idCategoria=<?php echo $idCategoria;?>">
                            <button type="button" class="btn btn-outline-secondary"><i class="fas fa-times"></i> Salir</button>
                    </a>
                    </div>
                </div>
                </form>
</table>
        </div>
        </div>
        </div>

    <script type="text/javascript">
        function comprobarCategoria() {
            var comprobacion = false;
            var expReg = /[\s\S]{4}/;
            var nombre = document.getElementById('tema-agregar').value;
            if (!expReg.test(nombre)) {
                alert('El campo de categoria es muy pequeño, el formulario NO se enviará');
                return false;
            }
        }
    </script>

        <?php
    }
    else{
                header('Location:iniciosesion.php');
    }
    ?>

</body>
</html>