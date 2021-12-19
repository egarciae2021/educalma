<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/cuestionario_formu.css">
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

    <br><br>
    <br>
    <br>
    <br>
     <!--Contenido-->
     <div class="container-fluid">
        <div class="title">
            <div class="mb-4">
                <center>Cuestionario de Preguntas</center>
            </div>
            <h1><a href="agregarModulos.php?id=<?php echo $id=$_SESSION['ids'];?>">Atras <-</a></h1>
            </div>
    </DIV>
    <!--Contenido del cuestionario-->
    <?php $idmodulo=$_GET['id_modulo'];?>
    <div class="cont">
    <div class="container-contformulario">
    <div class="contformulario" id="contformulario">
        <div class="formu"  style="border-radius:15px;box-shadow:2px 3px 5px gray;">
            <div style=" padding: 5px 50px 0px 50px; font-size: 20px;">
            <div class="inputBox"><br>
            <i class="fas fa-question-circle"></i> Preguntas</div></div>
            <form id="preguntas_cuestionario" action="includes/Pregunta_Respuesta/Pregunta_CRUD.php?id_modulo=<?php echo $idmodulo;?>" method="POST">
            <div class="inputBox">
                <textarea name="pregunta" placeholder="Agregue una Pregunta"></textarea>
            </div>
                <div class="inputBox">
                <button type="submit" class="boton1"><i class="fas fa-plus"></i> Agregar Pregunta</button>
            </div>
            </form>
            <div class="inputBox">
                    <h3><i class="fas fa-list"></i> Listado de Preguntas</h3>
            </div>
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
                <div class="inputBox">
                    <input type="text" value="<?php echo $registro1['pregunta'];?>" style="border-radius:15px;border-color:#53F5ED;" disabled>
                    </div>
                    <div style="padding: 10px 20px;">
                        <a href="Form_respue_cuestionario.php?id_pregunta=<?php echo $registro1['idPregunta']?>&id_modulo=<?php echo $idmodulo;?>&pregunta=<?php echo $registro1['pregunta']?>">
                            <button type="button" class="btn btn-success">
                            <i class="fas fa-plus"></i> Agregar Respuestas</button>
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
                    </div>
                    </div>
                    </div>
    <br>
    <br>
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