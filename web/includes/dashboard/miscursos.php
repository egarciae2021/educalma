<head>
    <link rel="shortcut icon" href="assets/images/logo_edu.png">
    <link rel="stylesheet" href="assets/css/cursos.css" />

    <style>
        body {
            background: rgb(255,255,255);
            background: linear-gradient(180deg, rgba(255,255,255,1) 20%, rgba(224,199,229,1) 50%, rgba(231,244,255,1) 92%);
            background-repeat: no-repeat;
            background-attachment: fixed;
    }
        .txtTrailer {
            position: absolute; 
            background: rgba(0,0,0,0.6);  
            font-size: 16px; 
            font-weight: bold;
            opacity: 0; 
        }

        .txtTrailer:hover {
            opacity: 1;
        }

        label {
            color: white;
        }

    </style>
</head>

<!------------------------------------------------------------->
<div class="container-fluid px-0">

    <div class="container-card-course">
        <div class="row pt-1">
            <?php
                $pdo = Database::connect();
                error_reporting(0);
                $idcategoria = $_GET['idcate'];
                $sql2 = "SELECT * FROM cursos WHERE permisoCurso=1 AND estado=1 ORDER BY cursos.idCurso DESC";
                $query2 = $pdo->prepare($sql2);
                $query2->execute();
                $contar = $query2->rowCount();

                $cantidad_paginas = 3;
                $page = $contar / $cantidad_paginas;
                $page = ceil($page);
                if ($contar > 0) {
                    if ($_GET['pag'] > $page || $_GET['pag'] < 1) {
                        header('Location:sidebarCursos.php?pag=1');
                    }
                }

                $inicio = ($_GET['pag'] - 1) * $cantidad_paginas;
                $sql3 = "SELECT * FROM cursos where permisoCurso=1 AND estado=1 order by idCurso desc LIMIT 3";
                // SELECT * FROM `cursos`order by idCurso DESC LIMIT 3 

                $query3 = $pdo->prepare($sql3);
                // $query3->bindParam('iniciar', $inicio, PDO::PARAM_INT);
                // $query3->bindParam('narticulos', $cantidad_paginas, PDO::PARAM_INT);
                $query3->execute();
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
            
            <?php
                }
            ?>

        </div>
    </div>    
 








    <!--CURSOS COMPRADOS (aquí está solo el título y el buscador)-->
    <div class="container-fluid px-0">


        <!--Título-->
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="container mt-5 mb-2">
                        <div class="title_miscursos">
                            Cursos comprados
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!--Buscador
        <div class="container mb-4">
            <div class="col-12">
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="search_wrap search_wrap_3">
                            <div class="search_box">
                                <input type="text" class="input" id="buscar" name="buscar" placeholder="Buscar un curso comprado...">
                                <div style="position: relative; top: -15px; float: right;" class="btn btn_common">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
    
            </div>
        </div>-->
    </div>
    <!--FIN DE CURSOS COMPRADOS (aquí está solo el título y el buscador)-->

</div>
<!------------------------------------------------------------->














