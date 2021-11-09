<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="././assets/css/stylecuestionario.css">

    <!-- Bootstrap v5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- iconos -->
    <script src="https://kit.fontawesome.com/abc76d5c4d.js" crossorigin="anonymous"></script>
    <title>Cuestionario</title>
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

    <!--contenido de cuestionario-->
    <?php
        require_once '././database/databaseConection.php';
        $id=$_GET['id'];
        $idModulo=$_GET['idModulo'];
        if(isset($_GET['c_tema']) && isset($_GET['c_modulo'])){
            $c_tema=$_GET['c_tema'];
            $c_modulo=$_GET['c_modulo'];
        }
        echo $c_tema.'/';
        echo $c_modulo;
        //esta variable solo me cuenta las respuestas correctas
        if(!isset($_GET['c'])){
            $_GET['c']=0;
        }
        $c=$_GET['c'];
        //contador de las preguntas respondidas
        if(!isset($_GET['contador'])){
            $_GET['contador']=0;
        }
        $contador=$_GET['contador'];

        //selectionamos el id del cuestionario del modulo 1

        $pdo = Database::connect();
        $sql = "SELECT * FROM cuestionario WHERE id_modulo='$idModulo'";
        $q = $pdo->prepare($sql);
        $q->execute(array());
        $fila=$q->fetch(PDO::FETCH_ASSOC);

        
        //saber cantidad de preguntas existen
            $pdo2 = Database::connect();
            $sql2 = "SELECT * FROM preguntas WHERE id_cuestionario='$fila[idCuestionario]'";
            $q2 = $pdo2->prepare($sql2);
            $q2->execute();
            $cuenta2 = $q2->rowCount();
            Database::disconnect();
        //generar las preguntas que tengan el id_cuestionario
        $pdo1 = Database::connect();
        $sql1 = "SELECT * FROM preguntas WHERE id_cuestionario='$fila[idCuestionario]'";
        $q1 = $pdo1->prepare($sql1);
        $q1->execute(array());
        $reco=0;
        while($reco<$contador){
            $fila1=$q1->fetch(PDO::FETCH_ASSOC);
            $reco++;
        }
    ?>

    <br><br>
    <br>
    <br>
    <br>

    <div>
        <div class="container" style="margin-top: 120px;">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="infoMin">
                        <a href="curso.php">Curso</a> <label> > </label> <a href="progreso.php"> Modulo 1 </a><label> >
                        </label><a href="cuestionario.php"> Cuestionario </a>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>

        <div style="background: #ECFCFE; width: 80%; margin: auto;">
            <h1 style="color: #4F52D6; font-size: 30px; padding: 15px; text-align: center;">
                <strong>Cuestionario</strong>
            </h1>
            <?php
                
                

                if($contador==$cuenta2){
            ?>
            <h6 style="text-align: center;">fin de cuestionario</h6>
            <div style="text-align: center;">
                <a href="Cursoiniciar.php?id=<?php echo $id;?>"><button type="button" class="btn btn-outline-secondary">Terminar</button></a>
                <a href="video.php?id=<?php echo $id;?>&c_tema=<?php echo $c_tema;?>&validar=1&c_modulo=<?php echo $c_modulo;?>"><button type="button" class="btn btn-outline-secondary">Siguiente</button></a>
                
                
            </div>
            <div style="padding: 10px 20%;">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Resultado de las <?php echo $cuenta2;?> preguntas.
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <h5>Respuestas Correctas: <?php echo $c;?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php 
                if($fila1=$q1->fetch(PDO::FETCH_ASSOC)){
                    $pdo2 = Database::connect();
                    $sql2 = "SELECT * FROM respuestas WHERE id_Pregunta='$fila1[idPregunta]'";
                    $q2 = $pdo2->prepare($sql2);
                    $q2->execute(array());
            ?>
            <h5 style="background: #CFE8FE; padding: 20px 35px; color: #4F52D6"><?php echo $fila1['pregunta'];?>?</h5>

            
            <form style="padding: 30px;"
                action="includes/cuestionarioCRUD/cuestion.php?contador=<?php echo $contador;?>&id=<?php echo $id;?>&idModulo=<?php echo $idModulo;?>&c_tema=<?php echo $c_tema;?>&validar=1&c_modulo=<?php echo $c_modulo;?>"
                method="POST">
                <?php while($fila2=$q2->fetch(PDO::FETCH_ASSOC)){?>
                <div
                    style="padding: 10px; border-radius: 5px; background: #ffff; border-bottom: 1px solid slategray; margin-bottom: 20px;">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="verif_resp"
                            value="<?php echo $fila2['respuesta'];?>" checked>
                        <input type="hidden" name="c" value="<?php echo $c;?>">
                        <label class="form-check-label" for="exampleRadios1">
                            <?php echo $fila2['respuesta'];?>
                        </label>
                    </div>
                </div>
                <?php }?>
                <div style="text-align: right;">
                    <button type="submit" class="btn btn-outline-primary">Siguiente</button>
                </div>

            </form>
            <?php }?>
        </div>

    </div>

    <br><br>
    <br>
    <br>
    <br>

</body>

</html>