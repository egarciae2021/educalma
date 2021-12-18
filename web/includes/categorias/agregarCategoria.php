<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/agregarCategoria.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/js/plugins/sweetalert2.min.css">
    <title>Document</title>
</head>
<body>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/validarRegisCateg.js"></script>
    <script src="assets/js/plugins/sweetalert2.all.min.js"></script>   
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

                    <form id="formRegis" action="includes/categorias/checkAgrCateg.php" target="dummyframe" method="POST" onsubmit="return comprobarCategoria()" style="padding:0;"> 
                        <table> 
                            <tr>
                                <th>Agregar Categoría</th>
                                <th>Lista de Categorías</th>
                                <th>Acción</th>
                            </tr>
                            <tr>
                          
                                <td style="border-right:1px #DADADA solid;" rowspan=100>
                                    <div class="inputBox">
                                        <h3>Nombre de la Categoría:</h3>
                                        <input type="text" id="categoria_agregar" name="categoria_agregar"   aria-describedby="temaAgr-addon" required>
                                    </div>
                                    <div class="inputBox">
                                        <button type="submit" id="categoria_agregar" class="boton1"><i class="fas fa-plus"></i> Agregar</button>
                                    </div>
                                </td>
                                </form>

                                
                                <?php
                                require_once 'database/databaseConection.php';
                                $pdo3 = Database::connect();

                                $sql3 = "SELECT * FROM categorias ";
                                $q3 = $pdo3->prepare($sql3);
                                $q3->execute();
                                while ($dato3 = $q3->fetch(PDO::FETCH_ASSOC)) {
                                ?>

                            </tr>
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $dato3['nombreCategoria'] ?>" aria-label="Recipient's username with two button addons" style="text-align:center;border:0;background:none;" disabled>
                                    
                                </td>
                                <td>
                                    <!-- Funcionalidad de los Botones NO CORRE -->
                                    <!--Boton Editar Categoría-->
                                    
                                    <a>
                                        <button class="btn btn-outline-success" nombre="categoria_editar" type="button" data-toggle="modal" data-target="#ModalCategoria<?php echo $dato3['idCategoria']; ?>">
                                        <i class='fas fa-edit'></i></button>
                                    </a>       
                                    <!--Boton Quitar Categoría--> 
                                    <!--<a href="includes/categorias/checkAgrCateg.php">-->
                                   

                                    <a id="eliminar_categoria" href="#" data-id="<?php echo $dato3['idCategoria'] ?>">
                                        <button class="btn btn-outline-danger" type="button">
                                        <i class="fas fa-trash-alt"></i></button>
                                    </a>
                                        <?php include('ModalEdit.php'); ?>

                                      
                                </td> 
                            </tr>
                            <?php
                                
                                }
                                Database::disconnect();
                                ?> 
                        </table>    
                   
                    
                </div>
            </div>
        </div>

        <?php
    }
    else{
        header('Location:iniciosesion.php');
    }
        ?>

<script src="assets/js/home.js"></script>

</body>
</html>