<!--CURSOS COMPRADOS (aquí está la lista de cursos)-->
<div class="container-fluid px-0 pl-2" id="result">


    <div class="container-card-course">


        <div class="row pt-1">
            
            <?php
                error_reporting(0);
                $idcategoria = $_GET['idcate'];
                $sql2 = "SELECT * FROM cursos WHERE permisoCurso=1";
                $query2 = $pdo->prepare($sql2);
                $query2->execute();
                $contar = $query2->rowCount();
                //con este codigo se hara la division 
                //para generar las paginas necesarias 
                //con respecto al numero que tenga y a los campos que halla
                $cantidad_paginas = 8;
                $page = $contar / $cantidad_paginas;
                $page = ceil($page);
                //seguimos con el paginador 
                if ($contar > 0) {
                    if ($_GET['pag'] > $page || $_GET['pag'] < 1) {
                        header('Location:sidebarCursos.php?pag=1');
                    }
                }
                $inicio = ($_GET['pag'] - 1) * $cantidad_paginas;
                $sql3 = "SELECT * FROM cursos WHERE permisoCurso=1 LIMIT :iniciar,:narticulos";

                $query3 = $pdo->prepare($sql3);
                $query3->bindParam(':iniciar', $inicio, PDO::PARAM_INT);
                $query3->bindParam(':narticulos', $cantidad_paginas, PDO::PARAM_INT);
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

            <?php if($dato2['id_cursoInscrito'] != NULL) { ?>

                <!--Contenedor del curso comprado-->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                    <div style="border-radius: 30px; overflow: hidden; border: 1px solid #7C83FD;" class="card card-miscursos">

                        <!--Contenedor de la imagen-->
                        <div class="p-2" style="overflow: hidden; border-radius: 30px;">
                            <div class="container-card-image" style="border-radius: 30px;" >
                                <?php if ($dato['imagenDestacadaCurso'] != null) { ?>
                                    <!--Imagen elegida-->
                                    <img heigth="10px"; src="<?php echo $dato['imagenDestacadaCurso']; ?>" style="cursor:pointer;"alt="">
                                    <a class="txtTrailer w-100 h-100 d-flex align-items-center justify-content-center" style="cursor: pointer;" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $dato['idCurso'];?>"><label>Ver Trailer</label></a>
                                <?php } else { ?>
                                    <!--Imagen por default-->
                                    <img heigth="10px"; src="./assets/images/curso_educalma.png" style="cursor: pointer;">
                                    <a class="txtTrailer w-100 h-100 d-flex align-items-center justify-content-center" style="cursor: pointer;" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $dato['idCurso'];?>"><label>Ver Trailer</label></a>
                                <?php } ?>
                            </div>
                        </div>

                        <!--Contenedor del nombre del curso publicado-->
                        <div style="background-color: white; flex-grow: 1;" class="d-flex flex-column p-2">
                            <div class="container-card-title text-center">
                                <span class="font-weight-bold" style="color: #7C83FD;">
                                <!--Nombre-->
                                <?php echo $dato['nombreCurso']; ?>
                            </span>
                        </div>

                        <!--Contenedor del nombre del profesor del curso publicado-->
                        <div class="container-card-description text-center">
                            <!--Código para obtener el nombre del profesor-->
                            <?php 
                                $idUsuario = $dato['id_userprofesor'];
                                $sql = "SELECT * FROM usuarios WHERE id_user = '$idUsuario'";
                                $q = $pdo->prepare($sql);
                                $q->execute(array());
                                $dato5 = $q->fetch(PDO::FETCH_ASSOC);
                                $nombresProf = $dato5['nombres'];
                                $apepaternoProf = $dato5['apellido_pat'];
                                $apematernoProf = $dato5['apellido_mat'];
                            ?>

                            <a>
                                <?php if($dato5['privilegio']==1) { ?>

                                    <span>Creado por la Fundación CALMA.</span>

                                <?php } if($dato5['privilegio']==2) { ?>

                                    <span>Creado por <?php echo " " . $dato5['nombres'] . " " . $dato5['apellido_pat'] . " " . $dato5['apellido_mat'] . "."?></span>

                                <?php } ?>
                            </a>

                        </div>

                        <!--Contenedor de la descripción del curso-->
                        <!-- <div class="container-card-description card-description-miscursos px-3">
                            <span><?php echo substr($dato['descripcionCurso'], 0, 60) . "..."; ?></span>
                        </div> -->

                        <!-- Link "Iniciar curso" -->
                        <div class="container-card-description">

                            <?php if($dato2['id_cursoInscrito'] == NULL){ ?>

                            <?php }else{ ?>

                            <?php } ?>

                            <?php if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)) { ?>

                                <!--Link "Iniciar Curso"-->
                                <!-- <div class="container-card-link card-link-miscursos">
                                    <a href="<?php echo $paginaRed ?>.php?id=<?php echo $dato['idCurso']; ?><?php if(!empty($dato2)){?>&idCI=<?php echo $dato2['id_cursoInscrito']; }?>">
                                        Ver más <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div> -->

                            <?php } else { ?>
                            
                                <!--Link "Iniciar Curso"-->
                                <!-- <div class="container-card-link card-link-miscursos">
                                    <a href="iniciosesion.php">
                                        Ver más <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div> -->
                            <?php } ?>
            
                        </div>
                    </div>
                </div>
        </div>
            <!--Fin del contenedor del curso comprado-->



                    <!-- MODAL -->
                    <!-- Este modal es para mostrar la información del un curso publicado. También para mostrar la información de un curso publicado destacado. -->
                    <!-- Este modal se activa después de hacer clic en una imagen que está dentro de un elemento a. -->
                    <div class="modal fade bd-example-modal-lg<?php echo $dato['idCurso'];?>" tabindex="-1" role="dialog"   aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered  modal-xl">
                            <div class="modal-content">

                                <!--VIDEO-->
                                <div>
                                    <div style="position: relative; margin: 0; padding: 0; width: auto; height: 270px;">
                                        
                                        <iframe width="100%" height="100%" src="https://www.youtube.com/watch?v=ptc4Awb0UpU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                                    </div>
                                </div>

                                <div class="modal-body" style="background-image: url('assets/images/fondo-modal.jpeg');background-size: 100% 100%;">
                                    <!--Contenedor del nombre del curso publicado-->
                                    <div class="container-card-title">
                                        <a class="tittle">
                                            <!--Nombre-->
                                            <center><?php echo $dato['nombreCurso']; ?></center>
                                        </a>
                                    </div>

                                    <!--Contenedor del nombre del profesor del curso publicado-->
                                    <div class="container-card-description text-center" style="font-size: 15px;">

                                        <!--Código para obtener el nombre del profesor-->
                                        <?php 
                                            $idUsuario = $dato['id_userprofesor'];
                                            $sql = "SELECT * FROM usuarios WHERE id_user = '$idUsuario'";
                                            $q = $pdo->prepare($sql);
                                            $q->execute(array());
                                            $dato5 = $q->fetch(PDO::FETCH_ASSOC);
                                            $nombresProf = $dato5['nombres'];
                                            $apepaternoProf = $dato5['apellido_pat'];
                                            $apematernoProf = $dato5['apellido_mat'];
                                        ?>

                                        <a>
                                            <?php 
                                                if($dato5['privilegio']==1){
                                            ?>

                                                    <span style="color: white;">Creado por la Fundación CALMA.</span>

                                            <?php 
                                                }

                                                if($dato5['privilegio']==2){
                                            ?>
                                                    <span style="color: white;">Creado por <?php echo " " . $dato5['nombres'] . " " . $dato5['apellido_pat'] . " " . $dato5['apellido_mat'] . "."?></span>
                                            <?php 
                                                }
                                            ?>
                                        </a>
                                    </div>

                                    <!--Contenedor de la descripción del curso-->
                                    <div class="container-card-description description">
                                        <!--Descripción-->
                                        <strong>
                                            <p style="text-align: justify;padding: 2em 4em 0 4em"><?php echo $dato['descripcionCurso'] ?></p>
                                        </strong>
                                    </div>

                                    <!--Contenedor del costo del curso, mensaje si se compró o no el curso y del link "Leer Más".-->
                                    <div style="font-size: 18px; color: white; padding-top: 1em; font-weight: bold;font-size: 20px;" class="precio">
                                                
                                        <?php if($dato2['id_cursoInscrito'] == NULL){ ?>
                        
                                            <p>
                                                <?php
                                                    if($dato['costoCurso']!=0 && $dato['costoCurso'] != "Gratis"){
                                                        echo 'S/ ' . $dato['costoCurso'];
                                                    }else{
                                                        echo 'Gratis';
                                                    }
                                                ?>
                                            </p>
                        
                                        <?php }else{ ?>
                        
                                            <p>
                                                <?php
                                                    if($dato['costoCurso']!=0 && $dato['costoCurso'] != "Gratis"){
                                                        echo 'S/ ' . $dato['costoCurso'],"";
                                                    }else{
                                                        echo 'Gratis';
                                                    }
                                                ?>
                                            </p>
                                            <!--<p>S/.<?php echo $dato['costoCurso'],"" ?></p>-->
                        
                                        <?php } ?>

                                                <?php
                                                if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
                                                ?>
                                                    <!--Link "Iniciar Curso"-->
                                                    <div class="info">
                                                        <a href="<?php echo $paginaRed ?>.php?id=<?php echo $dato['idCurso']; ?><?php if(!empty($dato2)){?>&idCI=<?php echo $dato2['id_cursoInscrito']; }?>">
                                                        <center>Iniciar Curso</center>
                                                        </a>
                                                    </div>
                                                <?php
                                                }else{
                                                ?>
                                                
                                                    <!--Link "Iniciar Curso"-->
                                                    <div class="info">
                                                        <a href="iniciosesion.php">
                                                        <center>Iniciar Curso</center>
                                                        </a>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
            }
            ?>

            <?php
            }
            ?>

        </div>
        <!--PAGINADOR-->
        <div class="row m-0 my-5">
            <div class="col-12">
                <nav aria-label="Page navigation calma">
                    <ul class="pagination justify-content-end">
                        <li class="page-item <?php if ($_GET['pag'] <= 1) echo 'disabled' ?>">
                            <a class="page-link" href="sidebarCursos.php?pag=<?php echo $_GET['pag'] - 1; ?>&idcate=<?php echo $_GET['$idcate']; ?>" tabindex="-1">
                                Anterior
                            </a>
                        </li>
                        <?php for ($i = 0; $i < $page; $i++) : ?>
                            <li class="page-item <?php echo $_GET['pag'] == $i + 1 ? 'activate' : '' ?>"><a class="page-link" href="sidebarCursos.php?pag=<?php echo $i + 1; ?>&idcate=<?php echo $_GET['idcate']; ?>"><?php echo $i + 1; ?></a></li>
                        <?php endfor ?>
                        <li class="page-item <?php if ($_GET['pag'] >= $page) echo 'disabled' ?>">
                            <a class="page-link" href="sidebarCursos.php?pag=<?php echo $_GET['pag'] + 1; ?>&idcate=<?php echo $_GET['idcate']; ?>">Siguiente</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!--FIN DE PAGINADOR-->
    </div>
   

</div>
<!--FIN DE CURSOS PUBLICADOS (aquí está la lista de cursos)-->











