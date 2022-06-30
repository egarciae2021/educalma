<head>
    <link rel="shortcut icon" href="assets/images/logo_edu.png">
    <link rel="stylesheet" href="assets/css/cursos.css" />

    <style>

        .imgCurso:hover {
            filter: brightness(50%);

        }

    </style>
</head>


<br><br><br>


<!------------------------------------------------------------->
<div style="position: relative; top: -40px;" class="container-fluid px-0">


    <!-- CURSOS PUBLICADOS MÁS DESTACADOS -->

    <!--Título-->
    <div class="row">
        <div class="col-12">
            <div class="row mb-4 mt-4" style="background-color: #e7f4ff; margin-left: 25px; margin-right: 25px; border-radius: 50px;">
                <div class="container section-title-course">
                    <i class="fas fa-shapes mr-3"></i>Cursos publicados más destacados
                    <hr>
                </div>
            </div>
        </div>
    </div>








        <div class="container-card-course">
            <div class="row pt-1 container" style="margin: 0 auto;">

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

                <!--Este checkbox se activa después de hacer clic en la imagen de un curso, cuyo for de la imagen es igual al ID del checkbox para que lo active.-->
                <!--<input type="checkbox" id="activarModal" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $dato['idCurso'];?>">-->
                
                    
               
                    <!--Contenedor del curso publicado más destacado-->
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        <div style="border-radius: 30px;" class="card">

                                    <!--Contenedor de la imagen-->
                                    <div style="border-radius: 30px 30px 0 0;" class="container-card-image">
                                        
                                        <?php
                                        if ($dato['imagenDestacadaCurso'] != null) {
                                        ?>
                                            <!--Imagen-->
                                            <a data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $dato['idCurso'];?>"><img class="imgCurso" src="data:image/*;base64,<?php echo base64_encode($dato['imagenDestacadaCurso']); ?>" alt=""></a>
                                        <?php
                                        } else {
                                        ?>
                                            <a data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $dato['idCurso'];?>"><img class="imgCurso" src="./assets/images/curso_educalma.png"></a>
                                        <?php
                                        }
                                        ?>

                                    </div>

                                    
                               

                                

                                    <!--Nombre del curso publicado más destacado-->
                                    <div class="container-card-title" style="padding-bottom: 1px; color: black;">
                                        <a style="float: left;"><center><strong><?php echo $dato['nombreCurso']; ?></strong><center></a>
                                    </div>

                                    <!--Contenedor del nombre del profesor del curso publicado más destacado-->
                                    <div class="container-card-description" style="margin-top: 1px; padding-top: 1px; font-size: 11px;">

                                        <!--Código para obtener el nombre del profesor-->
                                        <?php 
                                            $idUsuario = $dato['id_userprofesor'];
                                            $sql = "SELECT * FROM usuarios WHERE id_user = '$idUsuario'";
                                            $q = $pdo->prepare($sql);
                                            $q->execute(array());
                                            $dato5 = $q->fetch(PDO::FETCH_ASSOC);
                                        ?>

                                        <a>

                                            <?php 
                                                if($dato5['privilegio']==1){
                                            ?>

                                                    <span style="color: #565656;">Creado por la Fundación CALMA.</span>

                                            <?php 
                                                }

                                                if($dato5['privilegio']==2){
                                            ?>
                                                    <span style="color: #565656;">Creado por <?php echo " " . $dato5['nombres'] . " " . $dato5['apellido_pat'] . " " . $dato5['apellido_mat'] . "."?></span>
                                            <?php 
                                                }
                                            ?>
                                        </a>
                                    </div>




                                    
                                    <!--Descripción del curso comprado más destacado-->
                                    <div class="container-card-description" style="padding-bottom: 1px; margin-bottom: 1px; font-size: 13px; position: relative;">
                                        <p><?php echo substr($dato['descripcionCurso'], 0, 50) . "..."; ?></p>
                                        
                                    </div>


                                    <!--Contenedor del costo del curso, mensaje si se compró o no el curso y del link "Leer Más".-->
                                    <div class="container-card-description" style="padding-top: 1px; margin-top: 1px; font-weight: bold; font-size: 15px; color: black; position: relative;">
                                        
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
                                                                echo 'S/ ' . $dato['costoCurso'],"","<span style='position: relative; left: 100px; color: #63F70E;'>Comprado</span>";
                                                            }else{
                                                                echo 'Gratis',"","<span style='margin-left: 110px; color: #63F70E;'>Comprado</span>";
                                                            }
                                                        ?>
                                                    </p>
                                                    <!--<p>S/.<?php echo $dato['costoCurso'],"","<span style='position: relative; left: 100px; color: #63F70E;'>Comprado</span>" ?></p>-->
                                
                                                <?php } ?>
            
                                                <?php
                                                if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
                                                ?>
                                                    <!--Link "Leer Más"-->
                                                    <div class="container-card-link" style="margin: auto;">
                                                        <a href="<?php echo $paginaRed ?>.php?id=<?php echo $dato['idCurso']; ?><?php if(!empty($dato2)){?>&idCI=<?php echo $dato2['id_cursoInscrito']; }?>">
                                                        <center><strong>Leer Más</strong></center>
                                                        </a>
                                                    </div>
                                                <?php
                                                }else{
                                                ?>
                                                
                                                    <!--Link "Leer Más"-->
                                                    <div class="container-card-link" style="margin: auto;">
                                                        <a href="iniciosesion.php">
                                                        <center><strong>Leer Más</strong></center>
                                                        </a>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                        
                                    </div>

                            
                        </div>
                    </div>

                <?php
                }
                ?>

            </div>
        </div>    
 








    <!--CURSOS PUBLICADOS (aquí está solo el título y el buscador)-->
    <div class="container-fluid px-0">


        <!--Título-->
        <div class="row">
            <div class="col-12">
                <div class="row mb-4 mt-4" style="background-color: #e7f4ff; margin-left: 25px; margin-right: 25px; border-radius: 50px;">
                    <div class="container section-title-course">
                        <i class="fas fa-shapes mr-3"></i>Cursos publicados
                        <hr>
                    </div>
                </div>
            </div>
        </div>



        <!--Buscador-->
        <div class="container mb-4">
            <div class="col-12">
                <div class="row mb-2">
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
            </div>
            <div class="col-12">
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
            </div>
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
<div style="position: relative; top: -90px;" class="container-fluid px-0" id="result">


    <div class="container-card-course">














        <div class="row pt-1 container" style="margin: 0 auto;">


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
                    <div style="border-radius: 30px;" class="card">

                        <!--Contenedor de la imagen-->
                        <div style="border-radius: 30px 30px 0 0;" class="container-card-image">
                            <?php
                            if ($dato['imagenDestacadaCurso'] != null) {
                            ?>
                                <!--Imagen elegida-->
                                <a data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $dato['idCurso'];?>"><img class="imgCurso" heigth="10px"; src="data:image/*;base64,<?php echo base64_encode($dato['imagenDestacadaCurso']); ?>" alt=""></a>
                            <?php
                            } else {
                            ?>
                                <!--Imagen por default-->
                                <a data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $dato['idCurso'];?>"><img class="imgCurso" heigth="10px"; src="./assets/images/curso_educalma.png"></a>
                            <?php
                            }
                            ?>
                        </div>

                        <!--Contenedor del nombre del curso publicado-->
                        <div class="container-card-title" style="padding-bottom: 1px; color: black;">
                            <a style="float: left;">
                                <!--Nombre-->
                                <center><strong><?php echo $dato['nombreCurso']; ?></strong></center>
                            </a>
                        </div>



                        <!--Contenedor del nombre del profesor del curso publicado-->
                        <div class="container-card-description" style="margin-top: 1px; padding-top: 1px; font-size: 11px;">

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

                                                    <span style="color: #565656;">Creado por la Fundación CALMA.</span>

                                            <?php 
                                                }

                                                if($dato5['privilegio']==2){
                                            ?>
                                                    <span style="color: #565656;">Creado por <?php echo " " . $dato5['nombres'] . " " . $dato5['apellido_pat'] . " " . $dato5['apellido_mat'] . "."?></span>
                                            <?php 
                                                }
                                            ?>
                            </a>
                        </div>











                        <!--Contenedor de la descripción del curso-->
                        <div class="container-card-description" style="padding-bottom: 1px; margin-bottom: 1px; font-size: 13px; position: relative;">
                            <!--Descripción-->
                            <p><?php echo substr($dato['descripcionCurso'], 0, 50) . "..."; ?></p>
                        </div>

                        <!--Contenedor del costo del curso, mensaje si se compró o no el curso y del link "Leer Más".-->
                        <div class="container-card-description" style="padding-top: 1px; margin-top: 1px; font-weight: bold; font-size: 15px; color: black; position: relative;">
                                    
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
                                            echo 'S/ ' . $dato['costoCurso'],"","<span style='position: relative; left: 100px; color: #63F70E;'>Comprado</span>";
                                        }else{
                                            echo 'Gratis',"","<span style='margin-left: 110px; color: #63F70E;'>Comprado</span>";
                                        }
                                    ?>
                                </p>
                                <!--<p>S/.<?php echo $dato['costoCurso'],"","<span style='position: relative; left: 100px; color: #63F70E;'>Comprado</span>" ?></p>-->
            
                            <?php } ?>

                                    <?php
                                    if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
                                    ?>
                                        <!--Link "Leer Más"-->
                                        <div class="container-card-link" style="margin: auto;">
                                            <a href="<?php echo $paginaRed ?>.php?id=<?php echo $dato['idCurso']; ?><?php if(!empty($dato2)){?>&idCI=<?php echo $dato2['id_cursoInscrito']; }?>">
                                            <center><strong>Leer Más</strong></center>
                                            </a>
                                        </div>
                                    <?php
                                    }else{
                                    ?>
                                    
                                        <!--Link "Leer Más"-->
                                        <div class="container-card-link" style="margin: auto;">
                                            <a href="iniciosesion.php">
                                            <center><strong>Leer Más</strong></center>
                                            </a>
                                        </div>
                                    <?php
                                    }
                                    ?>
            
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
                            <div class="modal-body">




                                <!--Contenedor del nombre del curso publicado-->
                                <div class="container-card-title" style="padding-bottom: 1px; color: black;">
                                    <a style="float: left;">
                                        <!--Nombre-->
                                        <center><strong><?php echo $dato['nombreCurso']; ?></strong></center>
                                    </a>
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
                <?php for ($i = 0; $i < $page; $i++) : ?>
                    <li class="page-item <?php echo $_GET['pag'] == $i + 1 ? 'activate' : '' ?>"><a class="page-link" href="ListaCursos.php?pag=<?php echo $i + 1; ?>&idcate=<?php echo $_GET['idcate']; ?>"><?php echo $i + 1; ?></a></li>
                <?php endfor ?>
                <li class="page-item <?php if ($_GET['pag'] >= $page) echo 'disabled' ?>">
                    <a class="page-link" href="ListaCursos.php?pag=<?php echo $_GET['pag'] + 1; ?>&idcate=<?php echo $_GET['idcate']; ?>">Siguiente</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!--FIN DE PAGINADOR-->



















