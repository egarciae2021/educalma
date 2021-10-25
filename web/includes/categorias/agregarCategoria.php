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
    <title>Document</title>
</head>

<body>
<div class="container_cate">
        <h2 class="mt-5" style="color:#4F52D6;font-size: 300%;font-family: 'Oswald', sans-serif; text-shadow: -3px 3px 0 whitesmoke;">
            <center>Bienvenido a EduCalma</center>
        </h2>
</div>

<table class="cont" style="border:1px #DADADA solid;">
  <tr>
    <th>Agregar Categoría</th>
    <th>Lista de Categorías</th>
    <th>Acción</th>
  </tr>
  <tr>
    <td style="border-right:1px #DADADA solid;" rowspan=100>
        <form id="form-agretemas" action="includes/categorias/checkAgrCateg.php" target="dummyframe" method="POST" onsubmit="return comprobarCategoria()">
                <div class="mb-3">
                    <input type="text" name="categoria_agregar" id="tema-agregar" class="form-control form-control-lg" 
                    placeholder="Nombre de la Categoría" aria-label="default input example" aria-describedby="temaAgr-addon" 
                    style="margin-top:8px;border-radius:15px;border-color:gray;font-size:15px;" required>
                </div>
        <div class="boton_add">
            <button type="submit" class="btn btn-outline-secondary" style="background:#FA5CCA;color:#FFFFFF;"><i class="fas fa-plus"></i> Agregar</button>
        </div>
        </form>
    </td>
    <?php
            require_once 'database/databaseConection.php';
            $pdo3 = Database::connect();

            $sql3 = "SELECT * FROM categorias ";
            $q3 = $pdo3->prepare($sql3);
            $q3->execute(array());


            while ($dato3 = $q3->fetch(PDO::FETCH_ASSOC)) {
            ?>
  </tr>
  <tr>
    <td>
    <input type="text" class="form-control" value="<?php echo $dato3['nombreCategoria'] ?>" aria-label="Recipient's username with two button addons" style="text-align:center;border:0;background:none;" disabled>
    </td>
    <td>
        <!--Boton Editar Categoría-->
    <a href="editartema.php?id_modulo=<?php echo $idd; ?>&id_curso=<?php echo $idCurso; ?>&id_tema=<?php echo $dato3['idTema'];?>">
        <button class="btn btn-outline-secondary" type="button" style="background:#3551FF;color:#FFFFFF;border-radius:15px;">
        <i class='fas fa-edit'></i></button>
    </a>       
        <!--Boton Quitar Categoría--> 
    <a href="includes/tema/quitartemas.php?id_modulo=<?php echo $idd; ?>&id_curso=<?php echo $idCurso; ?>&id_tema=<?php echo $dato3['idTema']; ?>">
        <button class="btn btn-outline-secondary" type="button" style="background:#FF3535;color:#FFFFFF;border-radius:15px;">
        <i class="fas fa-trash-alt"></i></button>
    </a>
    </td>
  </tr>
            <?php
            }
            Database::disconnect();
            ?>
</table>
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
</body>

</html>