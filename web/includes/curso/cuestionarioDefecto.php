<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="././assets/css/stylecuestionario.css">
    <!-- iconos -->
    <script src="https://kit.fontawesome.com/abc76d5c4d.js" crossorigin="anonymous"></script>
</head>


<div class= "container" style="margin-top: 120px;">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="infoMin">
            <a href="curso.php">Curso</a> <label> > </label> <a href="progreso.php"> Modulo 1 </a><label> > </label><a href="cuestionario.php"> Cuestionario </a>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>
<br>
<div>
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                  <button type="button" class="btn btn-outline-secondary" id="btnV1" onclick="parent.location='video.php'">  <strong>< </strong>  Anterior</button>
                  <button type="button" class="btn btn-outline-secondary" id="btnV3" disabled>
                  <button type="button" class="btn btn-outline-secondary" id="btnV1" onclick="parent.location='Cursoiniciar.php'">  Siguiente <strong> > </strong></button>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</div>
<br>

<body>
<?php
    require_once '././database/databaseConection.php';
    $id=$_GET['id'];
    $idtema=$_GET['idtema'];

    // creando una matriz y pasando el número, preguntas, opciones y respuestas

?>
    

<div class="container_quiz">

    <!-- boton de iniciar cuestionario -->
    <div class="start_btn"><button>Iniciar cuestionario</button></div>

    <!-- info de caja -->
    <div class="info_box">
        <div class="info_tittle">
            <span>Estas son las reglas del cuestionario</span>
        </div>
        <div class="info_list">
            <div class="info">1. No copiaras</div>
            <div class="info">2. Tendras solo <span>15 segundos</span> para responder</div>
            <div class="info">3. Al marcar alguna respuesta se detendre el tiempo</div>
            <div class="info">4. Esto es como un juego , diviertete</div>
            <div class="info">5. Tu puntaje saldra cuando termines el cuestionario</div>
        </div>
        <div class="buttons">
            <button class="quit">Salir</button>
            <button class="restart">Continuar</button>
        </div>
    </div>

    <!-- Caja de cuestionario -->
    <div class="quiz_box">
        <header>
            <div class="title">Cuestionario: Tema 1</div>
            <div class="timers">
                <div class="time_text">Tiempo</div>
                <div class="timer_sec">15</div>
            </div>
            <div class="time_line"></div>
        </header>

        <section>
            <div class="que_text">
                <!-- <span> ¿Qué es el bullying?</span> -->
            </div>
            <div class="option_list">
                <!-- <div class="option">
                    <span>Un pasatiempo</span>
                    <div class="icon tick"><i class="fas fa-check"></i></div>
                </div>
                <div class="option">
                    <span>Algo normal que pasa mientras crecemos</span>
                    <div class="icon cross"><i class="fas fa-times"></i></div>
                </div>
                <div class="option">
                    <span>Es el maltrato físico y psicológico hacia otra persona de manera constante.</span>
                </div>
                <div class="option">
                    <span>Una broma y juego entre compañero(a)s.</span>
                </div> -->
            </div>
        </section>

        <!-- footer de la caja de cuestionario -->
        <footer>
            <div class="total_que">
               <!-- <span><p class="pbold">2</p> de <p class="pbold">5</p> Preguntas</span> -->
            </div>
            <button class="next_btn">Siguiente pregunta</button>
        </footer>
    </div>

    <!-- Caja resultado -->
    <div class="result_box">
        <div class="icon">
            <i class="fas fa-crown"></i>
        </div>
        <div class="complete_text">Completaste el cuestionario</div>
        <div class="score_text">
            <!-- <span>Lo sentimos, solo tienes <p>2</p> de <p>5</p> </span> -->
        </div>
        <div class="buttons">
            <button class="restart">Repetir</button>
            <button class="quit">Finalizar</button>
        </div>
    </div>




</div>
<br>

<script src="././assets/js/cuest.js"></script>
<script src="././assets/js/funcuest.js"></script>
</body>