<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/cuestionario_formu.css">
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
    <!--Contenido del cuestionario-->
    <?php $idmodulo=$_GET['id_modulo']?>
    <div class="cont">
        <div class="formu"  style="height: 100%;border-radius:15px;border-color:#53F5ED;"  >
            <h3 style="color:white; background:#53F5ED; border-radius:15px;">Cuestionario</h3>
            <div style=" padding: 5px 50px 0px 50px; font-size: 20px; ">Preguntas</div>
            <form action="includes/Pregunta_Respuesta/Pregunta_CRUD.php?id_modulo=<?php echo $idmodulo;?>" method="POST">
                <input type="text" name="pregunta" placeholder="Agregue una Pregunta" >
                <div class="boton">
                    <button type="submit" style="background:#9888DC;color:#FFFFFF;">agregar pregunta</button>
                </div>
            </form>
            <div class="formu02"  style="color:white; background:#53F5ED;">Listado de Preguntas</div>
            <div style="height: 300px;" class="overflow-auto">
                <?php
                    error_reporting(0);
                    require_once 'database/databaseConection.php';
                    $pdo = Database::connect();
                    $sql = "SELECT * FROM cuestionario WHERE id_modulo='$idmodulo'";
                    $q = $pdo->prepare($sql);
                    $q->execute(array());
                    $registro = $q->fetch(PDO::FETCH_ASSOC);
                    Database::disconnect();

                    $pdo1 = Database::connect();
                    $sql1 = "SELECT * FROM preguntas WHERE id_cuestionario='$registro[idCuestionario]'";
                    $q1 = $pdo1->prepare($sql1);
                    $q1->execute(array());
                    Database::disconnect();
                    while($registro1 = $q1->fetch(PDO::FETCH_ASSOC)){

                ?>
                <div style="padding: 15px 50px;">
                    <input type="text" value="<?php echo $registro1['pregunta'];?>" style="border-radius:15px;border-color:#53F5ED;" disabled>
                    <div style="padding: 10px 20px;">
                        <a href="Form_respue_cuestionario.php?id_pregunta=<?php echo $registro1['idPregunta']?>&id_modulo=<?php echo $idmodulo;?>&pregunta=<?php echo $registro1['pregunta']?>">
                            <button type="button" class="btn btn-outline-primary" style="background:#9888DC;color:#FFFFFF;">Agregar Respuestas</button>
                        </a>
                        <!--editar-->
                        <a href="Editar_pregun_Cuestionario.php?id_pregunta=<?php echo $registro1['idPregunta']?>&pregunta=<?php echo $registro1['pregunta']?>&id_modulo=<?php echo $idmodulo;?>">
                            <button type="button" class="btn btn-outline-primary"><i class="far fa-edit"></i></button>
                        </a>
                        <!--eliminar-->
                        <a href="includes/Pregunta_Respuesta/Pregunta_CRUD.php?id_modulo=<?php echo $idmodulo;?>&id_pregunta=<?php echo $registro1['idPregunta']?>">
                            <button type="button" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                        </a>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>

    <br><br>
    <br>
    <br>
    <br>
</body>

</html>
