<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/agretemas.css">
    <title>Agregar Temas</title>
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


    <div class="contai">
        <div class="cont_text" style=" border-color:#53F5ED ; border-radius:15px;">
            <?php
                require_once '././database/databaseConection.php';
                $idModulo=$_GET['id_mo'];
                $idCurso=$_GET['idCurso'];

                $pdo2 = Database::connect();
                $sql2 = "SELECT * FROM modulo WHERE idModulo='$idModulo'";
                $q2 = $pdo2->prepare($sql2);
                $q2->execute(array());
                $dato2=$q2->fetch(PDO::FETCH_ASSOC)
                //obtener el id por medio del $_GET['id']
                //recorrer la tabla modulo y buscar el idmodulo=$_GET['id']
                //hacer un array y traer el nombre
            ?>

            <h3 style="color:white; background:#53F5ED ; border-radius:15px;">Agregue los <strong>Temas</strong> del modulo: <strong><?php echo $dato2['nombreModulo'];?></strong>
            </h3>

            <div class="cont_formu">
                <form id="form-agretemas"
                    action="includes/tema/checkAgrTema.php?id_mo=<?php echo $idModulo?>&idCurso=<?php echo $idCurso?>"
                    target="dummyframe" method="POST" onsubmit="registrar_nuevo_usuario();">
                    <div class="mb-3">
                        <input type="text" name="temas_agregar" id="tema-agregar" class="form-control form-control-lg "
                            placeholder="Nombre del Tema" aria-label="TemaAgr" aria-describedby="temaAgr-addon"
                        style=" border-color:#53F5ED ; border-radius:15px;"       required>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Descripcion del Tema" id="descripcio-tema"
                                name="descripcio_tema" style="height: 100px; border-color:#53F5ED ; border-radius:15px;" required></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="link" id="apellidoMat-registro" class="form-control form-control-lg "
                            placeholder="Link del Video" aria-label="ApellidosMat" aria-describedby="apellidoMat-addon"
                        style=" border-color:#53F5ED ; border-radius:15px;"  required>
                    </div>
                    <div style="text-align: center; padding: 5% 0px; width: 50%; float: left;">
                        <button type="submit" class="boton"  style="background:#9888DC;color:#FFFFFF;">Agregar</button>
                    </div>
                    <div style="text-align: center; padding: 5% 0px; width: 50%;float: left;">
                        <a href="agregarModulos.php?id=<?php echo $_GET['idCurso'];?>">
                            <button type="button" class="boton" style="background:#9888DC;color:#FFFFFF;">Salir</button></a>
                    </div>
                </form>
                <?php
                $pdo3 = Database::connect();
                    $idd = $dato2['idModulo'];
                    $sql3 = "SELECT * FROM tema WHERE id_modulo='$idd'";
                    $q3 = $pdo3->prepare($sql3);
                    $q3->execute(array());


                while($dato3=$q3->fetch(PDO::FETCH_ASSOC)){
            ?>

            <div class="mb-3">

                <input type="text" class="form-control" value="<?php echo $dato3['nombreTema']?>"
                    aria-label="Recipient's username with two button addons" disabled>

                <a href="editartema.php?id_modulo=<?php echo $idd; ?>&id_curso=<?php echo $idCurso;?>&id_tema=<?php echo $dato3['idTema'];?>">
                    <button class="btn btn-outline-secondary" type="button">Editar Tema</button>
                </a>

                <a href="includes/tema/quitartemas.php?id_modulo=<?php echo $idd; ?>&id_curso=<?php echo $idCurso;?>&id_tema=<?php echo $dato3['idTema'];?>">
                    <button class="btn btn-outline-secondary" type="button">Quitar Tema</button>
                </a>

            </div>
            <?php

                }
                Database::disconnect();
            ?>
            </div>

        </div>
    </div>
    <br><br>
    <br>
    <br>
    <br>
</body>

</html>
