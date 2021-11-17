<?php
 if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
?>
  <?php 
        // ob_start(); 
        // session_start();
        require_once '././database/databaseConection.php';
        $id=$_GET['id'];

        $pdo4 = Database::connect(); 
        $sql4 = "SELECT * FROM cursos WHERE idCurso='$id'";
        $q4 = $pdo4->prepare($sql4);
        $q4->execute(array());
        $dato4 = $q4->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    ?>



    <div id="projects" class="filter">
        <div class="container">
            <div class="row">
                <div class="col-lg-12"></div>
            </div> <!-- end of row -->
                <div class="col-lg-12">
                    <!-- Filter -->
                    <div class="button-group filters-button-group">
                        <a class="button" data-filter=".design"><span>CURSO</span> </a>
                        <a class="button" data-filter=".development" href="foro.php?id=<?php echo $id;?>"><span>FORO</span> </a>
                        <a class="button" data-filter=".marketing" href="descargas.php"><span>DESCARGABLE</span></a>
                        <a class="button" data-filter=".seo" href="progreso.php?id=<?php echo $id ?>"><span>PROGRESO</span></a>

                        <?php
                        /*
                         *METODO PARA VALIDAR EL CERTIFICADO
                         *@AUTOR: Giancarlo S. xd
                         */
                            
                        ?>

                          <?php 
                        

                              $pdo5 = Database::connect(); 



                              $q5=$pdo5->query("SELECT count(*) FROM respuestas res INNER JOIN preguntas pre ON res.id_Pregunta=pre.idPregunta
                                                                                    INNER JOIN cuestionario cues ON cues.idCuestionario=pre.id_cuestionario
                                                                                    INNER JOIN modulo mo ON mo.idModulo=cues.id_modulo
                                                                                    INNER JOIN cursos cur ON cur.idCurso= mo.id_curso
                                                                                    where cur.idCurso=$id and res.estado=1");
                              $cantidad_respuestas_validas= $q5->fetchColumn();

                              if($cantidad_respuestas_validas<=9){
                                $minimo_respuestas_para_aprobar=$cantidad_respuestas_validas;
                              }else{
                                $minimo_respuestas_para_aprobar=$cantidad_respuestas_validas-2;
                              }

                              
                               Database::disconnect();

                                $pdo6 = Database::connect();
                                $sql6 = "SELECT cantidad_respuestas FROM cursoinscrito WHERE curso_id = '$id' ";
                                $q6 = $pdo6->prepare($sql6);
                                $q6->execute(array());
                                $dato=$q6->fetch(PDO::FETCH_ASSOC);
                                Database::disconnect();
                               
                                    $cantidad_respuesta_acertadas=$dato['cantidad_respuestas'];
                              
                                
    
                              if($cantidad_respuesta_acertadas>=$minimo_respuestas_para_aprobar){
                                    
                             echo '<a class="button" data-filter=".seo" href="plugins/ejemplo.php?idCurso='.$id.'"><span>CERTIFICADO</span></a>';
                                 $validar=1;

                              }else {
                                 $validar=0;
                                
                              }
                              $_SESSION['validar']=$validar;

                          ?>



                               
            
            
                    </div> <!-- end of button group -->

    <!-- section -->

    <!-- end section -->
    <!-- section -->
  
    <div class="section margin-top_50">
        <h3><a href="sidebarCursos.php">Ir a cursos</a></h3>
        <div class="container">
            <div class="row">
                <div class="col-md-6 layout_padding_2">
                    <div class="full">
                        <div class="heading_main text_align_left">
                           <h2><span><?php echo $dato4['nombreCurso']; ?></h2>
                        </div>
                        <div class="full">
                          <p><?php echo $dato4['descripcionCurso']; ?></p>
                          <?php
                    $pdo10 = Database::connect(); 
                    $sql10 = "SELECT * FROM cursoinscrito WHERE curso_id='$id'";
                    $q10 = $pdo10->prepare($sql10);
                    $q10->execute();
                    $dato10 = $q10->rowCount();
                    Database::disconnect();


                    if($dato10!=1){
                        echo "<p style='color:#4F52D6;'>Este curso cuenta con <strong>".$dato10."</strong> usuarios incritos<p>";
                    }else{
                        echo "<p style='color:#4F52D6;'>Este curso cuenta con <strong>".$dato10."</strong> usuario incrito<p>";
                    }
                   
                ?>
                        </div>
                       </div>
                </div>
                <div class="col-md-6">
                    <div class="full" style="width: 500px ; height: 300px;">
                        <img class="img_logo_cursos" style="height: 100%;" src="data:image/*;base64,<?php echo base64_encode($dato4['imagenDestacadaCurso'])?>" alt="#" />
                    </div>
                </div>
            </div>
            <?php
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
        ?>
            <div class="full">
                        <a class="hvr-radial-out button-theme"href="Cursoiniciar.php?id=<?php echo $id;?>"<?php if ($query==0 || $vere==false) {
                    echo 'style="pointer-events: none;"';}?> >Iniciar curso</a>
            </div>
            <form action="" method="POST" name="frm1" class="formcodigocursos">
                
                

            <?php
            /*validar que si ya ingreso un codigo valida no muestro el input
            *@autor: Jean
            */
            if ($vere==0){
        ?>
        <input type="text" placeholder="XPFJ-AFAKN" class="inputcodigo" name="codi" id="codiguito" required><button type="submit" class="btn btn-primary" name="vali">Ingresar</button>
                        <br>
                        <label for="codiguito" style="color: #7C83FD;">Obtener curso por medio del código</label>
        <?php
            }else{
                echo "<br><br>";
            }
        ?>
                        
                    </form>
        </div>
        <br>
        <br>
        <section class="cursoslinks" id="about">
        <div class="titulotemario col">
            <h3>Introducción al Curso</h3>
        </div>
        <div class="content col">
            <div class="icons-container">
                <a href="video.php?id=<?php echo $id; ?>&idtema=1&validar=1&a=d" role="button" class="btn btn-primary btn_cursovideo">
                    <i class="fas fa-play"></i>
                    Toca aqui para ver el primer video del curso
                </a>
                <br>
                <br>
                <a href="video.php?id=<?php echo $id; ?>&c_tema=2&validar=1&c_modulo=1&a=d" role="button" class="btn btn-primary btn_cursovideo">
                    <i class="fas fa-play"></i>
                    Toca aqui para ver el segundo video del curso
                </a>
            </div>
        </div>
    </section>
    <!-- end section -->
    <!-- section -->
    <div class="section layout_padding">
        <div class="container">
            <div class="row">
       
                <div class="col-md-12">
                    <div class="full">
                        <div class="heading_main text_align_center">
                           <h2><span>Cursos </span>destacados</h2>
                        </div>
                      </div>
                </div>
            <?php 
            
            $pdo=Database::connect();
            $sql="SELECT COUNT(*) as Cantidad,curso_id,c.permisoCurso FROM cursoinscrito as ci INNER JOIN cursos as c ON ci.id_cursoInscrito = c.idCurso WHERE c.permisoCurso = 1 GROUP BY curso_id ORDER BY Cantidad DESC";
            $q=$pdo->prepare($sql);
            $q->execute(array());

            $cont = 0;
            while($dato2=$q->fetch(PDO::FETCH_ASSOC)){ 
                $cont = $cont + 1;
                
                $curso_Id= $dato2['curso_id'];
                $pdo15=Database::connect();
                $sql15 = "SELECT * FROM cursos where idCurso='$curso_Id'";
                $q15 = $pdo15->prepare($sql15);
                $q15->execute(array());
                        

                while($dato=$q15->fetch(PDO::FETCH_ASSOC)){

                
                ?>
                <div class="col-md-4">
                    <div class="full blog_img_popular" style="width: 390px; height: 300px;">
                       <a href="DetalleCurso.php?id=<?php echo $dato['idCurso']; ?>">
                            <img style="height: 100%; width: 100%;" class="img-responsive" src="data:image/*;base64,<?php echo base64_encode($dato['imagenDestacadaCurso'])?>" alt="#" />
                            <h4><?php echo $dato['nombreCurso']; ?></h4>
                       </a>
                    </div>
                </div>
            <?php 
         
        }
        if($cont==3){
            break ;
        }
        
    }
            
            ?>
            
            </div>
        </div>
    </div>
  </div>
</div>
</div>
    <!-- end section -->




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
    <script>
    /* counter js */

(function ($) {
    $.fn.countTo = function (options) {
        options = options || {};

        return $(this).each(function () {
            // set options for current element
            var settings = $.extend({}, $.fn.countTo.defaults, {
                from:            $(this).data('from'),
                to:              $(this).data('to'),
                speed:           $(this).data('speed'),
                refreshInterval: $(this).data('refresh-interval'),
                decimals:        $(this).data('decimals')
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
        from: 0,               // the number the element should start at
        to: 0,                 // the number the element should end at
        speed: 1000,           // how long it should take to count between the target numbers
        refreshInterval: 100,  // how often the element should be updated
        decimals: 0,           // the number of decimal places to show
        formatter: formatter,  // handler for formatting the value before rendering
        onUpdate: null,        // callback method for every time the element is updated
        onComplete: null       // callback method for when the element finishes updating
    };

    function formatter(value, settings) {
        return value.toFixed(settings.decimals);
    }
}(jQuery));

jQuery(function ($) {
  // custom formatting example
  $('.count-number').data('countToOptions', {
    formatter: function (value, options) {
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
    }
    else{
                header('Location:iniciosesion.php');
    }
?>