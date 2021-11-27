<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros</title>
    <!-- <link rel="stylesheet" href="././assets/css/styleban.css"> -->
    <!-- <link rel="stylesheet" href="././assets/css/stylecard.css"> -->
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
  <?php
   
    if(!isset($_GET['pag'])){
        $_GET['pag']=1;
    }

  ?>
    <!-- Start Carousel -->
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="./assets/images/slider1.png" alt="First slide">
                 <!-- Static Header -->
                 <div class="header-text hidden-xs">
                        <div class="col-md-12 text-center">
                            <h2>
                            	<span>Bienvenido a <strong style="color:#130F40;">EduCalma</strong></span>
                            </h2>
                            <br>
                            <h3>
                            	<span>¡Impulsa tu aprendizaje junto a los mejores especialistas en EduCalma desde hoy!</span>
                            </h3>
                        </div>
                    </div><!-- /header-text -->
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="./assets/images/slider2.png" alt="Second slide">
                <!-- Static Header -->
                <div class="header-text hidden-xs">
                        <div class="col-md-12 text-center">
                            <h2>
                            	<span>Bienvenido a <strong style="color:#130F40;">EduCalma</strong></span>
                            </h2>
                            <br>
                            <h3>
                            	<span>¡Encuentra los cursos que desees aprender y comienza YA!</span>
                            </h3>
                            <br>
                            <div class="">
                                <a class="btn btn-theme btn-sm btn-min-block" href="../educalma/ListaCursos.php">Ver Cursos</a>
                            </div>
                        </div>
                    </div><!-- /header-text -->
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="./assets/images/slider3.jpg" alt="Third slide">
                <!-- Static Header -->
                <div class="header-text hidden-xs">
                        <div class="col-md-12 text-center">
                            <h2>
                            	<span>Bienvenido a <strong style="color:#130F40;">EduCalma</strong></span>
                            </h2>
                            <br>
                            <h3>
                            	<span>El Bullying es un tipo de violencia que sufren 1 de cada 10 niños y niñas en nuestro país.</span>
                                <br>
                                <p><span>Descubre más sobre este Curso.</span></p>
                            </h3>
                            <br>
                            <div class="">
                                <a class="btn btn-theme btn-sm btn-min-block" href="../educalma/ListaCursos.php?idcate=1">Ver Bullying</a>
                            </div>
                        </div>
                    </div><!-- /header-text -->
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
            <div class="row">
                <div class="col-md-12">

    <!-- Cards / Cursos destacados -->
                
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="section-title-course">
                        <hr>Cursos destacados
                    </div>
                </div>
                
                <div class="row">
                    <!-- 1er card -->
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="card">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="circulo">
                                            <div class="container-image">
                                                <img src="./assets/images/libro_card.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="container-title">
                                            LOREM IPSUM
                                        </div>
                                        <div class="container-text">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit...
                                        <button class="btn btn-card container-link">
                                            Ver informaci&oacute;n >
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--2do card-->
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="card">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="circulo">
                                            <div class="container-image">
                                                <img src="./assets/images/libro_card.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="container-title">
                                            LOREM IPSUM
                                        </div>
                                        <div class="container-text">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit...
                                        <button class="btn btn-card container-link">
                                            Ver informaci&oacute;n >
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--3er card-->
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="card">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="circulo">
                                            <div class="container-image">
                                                <img src="./assets/images/libro_card.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="container-title">
                                            LOREM IPSUM
                                        </div>
                                        <div class="container-text">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit...
                                        <button class="btn btn-card container-link">
                                            Ver informaci&oacute;n >
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- fin 3er card-->
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div> <!--fin layout padding-->
            
    <!-- Fin Cards-->

            <div class="cont-padre">
                
                <?php 
                            require_once 'database/databaseConection.php';
                                
                            $pdo=Database::connect();
                            $sql="SELECT COUNT(*) cantidad, curso_id FROM cursoinscrito as ci INNER JOIN cursos as c ON ci.curso_id = c.idCurso GROUP BY c.idCurso ORDER BY cantidad desc";
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
                        $sql15 = "SELECT * FROM cursos where idCurso='$curso_Id' AND  permisoCurso = 1";
                        $q15 = $pdo15->prepare($sql15);
                        $q15->execute(array());
                        

                        while($reco2=$q15->fetch(PDO::FETCH_ASSOC)){

                        error_reporting(0);
                        echo '<div class="contenedor">
                        <img src="data:image/*;base64,'.base64_encode($reco2['imagenDestacadaCurso']).'" alt="">
                        <div class="box-datos">
                        
                        <a href= "'.$paginaRed.'.php?id='.$reco2['idCurso'].'" style="font-size:18px; color: #4F52D6"> <center><strong>'.$reco2['nombreCurso'] .'</strong> </center></a>
                        <div class="redes">
                                <span class="date">Dirigido: '.$reco2['dirigido'].'</span>
                            </div>    
                        
                        <p>'.$reco2['descripcionCurso'].'</p>
                            
                        </div>
                    </div>';
                        }
                        if($cont==4){
                            break;
                         }
                    }
                         
                         
                         ?>
            </div>            
            <div class="col-md-1"></div>
            </div>
                </div>
                
<!-- CARDS -->

        <!-- parte 2 -->
        <div class="container">
            <div class="row" style="height: 100px;">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <!-- <div class="full">
                        <div class="heading_main text_align_start pdt50">
                            <h2><span> Todos los cursos</span></h2>
                        </div>
                    </div> -->
                </div>
                <div class="col-md-1"></div>
            </div>

      
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">


                   
                        <!--recorre los cursos-->
                        <div class="cont-padre">
                        <?php 
                            require_once 'database/databaseConection.php';
                                
                            $pdo=Database::connect();
                            $sql="SELECT * FROM cursos";
                            $q=$pdo->prepare($sql);
                            $q->execute();
                            $cont=$q->rowCount();
                            Database::disconnect();

                        //generar para el paginador
                            //constante 
                            $cant_pagi=8;
                            
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
                            $sql2="SELECT * FROM cursos where permisoCurso = 1  LIMIT $iniciar,$cant_pagi";
                            $q2=$pdo2->prepare($sql2);
                            $q2->execute();
                            Database::disconnect();

                            $cont = 0;
                            while($reco2=$q2->fetch(PDO::FETCH_ASSOC)){
                                $cont = $cont + 1;
      
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

                    
                        echo '<div class="contenedor">
                        <img src="data:image/*;base64,'.base64_encode($reco2['imagenDestacadaCurso']).'" alt="">
                        <div class="box-datos">
                        <a href= "'.$paginaRed.'.php?id='.$reco2['idCurso'].'" style="font-size:18px; color: #4F52D6"> <center><strong>'.$reco2['nombreCurso'] .'</strong> </center></a>
                        <div class="redes">
                                <span class="date">Dirigido: '.$reco2['dirigido'].'</span>
                            </div>    
                        <p>'.$reco2['descripcionCurso'].'</p>

                        </div>
                    </div>';
                         } 
                         
                         
                         ?>
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
</div>

</body>

</html>
