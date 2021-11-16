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
<?php
// Este codigo hace validacion para que no se pueda acceder a cualquier pagina sin estar logueado

 if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
?>
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="titlemc"></div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>

    <!--contenido-->
    <div class="container-fluid">
        <div class="title">
            <div class="mb-4">
                <center><i class="fas fa-edit"></i> Editar <strong>Tema</strong></center>
            </div>
        </div>
    </div>

    <div class="container-contformulario">
    <div class="contformulario" id="contformulario">
    <div class="row">
            <div class="image">
                <img src="./assets/images/donar05.png" alt="">
            </div>
            
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

             <!--
                                        ======================================
                                                    Editar Tema
                                        ======================================              
            -->

                <form id="form-agretemas" action="includes/tema/checkEditTema.php?id_mo=<?php echo $idModulo?>&idCurso=<?php echo $idCurso?>"
                    target="dummyframe" method="POST" onsubmit="registrar_nuevo_usuario();">
                    <div class="inputBox">
                        <h3>Editar Tema: <strong>"<?php echo $dato2['nombreTema'];?>"</strong></h3>
                        <input type="hidden" name="idtema" value="<?php echo $dato2['idTema']?>">
                    </div>
                    <div class="inputBox">
                        <input type="text" name="temas_agregar" id="tema-agregar" value="<?php echo $dato2['nombreTema']?>" aria-label="TemaAgr" aria-describedby="temaAgr-addon" required>
                    </div>
                    <div class="inputBox">
                        <h3>Descripción:</h3>
                            <textarea placeholder="<?php echo $dato2['descripcionTema']?>" id="descripcio-tema" name="descripcio_tema" required></textarea>
                    </div>
                    <div class="inputBox">
                        <h3>Editar link de vídeo:</h3>
                        <input type="text" name="link" id="apellidoMat-registro" value="<?php echo $dato2['link_video']?>" aria-label="ApellidosMat" aria-describedby="apellidoMat-addon" required>
                    </div>
                    <div class="inputBox">
                        <button type="submit" class="boton1"><i class="fas fa-redo"></i> Actualizar Tema</button>
                    </div>
                    <div class="inputBox">
                    <div style="text-align: right;">
                    <a href="agregartema.php?idCurso=<?php echo $idCurso;?>&id_mo=<?php echo $idModulo;?>">
                            <button type="button" class="btn btn-outline-secondary"><i class="fas fa-times"></i> Salir</button>
                    </a>
                    </div>
                </div>
                </form>
            </div>
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

</body>
</html>
