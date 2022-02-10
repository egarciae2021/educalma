
<head>
    <link rel="stylesheet" href="assets/css/agregarCategoria.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/js/plugins/sweetalert2.min.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

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

<div class="container">
    <h1>CATEGORÍA</h1>
    <div class="row mt-3" id="contformulario">
        <div class="col-12 col-md-6 namecategoria" >
            <div class="border-button">
                <h4 class="py-3">Nombre de la Categoría:</h4>
            </div>
            <form id="formRegis" action="includes/categorias/checkAgrCateg.php" target="dummyframe" method="POST" onsubmit="return comprobarCategoria()" style="padding:0;">
                <div class="form-group">
                <input type="text" id="categoria_agregar" class="form-control"   aria-describedby="temaAgr-addon" placeholder="Ingrese una categoría" required>
                </div>
                <button type="submit" id="categoria_agregar" class="btn btn-primary"><i class="fas fa-plus mx-2"></i>Añadir</button>
            </form>

            <?php
                                require_once 'database/databaseConection.php';
                                $pdo3 = Database::connect();

                                $sql3 = "SELECT * FROM categorias ";
                                $q3 = $pdo3->prepare($sql3);
                                $q3->execute();
                                while ($dato3 = $q3->fetch(PDO::FETCH_ASSOC)) {
                                ?>
        </div>
        <div class="col-12 col-md-6 namecategoria" >
            <div class="border-button">
                <h4 class="py-3">Lista de Categorías</h4>
            </div>
            <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nombres:</th>
        <th>Acciones:</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><input type="text" value="<?php echo $dato3['nombreCategoria'] ?>" aria-label="Recipient's username with two button addons" style="text-align:center;border:0;background:none;" disabled></td>
        <td>
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
    </tbody>
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



