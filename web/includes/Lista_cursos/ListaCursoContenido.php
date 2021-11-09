<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nosotros</title>
    <link rel="stylesheet" href="././assets/css/styleban.css">
    <link rel="stylesheet" href="././assets/css/stylecard.css">
</head>

<body>
    <?php
    if(!isset($_GET['pag'])){
        $_GET['pag']=1;
    }
    if(!$_GET){
        header('Location:ListaCursos.php?pag=1');
    }
    ?>
    <?php
    // Primera y unica conexion para utilizar el polimorfismo
    require_once 'database/databaseConection.php';
    $pdo = Database::connect();
    //llama a la tabla 
    $sql = "SELECT * FROM categorias ";
    $query = $pdo->prepare($sql);
    $query->execute(array());
    ?>
    <!-- Contenido -->

  
    <div class="section layout_padding">
        <div class="container">
            <br>
            <div class="row" >
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <!--NOMBRE DE LA CATEGORIA-->
                    <?php
                    if (isset($_GET['idcate'])){
                        $idcategoria = $_GET['idcate'];
                        $sql2 = "SELECT * FROM categorias where idCategoria=' $idcategoria'";
                        $query2 = $pdo->prepare($sql2);
                        $query2->execute(array());
                        $datoAdicional = $query2->fetch(PDO::FETCH_ASSOC);
                        $mensaje = "Categoria ".$datoAdicional['nombreCategoria']."";
                    }else{
                        $mensaje = "";
                    }
                    ?>
                    <section class="about" id="about">
                        <div class="content col">
                            <span>Cursos</span>
                            <h3 class="title"><?php echo $mensaje; ?></h3>
                        </div>
                        <div class="image col">
                            <img src="assets/images/clasesvirtuales.jpg" alt="">
                        </div>
                    </section>
                    <hr>
                    
                  
                    <div class="cont-padre">
                        <!--recorre los cursos-->
                        <?php
                        require_once 'database/databaseConection.php';
                        error_reporting(0);
                        $idcategoria = $_GET['idcate'];
                        $sql2 = "SELECT * FROM cursos";
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
                        $sql3 = "SELECT * FROM cursos LIMIT :iniciar,:narticulos";

                        $query3=$pdo->prepare($sql3);
                        $query3->bindParam('iniciar',$inicio,PDO::PARAM_INT);
                        $query3->bindParam('narticulos',$cantidad_paginas,PDO::PARAM_INT);
                        $query3->execute();
                        ?>
                        <?php
                        $conteo = 0;
                        while ($dato = $query3->fetch(PDO::FETCH_ASSOC)) {
                            $conteo = $conteo + 1;
                            //ALGORITMO CURSO INSCRITO Y NO INSCRITO
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
                            <!--<div class="col-lg-3 col-md-5 col-sm-6 col-12">
                                <?php echo '<img src="data:image/*;base64,' . base64_encode($dato['imagenDestacadaCurso']) . '"
                                class="card-img-top imgd roundedimg img-responsive" alt="190" style=" height:180px; ">';?>
                                <div class="card-body">
                                    <label class="card-text" style="font-size:15px; color: #4F52D6"><strong><?php echo $dato['nombreCurso']; ?></strong></label>
                                    <label class="card-text" style="font-size:14px;"><?php echo $dato['descripcionCurso']; ?></label>
                                    <div class="ins">
                                        <a href="<?php echo $paginaRed ?>.php?id=<?php echo $dato['idCurso']; ?>">
                                        <button type="button" style="width: 80%; height: 40px; font-size:13px;" class="roundedpill w165 mdl2 btn btn-lg btn-block btn-outline-primary">
                                        Empezar Curso</button></a>
                                    </div>
                                </div>
                            </div>-->

                          
                                 <div class="contenedor">
                                    <img src="data:image/*;base64,<?php echo base64_encode($dato['imagenDestacadaCurso']); ?>" alt="">
                                    <div class="box-datos">
                                        <a href= "<?php echo $paginaRed ?>.php?id=<?php echo $dato['idCurso']; ?>" style="font-size:18px; color: #4F52D6"> <center><strong><?php echo $dato['nombreCurso']; ?></strong> </center></a>
                                         <div class="redes">
                                           <span class="date">Dirigido: <?php echo $dato['dirigido']; ?></span>
                                         </div>    
                                         <p><?php echo $dato['descripcionCurso']; ?>'</p>

                                     </div>
                                </div>
                            
                        <?php
                        }
                        ?>
                        </div>
                    <nav aria-label="Page navigation calma" class="pdt50">
                        <ul class="pagination justify-content-end">
                            <li class="page-item <?php if($_GET['pag']<=1)echo 'disabled'?>">
                                <a class="page-link" href="ListaCursos.php?pag=<?php echo $_GET['pag']-1;?>&idcate=<?php echo $_GET['$idcate']; ?>" tabindex="-1">
                                Anterior
                                </a>
                            </li>
                            <?php for($i=0;$i<$page;$i++):?>
                            <li class="page-item <?php echo $_GET['pag']==$i+1?'activate':''?>"><a class="page-link" href="ListaCursos.php?pag=<?php echo $i+1;?>&idcate=<?php echo $_GET['idcate']; ?>"><?php echo $i+1;?></a>
                            </li>
                            <?php endfor?>
                            <li class="page-item <?php if($_GET['pag']>=$page) echo 'disabled'?>">
                            <a class="page-link" href="ListaCursos.php?pag=<?php echo $_GET['pag']+1;?>&idcate=<?php echo $_GET['idcate']; ?>">Siguiente</a>
                        </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
        <br>
        <br>
        <!-- Fila 4 -->
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="card-deck">
                        <div class="col-lg-3 col-md-5 col-sm-6 col-12"></div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>
    <!-- End Contenido -->
</body>
</html>