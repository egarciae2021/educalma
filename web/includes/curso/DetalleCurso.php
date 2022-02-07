<head>
    <title>Bootstrap Example</title>

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styledetcurso.css">
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

    $idUserr = $_SESSION['codUsuario'];
    $veriS = "SELECT * FROM cursoinscrito WHERE curso_id = $id AND usuario_id='$idUserr'";
    $qS = $pdo->prepare($veriS);
    $qS->execute(array());
    $datoS = $qS->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    if (empty($datoS['id_cursoInscrito'])) {

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
            $minimo_respuestas_para_aprobar = $cantidad_respuestas_validas - 2;
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
                                <img class="card-img-top1" src="data:image/*;base64,<?php echo base64_encode($dato4['imagenDestacadaCurso']) ?>" alt="Card image">
                            </div>


                            <div class="card-body">
                                <h4 class="card-title font-weight-bold" style="font-size: 30px;"><?php
                                                                                                    if ($dato4['costoCurso'] != 0) {
                                                                                                        echo 'S/ ' . $dato4['costoCurso'];
                                                                                                    } else {
                                                                                                        echo 'Gratis';
                                                                                                    }
                                                                                                    ?></h4>
                                <?php if ($dato4['costoCurso'] != 0) {
                                ?>
                                    <a href="pagepay.php?id=<?php echo $dato4["idCurso"]; ?>" class="btn btn-outline-dark my-3">Comprar ahora</a>
                                <?php
                                } else {
                                ?>
                                    <a href="includes/Cursos_crud/inscribirseGratis.php?id=<?php echo $dato4["idCurso"]; ?>" class="btn btn-outline-dark my-3">Comprar ahora</a>
                                <?php
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
                                        <span class="ml-3">La nota mínima para aprobar el curso es <?php echo $minimo_respuestas_para_aprobar; ?></span>
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
    } else {
        echo '
            <script>
                window.location = "sidebarCursos.php";
            </script>
        ';
    }
        ?>
</body>

</html>