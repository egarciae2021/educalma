<head>
    <title>Bootstrap Example</title>

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styledetcurso.css">
    <link rel="stylesheet" href="assets/css/styleforo.css">
</head>

<body>

    <?php
    require_once 'database/databaseConection.php';
    $id = $_GET['id'];
    $pdo4 = Database::connect();
    $sql4 = "SELECT * FROM cursos WHERE idCurso='$id'";
    $q4 = $pdo4->prepare($sql4);
    $q4->execute(array());
    $dato4 = $q4->fetch(PDO::FETCH_ASSOC);

        //Cantidad de modulos del curso
        $pdo13 = Database::connect();
        $q13 = $pdo13->query("SELECT count(*) FROM modulo WHERE id_curso='$id'");
        $modulos = $q13->fetchColumn();

        //Cantidad de temas
        $pdo14 = Database::connect();
        $q14 = $pdo14->query("SELECT  COUNT(tema.idTema) AS 'TEMA' from tema 
                                                    INNER JOIN modulo ON tema.id_modulo = modulo.idModulo
                                                    INNER JOIN  cursos ON cursos.idCurso = modulo.id_curso
                                                    WHERE cursos.idCurso = '$id'
                                                    GROUP BY cursos.idCurso");
        $temas = $q14->fetchColumn();

        //Cantidad de Cuestionarios
        $pdo15 = Database::connect();
        $q15 = $pdo15->query("SELECT  COUNT(cuestionario.idCuestionario) AS 'Cuestionario'  from cursos 
                                                    INNER JOIN modulo ON cursos.idCurso = modulo.id_curso
                                                    INNER JOIN  cuestionario ON cuestionario.id_modulo = modulo.idModulo
                                                    WHERE cursos.idCurso = '$id'
                                                    GROUP BY cursos.idCurso");
        $cuestionarios = $q15->fetchColumn();

        //Cantidad de preguntas
        $pdo16 = Database::connect();
        $q16 = $pdo16->query("SELECT COUNT(preguntas.idPregunta) AS 'preguntas'  from cursos 
                                                    INNER JOIN modulo ON cursos.idCurso = modulo.id_curso
                                                    INNER JOIN cuestionario ON cuestionario.id_modulo = modulo.idModulo
                                                    INNER JOIN preguntas on cuestionario.idcuestionario = preguntas.id_cuestionario
                                                    WHERE cursos.idCurso = '$id'
                                                    GROUP BY cursos.idCurso");
        $preguntas = $q16->fetchColumn();

        //cantidad respuestas para aprobar
        $pdo5 = Database::connect();
        $q5 = $pdo5->query("SELECT count(*) FROM respuestas res INNER JOIN preguntas pre ON res.id_Pregunta=pre.idPregunta
                                                                                        INNER JOIN cuestionario cues ON cues.idCuestionario=pre.id_cuestionario
                                                                                        INNER JOIN modulo mo ON mo.idModulo=cues.id_modulo
                                                                                        INNER JOIN cursos cur ON cur.idCurso= mo.id_curso
                                                                                        where cur.idCurso=$id and res.estado=1");

        $cantidad_respuestas_validas = $q5->fetchColumn();

        if ($cantidad_respuestas_validas <= 9) {
            $minimo_respuestas_para_aprobar = $cantidad_respuestas_validas;
        } else {
            $minimo_respuestas_para_aprobar = $cantidad_respuestas_validas; - 2;
        }

        //Nombre del modulo
        $pdo6 = Database::connect();
        $sql6 = "SELECT idModulo, nombreModulo FROM modulo WHERE id_curso='$id'";
        $q6 = $pdo6->prepare($sql6);
        $q6->execute(array());

        Database::disconnect();

    ?>

    <div class="container-course bg-light" style="min-height: 100vh;">
        <div class="bg-dark1">
            <div class="row py-5">
                <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xl-9 ">
                    <br><br><br><br>
                    <span>Cursos</span><i class="fas fa-angle-right mx-2"></i>
                    <span>Categoría</span><i class="fas fa-angle-right mx-2"></i>
                    <span>nombre del curso</span>
                    <h2 class="my-2 font-weight-bold"><?php echo $dato4['nombreCurso']; ?></h2>
                    <p><?php echo $dato4['descripcionCurso']; ?></p>
                    <i class="fas fa-stopwatch mr-2"></i><span>Fecha: <?php echo $dato4['fechaPulicacion']; ?></span>
                    <i class="fas fa-globe ml-4 mr-2"></i><span>Español</span>
                    <i class="fas fa-closed-captioning ml-4 mr-2"></i><span>Español [automático]</span>
                </div>
                <div class="col-12 col-sm-12 col-md-5 col-lg-4 col-xl-3 info-course-right pt-3">
                    <!-- <br><br><br><br> -->
                    <div class="card ">
                        <div class="content-img">
                            <?php    
                                if($dato4['imagenDestacadaCurso']!=null){
                            ?>
                                    <img class="card-img-top1" src="data:image/*;base64,<?php echo base64_encode($dato4['imagenDestacadaCurso']) ?>" alt="Card image">
                            <?php
                                }else{
                            ?>
                                    <img class="card-img-top1"  src="./assets/images/curso_educalma.png">
                            <?php
                                }
                            ?>
                            
                        </div>


                        <div class="card-body">
                            <h4 class="card-title font-weight-bold" style="font-size: 30px;"><?php
                                                                                                if ($dato4['costoCurso'] != 0) {
                                                                                                    echo 'S/ ' . $dato4['costoCurso'];
                                                                                                } else {
                                                                                                    echo 'Gratis';
                                                                                                }
                                                                                                ?></h4>
                        <?php 
                            if ($dato4['costoCurso'] != 0) {
                                if(isset($_SESSION['Logueado'])){
                            ?>
                                    <a href="pagepay.php?id=<?php echo $dato4["idCurso"]; ?>" class="btn btn-outline-dark my-3">Comprar ahora</a>
                            <?php
                                }else{
                                    ?>
                                    <a onclick="msje_Redireccion()" class="btn btn-outline-dark my-3">Comprar ahora</a>
                                    <?php
                                }
                            } else {
                                if(isset($_SESSION['Logueado'])){
                            ?>
                                <a href="includes/Cursos_crud/inscribirseGratis.php?id=<?php echo $dato4["idCurso"]; ?>" class="btn btn-outline-dark my-3">Comprar ahora</a>
                            <?php
                                }else{
                                    ?>
                                        <a onclick="msje_Redireccion()" class="btn btn-outline-dark my-3">Comprar ahora</a>
                                    <?php
                                }
                            }
                            ?>
                            <p class="font-weight-bold mb-0">Este curso incluye:</p>
                            <div class="my-1" style="font-size: 13px;">

                                <div>
                                    <i class="far fa-file text-center" style="width: 1.5rem;"></i>
                                    <span class="ml-3"><?php echo $modulos; ?> Módulos</span>
                                </div>

                                <div>
                                    <i class="far fa-folder text-center" style="width: 1.5rem;"></i>
                                    <span class="ml-3"><?php echo $temas; ?> Temas</span>
                                </div>

                                <div>
                                    <i class="far fa-list-alt text-center" style="width: 1.5rem;"></i>
                                    <span class="ml-3"><?php echo $cuestionarios; ?> Cuestionarios</span>
                                </div>

                                <div>
                                    <i class="fas fa-graduation-cap text-center" style="width: 1.5rem;"></i>
                                    <span class="ml-3">La nota mínima aprobatoria es 14<?php //echo $minimo_respuestas_para_aprobar; ?></span>
                                </div>

                                <div>
                                    <i class="fas fa-list-ol text-center" style="width: 1.5rem;"></i>
                                    <span class="ml-3">Cantidad de preguntas: <?php echo $preguntas; ?></span>
                                </div>


                                <div>
                                    <i class="fas fa-trophy text-center" style="width: 1.5rem;"></i>
                                    <span class="ml-3">Certificado de Finalización</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <br><br><br>

    <div class="bg-light" style="height: 100%;">
        <div class="row py-5" style="height: 100%;">
            <div class="col-12 col-sm-12 col-md-5 col-lg-4 col-xl-3 info-course-left" style="border: 1px solid red;">
                <h4>Contenido del curso</h4>
            </div>
            <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xl-9 text-dark">
                <h4 class="font-weight-bold">Contenido del curso</h4>
                <div class="d-flex">
                    <div class="mr-auto p-2">
                        <span class="mr-1"><?php echo $modulos; ?></span>Módulos <i class="fas fa-circle mx-2" style="font-size: 5px;"></i>
                        <span class="mr-1"><?php echo $temas; ?></span>Temas <i class="fas fa-circle mx-2" style="font-size: 5px;"></i>
                        <span class="mr-1"><?php echo $cuestionarios; ?></span>Cuestionarios
                    </div>
                    <div class="p-2">
                        <h6>Ampliar todas las secciones</h6>
                    </div>
                </div>

                <?php
                $i = 0;
                while ($modulosC = $q6->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <div id="accordion">
                        <div class="card">
                            <a class="card-header card-link" data-toggle="collapse" href="<?php echo '#collapseOne' . $i  ?>">
                                <span><i class="fas fa-sort-down mr-3"></i><?php echo $modulosC['nombreModulo'] ?></span>
                            </a>

                            <?php

                            $idModuloC = $modulosC['idModulo'];

                            //Nombre del modulo
                            $pdo7 = Database::connect();
                            $sql7 = "SELECT nombreTema FROM tema WHERE id_modulo='$idModuloC'";
                            $q7 = $pdo7->prepare($sql7);
                            $q7->execute(array());

                            while ($temasC = $q7->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <div id="<?php echo 'collapseOne' . $i ?>" class="collapse show" data-parent="#accordion">
                                    <div class="card-body">
                                        <?php echo $temasC['nombreTema'] ?>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <div id="<?php echo 'collapseOne' . $i  ?>" class="collapse show" data-parent="#accordion">
                                <div class="card-body">
                                    Cuestionario
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    $i++;
                }
                ?>




            </div>
        </div>
    </div>
    

    <?php
    $idCurso = $id;

    $pdo = Database::connect();
    $sql = "SELECT * FROM comentarioforo as c inner join usuarios as a on a.id_user = c.iduser WHERE idcurso = '$idCurso'";
    $stm = $pdo->prepare($sql);
    $stm->execute(array());

    //ID DEL PROFESOR
    $pdo5 = Database::connect();
    $sql5 = "SELECT * FROM cursos WHERE idCurso = '$idCurso'";
    $stm5 = $pdo->prepare($sql5);
    $stm5->execute(array());
    $dato6 = $stm5->fetch(PDO::FETCH_ASSOC);
    $idProfe = $dato6['id_userprofesor'];
    ?>
    
    <!-- Comentario del Foro de Educalma -->

     <!-- Contenedor Principal -->
    <!-- Comentar Foro para que no se muestre y quitado de simbolos < > en los inicios de cada  ?php -->
    
    <?php
    if (isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)) {
    ?>
        <div class="comments-container" id="foro-curso">
        <h1>Foro Educalma <?php echo $_SESSION['iduser']?></h1>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Comentar</button>

        <?php
            if($_SESSION['privilegio']==1 || $_SESSION['privilegio']==2){
                echo '
                    <button type="button" class="btn btn-danger" onClick="AlertEliminaTodo('.$idCurso.')">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                ';
            }
        ?>
        
        <ul id="comments-list" class="comments-list">
            <li>
                <?php
                $autor = "";
                while ($registro =  $stm->fetch(PDO::FETCH_ASSOC)) {
                    if($registro['iduser']==$idProfe){
                        $autor = " by-author";
                        
                    }else{
                        $autor = "";
                    }
                ?>
                <div class="comment-main-level">
                    <!-- Avatar -->
                   <div class="comment-avatar">
                        
                        <?php    
                            if($registro['mifoto']!=null){
                        ?>
                                <img src="data:image/*;base64,<?php echo base64_encode($registro['mifoto']);?>" alt="foto_curso"
                                    style="width: 60px;height:60px;">
                        <?php
                            }else{
                        ?>
                                <img src="./assets/images/user.png" alt="foto_curso" style="width: 60px;height:60px;">
                        <?php
                            }
                        ?> 
                        
                    </div> 
                    <!-- Contenedor del Comentario -->
                   <div class="comment-box">
                        <div class="comment-head">
                            <h6 class="comment-name<?php echo $autor; ?>">
                                <spam><?php echo $registro['nombreUser']; ?></spam>
                            </h6>
                            <span>
                                <?php
                                    $fecha1 = new DateTime($registro['fecha_ingreso']);
                                    $fecha_actual= new DateTime("now");
                                    $fecha_correcta= $fecha1->add(new DateInterval('PT6H'));
                                    //se agrega 6 horas porq restar al contrario agrega, no se porque.
                                    //sucede el error q al crear un nuevo post aparece como si fuese 
                                    //de hace 6 horas, incluso al probar como aparece en segundos(unix epoch)
                                    $intervalo = $fecha_correcta->diff($fecha_actual);

                                    if($intervalo->y>0){
                                        echo 'hace '. $intervalo->y . ' año'.($intervalo->y>1?'s':'');
                                    }
                                    else if($intervalo->m>0){
                                        echo 'hace '.$intervalo->m . ' mes'.($intervalo->m>1?'es':'');
                                    }
                                    else if($intervalo->days>0){
                                        echo 'hace '.$intervalo->d . ' dia'.($intervalo->d>1?'s':'');
                                    }
                                    else if($intervalo->h>=1){
                                        echo 'hace '.$intervalo->h . ' hora'.($intervalo->h>1?'s':'');
                                    }
                                    else if($intervalo->i>0){
                                        echo 'hace '.$intervalo->i . ' minuto'.($intervalo->i>1?'s':'');
                                    }
                                    else if($intervalo->i=0){
                                        echo 'justo ahora';
                                    }        
                                    else{
                                        echo 'justo ahora';
                                    }//si no pones el else hay bug
                                ?>
                            </span>
                            <button type="button" id="modal" class="btn btn-light btn-sm ml-3" data-toggle="modal"
                                data-target="#respuesta<?php echo $registro['idcomentario'] ?>"
                                data-id="<?php echo '5' ?>">Responder</button>
                            <?php
                            if($_SESSION['privilegio']==1 || $_SESSION['iduser']==$idProfe || $registro['iduser']==$_SESSION['iduser']){
                                echo '
                                    <button type="submit" class="btn btn-danger" onClick="AlertEliminacion('.$registro['idcomentario'].')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                ';
                            }
                            ?>
                            <a class="fb-xfbml-parse-ignore" target="_blank" href="http://www.facebook.com/sharer.php?s=100&p[url]=http://educalma.fundacioncalma.org/detallecurso.php?id=<?php echo $idCurso;?>&p[title]=prueba&p[summary]=descripcion_contenido&display=page" 
                                onclick="window.open(this.href, this.target, 'width=300,height=400')"><i style="color:white;" class="fa fa-reply"></i></a>
                            <i style="color:white;" class="fa fa-heart"></i>
                        </div>
                        <div class="comment-content">
                            <?php echo $registro['comentario']; ?>
                        </div>
                    </div>
                </div>
                <!-- Respuestas de los comentarios -->
                  <?php
                        $pdo2 = Database::connect();
                        $sql2 = "SELECT * FROM sub_come_foro as s inner join usuarios as u on u.id_user= s.iduser WHERE idcomentario = '$registro[idcomentario]'";
                        $stm2 = $pdo2->prepare($sql2);
                        $stm2->execute(array());

                        $autor = "";
                    while($registro2 =  $stm2->fetch(PDO::FETCH_ASSOC)){
                     
                        if($registro2['iduser']==$idProfe){
                            $autor = " by-author";
                        }else{
                            $autor = "";
                        }
                    ?>
                <ul class="comments-list reply-list">
                    <li>
                        <!-- Avatar -->
                       <div class="comment-avatar">
                            
                            <?php    
                                if($registro2['mifoto']!=null){
                            ?>
                                    <img src="data:image/*;base64,?php echo base64_encode($registro2['mifoto']);?>"
                                alt="foto_curso" style="width: 43px;height:43px;">
                            <?php
                                }else{
                            ?>
                                    <img src="./assets/images/user.png" alt="foto_curso" style="width: 43px;height:43px;">
                            <?php
                                }
                            ?> 
                        </div> 
                        <!-- Contenedor del Comentario -->
                       <div class="comment-box">
                            <div class="comment-head">
                                <h6 class="comment-name<?php echo $autor; ?>"><spam><?php echo $registro2['user_men'];?></spam></h6>
                                <span>
                                    <?php 
                                        $fecha1_2 = new DateTime($registro2['fecha_ingreso']);
                                        $fecha_actual12= new DateTime("now");
                                        $fecha_correcta12= $fecha1_2->add(new DateInterval('PT6H'));
                                        $intervalo = $fecha_correcta12->diff($fecha_actual12);
    
                                        if($intervalo->y>0){
                                            echo 'hace '. $intervalo->y . ' año'.($intervalo->y>1?'s':'');
                                        }
                                        else if($intervalo->m>0){
                                            echo 'hace '.$intervalo->m . ' mes'.($intervalo->m>1?'es':'');
                                        }
                                        else if($intervalo->days>0){
                                            echo 'hace '.$intervalo->d . ' dia'.($intervalo->d>1?'s':'');
                                        }
                                        else if($intervalo->h>=1){
                                            echo 'hace '.$intervalo->h . ' hora'.($intervalo->h>1?'s':'');
                                        }
                                        else if($intervalo->i>0){
                                            echo 'hace '.$intervalo->i . ' minuto'.($intervalo->i>1?'s':'');
                                        }
                                        else if($intervalo->i=0){
                                            echo 'justo ahora';
                                        }        
                                        else{
                                            echo 'justo ahora';
                                        }
                                    ?>
                                </span>
                                <?php
                                    if($_SESSION['privilegio']==1 || $_SESSION['iduser']==$idProfe || $registro2['iduser']==$_SESSION['iduser']){
                                
                                    echo '
                                        <button type="submit" class="btn btn-danger" onClick="AlertElimiSubComen('.$registro2['idsubcomentario'].')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    ';
                                    }
                                ?>
                                <i style="color:white;" class="fa fa-reply"></i>
                                <i style="color:white;" class="fa fa-heart"></i>
                            </div>
                            <div class="comment-content">
                                <?php echo $registro2['subcomentario'];?>
                            </div>
                        </div>
                    </li>
                </ul>
                <?php 
                }
                ?>  
                <!------------------------------------
                        modal para ingresar respuesta
                -------------------------------------->
                <!-- Modal -->
                <div class="modal fade" id="respuesta<?php echo $registro['idcomentario'] ?>" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">:: RESPUESTA ::</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="includes/foroCrud/foroMen.php" method="post">
                                    <div class="form-group">
                                        <label for="mensaje">Responder</label>
                                        <textarea class="form-control" id="mensaje" name="submensaje" rows="3"
                                            required></textarea>
                                        <input type="hidden" name="cursoGeneral" value="<?php echo $registro['idcomentario']?>">
                                        <input type="hidden" name="id_comenta"
                                            value="<?php echo $registro['idcomentario']?>">
                                        <input type="hidden" name="id" value="<?php echo $idCurso?>">
                                        <input type="hidden" name="detalleCursoHid" value="<?php echo $idCurso?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-secondary">Enviar Respuesta</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </li>
        </ul>
    </div>              



    <!------------------------------------
        modal para ingresar mensaje
    -------------------------------------->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">:: FORO ::</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="includes/foroCrud/foroMen.php" method="post">
                        <div class="form-group">
                            <label for="mensaje">Realiza un Comentario</label>
                            <textarea class="form-control" id="mensaje" name="mensaje" rows="3" required></textarea>
                            <input type="hidden" name="id" value="<?php echo  $idCurso; ?>">
                            <input type="hidden" name="detalleCursoHid" value="<?php echo $idCurso?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-secondary">Enviar Mensaje</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    }else{
    ?>
        <div class="comments-container" id="foro-curso">
            <h1>Foro Educalma </h1>
            <button type="button" class="btn btn-primary" onclick="msje_Redireccion()">Comentar</button>

            <ul id="comments-list" class="comments-list">
                <li>
                    <?php
                    $autor = "";
                    while ($registro =  $stm->fetch(PDO::FETCH_ASSOC)) {
                        if($registro['iduser']==$idProfe){
                            $autor = " by-author";
                            
                        }else{
                            $autor = "";
                        }
                    ?>
                    <div class="comment-main-level">
                        <!-- Avatar -->
                    <div class="comment-avatar">
                            
                            <?php    
                                if($registro['mifoto']!=null){
                            ?>
                                    <img src="data:image/*;base64,<?php echo base64_encode($registro['mifoto']);?>" alt="foto_curso"
                                        style="width: 60px;height:60px;">
                            <?php
                                }else{
                            ?>
                                    <img src="./assets/images/user.png" alt="foto_curso" style="width: 60px;height:60px;">
                            <?php
                                }
                            ?> 
                            
                        </div> 
                        <!-- Contenedor del Comentario -->
                    <div class="comment-box">
                            <div class="comment-head">
                                <h6 class="comment-name<?php echo $autor; ?>">
                                    <spam><?php echo $registro['nombreUser']; ?></spam>
                                </h6>
                                <span>
                                    <?php
                                        $fecha1 = new DateTime($registro['fecha_ingreso']);
                                        $fecha_actual= new DateTime("now");
                                        $fecha_correcta= $fecha1->add(new DateInterval('PT6H'));
                                        //se agrega 6 horas porq restar al contrario agrega, no se porque.
                                        //sucede el error q al crear un nuevo post aparece como si fuese 
                                        //de hace 6 horas, incluso al probar como aparece en segundos(unix epoch)
                                        $intervalo = $fecha_correcta->diff($fecha_actual);

                                        if($intervalo->y>0){
                                            echo 'hace '. $intervalo->y . ' año'.($intervalo->y>1?'s':'');
                                        }
                                        else if($intervalo->m>0){
                                            echo 'hace '.$intervalo->m . ' mes'.($intervalo->m>1?'es':'');
                                        }
                                        else if($intervalo->days>0){
                                            echo 'hace '.$intervalo->d . ' dia'.($intervalo->d>1?'s':'');
                                        }
                                        else if($intervalo->h>=1){
                                            echo 'hace '.$intervalo->h . ' hora'.($intervalo->h>1?'s':'');
                                        }
                                        else if($intervalo->i>0){
                                            echo 'hace '.$intervalo->i . ' minuto'.($intervalo->i>1?'s':'');
                                        }
                                        else if($intervalo->i=0){
                                            echo 'justo ahora';
                                        }        
                                        else{
                                            echo 'justo ahora';
                                        }//si no pones el else hay bug
                                    ?>
                                </span>
                                <button type="button" id="modal" class="btn btn-light btn-sm ml-3" onclick="msje_Redireccion()" >Responder</button>
                                
                                <a class="fb-xfbml-parse-ignore" target="_blank" href="http://www.facebook.com/sharer.php?s=100&p[url]=http://educalma.fundacioncalma.org/detallecurso.php?id=<?php echo $idCurso;?>&p[title]=prueba&p[summary]=descripcion_contenido&display=page" 
                                    onclick="window.open(this.href, this.target, 'width=300,height=400')"><i style="color:white;" class="fa fa-reply"></i></a>
                                <i style="color:white;" class="fa fa-heart"></i>
                            </div>
                            <div class="comment-content">
                                <?php echo $registro['comentario']; ?>
                            </div>
                        </div>
                    </div>
                    <!-- Respuestas de los comentarios -->
                    <?php
                            $pdo2 = Database::connect();
                            $sql2 = "SELECT * FROM sub_come_foro as s inner join usuarios as u on u.id_user= s.iduser WHERE idcomentario = '$registro[idcomentario]'";
                            $stm2 = $pdo2->prepare($sql2);
                            $stm2->execute(array());

                            $autor = "";
                        while($registro2 =  $stm2->fetch(PDO::FETCH_ASSOC)){
                        
                            if($registro2['iduser']==$idProfe){
                                $autor = " by-author";
                            }else{
                                $autor = "";
                            }
                        ?>
                    <ul class="comments-list reply-list">
                        <li>
                            <!-- Avatar -->
                        <div class="comment-avatar">
                                
                                <?php    
                                    if($registro2['mifoto']!=null){
                                ?>
                                        <img src="data:image/*;base64,?php echo base64_encode($registro2['mifoto']);?>"
                                    alt="foto_curso" style="width: 43px;height:43px;">
                                <?php
                                    }else{
                                ?>
                                        <img src="./assets/images/user.png" alt="foto_curso" style="width: 43px;height:43px;">
                                <?php
                                    }
                                ?> 
                            </div> 
                            <!-- Contenedor del Comentario -->
                        <div class="comment-box">
                                <div class="comment-head">
                                    <h6 class="comment-name<?php echo $autor; ?>"><spam><?php echo $registro2['user_men'];?></spam></h6>
                                    <span>
                                        <?php 
                                            $fecha1_2 = new DateTime($registro2['fecha_ingreso']);
                                            $fecha_actual12= new DateTime("now");
                                            $fecha_correcta12= $fecha1_2->add(new DateInterval('PT6H'));
                                            $intervalo = $fecha_correcta12->diff($fecha_actual12);
        
                                            if($intervalo->y>0){
                                                echo 'hace '. $intervalo->y . ' año'.($intervalo->y>1?'s':'');
                                            }
                                            else if($intervalo->m>0){
                                                echo 'hace '.$intervalo->m . ' mes'.($intervalo->m>1?'es':'');
                                            }
                                            else if($intervalo->days>0){
                                                echo 'hace '.$intervalo->d . ' dia'.($intervalo->d>1?'s':'');
                                            }
                                            else if($intervalo->h>=1){
                                                echo 'hace '.$intervalo->h . ' hora'.($intervalo->h>1?'s':'');
                                            }
                                            else if($intervalo->i>0){
                                                echo 'hace '.$intervalo->i . ' minuto'.($intervalo->i>1?'s':'');
                                            }
                                            else if($intervalo->i=0){
                                                echo 'justo ahora';
                                            }        
                                            else{
                                                echo 'justo ahora';
                                            }
                                        ?>
                                    </span>
                                    
                                    <i style="color:white;" class="fa fa-reply"></i>
                                    <i style="color:white;" class="fa fa-heart"></i>
                                </div>
                                <div class="comment-content">
                                    <?php echo $registro2['subcomentario'];?>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <?php 
                    }
                    ?>  
                    
                    <?php
                    }
                    ?>
                </li>
            </ul>
        </div>              
    <?php
    }
    ?>


    <script>
        function msje_Redireccion(){
            Swal.fire({
                title: 'Necesita Loguearse primero',
                icon: 'error',
                timer: 2000,
            }).then(function() {
                location.href= "../../iniciosesion.php"
            });
        }
    </script>
</body>

</html>