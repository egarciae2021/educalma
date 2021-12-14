<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/cuestionario_formu.css">
    <link rel="stylesheet" href="assets/css/agretemas.css">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/f9e5248491.js" crossorigin="anonymous"></script>
    <style>
         label.error{
    	color: red;
        font-style: italic;
        font-size: 13px;    
        max-width:400px;
        padding: 10px;
        margin:0;
        }
    </style>
    <title>Editar Pregunta</title>
</head>

<body>
<?php
 if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
?>
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
    <br>
    <br>
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
    </div>

    <!--Contenido del cuestionario-->
    <?php
        $idmodulo=$_GET['id_modulo'];
        $nombre_pregunta=$_GET['pregunta'];
        $id_pregunta=$_GET['id_pregunta'];
    ?>

    <div class="container-contformulario">
        <div class="contformulario" id="contformulario">
            <div class="row">
                <div class="image">
                    <img src="./assets/images/donar09.png" alt="">
                </div>
                
                <form name="formulario" method="POST" id="editando_preguntas" action="includes/Pregunta_Respuesta/Pregunta_CRUD.php?id_modulo=<?php echo $idmodulo;?>"  style="background:#F7F7F7;">
                <div class="inputBox">
                    <h3>
                        <i class="fas fa-edit"></i> Edita la Pregunta: <strong>"<?php echo $nombre_pregunta;?>"</strong>
                    </h3>
                    <input type="text" name="actuali_pregunta" id="" value="<?php echo $nombre_pregunta;?>">
                    <input type="hidden" name="id_pregunta" value="<?php echo $id_pregunta;?>">
                </div>
                <div class="inputBox">
                    <button type="submit" class="boton1">
                        <i class="fas fa-redo"></i> Actualizar pregunta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    }
    else{
                header('Location:iniciosesion.php');
    }
    ?>

<!-- Validaciones Autor:Jorge Martinez-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
<script src="assets/js/validarCategoria.js"></script>
</body>
</html>
