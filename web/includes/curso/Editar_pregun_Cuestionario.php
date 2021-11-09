<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/cuestionario_formu.css">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/f9e5248491.js" crossorigin="anonymous"></script>
    <title>Agregar Cursos</title>
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
    <!--Contenido-->
    <div class="container-fluid">
        <div class="title">
            <div class="mb-4">
                <center><i class="fas fa-edit"></i> Editar<strong> Pregunta</strong></center>
            </div>
        </div>
    </DIV>

    <!--Contenido del cuestionario-->
    <?php
        $idmodulo=$_GET['id_modulo'];
        $nombre_pregunta=$_GET['pregunta'];
        $id_pregunta=$_GET['id_pregunta'];
    ?>
    <div class="cont">
        <div class="formu" style="height: 250px; border-radius:15px; border-color:#53F5ED ; ">
            <h3 style="background:#53F5ED ; border-radius:15px;color: #FFFFFF; ">Edita tu Pregunta: <strong><?php echo $nombre_pregunta;?></strong></h3>

            <form action="includes/Pregunta_Respuesta/Pregunta_CRUD.php?id_modulo=<?php echo $idmodulo;?>" method="POST">
                <input type="text" name="actuali_pregunta" style="  border-radius:15px; border-color:#53F5ED ;"   value="<?php echo $nombre_pregunta;?>" >
                <input type="hidden" name="id_pregunta" style="  border-radius:15px; border-color:#53F5ED ; "  value="<?php echo $id_pregunta;?>" >
                <div class="boton">
                    <button type="submit"style="background:#9888DC;color:#FFFFFF;" >
                    <i class="fas fa-redo"></i> Actualizar</button>
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
