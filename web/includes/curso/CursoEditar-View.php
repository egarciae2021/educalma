<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <title>Document</title>
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
    <!--
            ======================================
                        Editar Curso
            ======================================
    -->
    <?php
        require_once 'database/databaseConection.php';

        $id=$_GET['id_curso'];

        $pdo3 = Database::connect();
        $sql3 = "SELECT * FROM cursos WHERE idCurso = '$id'";
        $q3 = $pdo3->prepare($sql3);
        $q3->execute(array());
        $dato2 = $q3->fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="contai" style=" padding: 50px 30%;">
        <div class="cont_text">
            <h2 style="color:#4F52D6;font-size: 300%;font-family: 'Oswald', sans-serif;"><center>Bienvenido a EduCalma</center></h2>
            <h3 style="color: #4F52D6;font-size: 20px;">Actualizar Curso: <?php echo $dato2['nombreCurso'];?></h3>
            <div class="cont_formu">

                 <!--empiesa formulario-->

                <form id="form-agrecursos" action="includes/Cursos_crud/Cursos_CRUD.php?id=<?php echo $dato2['idCurso'];?>" target="dummyframe" method="POST" onsubmit="registrar_nuevo_usuario();" enctype="multipart/form-data" >

                <!--Valores de formulario-->
                    <div class="mb-3">
                        <input type="text" name="nomb_actu_cursos" id="names-agrecursos" class="form-control form-control-lg" value="<?php echo $dato2['nombreCurso'];?>" aria-label="Nombrecurso" aria-describedby="names-addon"   style="border-radius:15px;border-color:#53F5ED;" required>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" id="desc-curso" name="desc_curso" style="height: 100px; border-radius:15px;border-color:#53F5ED;" required><?php echo $dato2['descripcionCurso'];?></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="number" step="any" name="prec_curso" id="precio-curso" class="form-control form-control-lg " value="<?php echo $dato2['costoCurso'];?>" aria-label="PrecioCurso" aria-describedby="precio-curso" style="border-radius:15px;border-color:#53F5ED;" required>
                    </div>
                    <div class="input-group">
                        <input accept="image/*" name="txtimagenAct" type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" style="border-radius:15px;border-color:#53F5ED;" multiple>
                    </div>
                    <div class="mb-3">
                        <img height="50px" src="data:image/*;base64,<?php echo base64_encode($dato2['imagenDestacadaCurso'])?>" >

                    </div>
                    <input type="hidden" name="idcurso" value="<?php echo $dato2['idCurso'];?>">

                    <div style="text-align: center; padding: 5% 0px;">
                        <button type="submit" class="boton"  style="background:#9888DC;color:#FFFFFF;border-radius:15px">Actualizar</button>
                    </div>

                    <!--Termina Valores de formulario-->
                </form>
                <!-- Termina formulario -->
            </div>
        </div>
    </div>
    <br><br>
    <br>
    <br>
    <br>
</body>

</html>
