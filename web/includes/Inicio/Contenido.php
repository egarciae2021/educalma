<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nosotros</title>
    <link rel="stylesheet" href="././assets/css/styleban.css">
</head>

<body>
  <?php
   
    if(!isset($_GET['pag'])){
        $_GET['pag']=1;
    }
    
   
  ?>
    <!-- Start Carousel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="./assets/images/crs1.png" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="./assets/images/crs1.png" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="./assets/images/crs1.png" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- End Carousel-->

    <div class="section layout_padding">

        <div class="container">
            <div class="row" style="height: 100px;">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="full">
                        <div class="heading_main text_align_start pdt50">
                            <h2><span style="color: #4F52D6;"> Cursos destacados</span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
            <hr class="lineahori">

            <br>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="card-deck">
                        <?php 
                            require_once 'database/databaseConection.php';
                                
                            $pdo=Database::connect();
                            $sql="SELECT COUNT(*) as Cantidad,curso_id,c.permisoCurso FROM cursoinscrito as ci INNER JOIN cursos as c ON ci.id_cursoInscrito = c.idCurso WHERE c.permisoCurso = 1 GROUP BY curso_id ORDER BY Cantidad DESC";
                            $q=$pdo->prepare($sql);
                            $q->execute(array());
                            Database::disconnect();

                            $cont = 0;

                            while($reco=$q->fetch(PDO::FETCH_ASSOC)){
                                $cont = $cont + 1;

                                    
                        //ALGORITMO CURSO INSCRITO Y NO INSCRITO
                         if(isset($_SESSION['codUsuario'])){
                            $pdo5 = Database::connect();
                          
                            $cursoID = $reco['curso_id'];
                            $userID = $_SESSION['codUsuario'];

                            $sql5 = "SELECT * FROM cursoinscrito where curso_id='$cursoID' and usuario_id = '$userID'";
                            $q5 = $pdo5->prepare($sql5);
                            $q5->execute(array());
                            $dato5=$q5->fetch(PDO::FETCH_ASSOC);

                              if (empty($dato5)){
                                $paginaRed = "detallecurso";
                              }else{
                                $paginaRed = "curso";
                              }
                            
                         }else{
                               $paginaRed = "detallecurso";
                        }
                        
                        $pdo15=Database::connect();
                        $curso_Id= $reco['curso_id'];
                        $sql15 = "SELECT * FROM cursos where idCurso='$curso_Id'";
                        $q15 = $pdo15->prepare($sql15);
                        $q15->execute(array());
                        

                        while($reco2=$q15->fetch(PDO::FETCH_ASSOC)){

                        error_reporting(0);
                        echo '<div class="col-md-3">
                            <div class="card bdnone roundedcard" style="width: 100%;">
                                <img src="data:image/*;base64,'.base64_encode($reco2['imagenDestacadaCurso']).'" class="card-img-top imgd roundedimg" alt="190">
                                <div class="card-body">
                                  <a href= "'.$paginaRed.'.php?id='.$reco2['idCurso'].'" style="font-size:15px; color: #4F52D6"> <center>'.$reco2['nombreCurso'] .' </center></a>
                                  <label class="card-text" style="font-size:14px;">'.$reco2['descripcionCurso'].'</label>
                                     <div class="ins">
                                       <p style="font-size:15px; color: #4F52D6"><strong>Dirigido a: '.$reco2['dirigido'].'</strong></p>
                                     </div>
                                </div>
                                
                            </div>
                        </div>';
                        }
                                if($cont==4){
                                    break ;
                                }
                            }
                         
                         
                         ?>
                    </div>

                </div>
                <div class="col-md-1"></div>
            </div>

            <br>

        </div>

        <!-- parte 2 -->
        <div class="container">
            <div class="row" style="height: 100px;">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="full">
                        <div class="heading_main text_align_start pdt50">
                            <h2><span style="color: #4F52D6;"> Todos los cursos</span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
            <hr class="lineahori">

            <br>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="card-deck">
                        <!--recorre los cursos-->
                        <?php 
                            require_once 'database/databaseConection.php';
                                
                            $pdo=Database::connect();
                            $sql="SELECT * FROM cursos WHERE permisoCurso='1'";
                            $q=$pdo->prepare($sql);
                            $q->execute();
                            $cont=$q->rowCount();
                            Database::disconnect();

                        //generar para el paginador
                            //constante 
                            $cant_pagi=4;
                            
                            $pagina=$cont/$cant_pagi;
                            $pagina=ceil($pagina);
                            //para el paginador
                            if($cont>0){
                                if($_GET['pag']>$pagina || $_GET['pag']<1){
                                    header('Location:index.php');
                                }
                            }
                            $iniciar=($_GET['pag']-1)*$cant_pagi;
                            
                            
                            $pdo2=Database::connect();
                            $sql2="SELECT * FROM cursos WHERE permisoCurso='1' LIMIT $iniciar,$cant_pagi";
                            $q2=$pdo2->prepare($sql2);
                            $q2->execute();
                            Database::disconnect();


                            while($reco2=$q2->fetch(PDO::FETCH_ASSOC)){

      
                        //ALGORITMO CURSO INSCRITO Y NO INSCRITO
                         if(isset($_SESSION['codUsuario'])){
                            $pdo5 = Database::connect();
                          
                            $cursoID = $reco2['idCurso'];
                            $userID = $_SESSION['codUsuario'];

                            $sql5 = "SELECT * FROM cursoinscrito where curso_id='$cursoID' and usuario_id = '$userID'";
                            $q5 = $pdo5->prepare($sql5);
                            $q5->execute(array());
                            $dato5=$q5->fetch(PDO::FETCH_ASSOC);

                              if (empty($dato5)){
                                $paginaRed = "detallecurso";
                              }else{
                                $paginaRed = "curso";
                              }
                            
                         }else{
                               $paginaRed = "detallecurso";
                        }

                       
                       
                        echo '<div class="col-md-3">
                        <div class="card bdnone roundedcard" style="width: 100%;">
                            <img src="data:image/*;base64,'.base64_encode($reco2['imagenDestacadaCurso']).'" class="card-img-top imgd roundedimg" alt="190">
                            <div class="card-body">
                                <a href= "'.$paginaRed.'.php?id='.$reco2['idCurso'].'" > <center>'.$reco2['nombreCurso'] .' </center></a>
                                <label class="card-text" style="font-size:14px;">'.$reco2['descripcionCurso'].'</p>
                                <div class="ins">
                                  <p style="color:#4F52D6;">Dirigido a: '.$reco2['dirigido'].'</label></p>
                                </div>
                            </div>
                        </div>
                    </div>';
                         } ?>
                    </div>
                    <nav aria-label="Page navigation calma" class="pdt50">
                        <ul class="pagination justify-content-end">
                            <li class="page-item <?php if($_GET['pag']<=1) echo 'disabled'?>">
                                <a class="page-link" href="index.php?pag=<?php echo $_GET['pag']-1;?>" tabindex="-1">Anterior</a>
                            </li>
                            <?php for($i=0;$i<$pagina;$i++):?>
                            <li class="page-item <?php echo $_GET['pag']==$i+1 ? 'active':'' ?>">
                              <a class="page-link" href="index.php?pag=<?php echo $i+1;?>"><?php echo $i+1;?></a>
                            </li>
                            <?php endfor?>
                            <li class="page-item <?php if($_GET['pag']>=$pagina) echo 'disabled'?>">
                                <a class="page-link" href="index.php?pag=<?php echo $_GET['pag']+1;?>">Siguiente</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-1"></div>
            </div>

            <br>

        </div>
    </div>
</body>

</html>
