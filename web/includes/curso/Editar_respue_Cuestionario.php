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
    <title>Agregar Cursos</title>
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
    <div class="container-fluid">
        <div class="title">
            <div class="mb-4">
                <center><i class="fas fa-edit"></i> Editar<strong> Respuesta</strong></center>
            </div>
        </div>
    </div>

    <!--Contenido del cuestionario-->
    <?php
        $idmodulo=$_GET['id_modulo'];
        $id_respuesta=$_GET['id_respuesta'];
        $id_pregunta=$_GET['idpregunta'];
        $pregunta=$_GET['pregunta'];
        $respuesta=$_GET['respuesta'];

    ?>
    
    <div class="container-contformulario">
        <div class="contformulario" id="contformulario">
            <div class="row">
                <div class="image">
                    <img src="./assets/images/donar03.png" alt="">
                </div>
                
                <form name="formulario" method="POST" id="editando_respuestas" action="includes/Pregunta_Respuesta/Respuesta_CRUD.php?id_modulo=<?php echo $idmodulo;?>" style="background:#F7F7F7;">
                <div class="inputBox">
                    <h3>
                        <i class="fas fa-edit"></i> Edita la Respuesta: <strong>"<?php echo $respuesta;?>"</strong>
                    </h3>
                    <input type="text" name="actu_respuesta" id="" value="<?php echo $respuesta;?>">
                    <input type="hidden" name="actu_respuesta" value="<?php echo $respuesta;?>">
                    <input type="hidden" name="idrespuesta" value="<?php echo $id_respuesta;?>">
                    <input type="hidden" name="pregunta" value="<?php echo $pregunta;?>">
                    <input type="hidden" name="idpregunta" value="<?php echo $id_pregunta;?>">
                </div>
                <div class="inputBox">
                    <button type="submit" class="boton1">
                        <i class="fas fa-redo"></i> Actualizar respuesta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 <br>
 <br>
 <br>

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
