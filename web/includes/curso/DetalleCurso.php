<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Curso</title>
    <link rel="stylesheet" href="././assets/css/styledetcurso.css">
</head>
<body>

                <!--
                    ======================================
                               Detalle de Curso
                    ======================================
                -->
<?php
 
    require_once 'database/databaseConection.php';
    $id=$_GET['id'];

    $pdo4 = Database::connect(); 
    $sql4 = "SELECT * FROM cursos WHERE idCurso='$id'";
    $q4 = $pdo4->prepare($sql4);
    $q4->execute(array());
    $dato4 = $q4->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
?>

<section class="contbody">

    <div class="contdetinfo">
        <div class="continfo">

            <div class="detboxinfo">
           <!-- Cursos prevención de bullying-->
                <h1><?php echo $dato4['nombreCurso'];?> </h1>
                <p><?php echo $dato4['descripcionCurso'];?></p>
                
                
            </div>

            <div class="detboxinfo2">
                
                <?php 
                    $ProfesorID = $dato4['id_userprofesor'];

                    //DATOS DEL PROFESOR
                    $pdo5 = Database::connect(); 
                    $sql5 = "SELECT * FROM usuarios WHERE id_user='$ProfesorID'";
                    $q5 = $pdo5->prepare($sql5);
                    $q5->execute(array());
                    $dato5 = $q5->fetch(PDO::FETCH_ASSOC);

                    $nombreP = $dato5['nombres'] . " " . $dato5['apellido_pat'] . " " . $dato5['apellido_mat'];
                    $correoP = $dato5['email'];
               ?>
               <form class="formulario" action="" method="POST" enctype="multipart/form-data">
               <div class="imgbx"><img src="data:image/*;base64,<?php echo base64_encode($dato5['mifoto']);?>" alt="foto_curso" style="width: 60px;"></div>
                </form>
                <h1><?php echo $nombreP ?></h1>
                <p><?php echo $correoP ?></p>
            </div>

            <div class="detboxinfo3">
                <h1>Porttitor feugiat</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Accumsan
                    arcu ac adipiscing tincidunt adipiscing praesent consectetur. Sed
                    amet, sapien metus, proin justo. Lacus adipiscing nisi, velit arcu.
                    Consequat pretium, est tortor, proin urna nibh urna urna. Convallis
                    integer ipsum vitae
                </p>
                <h1>Porttitor feugiat</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Accumsan
                    arcu ac adipiscing tincidunt adipiscing praesent consectetur. Sed
                    amet, sapien metus, proin justo. Lacus adipiscing nisi, velit arcu.
                    Consequat pretium, est tortor, proin urna nibh urna urna. Convallis
                    integer ipsum vitae
                </p>
                <h1>Porttitor feugiat</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Accumsan
                    arcu ac adipiscing tincidunt adipiscing praesent consectetur. Sed
                    amet, sapien metus, proin justo. Lacus adipiscing nisi, velit arcu.
                    Consequat pretium, est tortor, proin urna nibh urna urna. Convallis
                    integer ipsum vitae
                </p>
            </div>

            <div class="detboxinfo4">
                <h1>Acerca del curso</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Accumsan
                    arcu ac adipiscing tincidunt adipiscing praesent consectetur. Sed
                    amet, sapien metus, proin justo. Lacus adipiscing nisi, velit arcu.
                    Consequat pretium, est tortor, proin urna nibh urna urna. Convallis
                    integer ipsum vitae
                </p>
      
            </div>

        </div>
    </div>

    <div class="contboxdet">
        <div class="contboxinfo">
            <div class="detbox">
                <img src="data:image/*;base64,<?php echo base64_encode($dato4['imagenDestacadaCurso'])?>">
                     <a href="./includes/Cursos_crud/inscribeteCurso.php?id=<?php echo $id;?>">Inscribete ahora</a>
    
                <h1>Detalles del curso</h1>
                <?php
                    $pdo10 = Database::connect(); 
                    $sql10 = "SELECT * FROM cursoinscrito WHERE curso_id='$id'";
                    $q10 = $pdo10->prepare($sql10);
                    $q10->execute();
                    $dato10 = $q10->rowCount();
                    Database::disconnect();

                    $pdo11 = Database::connect(); 
                    $sql11 = "SELECT * FROM modulo WHERE id_curso='$id'";
                    $q11 = $pdo11->prepare($sql11);
                    $q11->execute();
                    $dato11 = $q11->rowCount();
                    Database::disconnect();

                    if($dato10!=1){
                        echo "<p>Este curso cuenta con <strong>".$dato10."</strong> usuarios incritos<p>";
                    }else{
                        echo "<p>Este curso cuenta con <strong>".$dato10."</strong> usuario incrito<p>";
                    }

                    if ($dato11!=1){
                        echo "<p>Contiene <strong>".$dato11."</strong> Modulos<p>";
                    }else{
                        echo "<p>Contiene <strong>".$dato11."</strong> Modulo<p>";
                    }
                    
                    echo '<p>Contiene un Centificado</p>';
                   
                ?>
                
               
            </div>
        </div>
    </div>

</section>


<section>
 <!-- start FAQ -->
    <div class="containerdet">


        <div class="row">

                <div class="col-md-10">
                    <div class="conttitudet">
                    <h1 >Temario del curso</h1>
                    </div>
                </div>
            <div class="col-md-1"></div>
        </div>
        <hr class="lineahoridet">

        <?php
                require_once 'database/databaseConection.php';
            
                $pdo5 = Database::connect(); 
                $sql5 = "SELECT * FROM modulo WHERE id_curso='$id'";
                $q5 = $pdo5->prepare($sql5);
                $q5->execute(array());

                while($dato5 = $q5->fetch(PDO::FETCH_ASSOC)){
                    ?>

                        
        <div class="row" >
        <div class="col-md-1"></div>
        <div class="col-md-10">
        <div class="accordion_outerdet">
            <div class="containerdet">
                <details>
                    <summary><?php echo $dato5['nombreModulo'] ?><p>1h 30 min</p></summary>
                        <div class="infodet">
                            <?php
                                 $pdo6 = Database::connect(); 
                                 $aux1 = $dato5['idModulo'];
                                 $sql6 = "SELECT * FROM tema WHERE id_modulo='$aux1'";
                                 $q6 = $pdo6->prepare($sql6);
                                 $q6->execute(array());
                                 while($dato6 = $q6->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                     <a href=""><?php echo $dato6['nombreTema']  ?></a><bR>
                                <?php
                                  }
                                ?>

                        </div>
                </details>
            </div>
            </div>
        </div>
        <div class="col-md-1"></div>
        </div>

        <hr class="lineahoridet">


                    <?php
                              
                }
                Database::disconnect();

        ?>

       

        <br>
        <br>
        <br>

    </div>
<!-- end FAQ -->

</section>







</body>
</html>
