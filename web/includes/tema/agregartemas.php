<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/agretemas.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
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
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container-fluid">
        <h2 class="mb-4" style="text-align: center; color:#4F52D6; font-size: 300%;font-family: 'Oswald', sans-serif;">
                <center>Bienvenido a EduCalma</center>
        </h2>
        <div class="title">
            <div class="mb-4">
                <center><i class="fas fa-plus-square"></i> Agrega Temas a un Módulo</center>
            </div>
        </div>
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

<!-- CODIGO ANTERIOR
            <h3 style="color:white; background:#53F5ED; border-radius:15px 15px 0 0;">
            <i class="fas fa-plus-square"></i> Agregue los <strong>Temas</strong> del módulo: <strong>
                <?php echo $dato2['nombreModulo'];?></strong>
            </h3>
            <div class="cont_formu">
                <form id="form-agretemas"
                    action="includes/tema/checkAgrTema.php?id_mo=<?php echo $idModulo?>&idCurso=<?php echo $idCurso?>"
                    target="dummyframe" method="POST" onsubmit="registrar_nuevo_usuario();">
                    <div class="mb-3">
                        <input type="text" name="temas_agregar" id="tema-agregar" class="form-control form-control-lg "
                            placeholder="Nombre del Tema" aria-label="TemaAgr" aria-describedby="temaAgr-addon"
                        style="border-color:#53F5ED; border-radius:15px; font-size:15px;" required>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Descripción del Tema" id="descripcio-tema"
                                name="descripcio_tema" style="height: 100px; border-color:#53F5ED ; border-radius:15px;font-size:15px;" required></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="link" id="apellidoMat-registro" class="form-control form-control-lg "
                            placeholder="Link del Vídeo" aria-label="ApellidosMat" aria-describedby="apellidoMat-addon"
                        style=" border-color:#53F5ED; border-radius:15px;font-size:15px;"  required>
                    </div>
                    <div style="text-align: center; padding: 5% 0px; width: 50%; float: left;">
                        <button type="submit" class="boton"  style="background:#FA5CCA;color:#FFFFFF;font-size:18px;">
                        <i class="fas fa-plus"></i> Añadir</button>
                    </div>
                    <div style="text-align: center; padding: 5% 0px; width: 50%;float: left;">
                        <a href="agregarModulos.php?id=<?php echo $_GET['idCurso'];?>">
                            <button type="button" class="boton" style="background:#ED0A0A;color:#FFFFFF;font-size:18px;">
                            <i class="fas fa-window-close"></i> Salir</button></a>
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
    <br>
    <br>
    <br>
    <br>
    <br> 
-->

<!-- FORMULARIO -->
    <div class="container-contformulario">
    <div class="contformulario" id="contformulario">
        <div class="row">
            <div class="image">
                <img src="./assets/images/donar06.png" alt="">
            </div>
             <!--
                                        ======================================
                                                    Agregar Temas
                                        ======================================

            -->
            <form name="formulario" id="form-agretemas" method="POST" action="includes/tema/checkAgrTema.php?id_mo=<?php echo $idModulo?>&idCurso=<?php echo $idCurso?>" target="dummyframe" onsubmit="registrar_nuevo_usuario();">
            <div class="inputBox">
                    <h3>Agregue temas del módulo: "<strong><?php echo $dato2['nombreModulo'];?>"</strong></h3>
            </div>
            <div class="inputBox">
                    <h3>Nombre del Tema</h3>
                <input type="text" name="temas_agregar" id="tema-agregar" placeholder="" aria-label="TemaAgr" aria-describedby="temaAgr-addon" required>      
                </div>
                <div class="inputBox">
                <h3>Link del Vídeo</h3>
                    <input type="text" name="link" id="apellidoMat-registro" placeholder="" aria-label="ApellidosMat" aria-describedby="apellidoMat-addon" required>      
                </div>
                <div class="inputBox">
                    <h3>Descripción del Tema</h3>
                    <textarea maxlength="250" placeholder="" id="descripcio-tema" name="descripcio_tema" required></textarea> 
                </div>
                <div class="inputBox">
                <button type="submit" class="boton1">
                    <i class="fas fa-plus"></i> Agregar</button></button>
            </div>
            <div class="inputBox">
            <a href="agregarModulos.php?id=<?php echo $_GET['idCurso'];?>">    
            <button type="submit" class="boton1" style="background: gray; border-color: transparent;">
                <i class="fas fa-window-close"></i> Salir</button>
            </div>
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

        </div>
    </div>
</div>
</div>
<br>

<!--    Barra que muestra los temas añadidos   -->
        <div class="container_fluid">
            <div class="m-2">
                <input type="text" class="form-control" value="<?php echo $dato3['nombreTema']?>"
                    aria-label="Recipient's username with two button addons" disabled>
                <a href="editartema.php?id_modulo=<?php echo $idd; ?>&id_curso=<?php echo $idCurso;?>&id_tema=<?php echo $dato3['idTema'];?>">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-edit"></i> Editar Tema</button>
                </a>
                <a href="includes/tema/quitartemas.php?id_modulo=<?php echo $idd; ?>&id_curso=<?php echo $idCurso;?>&id_tema=<?php echo $dato3['idTema'];?>">
                    <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-trash"></i> Quitar Tema</button>
                </a>
            </div>
        </div>
                </div></div>
            <?php
                        }
                        Database::disconnect();
                    ?>
</div>
        </div>
    </div>
</body>
</html>
