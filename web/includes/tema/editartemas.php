<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/agretemas.css">
    <title>Editar Temas</title>
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
        <div class="cont_text" style="border-radius:15px; border-color:#53F5ED;">
            <?php
                require_once '././database/databaseConection.php';
                $idCurso= $_GET['id_curso'];
                $idModulo = $_GET['id_modulo'];
                $idtema= $_GET['id_tema'];

                $pdo2 = Database::connect();
                $sql2 = "SELECT * FROM tema WHERE idTema='$idtema'";
                $q2 = $pdo2->prepare($sql2);
                $q2->execute(array());
                $dato2=$q2->fetch(PDO::FETCH_ASSOC)
            ?>

            <h3 style="color:white; background:#53F5ED ; border-radius:15px;">Editar los Temas: <strong><?php echo $dato2['nombreTema'];?></strong>
            </h3>

            <div class="cont_formu">
                <form id="form-agretemas" action="includes/tema/checkEditTema.php?id_mo=<?php echo $idModulo?>&idCurso=<?php echo $idCurso?>"
                    target="dummyframe" method="POST" onsubmit="registrar_nuevo_usuario();">
                    <input type="hidden" name="idtema" value="<?php echo $dato2['idTema']?>">
                    <div class="mb-3">
                        <input type="text" name="temas_agregar" id="tema-agregar" class="form-control form-control-lg "
                            value="<?php echo $dato2['nombreTema']?>" aria-label="TemaAgr" aria-describedby="temaAgr-addon"
                            style="border-radius:15px; border-color:#53F5ED;"  required>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="<?php echo $dato2['descripcionTema']?>" id="descripcio-tema"
                                name="descripcio_tema" style="height: 100px;border-radius:15px; border-color:#53F5ED; " required></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="link" id="apellidoMat-registro" class="form-control form-control-lg "
                            value="<?php echo $dato2['link_video']?>" aria-label="ApellidosMat" aria-describedby="apellidoMat-addon"
                          style="border-radius:15px; border-color:#53F5ED;"    required>
                    </div>
                    <div style="text-align: center; padding: 5% 0px; width: 50%; float: left;">
                        <button type="submit" class="boton"  style="background:#9888DC;color:#FFFFFF;">Actualizar</button>
                    </div>
                    <div style="text-align: center; padding: 5% 0px; width: 50%;float: left;">
                        <a href="agregartema.php?idCurso=<?php echo $idCurso;?>&id_mo=<?php echo $idModulo;?>">
                            <button type="button" class="boton" style="background:#9888DC;color:#FFFFFF;">Salir</button></a>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <br><br>
    <br>
    <br>
    <br>
</body>

</html>
