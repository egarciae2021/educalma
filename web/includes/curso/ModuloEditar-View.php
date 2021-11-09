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
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <title>Módulo</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="titlemc"></div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
    <br>
    <br>
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

<div class="container-fluid">
        <h2 class="mb-4" style="text-align: center; color:#4F52D6; font-size: 300%;font-family: 'Oswald', sans-serif;">
                <center>Bienvenido a EduCalma</center>
        </h2>
        <div class="title">
            <div class="mb-4">
                <center><i class="fas fa-edit"></i> Editar<strong> Módulo</strong></center>
            </div>
        </div>
    </DIV>
    
<div class="container-contformulario">
    <div class="contformulario" id="contformulario">
        <div class="row">
            <div class="image">
                <img src="./assets/images/donar01.png" alt="">
            </div>
            <form name="formulario" id="form-agretemas" method="POST" action="includes/modulo/Modulo_CRUD.php?id=<?php echo $dato['id_curso'];?>" target="dummyframe" method="POST">   
            <div class="inputBox">
                    <h3>Renombrar Módulo:</h3>
                    <input type="text" name="actu_nomb_agregar" id="actu-nomb-agregar" value="<?php echo $dato['nombreModulo'];?>" 
                    placeholder="" aria-label="ModuloAgr" aria-describedby="moduloAgr-addon" required>
                    <input type="hidden" name="idmodulo" value="<?php echo $dato['idModulo'];?>">
            </div>
            <div class="inputBox">
                    <button type="submit" class="boton1">
                    <i class="fas fa-redo"></i> Actualizar</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

</body>
</html>
