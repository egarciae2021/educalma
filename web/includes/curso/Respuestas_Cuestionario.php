<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/cuestionario_formu.css">
    <link rel="stylesheet" href="assets/css/agretemas.css">
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
    <br>
    <br>
    <br>
    <br>
    <br>
    <!--Contenido-->
    <div class="container-fluid">
        <div class="title">
            <div class="mb-4">
                <center>Cuestionario de Respuestas</center>
            </div>
        </div>
    </DIV>

    <!--Contenido del cuestionario-->

    <?php
        $idmodulo=$_GET['id_modulo'];
        $id_pregunta=$_GET['id_pregunta'];
        $pregunta=$_GET['pregunta'];
    ?>

<!-- codigo sidebar --->
<div class="container-contformulario">
    <div class="contformulario" id="contformulario">
        <div class="row">
            <div class="image">
                <img src="./assets/images/donar08.png" alt="">
            </div>
            <form action="includes/Pregunta_Respuesta/Respuesta_CRUD.php?id_modulo=<?php echo $idmodulo;?>" method="POST" enctype="multipart/form-data">
                <div class="inputBox">
                    <h3><i class="fas fa-pen"></i> Dale Respuestas a tu Pregunta</h3>
                    <textarea name="respuesta" ></textarea>
                    <div>
                        <input type="hidden" name="idpregunta" value="<?php echo $id_pregunta;?>"></div>
                    <div>
                        <input type="hidden" name="pregunta" value="<?php echo $pregunta;?>"></div>
                </div>
            <div class="inputBox">
                <button type="submit" class="boton1"><i class="fas fa-plus"></i> Agregar Respuesta</button>
            </div>

<!-- Listado -->            
            <div class="inputBox">
                    <h3><i class="fas fa-list"></i> Listado de Respuestas</h3>
            </div>
            <div  class="overflow-auto">
                <?php
                    require_once 'database/databaseConection.php';
                    $pdo = Database::connect();
                    $sql = "SELECT * FROM cuestionario WHERE id_modulo='$idmodulo'";
                    $q = $pdo->prepare($sql);
                    $q->execute(array());
                    $registro = $q->fetch(PDO::FETCH_ASSOC);
                    Database::disconnect();

                    $pdo1 = Database::connect();
                    $sql1 = "SELECT * FROM respuestas WHERE id_Pregunta='$id_pregunta'";
                    $q1 = $pdo1->prepare($sql1);
                    $q1->execute(array());
                    Database::disconnect();
                ?>
                <table class="table">
                    <thead>
                        <tr style="text-align: center;">
                            <th scope="col">Respuestas</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="text-align: center;">
                            <td><?php echo $pregunta;?></td>
                        </tr>
                        <?php while($registro1 = $q1->fetch(PDO::FETCH_ASSOC)){?>
                        <tr>
                            <td><?php echo $registro1['respuesta'];?></td>
                            <td style="text-align: center;">
                                <!--editar-->
                                <a
                                    href="Editar_respue_cuestionario.php?id_respuesta=<?php echo $registro1['idRespuesta'];?>&respuesta=<?php echo $registro1['respuesta']?>&id_modulo=<?php echo $idmodulo;?>&pregunta=<?php echo $pregunta?>&idpregunta=<?php echo $id_pregunta;?>">
                                    <button type="button" class="btn btn-outline-primary"><i
                                            class="far fa-edit"></i></button>
                                </a>
                                <!--eliminar-->
                                <a
                                    href="includes/Pregunta_Respuesta/Respuesta_CRUD.php?id_resp=<?php echo $registro1['idRespuesta'];?>&id_modulo=<?php echo $idmodulo;?>&id_pregunta=<?php echo $id_pregunta?>&pregunta=<?php echo $pregunta;?>">
                                    <button type="button" class="btn btn-outline-danger"><i
                                            class="fas fa-trash-alt"></i></button>
                                </a>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>

            <h5 style="padding: 20px 20px 0px 20px; text-align: center;">Elija la respuesta correcta <i class="fas fa-mouse-pointer"></i></h5>
            <form action="includes/tema/checkAgrTema.php?idpregunta=<?php echo $id_pregunta;?>&id_modulo=<?php echo $idmodulo;?>&pregunta=<?php echo $pregunta;?>" method="POST">
                <div style="padding: 20px;" class="input-group">
                    <select class="form-select" name="respu_correcta" id="inputGroupSelect04" aria-label="Example select with button addon">
                        <?php
                            $pdo2 = Database::connect();
                            $sql2 = "SELECT * FROM respuestas WHERE id_Pregunta='$id_pregunta'";
                            $q2 = $pdo2->prepare($sql2);
                            $q2->execute(array());
                            Database::disconnect();
                        while($registro2 = $q2->fetch(PDO::FETCH_ASSOC)){?>

                        <option value="<?php echo $registro2['idRespuesta'];?>"><?php echo $registro2['respuesta'];?>
                        </option>
                        <?php }?>
                    </select>
                    <button class="btn btn-outline-primary" type="submit" style="background:blue;color:#FFFFFF;font-size:15px;">Correcto</button>
                </div>
            </form>
        </div>
    </div>
    <br>
    <br>
    <br>
</div>  
</div>
</div>
</body>
</html>
