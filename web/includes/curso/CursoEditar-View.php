<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/agretemas.css">
  <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <title>Document</title>
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

    <?php
        require_once 'database/databaseConection.php';

        $id=$_GET['id_curso'];

        $pdo3 = Database::connect();
        $sql3 = "SELECT * FROM cursos WHERE idCurso = '$id'";
        $q3 = $pdo3->prepare($sql3);
        $q3->execute(array());
        $dato2 = $q3->fetch(PDO::FETCH_ASSOC);

        if($dato2['costoCurso']=="Gratis"){
            $dato2['costoCurso']=0;
        }
    ?>

<div class="container-fluid">
        <h2 class="mb-4" style="text-align: center; color:#4F52D6; font-size: 300%;font-family: 'Oswald', sans-serif;">
                <center>Bienvenido a EduCalma</center>
        </h2>
        <div class="title">
            <div class="mb-4">
                <center><i class="fas fa-edit"></i> Editar Curso</center>
                </div>
        </div>
 </div>
            <div class="container-contformulario">
    <div class="contformulario" id="contformulario">
        <div class="row">
            <div class="image">
                <img src="./assets/images/donar04.png" alt="">
            </div>

            <!--
                                        ======================================
                                                    Editar Curso
                                        ======================================
            -->

            <form id="form-agrecursos" method="POST" action="includes/Cursos_crud/Cursos_CRUD.php?id=<?php echo $dato2['idCurso'];?>" onsubmit="registrar_nuevo_usuario();" target="dummyframe" enctype="multipart/form-data">
            <div class="inputBox">
                  <h3>Actualizar nombre del Curso: <strong>"<?php echo $dato2['nombreCurso'];?>"</strong></h3> 
                      <input type="text" name="nomb_actu_cursos" id="names-agrecursos" value="<?php echo $dato2['nombreCurso'];?>" aria-label="Nombrecurso" aria-describedby="names-addon" required>
            </div> 
            <div class="inputBox">
                    <h3>Descripción del Curso</h3>
                    <textarea maxlength="250" placeholder="" id="desc-curso" name="desc_curso" required><?php echo $dato2['descripcionCurso'];?></textarea>
                </div>
            <div class="inputBox">
                    <h3>Ingresar Precio del Curso</h3>
                <input type="number" step="any" name="prec_curso" id="precio-curso" value="<?php echo $dato2['costoCurso'];?>" placeholder="" aria-label="PrecioCurso" aria-describedby="precio-curso" required>
                </div>
                <div class="inputBox">
                    <h3>*Actualizar Imagen del Curso</h3>
                    <div class="column" style="margin:auto;">
                        <input type="file" accept="image/*" id="inputGroupFile04" name="txtimagenAct" aria-describedby="inputGroupFileAddon04" aria-label="Upload"; multiple/>
                    </div>
                    <div class="column" style="margin:auto;">
                        <div><center>
                       <img height="50px" style="margin-top:10px;" src="data:image/*;base64,<?php echo base64_encode($dato2['imagenDestacadaCurso'])?>"></center>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="idcurso" value="<?php echo $dato2['idCurso'];?>">
                <div class="inputBox">
                    <button type="submit" class="boton1">
                    <i class="fas fa-redo"></i> Actualizar</button>
                </div>
            </form>
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
