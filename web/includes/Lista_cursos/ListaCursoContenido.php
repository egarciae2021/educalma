<head>
    <link rel="stylesheet" href="assets/css/cursos.css"/> 
</head>
<br><br><br>

<?php
require_once 'database/databaseConection.php';
?>

<div class="container-fluid" >

<!-- CURSOS DESTACADOS -->
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="section-title-course">
                    Cursos destacados
                    <hr>
                </div>
            </div>
            
            <div class="row container" style="margin: 0 auto;">
            
                <?php
                        $sql2 = "SELECT * FROM cursos WHERE permisoCurso=1 ORDER BY cursos.idCurso DESC";
                        $query2 = $pdo->prepare($sql2);
                        $query2->execute();
                        $contar=$query2->rowCount();

                        $cantidad_paginas=3;
                        $page=$contar/$cantidad_paginas;
                        $page=ceil($page);
                        if ($contar>0) {
                            if($_GET['pag']>$page||$_GET['pag']<1){
                                header('Location:ListaCursos.php?pag=1');
                            }
                        }

                        $inicio=($_GET['pag']-1)*$cantidad_paginas;
                        $sql3 = "SELECT * FROM cursos WHERE permisoCurso=1 LIMIT :iniciar,:narticulos";

                        $query3=$pdo->prepare($sql3);
                        $query3->bindParam('iniciar',$inicio,PDO::PARAM_INT);
                        $query3->bindParam('narticulos',$cantidad_paginas,PDO::PARAM_INT);
                        $query3->execute();
                        $conteo = 0;
                        while ($dato = $query3->fetch(PDO::FETCH_ASSOC)) {
                            $conteo = $conteo + 1;
                            if (isset($_SESSION['codUsuario'])) {
                                $cursoID = $dato['idCurso'];
                                $userID = $_SESSION['codUsuario'];
                                $sql4 = "SELECT * FROM cursoinscrito where curso_id='$cursoID' and usuario_id = '$userID'";
                                $query4 = $pdo->prepare($sql4);
                                $query4->execute(array());
                                $dato2 = $query4->fetch(PDO::FETCH_ASSOC);
                                if (empty($dato2)) {
                                    $paginaRed = "detallecurso";
                                } else {
                                    $paginaRed = "curso";
                                }
                            } else {
                                $paginaRed = "detallecurso";
                            }
                ?>
            
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="row">
                            <div class="col-5">
                                <div class="container-image">
                                    <img src="data:image/*;base64,<?php echo base64_encode($dato['imagenDestacadaCurso']); ?>" alt="">
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="container-title">
                                    <a><strong><?php echo $dato['nombreCurso']; ?></strong></a>
                                </div>
                                <div class="container-descrition">
                                    <p><?php echo $dato['descripcionCurso']; ?>'</p>
                                </div>
                                <div class="container-link">
                                    <a href= "<?php echo $paginaRed ?>.php?id=<?php echo $dato['idCurso']; ?>">Ver informaci&oacute;n ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <?php
                }
                ?>
                
            </div>

                        
            <!-- CURSOS EN FILA -->
            <div class="row container" style="margin: 0 auto;">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="row">
                            <div class="col-5">
                                <div class="container-image">
                                    <img src="./assets/images/_111437543_197389d9-800f-4763-8654-aa30c04220e4.png" alt="">
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="container-title">
                                    Curso 1
                                </div>
                                <div class="container-descrition">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit...
                                </div>
                                <div class="container-link">
                                    <a href="#">Ver informaci&oacute;n ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="row">
                            <div class="col-5">
                                <div class="container-image">
                                    <img src="./assets/images/_111437543_197389d9-800f-4763-8654-aa30c04220e4.png" alt="">
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="container-title">
                                    Curso 1
                                </div>
                                <div class="container-descrition">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit...
                                </div>
                                <div class="container-link">
                                    <a href="#">Ver informaci&oacute;n ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="row">
                            <div class="col-5">
                                <div class="container-image">
                                    <img src="./assets/images/_111437543_197389d9-800f-4763-8654-aa30c04220e4.png" alt="">
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="container-title">
                                    Curso 1
                                </div>
                                <div class="container-descrition">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit...
                                </div>
                                <div class="container-link">
                                    <a href="#">Ver informaci&oacute;n ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- FIN CURSOS EN FILA-->

                <!-- Búsqueda -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4"></div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4"></div>
                    
                        <!-- <form class="form-inline">
                            <input type="text" class="form-control" placeholder="Buscar..." id="buscar" name="buscar">
                            <button  type="button" class="btn btn-outline-primary " onClick="location.reload()">
                                <i class="fas fa-times "></i>
                            </button>
                        </form>  -->
                        
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                            <div class="input-group justify-content-right mb-2">
                                <input type="text" class="form-control" id="buscar" name="buscar" placeholder="Buscar...">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-primary m-0" onClick="location.reload()" id="">
                                        <i class="fas fa-times"></i>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div> 
                <!--Fin de Búsqueda-->
            </div>
        </div>
    </div>
    <!-- FIN CURSOS DESTACADOS -->
    
    
    <!-- SECCIÓN CURSOS -->
    <div class="container-fluid px-0" id="result">
        <div class="row"><!-- <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4"> -->
            <div class="col-12">
                <div class="row">
                    <div class="section-title-course">
                        Cursos
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container-card-course">
            <div class="row pt-1 container" style="margin: 0 auto;" >
                
                <?php
                    error_reporting(0);
                    $idcategoria = $_GET['idcate'];
                    $sql2 = "SELECT * FROM cursos WHERE permisoCurso=1";
                    $query2 = $pdo->prepare($sql2);
                    $query2->execute();
                    $contar=$query2->rowCount(); 
                    //con este codigo se hara la division 
                    //para generar las paginas necesarias 
                    //con respecto al numero que tenga y a los campos que halla
                    $cantidad_paginas=8;
                    $page=$contar/$cantidad_paginas;
                    $page=ceil($page);
                    //seguimos con el paginador 
                    if ($contar>0) {
                        if($_GET['pag']>$page||$_GET['pag']<1){
                            header('Location:ListaCursos.php?pag=1');
                        }
                    }
                    $inicio=($_GET['pag']-1)*$cantidad_paginas;
                    $sql3 = "SELECT * FROM cursos WHERE permisoCurso=1 LIMIT :iniciar,:narticulos";

                    $query3=$pdo->prepare($sql3);
                    $query3->bindParam('iniciar',$inicio,PDO::PARAM_INT);
                    $query3->bindParam('narticulos',$cantidad_paginas,PDO::PARAM_INT);
                    $query3->execute();
                    $conteo = 0;
                    while ($dato = $query3->fetch(PDO::FETCH_ASSOC)) {
                        $conteo = $conteo + 1;
                        //ALGORITMO CURSO INSCRITO Y NO INSCRITO
                        if (isset($_SESSION['codUsuario'])) {
                            $cursoID = $dato['idCurso'];
                            $userID = $_SESSION['codUsuario'];
                            $sql4 = "SELECT * FROM cursoinscrito where curso_id='$cursoID' and usuario_id = '$userID' ";
                            $query4 = $pdo->prepare($sql4);
                            $query4->execute(array());
                            $dato2 = $query4->fetch(PDO::FETCH_ASSOC);
                            if (empty($dato2)) {
                                $paginaRed = "detallecurso";
                            } else {
                                $paginaRed = "curso";
                            }
                        } else {
                            $paginaRed =
                             "detallecurso";
                        }
                        
                ?>
                
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" >
                    <div class="card">
                        <div class="container-card-image">
                            <img heigth="10px"; src="data:image/*;base64,<?php echo base64_encode($dato['imagenDestacadaCurso']); ?>" alt="">
                        </div>
                        <div class="container-card-title">
                            <a>
                            <center><strong><?php echo $dato['nombreCurso']; ?></strong></center>
                            </a>
                        </div>
                        <div class="container-card-description">
                            <p><?php echo $dato['descripcionCurso']; ?>'</p>
                        </div>
                        <div class="container-card-link">
                            <a href= "<?php echo $paginaRed ?>.php?id=<?php echo $dato['idCurso']; ?>"> <center><strong>Ver Informaci&oacute;n > </strong> </center></a>
                        </div>
                    </div>
                </div>
                
                <?php
                }
                ?>
                
            </div>
            
            <!-- Muestras de como tenia que quedar -->
            <!-- <div class="row pt-1 container" style="margin:0 auto;">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 ">
                <div class="card">
                    <div class="container-card-image">
                        <img src="./assets/images/_111437543_197389d9-800f-4763-8654-aa30c04220e4.png">
                    </div>
                    <div class="container-card-title">
                        Curso 1
                    </div>
                    <div class="container-card-description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit...
                    </div>
                    <div class="container-card-link">
                        <a href="">Ver informaci&oacute;n ></a>
                    </div>
                </div>
            </div> -->

            <!-- <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                <div class="card">
                    <div class="container-card-image">
                        <img src="./assets/images/_111437543_197389d9-800f-4763-8654-aa30c04220e4.png">
                    </div>
                    <div class="container-card-title">
                        Curso 1
                    </div>
                    <div class="container-card-description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit...
                    </div>
                    <div class="container-card-link">
                        <a href="">Ver informaci&oacute;n ></a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                <div class="card">
                    <div class="container-card-image">
                        <img src="./assets/images/_111437543_197389d9-800f-4763-8654-aa30c04220e4.png">
                    </div>
                    <div class="container-card-title">
                        Curso 1
                    </div>
                    <div class="container-card-description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit...
                    </div>
                    <div class="container-card-link">
                        <a href="">Ver informaci&oacute;n ></a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                <div class="card">
                    <div class="container-card-image">
                        <img src="./assets/images/_111437543_197389d9-800f-4763-8654-aa30c04220e4.png">
                    </div>
                    <div class="container-card-title">
                        Curso 1
                    </div>
                    <div class="container-card-description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit...
                    </div>
                    <div class="container-card-link">
                        <a href="">Ver informaci&oacute;n ></a>
                    </div>
                </div>
            </div> -->
        </div>
        <!-- Hasta aqui son las muestras -->
    </div>
    <!-- FIN DE CURSOS -->
    
    <!--PAGINADOR-->
    <div class="row container py-4" style="margin: 0 auto;">
        <div class="col-12 mx-auto">
            <nav aria-label="Page navigation calma">
                <ul class="pagination justify-content-end">
                    <li class="page-item <?php if($_GET['pag']<=1)echo 'disabled'?>">
                    <a class="page-link" href="ListaCursos.php?pag=<?php echo $_GET['pag']-1;?>&idcate=<?php echo $_GET['$idcate']; ?>" tabindex="-1">
                        Anterior
                    </a>
                    </li>
                    
                    <?php for($i=0;$i<$page;$i++):?>
                        
                    <li class="page-item <?php echo $_GET['pag']==$i+1?'activate':''?>"><a class="page-link" href="ListaCursos.php?pag=<?php echo $i+1;?>&idcate=<?php echo $_GET['idcate']; ?>"><?php echo $i+1;?></a></li>
                    <?php endfor?>
                    <li class="page-item <?php if($_GET['pag']>=$page) echo 'disabled'?>">
                    <a class="page-link" href="ListaCursos.php?pag=<?php echo $_GET['pag']+1;?>&idcate=<?php echo $_GET['idcate']; ?>">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!--FIN DE PAGINADOR-->

</div>   
</div>
</div>