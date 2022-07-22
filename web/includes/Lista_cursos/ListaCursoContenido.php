<head>
    <link rel="shortcut icon" href="assets/images/logo_edu.png">
    <link rel="stylesheet" href="assets/css/cursos.css" />
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tamma+2&display=swap" rel="stylesheet">

    <style>

        .txtTrailer {
            /* padding: 100px 130px 100px 130px; */
            width: 100%;
            height: 100%;
            position: absolute; 
            background: rgba(0,0,0,0.6);
            font-size: 1rem; 
            font-weight: bold;
            opacity: 0;
            display: flex;
            transition: all .2s ease;
        }

        .txtTrailer:hover {
            box-shadow: 5px 5px 20px rgba(185, 45, 225, 0.4);
            color: #fff;
            opacity: 1;
        }

        label {
            color: white;
            margin: auto;
        }

    </style>
</head>


<br><br><br>


<!------------------------------------------------------------->
<div style="position: relative; top: -40px;" class="container-fluid px-0">


    <!-- CURSOS PUBLICADOS MÁS DESTACADOS -->

    <!--Título-->
    <div class="row">
        <div class="col-12 mt-4">
            <div class="row mx-4 mt-5 mb-3">
                <div class="section-title-course">
                    Cursos destacados
                </div>
            </div>
        </div>
    </div>








    <div class="container container-card-course mb-4">
        <div class="row pt-1 container">
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
                        header('Location:ListaCursos.php?pag=1');
                    }
                }

                $inicio = ($_GET['pag'] - 1) * $cantidad_paginas;
                $sql3 = "SELECT * FROM cursos where permisoCurso=1 AND estado=1 order by idCurso desc LIMIT 4";
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

            <!--Este checkbox se activa después de hacer clic en la imagen de un curso, cuyo for de la imagen es igual al ID del checkbox para que lo active.-->
            <!--<input type="checkbox" id="activarModal" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $dato['idCurso'];?>">-->

                <!--Contenedor del curso publicado más destacado-->
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div style="border-radius: 30px; overflow: hidden; border: 1px solid #7C83FD;" class="card">

                        <!--Contenedor de la imagen-->
                        <div class="container-card-image">
                            
                            <?php if ($dato['imagenDestacadaCurso'] != null) { ?>

                                <!--Imagen-->
                                <img class="imgCurso" style="cursor: pointer;" src="<?php echo $dato['imagenDestacadaCurso']; ?>" alt="">
                                <a class="txtTrailer text-center" style="cursor: pointer;" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $dato['idCurso'];?>"><label>Ver<br>Trailer</label></a>
                            
                            <?php } else { ?>

                                <img class="imgCurso" style="cursor: pointer;" src="./assets/images/curso_educalma.png">
                                <a class="txtTrailer text-center" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $dato['idCurso'];?>"><label>Ver<br>Trailer</label></a>

                            <?php } ?>

                        </div>

                        <!--Nombre del curso publicado más destacado-->
                        <div style="background-color: #ECDDF0; flex-grow: 1;" class="d-flex flex-column p-2">
                        
                            <div class="container-card-title">
                                <span class="font-weight-bold">
                                    <?php echo $dato['nombreCurso']; ?>
                                </span>
                            </div>

                            <!--Contenedor del nombre del profesor del curso publicado más destacado-->
                            <div class="container-card-description">

                                <!--Código para obtener el nombre del profesor-->
                                <?php 
                                    $idUsuario = $dato['id_userprofesor'];
                                    $sql = "SELECT * FROM usuarios WHERE id_user = '$idUsuario'";
                                    $q = $pdo->prepare($sql);
                                    $q->execute(array());
                                    $dato5 = $q->fetch(PDO::FETCH_ASSOC);
                                ?>

                                <a>
                                    <?php if($dato5['privilegio']==1){ ?>

                                        <span>Creado por la Fundación CALMA.</span>

                                    <?php } if($dato5['privilegio']==2){ ?>

                                        <span>Creado por <?php echo " " . $dato5['nombres'] . " " . $dato5['apellido_pat'] . " " . $dato5['apellido_mat'] . "."?></span>
                                    
                                    <?php } ?>
                                </a>
                                
                            </div>

                            <!--Descripción del curso comprado más destacado-->
                            <!-- <div class="container-card-description">
                                <span><?php echo $dato['descripcionCurso']; ?></span>
                            </div> -->

                            <!--Contenedor del costo del curso, mensaje si se compró o no el curso y del link "Leer Más".-->
                            <div class="container-card-description mb-2">
                                
                                <?php if($dato2['id_cursoInscrito'] == NULL) { ?>
                
                                    <p class="font-weight-bold mb-0" style="color: #7C83FD; text-transform: uppercase;">
                                        <?php 
                                            if($dato['costoCurso']!=0 && $dato['costoCurso'] != "Gratis"){
                                                echo 'S/ ' . $dato['costoCurso'];
                                            } else {
                                                echo 'Gratuito';
                                            }
                                        ?>
                                    </p>
                
                                <?php } else { ?>
                
                                    <p class="font-weight-bold mb-0" style="color: #7C83FD; text-transform: uppercase;">
                                        <?php
                                            if($dato['costoCurso']!=0 && $dato['costoCurso'] != "Gratis"){
                                                echo 'S/ ' . $dato['costoCurso'],"","<span style='position: relative; left: 100px; color: #63F70E;'>Comprado</span>";
                                            } else {
                                                echo 'Gratuito',"","<span style='position: relative; left: 100px; color: #63F70E;'>Comprado</span>";
                                            }
                                        ?>
                                    </p>
                                    <!--<p>S/.<?php echo $dato['costoCurso'],"","<span style='position: relative; left: 100px; color: #63F70E;'>Comprado</span>" ?></p>-->
                
                                <?php } ?>
                                
                                <?php if($dato['costoCurso']!=0 && $dato['costoCurso'] != "Gratis"){ //Si no gratis ?>

                                    <?php if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){ ?>

                                        <!--Link "Leer Más"-->
                                        <!-- <div class="container-card-link">
                                            <a href="<?php echo $paginaRed ?>.php?id=<?php echo $dato['idCurso']; ?><?php if(!empty($dato2)){?>&idCI=<?php echo $dato2['id_cursoInscrito']; }?>">
                                                Leer más
                                            </a>
                                        </div> -->

                                    <?php } else { ?>
                                    
                                        <!--Link "Leer Más"-->
                                        <!-- <div class="container-card-link">
                                            <a href="iniciosesion.php">
                                                Leer más
                                            </a>
                                        </div> -->

                                    <?php } ?>

                                <?php } else { //Si es gratiS ?>  

                                    <?php if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){ ?>

                                        <!--Link "Leer Más"-->
                                        <!-- <div class="container-card-link">
                                            <a href="<?php echo $paginaRed ?>.php?id=<?php echo $dato['idCurso']; ?><?php if(!empty($dato2)){?>&idCI=<?php echo $dato2['id_cursoInscrito']; }?>">
                                                Obtener Gratis
                                            </a>
                                        </div> -->

                                    <?php } else { ?>

                                        <!--Link "Leer Más"-->
                                        <!-- <div class="container-card-link">
                                            <a href="iniciosesion.php">
                                                Obtener Gratis
                                            </a>
                                        </div> -->

                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>    
    <!--CURSOS PUBLICADOS (aquí está solo el título y el buscador)-->
    <div class="container-fluid px-0">


        <!--Título-->
        <div class="row">
            <div class="col-12">
                <div class="row mx-4 mt-0 mb-4">
                    <div class="section-title-course">
                        Cursos publicados
                    </div>
                </div>
            </div>
        </div>



        <!--Buscador-->
        <div class="container mb-4">
            <!-- <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="search_wrap search_wrap_3">
                            <div class="search_box">
                                <input type="text" class="input" id="buscar" name="buscar" placeholder="Busca un curso publicado...">
                                <div style="position: relative; top: -15px; float: right;" class="btn btn_common">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="search_wrap search_wrap_3">
                            <div class="input-group" style="height: 45px;">
                                <input type="text" class="input form-control" style="border-radius: 30px 0 0 30px;" id="buscar" name="buscar" placeholder="Busca un curso publicado...">
                                <div class="input-group-append">
                                    <span class="input-group-text justify-content-center" style="border-radius: 0 30px 30px 0; width: 90px; background-color: #7C83FD;">
                                        <i class="fas fa-search" style="color: white; font-size: 1.4rem;"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-12"> -->
                <!-- <div class="row mb-4"> -->
                <!-- <hr>
                        <div class="d-flex justify-content-center mb-3">
                            <div class="px-2">Categoria 1</div>
                            <div class="px-2">Categoria 2</div>
                            <div class="px-2">Categoria 3</div>
                            <div class="px-2">Categoria 4</div>
                            <div class="px-2">Categoria 5</div>
                        </div>
                        <div class="d-flex justify-content-center mb-3">
                            <div class="px-2">subcategoria 1</div>
                            <div class="px-2">subcategoria 2</div>
                            <div class="px-2">subcategoria 3</div>
                            <div class="px-2">subcategoria 4</div>
                            <div class="px-2">subcategoria 5</div>
                        </div>
                        <hr> -->
                <!-- </div> -->
            <!-- </div> -->
        </div>
        <!-- 
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4"></div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4"></div>
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
             -->
        <!--Fin de Búsqueda-->
    </div>
    <!--FIN DE CURSOS PUBLICADOS (aquí está solo el título y el buscador)-->
</div>
<!------------------------------------------------------------->



















<!--CURSOS PUBLICADOS (aquí está la lista de cursos)-->

<div style="position: relative; top: -60px;" class="container-fluid px-0" id="result">
    <div class="container container-card-course">
        <div class="row pt-1 container">
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
                    header('Location:ListaCursos.php?pag=1');
                }
            }
            $inicio = ($_GET['pag'] - 1) * $cantidad_paginas;
            $sql3 = "SELECT * FROM cursos WHERE permisoCurso=1 AND estado=1";

            $query3 = $pdo->prepare($sql3);
            //$query3->bindParam(':iniciar', $inicio, PDO::PARAM_INT);
            //$query3->bindParam(':narticulos', $cantidad_paginas, PDO::PARAM_INT);
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

            <!--Este checkbox se activa después de hacer clic en la imagen de un curso, cuyo for de la imagen es igual al ID del checkbox para que lo active.-->
            <!--<input type="checkbox" id="activarModal" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $dato['idCurso'];?>">-->

            <!--Contenedor del curso publicado-->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                <div style="border-radius: 30px; overflow: hidden;" class="card">
                    <!--Contenedor de la imagen-->
                    <div class="container-card-image">

                        <?php if ($dato['imagenDestacadaCurso'] != null) { ?>

                        <!--Imagen elegida-->
                        <img style="cursor: pointer;" class="imgCurso" src="<?php echo $dato['imagenDestacadaCurso']; ?>" alt="">
                        <a class="txtTrailer text-center" data-toggle="modal" style="cursor: pointer;" data-target=".bd-example-modal-lg<?php echo $dato['idCurso'];?>"><label>Ver<br>Trailer</label></a>
                        
                        <?php } else { ?>


                            <?php
                            if ($dato['imagenDestacadaCurso'] != null) {
                            ?>
                            
                                <!--Imagen elegida-->
                                <img style="cursor: pointer;" class="imgCurso" heigth="10px"; src="<?php echo $dato['imagenDestacadaCurso']; ?>" alt="">
                                <a class="txtTrailer" style="cursor: pointer;" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $dato['idCurso'];?>"><label>Ver Trailer</label></a>
                            <?php
                            } else {
                            ?>
                                <!--Imagen por default-->
                                <img style="cursor: pointer;" class="imgCurso" heigth="10px"; src="./assets/images/curso_educalma.png">
                                <a class="txtTrailer" style="cursor: pointer;" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $dato['idCurso'];?>"><label>Ver Trailer</label></a>
                            <?php
                            }
                            ?>

                        <!--Imagen por default-->
                        <img style="cursor: pointer;" class="imgCurso" src="./assets/images/curso_educalma.png">
                        <a class="txtTrailer text-center" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $dato['idCurso'];?>"><label>Ver<br>Trailer</label></a>
                        
                        <?php } ?>

                    </div>

                    <!--Contenedor del nombre del curso publicado-->
                    <div style="background-color: #ECDDF0;  flex-grow: 1;" class="d-flex flex-column p-2">

                        <div class="container-card-title">
                            <!--Nombre-->
                            <span class="font-weight-bold">
                                <?php echo $dato['nombreCurso']; ?>
                            </span>
                        </div>

                        <!--Contenedor del nombre del profesor del curso publicado-->
                        <div class="container-card-description">
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
                            <?php if($dato5['privilegio']==1){ ?>
                                <span>Creado por la Fundación CALMA.</span>
                            <?php } if($dato5['privilegio']==2){ ?>
                                <span>Creado por <?php echo " " . $dato5['nombres'] . " " . $dato5['apellido_pat'] . " " . $dato5['apellido_mat'] . "."?></span>
                            <?php } ?>
                            </a>
                        </div>

                        <!--Contenedor de la descripción del curso-->
                        <!-- <div class="container-card-description">
                            <span>
                                <?php echo $dato['descripcionCurso']; ?>
                            </span>
                        </div> -->

                        <!--Contenedor del costo del curso, mensaje si se compró o no el curso y del link "Leer Más".-->
                        <div class="container-card-description">

                            <?php if($dato2['id_cursoInscrito'] == NULL){ ?>

                                <p class="font-weight-bold mb-0" style="color: #7C83FD; text-transform: uppercase;">
                                    <?php
                                        if($dato['costoCurso']!=0 && $dato['costoCurso'] != "Gratis"){
                                            echo 'S/ ' . $dato['costoCurso'];
                                        }else{
                                            echo 'Gratuito';
                                        }
                                    ?>
                                </p>

                            <?php } else { ?>

                                <p class="font-weight-bold mb-0" style="color: #7C83FD; text-transform: uppercase;">
                                    <?php
                                        if($dato['costoCurso']!=0 && $dato['costoCurso'] != "Gratis"){
                                            echo 'S/ ' . $dato['costoCurso'],"","<span style='position: relative; left: 100px; color: #63F70E;'>Comprado</span>";
                                        }else{
                                            echo 'Gratuito',"","<span style='position: relative; left: 100px; color: #63F70E;'>Comprado</span>";
                                        }
                                    ?>
                                </p>
                                <!--<p>S/.<?php echo $dato['costoCurso'],"","<span style='position: relative; left: 100px; color: #63F70E;'>Comprado</span>" ?></p>-->
            
                            <?php } ?>

                            <?php if($dato['costoCurso']!=0 && $dato['costoCurso'] != "Gratis"){ //Si no es gratis ?>

                                <?php if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){ ?>
                                    <!--Link "Leer Más"-->
                                    <!-- <div class="container-card-link">
                                        <a href="<?php echo $paginaRed ?>.php?id=<?php echo $dato['idCurso']; ?><?php if(!empty($dato2)){?>&idCI=<?php echo $dato2['id_cursoInscrito']; }?>">
                                            Leer Más
                                        </a>
                                    </div> -->
                                <?php } else { ?>
                                    <!--Link "Leer Más"-->
                                    <!-- <div class="container-card-link">
                                        <a href="iniciosesion.php">
                                            Leer Más
                                        </a>
                                    </div> -->
                                <?php } ?>

                            <?php } else { //Si es gratis ?>  

                                <?php if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){ ?>
                                    <!--Link "Leer Más"-->
                                    <!-- <div class="container-card-link">
                                        <a href="<?php echo $paginaRed ?>.php?id=<?php echo $dato['idCurso']; ?><?php if(!empty($dato2)){?>&idCI=<?php echo $dato2['id_cursoInscrito']; }?>">
                                            Obtener Gratis
                                        </a>
                                    </div> -->
                                <?php }else { ?>
                                
                                    <!--Link "Leer Más"-->
                                    <!-- <div class="container-card-link">
                                        <a href="iniciosesion.php">
                                            Obtener Gratis
                                        </a>
                                    </div> -->
                                <?php } ?>

                            <?php } ?>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!--Fin del contenedor del curso publicado-->

                        <!-- MODAL -->
                        <!-- Este modal es para mostrar la información del un curso publicado. También para mostrar la información de un curso publicado destacado. -->
                        <!-- Este modal se activa después de hacer clic en una imagen que está dentro de un elemento a. -->
                        <div class="modal fade bd-example-modal-lg<?php echo $dato['idCurso'];?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                            <?php if($dato5['privilegio']==1){ ?>

                                                <span style="color: white;">Creado por la Fundación CALMA.</span>

                                            <?php } if($dato5['privilegio']==2){ ?>

                                                <span style="color: white;">Creado por <?php echo " " . $dato5['nombres'] . " " . $dato5['apellido_pat'] . " " . $dato5['apellido_mat'] . "."?></span>
                                            
                                            <?php } ?>
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
                                        if($dato['costoCurso']!=0 && $dato['costoCurso'] != "Gratis"){//Si no es gratis
                                        ?>

                                                <?php
                                                if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
                                                ?>
                                                    <!--Link "Leer Más"-->
                                                    <div class="info">
                                                        <a href="<?php echo $paginaRed ?>.php?id=<?php echo $dato['idCurso']; ?><?php if(!empty($dato2)){?>&idCI=<?php echo $dato2['id_cursoInscrito']; }?>">
                                                        <center>Leer Más</center>
                                                        </a>
                                                    </div>
                                                <?php
                                                }else{
                                                ?>
                                                
                                                    <!--Link "Leer Más"-->
                                                    <div class="info">
                                                        <a href="iniciosesion.php">
                                                        <center>Leer Más</center>
                                                        </a>
                                                    </div>
                                                <?php
                                                }
                                                ?>




                                        <?php    
                                        }else{ //Si es gratis
                                        ?>


                                                <?php
                                                if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
                                                ?>
                                                    <!--Link "Leer Más"-->
                                                    <div class="info1">
                                                        <a href="<?php echo $paginaRed ?>.php?id=<?php echo $dato['idCurso']; ?><?php if(!empty($dato2)){?>&idCI=<?php echo $dato2['id_cursoInscrito']; }?>">
                                                        <center>Obtener Gratis</center>
                                                        </a>
                                                    </div>
                                                <?php
                                                }else{
                                                ?>
                                                
                                                    <!--Link "Leer Más"-->
                                                    <div class="info1">
                                                        <a href="iniciosesion.php">
                                                        <center>Obtener Gratis</center>
                                                        </a>
                                                    </div>
                                                <?php
                                                }
                                                ?>


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

        </div>
    </div>
   

