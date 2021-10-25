<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/agretemas.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>
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
    $_GET['id'];
    $pdo = Database::connect();
    $sql = "SELECT * FROM cursos WHERE idCurso='$_GET[id]'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $dato=$q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();


    ?>

    <div style="border: 1px solid transparent; padding: 5% 25%;">
        <div class="cont_formu">
            <div style="background: seashell;">
                <h2 style="text-align: center; color:#4F52D6;font-size: 400%;font-family: 'Oswald', sans-serif;">Bienvenido a EduCalma </h2>
                <h3 style="color:#4F52D6;font-size:200% ;">Agregue los <strong>Modulos </strong> del Curso: <?php echo $dato['nombreCurso'];?> </h3>
                <form id="form-agretemas" action="includes/modulo/Modulo_CRUD.php?id=<?php echo $dato['idCurso'];?> "
                    target="dummyframe" method="POST">
                    <div class="mb-3">
                        <input type="text" name="modulo_agregar" id="modulo-agregar"
                            class="form-control form-control-lg " placeholder="Nombre de Modulo" aria-label="ModuloAgr"
                            aria-describedby="moduloAgr-addon" style="border-radius:15px; border-color:#53F5ED;" required>
                    </div>
                    <div style="text-align: center; padding: 5% 0px;">
                        <button style="font-size: 20px; background:#9888DC;color:#FFFFFF;"  type="submit" class="btn btn-outline-secondary">Agregar</button>
                    </div>
                    <div style="text-align: right; ">
                        <button style="font-size: 20px; background:#9888DC;color:#FFFFFF; " type="button" class="btn btn-outline-secondary"
                            data-bs-toggle="modal" data-bs-target="#staticBackdrop">Ver</button>
                    </div>
                </form>
                <!--
                Modal listado de modulo
                -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Listado de Modulos</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div style="height: 400px;" class="overflow-auto">
                                    <div>
                                        <?php

                                    require_once '././database/databaseConection.php';
                                    $_GET['id'];
                                    $pdo2 = Database::connect();
                                    $sql2 = "SELECT * FROM modulo WHERE id_curso='$_GET[id]'";
                                    $q2 = $pdo2->prepare($sql2);
                                    $q2->execute(array());

                                    while($dato2=$q2->fetch(PDO::FETCH_ASSOC)){

                                        $pdo3 = Database::connect();
                                        $idd = $dato2['idModulo'];
                                        $sql3 = "SELECT * FROM tema WHERE id_modulo='$idd'";
                                        $q3 = $pdo3->prepare($sql3);
                                        $q3->execute(array());

                                    ?>

                                        <br>
                                        <div class="mb-3">

                                            <input type="text" class="form-control"
                                                value="Modulo : <?php echo $dato2['nombreModulo']?>"
                                                aria-label="Recipient's username with two button addons" disabled>

                                            <!--agregar temas-->
                                            <a
                                                href="agregartema.php?id_mo=<?php echo $dato2['idModulo']?>&idCurso=<?php echo $_GET['id']?>">
                                                <button style="font-size: 12px;" class="btn btn-outline-secondary" type="submit">Agregar
                                                    Temas</button>
                                            </a>
                                            <!--quitar modulos-->
                                            <a
                                                href="includes/modulo/Modulo_CRUD.php?id_modulo=<?php echo $dato2['idModulo']?>&id_curso=<?php echo $_GET['id']?>">
                                                <button style="font-size: 12px;" class="btn btn-outline-secondary" type="button">Quitar
                                                    Modulo</button>
                                            </a>
                                            <!--editar modulo-->
                                            <a
                                                href="editarModulo.php?id_modulo=<?php echo $dato2['idModulo']?>&id_curso=<?php echo $_GET['id']?>">
                                                <button style="font-size: 12px;" class="btn btn-outline-secondary" type="button">Editar
                                                    Modulo</button>
                                            </a>
                                            <!--agregar cuestionario-->
                                            <a
                                                href="Form_pregun_cuestionario.php?id_modulo=<?php echo $dato2['idModulo']?>">
                                                <button style="font-size: 12px;" class="btn btn-outline-secondary" type="button">Agregar
                                                    cuestionario</button>
                                            </a>
                                        </div>
                                        <?php } Database::disconnect(); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <br><br>
    <br>
    <br>
    <br>
</body>

</html>
