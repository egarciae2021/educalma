<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="././assets/css/stylecuestionario.css">
    <!-- iconos -->
    <script src="https://kit.fontawesome.com/abc76d5c4d.js" crossorigin="anonymous"></script>
    <title>Cuestionario</title>
</head>

<body>
    <?php
    // Este codigo hace validacion para que no se pueda acceder a cualquier pagina sin estar logueado__Pablo Loyola

    if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $envi=substr($url, strrpos($url, '=') + 1);
        //$envi."<br>";
        $en=substr($url, strrpos($url, '&') - 1);
        $ens=substr($en,0,1);
        $up=substr($url, strrpos($url, 'p') + 2);
        $up=substr($up,0,1);
        // echo $up."<br>";
        // echo $ens."<br>";
        // echo $envi."<br>";

    ?>
    
        <!--contenido de cuestionario-->
        <?php
        require_once '././database/databaseConection.php';
        $id=$_GET['id'];
        $idModulo=$_GET['idModulo'];
        if(isset($_GET['c_tema']) && isset($_GET['c_modulo'])){
            $c_tema=$_GET['c_tema'];
            $c_modulo=$_GET['c_modulo'];
        }
        //echo $c_tema.'/';
        //echo $c_modulo;
        //esta variable solo me cuenta las respuestas correctas
        if(!isset($_GET['c'])){
            $_GET['c']=0;
        }
        $correcta=$_GET['c'];
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

        //nombre del curso
       $nombre_curso = Database::connect()->query("SELECT nombreCurso FROM cursos WHERE idCurso='$id'")->fetch(PDO::FETCH_ASSOC);
       Database::disconnect();
       //nombre del modulo
       $nombre_modulo = Database::connect()->query("SELECT nombreModulo FROM modulo WHERE idModulo='$idModulo'")->fetch(PDO::FETCH_ASSOC);
       Database::disconnect();

        //nombre del modulo 
        

        
        //saber cantidad de preguntas existen
            $pdo2 = Database::connect();
            $sql2 = "SELECT * FROM preguntas WHERE id_cuestionario='$fila[idCuestionario]'";
            $q2 = $pdo2->prepare($sql2);
            $q2->execute();
            $cuenta2 = $q2->rowCount();
            $filaCor=$q2->fetchAll(PDO::FETCH_ASSOC);
            Database::disconnect();
        //generar las preguntas que tengan el id_cuestionario
        $pdo1 = Database::connect();
        $sql1 = "SELECT * FROM preguntas WHERE id_cuestionario='$fila[idCuestionario]'";
        $q1 = $pdo1->prepare($sql1);
        $q1->execute(array());
        $reco=0;
        while($reco<$contador){
            $fila1=$q1->fetchAll(PDO::FETCH_ASSOC);
            $reco++;
        }
    ?>
            <br>
            <br>

            <div>
                <div class="container" style="margin-top: 120px;"></div>

                <div style="background: #ECFCFE; width: 80%; margin: auto;">
                    <div class="col-md-12" style="background-color: white; padding-bottom: 40px;">
                        <div class="infoMin">
                            <a href="">
                                <?php echo $nombre_curso['nombreCurso']?> </a> <label> > </label>
                            <a href="">
                                <?php echo $nombre_modulo['nombreModulo']?> </a> <label> > </label>
                            <a href=""> Cuestionario </a>
                        </div>
                    </div>
                    <h1 style="color: #4F52D6; font-size: 30px; padding: 15px; text-align: center;">
                        <strong>Cuestionario</strong>
                    </h1>
                    <?php
                        if($envi==$cuenta2){
                    ?>
                        <h6 style="text-align: center; font-weight: bolder;">Fin de cuestionario</h6>
                        <div style="text-align: center;">
                            <a href="curso.php?id=<?php echo $id;?>"><button type="button" class="btn btn-outline-secondary">Terminar</button></a>
                            
                            <?php
                                // $pdow = Database::connect(); 
                                // $sqli = "SELECT * FROM modulo WHERE id_curso='$id'";
                                // $qi = $pdow->prepare($sqli);
                                // $qi->execute(array());
                                // $datoi = $qi->fetch(PDO::FETCH_ASSOC);
                                // Database::disconnect();
                                // $di=$datoi['idModulo'];
                                // $pdodi = Database::connect(); 
                                
                                // $sqli="SELECT c.idModulo,p.idTema,l.idCurso FROM tema p INNER JOIN modulo c ON c.idModulo=p.id_modulo INNER JOIN cursos l ON idCurso= c.id_curso WHERE c.idModulo='$di' AND l.idCurso='$id'";
                                // $qst = $pdow->prepare($sqlt);
                                // $qst->execute(array());
                                // echo "<br>";
                                // $resultado1t=$qst->fetchAll();
                                // echo $resultado1t[1]['idTema'];
                                // // $idtema=$_GET['idtema'];
                                // $nuevat=$_GET['idtema'];
                                // $idtemat=$resultado1t[intval($_GET['idtema'])-1]['idTema'];

                                // echo $nuevat;
                                $pdo19 = Database::connect(); 
                                $sqlit="SELECT idModulo FROM modulo where id_curso=$id order by idModulo DESC LIMIT 1";
                                $qi = $pdo19->prepare($sqlit);
                                $qi->execute();
                                $datoi = $qi->fetch(PDO::FETCH_ASSOC);
                                $idmodu=$datoi['idModulo'];


                                if($idModulo<$idmodu){
                            ?>
                                    <a href="video.php?id=<?php echo $id?>&idtema=1&id_modulo=<?php echo ($idModulo+1)?>"><button type="button" class="btn btn-outline-secondary">Siguiente</button></a>
                            <?php
                                }
                            ?>

                        </div>
                        <div class="card text-center muestras">
                            <div class="card-header">
                                Resultado de las
                                <?php echo $cuenta2;?> preguntas
                            </div>
                            <div class="card-body" style="background-color: #fff;">
                                <h5 style="font-size: large; margin-left: 10px; color:black; background-color: #fff;">Respuestas Correctas:
                                    <?php echo $correcta;?>
                                </h5>
                                
                                
                                <?php
                                foreach ($filaCor as $filaCor) {
                                    
                                    

                                    $pdo23 = Database::connect();
                                    $idpregunta=$filaCor['idPregunta'];
                                    //echo $idpregunta;
                                    $sql23 = "SELECT * FROM respuestas WHERE id_Pregunta='$idpregunta'";

                                    $q23 = $pdo23->prepare($sql23);
                                    $q23->execute(array());


                                ?>
                                    <!-- nuevo -->
                                    <div class="card c-rpta mx-4 mt-3">
                                        <div class="card-header">
                                                <div class="row">
                                                    <div class="col-sm-6 text-left">Pregunta n° 1</div>
                                                    <div class="col-sm-6 text-right" style="color:#768EE8;">0/2 pts</div>
                                                </div>
                                        </div>
                                        <div class="list-group list-group-flush small text-center text-secondary font-weight-normal my-3">
                                            <?php echo $filaCor['pregunta'];?>
                                        </div>
                                        <ul class="list-group list-group-flush text-justify">

                                            <!-- respuesta correcta debe llevar verde y respuesta incorrecta debe llevar rojo -->
                                            <!-- <label class="list-group-item small">
                                                    <div class="form-check" style="color:green;">
                                                        <input type="radio" name="verif_resp" value="<php echo $filaCor['respuesta'];?>">
                                                        <input type="hidden" name="correcta" value="<php echo $correcta;?>"> 
                                                        <label class="form-check-label" for="exampleRadios1"> <php echo $filaCor[0]['respuesta'];?> </label>
                                                    </div>
                                            </label> -->

                                            <?php while($fila23=$q23->fetch(PDO::FETCH_ASSOC)){ 
                                            ?>

                                                <label class="list-group-item small">
                                                    <div class="form-check"  style="color:green;">
                                                        <input type="radio" name="verif_resp" value="<?php echo $fila23['respuesta'];?>">
                                                        <input type="hidden" name="correcta" value="<?php echo $correcta;?>">
                                                        <label class="form-check-label" for="exampleRadios1"> <?php echo $fila23['respuesta'];?> </label>
                                                    </div>
                                                </label>
                                            <?php }?>
                                        </ul>
                                    </div>
                                    <!-- fin nuevo -->

                                <?php
                                }
                                ?>
                                
                            </div>
                        </div>
                    </div>
                    
                    <?php 
                    } 
                    ?>
                    
                    <?php 
                    if($envi<$cuenta2){
                        if($fila1=$q1->fetchAll()){
                            
                            $pdo2 = Database::connect();
                            $idpregunta=$fila1[$up]['idPregunta'];
                            //echo $idpregunta;
                            $sql2 = "SELECT * FROM respuestas WHERE id_Pregunta='$idpregunta'";

                            $q2 = $pdo2->prepare($sql2);
                            $q2->execute(array());
                    ?>

                            <h5 style="background: #CFE8FE; padding: 20px 35px; color: #4F52D6">
                                <?php echo $fila1[$envi]['pregunta'];?>
                            </h5>
                            <form style="padding: 30px;" action="includes/cuestionarioCRUD/cuestion.php?contador=<?php echo $contador;?>&id=<?php echo $id;?>&c=<?php $correcta ?>&idModulo=<?php echo $idModulo;?>&validar=<?php echo 0; ?>&up=<?php echo $up ?>&cuen=<?php echo $ens ?>&nro=<?php echo $envi?>&id_pregunta=<?php echo $idpregunta ?>"
                                method="POST" id="formcito">
                                <?php while($fila2=$q2->fetch(PDO::FETCH_ASSOC)){ 
                                            //checked
                                        ?>
                                <div style="padding: 10px; border-radius: 5px; background: #ffff; border-bottom: 1px solid slategray; margin-bottom: 20px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="verif_resp" value="<?php echo $fila2['respuesta'];?>">
                                        <input type="hidden" name="correcta" value="<?php echo $correcta;?>">
                                        <label class="form-check-label" for="exampleRadios1"> <?php echo $fila2['respuesta'];?> </label>
                                    </div>
                                </div>
                                <?php }?>
                                <div style="text-align: right;">
                                    <?php 
                                            $pdo8 = Database::connect();
                                            $sqlit="SELECT idModulo FROM modulo where id_curso=$id order by idModulo DESC LIMIT 1";
                                            $qi = $pdo8->prepare($sqlit);
                                            $qi->execute();
                                            $datoi = $qi->fetch(PDO::FETCH_ASSOC);
                                            $idmodu=$datoi['idModulo'];
                                            //echo $idModulo;
                                            if($envi<$cuenta2 && $ens<=$cuenta2){
                                        ?>
                                    <button type="submit" id="env" class="btn btn-outline-primary">Siguiente</button>
                                    <?php
                                            }
                                            //     else if($idModulo==$idmodu){
                                            //         
                                            //         <button type="submit" id="env" class="btn btn-outline-primary" onclick="parent.location='curso.php?id=<?php echo $id'">Siguiente</button> -->
                                            //         
                                            //     }
                                            //     else{
                                            
                                            //     <button type="submit" id="env" class="btn btn-outline-primary" onclick="parent.location='video.php?id=<?php echo $id&idtema=1&id_modulo=<?php echo ($idModulo+1)'">Siguiente</button> -->
                                            
                                                // }
                                        ?>
                                </div>
                            </form>

                        <?php 
                            }
                        ?>

                        </div>
                        </div>

                        <br>
                        <br>
                        <br>
                        <br>
                        <br>

                        <?php
                }
                }
                else{
                            header('Location:iniciosesion.php');
                }
            ?>

    <script>
        var form = document.getElementById('formcito');
        form.onsubmit = function() {
            if (form.verif_resp.value == "") {
                Swal.fire(
                    'Seleccione una respuesta',
                    '',
                    'error'
                )
                return false;
            }
        }
    </script>

</body>

</html>