</div>
<!--FIN DE CURSOS PUBLICADOS (aquí está la lista de cursos)-->









































<!--PAGINADOR-->
<div class="row container py-4" style="margin: 0 auto; position: relative; top: -80px;">
    <div class="col-12 mx-auto">
        <nav aria-label="Page navigation calma">
            <ul class="pagination justify-content-end">
                <li class="page-item <?php if ($_GET['pag'] <= 1) echo 'disabled' ?>">
                    <a class="page-link" href="ListaCursos.php?pag=<?php echo $_GET['pag'] - 1; ?>&idcate=<?php echo $_GET['$idcate']; ?>" tabindex="-1">
                        Anterior
                    </a>
                </li>
                <?php for ($i = 1; $i < $page; $i++) : ?>
                    <li class="page-item <?php echo $_GET['pag'] == $i ? 'activate' : '' ?>"><a class="page-link" href="ListaCursos.php?pag=<?php echo $i; ?>&idcate=<?php echo $_GET['idcate']; ?>"><?php echo $i; ?></a></li>
                <?php endfor ?>
                <li class="page-item <?php if ($_GET['pag'] >= $page-1) echo 'disabled' ?>">
		<a class="page-link" href="ListaCursos.php?pag=<?php echo $_GET['pag'] + 1; ?>&idcate=<?php echo $_GET['idcate']; ?>">Siguiente</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!--FIN DE PAGINADOR-->

















