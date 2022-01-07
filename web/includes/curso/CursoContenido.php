<head>
    <link href="assets/css/contenidocurso.css" rel="stylesheet" type="text/css" />
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
                            Lorem ipsum dolor sit amet.
                        </div>
                    </div>
                    <div class="rankin-course my-3">
                        <i class="fas fa-star m-1"></i><i class="fas fa-star m-1"></i><i class="fas fa-star m-1"></i><i
                            class="fas fa-star m-1"></i><i class="fas fa-star m-1"></i>
                        <span class="ml-4">20</span> Opiniones
                    </div>
                    <div class="description-course">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis molestiae exercitationem, iste
                        fugiat sint?
                    </div>
                    <div class="start-course mt-5">
                        <div class="row container-start-course py-2 ml-1 my-3">
                            <div class="col-6 pr-0">
                                <h5 class="m-0">Mira la primera clase de este curso!</h5>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn container-button">COMIENZA AHORA</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-image-course col-12 col sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="image-course">
                        <img src="assets/images/curso_educalma.png" alt="">
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
                    <h5>Gratis</h5>
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
                    <a href="#certificado-temario">Certificado</a>
                </div>
                <div class="nav-link-course">
                    <a href="#certificado-temario">Temario</a>
                </div>
                <div class="nav-link-course">
                    <a href="#">Foro</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0" id="informacion">
        <div class="container-detalle-informacion">
            <div class="container">
                <div class="row py-5">
                    <div class="col-4">
                        <!-- <img src="assets/img/cursophp.png" alt=""> -->
                    </div>
                    <div class="col-8">
                        <h5>¿Que incluye este curso?</h5>
                        <div class="container-info-course-detalle">
                            <h5>Tabla de contenido del curso</h5>
                            <div class="row pt-2">
                                <div class="col-12 col-sm-6 col-lg-6">
                                    <div><i class="far fa-file"></i></div> Módulos
                                </div>
                                <div class="col-12 col-sm-6 col-lg-6">
                                    <div><i class="fas fa-folder"></i></div> Temas
                                </div>
                                <div class="col-12 col-sm-6 col-lg-6">
                                    <div><i class="far fa-list-alt"></i></div> Cuestionarios
                                </div>
                                <div class="col-12 col-sm-6 col-lg-6">
                                    <div><i class="fas fa-graduation-cap"></i></div> Nota mínima
                                </div>
                                <div class="col-12 col-sm-6 col-lg-6">
                                    <div><i class="fas fa-list-ol"></i></div> Cant. de preguntas
                                </div>
                                <div class="col-12 col-sm-6 col-lg-6">
                                    <div><i class="fas fa-trophy"></i></div> Certificado de Finalización
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container container-others mb-5" id="certificado-temario">
        <div class="row">
            <div class="col-4">
                <h5>Certificación del curso</h5>
                <img src="assets/images/certificado.jpg" alt="">
                <div class="info">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse sapiente, harum, vero molestiae magnam
                    blanditiis cum omnis magni
                </div>
            </div>
            <div class="col-8">
                <h5>Temario del curso</h5>
                <div class="w-100">
                    <a href="#" class="btn w-100 px-4 mb-2">
                        <i class="fas fa-play mr-3"></i>
                        <span>Lorem ipsum dolor sit dolor sit amet.</span>
                    </a>
                </div>
                <div class="w-100">
                    <a href="#" class="btn w-100 px-4 mb-2">
                        <i class="fas fa-play mr-3"></i>
                        <span>Lorem ipsum dolor sit dolor sit amet.</span>
                    </a>
                </div>
                <div class="w-100">
                    <a href="#" class="btn w-100 px-4 mb-2">
                        <i class="fas fa-play mr-3"></i>
                        <span>Lorem ipsum dolor sit dolor sit amet.</span>
                    </a>
                </div>
                <div class="w-100">
                    <a href="#" class="btn w-100 px-4 ">
                        <i class="fas fa-play mr-3"></i>
                        <span>Lorem ipsum dolor sit dolor sit amet.</span>
                    </a>
                </div>
            </div>
        </div>
    </div>




        <!-- ALL JS FILES -->
        <script src="assets/js/plugins/jquery.min.js"></script>
        <script src="assets/js/plugins//popper.min.js"></script>
        <script src="assets/js/plugins/bootstrap.min.js"></script>
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

</html>