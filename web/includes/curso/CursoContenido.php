<head>
    <link href="assets/css/contenidocurso.css" rel="stylesheet" type="text/css" />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="assets/css/styleforo.css">
</head>

<body>
    <?php
    if (isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)) {
    ?>
        <?php
        // ob_start(); 
        // session_start();
        require_once '././database/databaseConection.php';
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

        $pdo5 = Database::connect();
        $q5=$pdo5->query("SELECT count(*) FROM respuestas res INNER JOIN preguntas pre ON res.id_Pregunta=pre.idPregunta
                                                    INNER JOIN cuestionario cues ON cues.idCuestionario=pre.id_cuestionario
                                                    INNER JOIN modulo mo ON mo.idModulo=cues.id_modulo
                                                    INNER JOIN cursos cur ON cur.idCurso= mo.id_curso
                                                    where cur.idCurso=$id and res.estado=1");
                                                    
        $cantidad_respuestas_validas= $q5->fetchColumn();
        
        if($cantidad_respuestas_validas<=9){
            $minimo_respuestas_para_aprobar=$cantidad_respuestas_validas;
            $nota37=20;
        }else{
            $minimo_respuestas_para_aprobar=$cantidad_respuestas_validas-2;
            $nota37=19;
        }
        
        
        $pdo6 = Database::connect();
        $idUser56=$_SESSION['iduser'];
        $sql6 = "SELECT cantidad_respuestas FROM cursoinscrito WHERE curso_id = '$id' and usuario_id= '$idUser56'";
        $q6 = $pdo6->prepare($sql6);
        $q6->execute(array());
        $dato=$q6->fetch(PDO::FETCH_ASSOC);
        
        $cantidad_respuesta_acertadas=$dato['cantidad_respuestas'];

        // ******//

        //Nombre del modulo
        $pdo6 = Database::connect();
        $sql6 = "SELECT idModulo, nombreModulo FROM modulo WHERE id_curso='$id'";
        $q6 = $pdo6->prepare($sql6);
        $q6->execute(array());


        //********************* *//
        $con = Database::connect();
        $idusuario=$_SESSION['iduser'];
        $ver = "SELECT curso_obt FROM cursoinscrito WHERE curso_id=$id AND usuario_id=$idusuario";
        $veremos = $con->prepare($ver);
        $veremos->setFetchMode(PDO::FETCH_ASSOC);
        $veremos->execute();
        $vere=$veremos->fetchColumn();
        $query=1;
        if ($vere==false || $vere==0) {
            if(isset($_POST['vali'])){
                $codi=$_POST['codi'];
                $conn = Database::connect(); 
                $squery = "SELECT COUNT(*) FROM cursoinscrito WHERE cod_curso='$codi' AND curso_id=$id AND usuario_id=$idusuario";
                $querys = $conn->prepare($squery);
                $querys->setFetchMode(PDO::FETCH_ASSOC);
                $querys->execute();
                $query=$querys->fetchColumn();
                if ($query==1||$query==true) {
                    $cop="UPDATE cursoinscrito SET curso_obt=1 WHERE curso_id=$id AND usuario_id=$idusuario";
                    $cops = $conn->prepare($cop);
                    $cops->execute();
                    $vere=1;
                }
            }
        }

        Database::disconnect();

        ?>

<br><br>
<br><br>
<br><br>
    <div class="container container-curso">
        <div class="container-info-course-curso">
            <div class="row">
                <div class="container-detalle-course col-12 col sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="row container-title-course">
                        <div class="col-auto icon-course pr-0">
                            <img src="assets/images/curso-por-internet.png" class="mr-2" alt="" style="height: 100px;">
                        </div>
                        <div class="col title-course">
                            <?php echo $dato4['nombreCurso']; ?>
                        </div>
                    </div>
                    <div class="rankin-course my-3">
                        <i class="fas fa-star m-1"></i><i class="fas fa-star m-1"></i><i class="fas fa-star m-1"></i><i
                            class="fas fa-star m-1"></i><i class="fas fa-star m-1"></i>
                        <span class="ml-4">20</span> Opiniones
                    </div>
                    <div class="description-course puntos-suspensivos">
                        <?php echo $dato4['descripcionCurso']; ?>
                    </div>
                    <div class="start-course mt-5">
                        <div class="row container-start-course py-2 ml-1 my-3">
                            <div class="col-6 pr-0">
                                <h5 class="m-0">Mira la primera clase de este curso!</h5>
                            </div>
                            <div class="col-6">
                                <a class="hvr-radial-out button-theme" href="Cursoiniciar.php?id=<?php echo $id;?>"<?php if ($query==0 || $vere==false) {
                                    echo 'style="pointer-events: none;"';}?> >
                                    <button type="button" class="btn container-button">
                                        COMIENZA AHORA
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-image-course col-12 col sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="image-course">
                     <?php
                      if ($dato4['imagenDestacadaCurso'] != null) {
                       echo '<img src="data:image/*;base64,' . base64_encode($dato4['imagenDestacadaCurso']) . '" alt="foto_curso" >' ;}    
                       else { echo ' <img src="./assets/images/curso_educalma.png" alt="foto_curso" >';}
                    ?> 
                    <!-- <img src="assets/images/curso_educalma.png" alt=""> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="container-other-course-curso mt-5">
            <div class="row">
                <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    Certificado
                    <h5>Obtenga certificado del curso</h5>
                </div>
                <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    100% online
                    <h5>Aprende a tu propio ritmo</h5>
                </div>
                <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    Costo
                    <h5>
                        <?php
                            if($dato4['costoCurso']!=0 && $dato4['costoCurso'] != "Gratis"){
                                echo 'S/ ' . $dato4['costoCurso'];
                            }else{
                                echo 'Gratis';
                            }
                        ?>
                    </h5>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5">
        <div class="container container-links-course-curso">
            <div class="d-flex justify-content-around">
                <div class="nav-link-course">
                    <a href="#informacion">Información</a>
                </div>
                <div class="nav-link-course">
                <?php 
                    // PONER EN EL BOTON DEL CERTIFICADO
                    if($cantidad_respuesta_acertadas>=$minimo_respuestas_para_aprobar){
                        echo '<a data-filter=".seo" href="plugins/ejemplo.php?idCurso='.$id.'&idUsu='.$idUser56.'">Certificado</a>';
                        $validar=1;
                    }else {
                        echo '<a onclick="sin_certificado()">Certificado</a>';
                        $validar=0;
                    }
                    $_SESSION['validar']=$validar;
                ?>
                    <!-- <a href="#certificado-temario">Certificado</a> -->
                </div>
                <div class="nav-link-course">
                    <a href="#informacion">Temario</a>
                </div>
                <div class="nav-link-course">
                    
                    <a href="#foro-curso">Foro</a>
                
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid p-0">
        <div class="container-detalle-informacion">
            <div class="container"  style="width:auto; overflow:hidden;">
                <div class="row py-0  "style="display:flex; flex-direction:column ;margin-top:25px ;">
                    <!-- <div class="col-4">
                         <img src="assets/img/cursophp.png" alt=""> 
                    </div>-->
                    <!--div class="col-md-5 col-lg-5 order-1 "style="align-self: flex-end; margin-top:25px;" -->
                    
                    <!--div class="col-8"-->
                    <div class="col-8" style="width: 100%;" id="informacion">
                        <h5>¿Que incluye este curso?</h5>
                        <div class="container-info-course-detalle">
                            <h5>Tabla de contenido del curso</h5>
                            <div class="row pt-2">
                                <div class="col-12 col-sm-6 col-lg-6">
                                    <div><i class="far fa-file"></i></div><?php echo $modulos; ?> Modulos
                                </div>
                                <div class="col-12 col-sm-6 col-lg-6">
                                    <div><i class="fas fa-folder"></i></div><?php echo $temas; ?> Temas
                                </div>
                                <div class="col-12 col-sm-6 col-lg-6">
                                    <div><i class="fas fa-infinity"></i></div><?php echo $cuestionarios; ?> Cuestionarios
                                </div>
                                <div class="col-12 col-sm-6 col-lg-6">
                                    <div><i class="fas fa-mobile-alt"></i></div> Nota mínima <?php echo $nota37; ?>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-6">
                                    <div><i class="fas fa-list-ol"></i></div> Cant. de preguntas <?php echo $preguntas; ?>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-6">
                                    <div><i class="fas fa-trophy"></i></div> Certificado de Finalización
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>

                

                <div class="col-12"   style="width:760px; height:auto; float:left; position: relative; " id="certificado-temario">
                <h5>Temario del curso</h5>
                <?php 
                $nW=0;
                    while ($modulosC = $q6->fetch(PDO::FETCH_ASSOC)) {
                        $nW=$nW+1;
                ?>
                    <div class="w-100">
                        <a href="video.php?id=<?php echo $id;?>&idtema=<?php echo 1;?>&id_modulo=<?php echo $modulosC['idModulo']?>&nW=<?php echo $nW-1?>" class="btn px-4 mb-2 puntos-suspensivos"  style="background:#DCECFA; width:100%; text-align:left;">
                            <i class="fas fa-play mr-3"></i>
                            <span style="color:black; width:100%;"><?php echo $modulosC['nombreModulo'] ?></span>
                        </a>
                    </div>
                    
                <?php 
                    }
                ?>

                </div>

                <div class="col-md-5 col-lg-5 order-1 "style="width:auto; float:right; position: relative; " >
                        <h5>Certificación del curso</h5>
                        <img src="assets/images/certificado.jpg" class="img-fluid "alt="">
                        <div class="info">
                        <!--Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse sapiente, harum, vero molestiae magnam
                        blanditiis cum omnis magni-->
                        </div>
                    </div>

            </div>
        </div>
    </div>

    <!-- Foro -->

    <!-- fin foro -->
    <style>
        .puntos-suspensivos{
            overflow:hidden; 
            text-overflow:ellipsis;
            display:-webkit-box; 
            -webkit-box-orient:vertical;
            -webkit-line-clamp:2;
        }
        html{
            scroll-behavior: smooth;
        }
    </style>

        <!-- ALL JS FILES -->
        <script src="assets/js/plugins/jquery.min.js"></script>
        <script src="assets/js/plugins//popper.min.js"></script>
        <script src="assets/js/plugins/bootstrap.min.js"></script>
        <!-- FORO -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="./assets/js/plugins/eliminarforo.js"></script>
        <!-- ALL PLUGINS -->
        <script src="assets/js/plugins/jquery.magnific-popup.min.js"></script>
        <script src="assets/js/plugins/jquery.pogo-slider.min.js"></script>
        <script src="assets/js/plugins/slider-index.js"></script>
        <script src="assets/js/plugins/smoothscroll.js"></script>
        <script src="assets/js/plugins/form-validator.min.js"></script>
        <script src="assets/js/plugins/contact-form-script.js"></script>
        <script src="assets/js/plugins/isotope.min.js"></script>
        <script src="assets/js/plugins/images-loded.min.js"></script>
        <script src="assets/js/plugins/custom.js"></script>
        <script src="./assets/js/plugins/sweetalert2.all.min.js"></script>
        <script>
            /* counter js */
            function sin_certificado() {
                Swal.fire({
                    icon: 'error',
                    title: 'Terminar el curso',
                    text: 'Todavia no ha completado el curso!'
                })
            }

            (function($) {
                $.fn.countTo = function(options) {
                    options = options || {};

                    return $(this).each(function() {
                        // set options for current element
                        var settings = $.extend({}, $.fn.countTo.defaults, {
                            from: $(this).data('from'),
                            to: $(this).data('to'),
                            speed: $(this).data('speed'),
                            refreshInterval: $(this).data('refresh-interval'),
                            decimals: $(this).data('decimals')
                        }, options);

                        // how many times to update the value, and how much to increment the value on each update
                        var loops = Math.ceil(settings.speed / settings.refreshInterval),
                            increment = (settings.to - settings.from) / loops;

                        // references & variables that will change with each update
                        var self = this,
                            $self = $(this),
                            loopCount = 0,
                            value = settings.from,
                            data = $self.data('countTo') || {};

                        $self.data('countTo', data);

                        // if an existing interval can be found, clear it first
                        if (data.interval) {
                            clearInterval(data.interval);
                        }
                        data.interval = setInterval(updateTimer, settings.refreshInterval);

                        // initialize the element with the starting value
                        render(value);

                        function updateTimer() {
                            value += increment;
                            loopCount++;

                            render(value);

                            if (typeof(settings.onUpdate) == 'function') {
                                settings.onUpdate.call(self, value);
                            }

                            if (loopCount >= loops) {
                                // remove the interval
                                $self.removeData('countTo');
                                clearInterval(data.interval);
                                value = settings.to;

                                if (typeof(settings.onComplete) == 'function') {
                                    settings.onComplete.call(self, value);
                                }
                            }
                        }

                        function render(value) {
                            var formattedValue = settings.formatter.call(self, value, settings);
                            $self.html(formattedValue);
                        }
                    });
                };

                $.fn.countTo.defaults = {
                    from: 0, // the number the element should start at
                    to: 0, // the number the element should end at
                    speed: 1000, // how long it should take to count between the target numbers
                    refreshInterval: 100, // how often the element should be updated
                    decimals: 0, // the number of decimal places to show
                    formatter: formatter, // handler for formatting the value before rendering
                    onUpdate: null, // callback method for every time the element is updated
                    onComplete: null // callback method for when the element finishes updating
                };

                function formatter(value, settings) {
                    return value.toFixed(settings.decimals);
                }
            }(jQuery));

            jQuery(function($) {
                // custom formatting example
                $('.count-number').data('countToOptions', {
                    formatter: function(value, options) {
                        return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
                    }
                });

                // start all the timers
                $('.timer').each(count);

                function count(options) {
                    var $this = $(this);
                    options = $.extend({}, options || {}, $this.data('countToOptions') || {});
                    $this.countTo(options);
                }
            });
        </script>
    <?php
    } else {
        header('Location:iniciosesion.php');
    }
    ?>
</body>

