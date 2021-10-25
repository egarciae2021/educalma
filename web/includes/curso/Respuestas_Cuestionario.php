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
    <?php
        $idmodulo=$_GET['id_modulo'];
        $id_pregunta=$_GET['id_pregunta'];
        $pregunta=$_GET['pregunta'];

    ?>
    <div class="cont">
        <div style="height: 100%; border-radius:15px;border-color:#53F5ED;" class="formu">
            <h3  style="color:white; background:#53F5ED; border-radius:15px;">Cuestionario</h3>
            <div style=" padding: 5px 50px 0px 50px; font-size: 20px; ">Dale respuestas a tú Pregunta</div>
            <form action="includes/Pregunta_Respuesta/Respuesta_CRUD.php?id_modulo=<?php echo $idmodulo;?>"
                method="POST">
                <input type="text" name="respuesta" placeholder="Respuesta" style="border-radius:15px; border-color:#53F5ED" ;  required>
                <input type="hidden" name="idpregunta" value="<?php echo $id_pregunta;?>">
                <input type="hidden" name="pregunta" value="<?php echo $pregunta;?>">
                <div class="boton">
                    <button type="submit"  style="background:#9888DC;color:#FFFFFF;">Agregar Respuesta</button>
                </div>
            </form>
            <div class="formu02" style="color:white; background:#53F5ED;">Listado de Preguntas</div>
            <div style="height: 300px; padding: 15px;" class="overflow-auto">
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
            <h4 style=" padding: 20px 20px 0px 20px; text-align: center;">Elija la respuesta correcta</h4>
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
                    <button class="btn btn-outline-primary" type="submit" style="background:#9888DC;color:#FFFFFF;">Correcto</button>
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
