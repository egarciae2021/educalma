<head>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<?php
// Este codigo hace validacion para que no se pueda acceder a cualquier pagina sin estar logueado__Pablo Loyola

 if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
?>
<?php 
        require_once '././database/databaseConection.php';
        $validacion=1;
        $id=$_GET['id'];
        $validar=$_SESSION['validar'];
        
        $pdo1 = Database::connect(); 
        $sql1 = "SELECT * FROM cursos WHERE idCurso='$id'";
        $q1 = $pdo1->prepare($sql1);
        $q1->execute(array());
        $dato1 = $q1->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
            if($validar==0){
                $pdo=Database::connect();
            $sql = "UPDATE `cursoinscrito` SET `cantidad_respuestas` ='0' WHERE `cursoinscrito`.`curso_id` ='$id' ";
            $q = $pdo->prepare($sql);
            $q->execute();
            Database::disconnect();

            }
            
       
        
    ?>


<div class="section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="full pt-5" style="margin:0 5%;">
                    <div class="heading_main text-left">
                        <h2><span style="color: #4F52D6; font-weight:bold;"><?php echo $dato1['nombreCurso'];?></span></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <hr class="lineahori">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="contbox">
                    <h1>Introducción</h1>
                    <p><?php echo $dato1['introduccion']; ?></p>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    
        <?php 
            $pdo2 = Database::connect(); 
            $sql2 = "SELECT * FROM modulo WHERE id_curso='$id'";
            $q2 = $pdo2->prepare($sql2);
            $q2->execute();
            $dato2 = $q2->fetch(PDO::FETCH_ASSOC);
            Database::disconnect();

            $pdo3 = Database::connect(); 
            $sql3 = "SELECT * FROM tema WHERE id_modulo='$dato2[idModulo]'";
            $q3 = $pdo3->prepare($sql3);
            $q3->execute();
            $dato3 = $q3->fetch(PDO::FETCH_ASSOC);
        ?>
        
        <br>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="buttonfaq">
                    <!-- <a style="pointer-events: none;" href="video.php?id=<?php echo $id;?>&validar=1&idtema=<?php echo $dato3['idTema'];?>&id_modulo=<?php echo $dato2['idModulo']?>">Siguiente</a> -->
                    <a href="video.php?id=<?php echo $id;?>&idtema=<?php echo $dato3['idTema'];?>&validar=<?php echo $validacion;?>&id_modulo=<?php echo $dato2['idModulo']?>">Siguiente</a>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
    
    <!-- start FAQ -->
    <div class="container">
        <!--  <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="conttitu">
                    <h1>Modulos del Curso</h1>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>-->


        <?php 

          /*  $pdo4 = Database::connect(); 
            $sql4 = "SELECT * FROM modulo WHERE id_curso='$id'";
            $q4 = $pdo4->prepare($sql4);
            $q4->execute(array());
            Database::disconnect();

            if(!isset($_GET['c_modulo'])){
                $_GET['c_modulo']=1;
            }
            $cont_modulo=$_GET['c_modulo'];
            if(!isset($_GET['c_tema'])){
                $_GET['c_tema']=1;
            }
            $cont_tema=$_GET['c_tema'];
        
        
            //$d=$dato2['idModulo'];

        $sqli="SELECT c.idModulo,c.nombreModulo,p.nombreTema,p.idTema,l.idCurso FROM tema p INNER JOIN modulo c ON c.idModulo=p.id_modulo INNER JOIN cursos l ON idCurso= c.id_curso WHERE l.idCurso='$id'ORDER BY c.idModulo, p.idTema ASC";
        $qs = $pdo3->prepare($sqli);
        $qs->execute(array());
        
        $resultado1=$qs->fetchAll();
        
        // $datoss=$qs->fetch(PDO::FETCH_ASSOC);

        if (!isset($resultado1[0]['idTema']) || $resultado1[0]['idTema']==false) {
        echo "No Tiene ningun video";
        }
        else{
            $nueva=$resultado1[0]['idTema'];
        }
        echo "<br>";
        $temp=0;
        $temp2=0;

        for ($i=0; $i < count($resultado1); $i++) { 
            if ($temp!=$resultado1[$i]['idModulo']) {
                ?>
                <summary><?php echo $resultado1[$i]['nombreModulo'];?></summary>
                <?php
                $temp2=0;
                $temp=0;

            }
            if ($temp==$resultado1[$i]['idModulo'] || $temp==0) {
                $temp2++;

                ?>
                <a href="video.php?id=<?php echo $id; ?>&idtema=<?php echo ($temp2);?>&validar=<?php $validacion?>&id_modulo=<?php echo $resultado1[$i]['idModulo'];?>">
                    <div style=" padding: 5px 20px;"><?php echo $resultado1[$i]['nombreTema'];?></div>
                </a>
                <?php
                if($temp!=$resultado1[$i]['idModulo']){
                    $dato4=$q4->fetch(PDO::FETCH_ASSOC);
                    $cont_modulo++;
                    ?>
                    <!-- <a href="cuestionario.php?id=<?php echo $id;?>&idModulo=<?php echo $dato4['idModulo'];?>"> -->
                    <a href="cuestionario.php?id=<?php echo $id;?>&c_modulo=<?php echo $cont_modulo;?>&c_tema=<?php echo ($cont_tema);?>&idModulo=<?php echo $dato4['idModulo'];?>">
                                <div style=" padding: 5px 30px;">Cuestionario</div>
                            </a>
                    <?php
                }
            }
            
            $temp=$resultado1[$i]['idModulo'];
        }
        
        Database::disconnect();*/
            
        ?>
        <?php //while($dato4=$q4->fetch(PDO::FETCH_ASSOC)){ ?>
        <!-- <hr class="lineahori">
        <div class="row">

            <div class="col-md-1"></div>

            <div class="col-md-10">

                <div class="accordion_outer">
                    <div class="container">
                        <details>
                            <summary><?php echo $dato4['nombreModulo'];?></summary>
                            <?php 
                                // $pdo5 = Database::connect(); 
                                // $sql5 = "SELECT * FROM tema WHERE id_modulo='$dato4[idModulo]'";
                                // $q5 = $pdo5->prepare($sql5);
                                // $q5->execute(array());
                                // Database::disconnect();
                                // while($dato5=$q5->fetch(PDO::FETCH_ASSOC)){
                                //     echo var_dump($dato5['idTema']) ;
                                //     // echo $n=count($dato5['idTema']);
                                //     $n=($dato5['idTema']-$dato5['idTema']);
                            ?>
                            
                            <a href="video.php?id=<?php echo $id; ?>&idtema=<?php echo ($n+1);?>&id_modulo=<?php echo $dato4['idModulo']?>">
                                <div style=" padding: 5px 20px;"><?php echo $dato5['nombreTema'];?></div>
                            </a>
                            <?php //}?>
                            


                            <a href="cuestionario.php?id=<?php echo $id;?>&idModulo=<?php echo $dato4['idModulo'];?>">
                                <div style=" padding: 5px 30px;">Cuestionario</div>
                            </a>
                        </details>
                    </div>
                </div>

            </div>

            <div class="col-md-1"></div>

        </div> -->
        <?php //}?>

        <hr class="lineahori">

    </div>
    <br>
    <br>

    <?php
    }
    else{
                header('Location:iniciosesion.php');
    }
    
?>