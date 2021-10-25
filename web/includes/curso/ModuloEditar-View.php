<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/agretemas.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <title>Modulo</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="titlemc">
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>

    <br><br>
    <br>
    <br>
    <br>
    <?php
        require_once '././database/databaseConection.php';
        $_GET['id_curso'];
        $idModulo=$_GET['id_modulo'];
        $pdo = Database::connect();
        $sql = "SELECT * FROM modulo WHERE idModulo='$idModulo'";
        $q = $pdo->prepare($sql);
        $q->execute(array());
        $dato=$q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    ?>

    <div style="  border: 1px solid transparent; padding: 0px 20%;">
        <h2 style="text-align: center; color:#4F52D6;font-size: 50PX;font-family: 'Oswald', sans-serif;">Bienvenido a EduCalma </h2>
        <h3 style=" color:#4F52D6; font-size:20px;">Editar <strong>Modulo </strong></h3>
        <div class="cont_formu">

            <form id="form-agretemas" action="includes/modulo/Modulo_CRUD.php?id=<?php echo $dato['id_curso'];?> "
                target="dummyframe" method="POST">
                <div class="mb-3">
                    <input type="text" name="actu_nomb_agregar" id="actu-nomb-agregar" class="form-control form-control-lg "
                        value="<?php echo $dato['nombreModulo'];?>" aria-label="ModuloAgr" aria-describedby="moduloAgr-addon"
                     style="border-radius:15px;border-color:#53F5ED;"     required>
                    <input type="hidden" name="idmodulo" value="<?php echo $dato['idModulo'];?>">
                </div>
                <div style="text-align: center; padding: 5% 0px;">
                    <button type="submit" class="boton" style="background:#9888DC;color:#FFFFFF;">Actualizar</button>
                </div>

            </form>
        </div>
    </div>
    <br><br>
    <br>
    <br>
    <br>
</body>

</html>
