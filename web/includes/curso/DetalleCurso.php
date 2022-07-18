<head>
    <title>Bootstrap Example</title>

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styledetcurso.css">
    <link rel="stylesheet" href="assets/css/styleforo.css">

    <!-- Esto hará que página se vea bien en cualquier resolución, a una escala correcta.-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<style>

.flex{
    display: flex;
}

div[id^='accordion'] .card .card-header span {
  color: #fff;
  font-weight: bold;
}

.boton4 {
  
    position: relative;
}

.imagecuadr{
  padding: 6px;
  border-radius: 10px;
  box-shadow: 4px 4px #7c83fda6;
}

.boton4:hover {

    color: rgba(255, 255, 255, ) !important;
    box-shadow: 0 4px 16px rgba(49, 138, 172, 1);
    transition: all 0.2s ease;

}

.img-nina{
    width: 26em;
    position: relative;
    left: -3em;
    margin-top: 1em;
}

body {

    background-color: white;
}

#btnComprarAhora {

    background: #7C83FD;
    color: #fff;
    font-weight: bold;
    border: none;
    height: 45px;
    display: flex;
    justify-content: center;
    align-items: center;
}

#btnComprarAhora:hover {

    background: #7c83fddb;
    color: white;
    font-weight: bold;
    /* border: 2px solid black; */
}

#nombreTemaCss:hover {

    background: #CCE3E5 !important; 
}









/****************************************************************************************************/
/** =====================
* Responsive
========================*/
@media only screen and (max-width: 766px) {
  .comments-container {
     width: 340px;
  }

  .comments-list .comment-box {
     width: 260px;
  }

  .reply-list .comment-box {
     width: 190px;
  }

  #btnComienzaAhora_2 {
    width: auto;

    position: relative;
    left: -10px;
  }
  
  #btnComentar2 {
    margin: 0 auto;
    margin-bottom: 30px;
  }

  .comments-container {
    width: 10px, auto !important;
  }

  #botonEliminarTodo {

    position: relative;
    left: -63px;
  }

}

@media (min-width: 1300px){
  .responsv1 {
     margin-left: 60px;
  }

}

@media (min-width: 1300px){
  .d-flex {
    width: 85%;
  }

}

@media (min-width: 1300px){
  .card {
    width: 85%;
    margin-bottom: -28px;
  }

}

@media (min-width: 1300px){
  .imagecuadr {
    margin-top: 19em;
    margin-left: -6em;
    height: 33em;
  }

}

@media (max-width: 360px) {
    .flex{
         display: initial;
   } 
   .img-nina {
      width: 19em;
      position: relative;
      left: 35px;
      margin-top: 3em;
      float: unset;
  }
}

@media (max-width: 375px) {
    .flex{
         display: initial;
   } 
   .img-nina {
      width: 19em;
      position: relative;
      left: 35px;
      margin-top: 1em;
      float: unset;
  }
}

@media (max-width: 414px) {
    .flex{
         display: initial;
   } 
   .img-nina {
      width: 19em;
      position: relative;
      left: 4em;
      margin-top: 1em;
      float: unset;
  }
}

@media only screen and (min-width:820px) and (max-width:912px) {
    .flex{
        position: relative;
        margin-left: 3em;
   } 
   .img-nina {
      width: 19em;
      position: relative;
      left: -3em;
      margin-top: 1em;
      float: unset;
  }
  .imagecuadr{
    margin-top: 25em;
  }
}

/****************************************************************************************************/









</style>



<body>


    <!-- Código PHP-->
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


















    <!-- pppp -->
    <div class="container-course bg-light" style="min-height: 100vh;background: rgb(231,244,255);background: linear-gradient(0deg, rgba(231,244,255,1) 0%, rgba(231,244,255,1) 21%, rgba(224,199,229,1) 30%);">

        <!-- zzzz -->
        <div class="bg-dark11">


            <!-- yyyy -->
            <div class="row py-5" style="padding: 15px;position: relative;">


            


                <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xl-9 " style="color: #fff;padding: 29px;margin-top: -48px;">
                    
                    <br><br><br><br>

                    <span>Cursos</span><i class="fas fa-angle-right mx-2"></i>
                    
                    <span>Categoría</span><i class="fas fa-angle-right mx-2"></i>
                    
                    <span>Nombre del curso</span>
                    
                    <h2 class="my-2 font-weight-bold"><?php echo $dato4['nombreCurso']; ?></h2>
                    








                                        <!--Código para obtener el nombre del profesor-->
                                        <?php 

                                            
                                            
                                            $idUsuario = $dato4['id_userprofesor'];
                                            $sql = "SELECT * FROM usuarios WHERE id_user = '$idUsuario'";
                                            $q = $pdo->prepare($sql);
                                            $q->execute(array());
                                            $dato20 = $q->fetch(PDO::FETCH_ASSOC);
                                        ?>

                    

                                            <?php 
                                                if($dato20['privilegio']==1){
                                            ?>

                                                   <!-- <span style="color: #fff; font-size: 15px;">Creado por la Fundación CALMA.</span> -->

                                            <?php 
                                                }

                                                if($dato20['privilegio']==2){
                                            ?>
                                                    <span style="color: #fff; font-size: 15px;">Creado por <?php echo " " . $dato20['nombres'] . " " . $dato20['apellido_pat'] . " " . $dato20['apellido_mat'] . "."?></span>
                                            <?php 
                                                }
                                            ?>                    
                    







                    <p style="padding-top: 30px;"><?php echo $dato4['descripcionCurso']; ?></p>
                    
                    <i class="fas fa-stopwatch mr-2"></i><span>Fecha: <?php echo $dato4['fechaPulicacion']; ?></span>
                    
                    <i class="fas fa-globe ml-4 mr-2"></i><span>Español</span>
                    
                    <i class="fas fa-closed-captioning ml-4 mr-2"></i><span>Español [automático]</span>

                </div>



                <!-- xxxxx -->
                <div class="col-12 col-sm-12 col-md-5 col-lg-4 col-xl-3 info-course-right pt-5">
                

                    <!-- CARD///////////////////////////////// -->
                    <div class="card imagecuadr">


                        <div class="content-img">
                            <?php    
                                if($dato4['imagenDestacadaCurso']!=null){
                            ?>
                                    <img class="card-img-top1" src="<?php echo $dato4['imagenDestacadaCurso'] ?>" alt="Card image">
                            <?php
                                }else{
                            ?>
                                    <img class="card-img-top1"  src="./assets/images/curso_educalma.png">
                            <?php
                                }
                            ?>
                            
                        </div>



                        <!-- ///////////////////////////////// -->
                        <div class="card-body">
                            <h4 class="card-title font-weight-bold" style="font-size: 25px;display: flex;justify-content: center;color: #7C83FD;">
                            <?php
                                                                                                if ($dato4['costoCurso'] != 0) {
                                                                                                    echo 'S/ ' . $dato4['costoCurso'];
                                                                                                } else {
                                                                                                    echo 'Gratis';
                                                                                                }
                                                                                                ?></h4>










                        <?php 


                            if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $_SESSION['privilegio'] == 1){

                                //////// ADMINISTRADOR
                                if ($dato4['costoCurso'] != 0) {
                                    if(isset($_SESSION['Logueado'])){
                                ?>
                                    
                                <?php
                                    }else{
                                        ?>
                                        <a href="pagepay.php?id=<?php echo $dato4["idCurso"]; ?>"> 
    
                                        
                                        
                                        <?php
                                    }
                                } else {
                                    if(isset($_SESSION['Logueado'])){
                                ?>
                                    
                                <?php
                                    }else{
                                        ?>
                                            
                                        <?php
                                    }
                                }
                                ////////
                                ?>
                                
                        <?php

                            }

                            if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $_SESSION['privilegio'] == 2){

                                //////// PROFESOR
                                if ($dato4['costoCurso'] != 0) {
                                    if(isset($_SESSION['Logueado'])){
                                ?>
                                    
                                <?php
                                    }else{
                                        ?>
                                        <a href="pagepay.php?id=<?php echo $dato4["idCurso"]; ?>"> 
    
                                        
                                        
                                        <?php
                                    }
                                } else {
                                    if(isset($_SESSION['Logueado'])){
                                ?>
                                    
                                <?php
                                    }else{
                                        ?>
                                            
                                        <?php
                                    }
                                }
                                ////////
                                ?>
                                
                        <?php
                                
                                
                            }

                            if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $_SESSION['privilegio'] == 3){

                                //////// USUARIO NORMAL
                                if ($dato4['costoCurso'] != 0) {
                                    if(isset($_SESSION['Logueado'])){
                                ?>
                                    <a id="btnComprarAhora" href="pagepay.php?id=<?php echo $dato4["idCurso"]; ?>" class="btn btn-outline-dark">Comprar ahora</a>
                                <?php
                                    }else{
                                        ?>
                                        <a href="pagepay.php?id=<?php echo $dato4["idCurso"]; ?>"> 
    
                                        <a id="btnComprarAhora" onclick="msje_Redireccion()" class="btn btn-outline-dark my-3">Comprar ahora</a>
                                        
                                        <?php
                                    }
                                } else {
                                    if(isset($_SESSION['Logueado'])){
                                ?>
                                    <a id="btnComprarAhora" href="includes/Cursos_crud/inscribirseGratis.php?id=<?php echo $dato4["idCurso"]; ?>" class="btn btn-outline-dark my-3">Comprar ahora</a>
                                <?php
                                    }else{
                                        ?>
                                            <a id="btnComprarAhora" onclick="msje_Redireccion()" class="btn btn-outline-dark my-3">Comprar ahora</a>
                                        <?php
                                    }
                                }
                                ////////
                                ?>
                                
                        <?php

                            }

                            if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $_SESSION['privilegio'] == 4){

                                //////// EMPRESA
                                if ($dato4['costoCurso'] != 0) {
                                    if(isset($_SESSION['Logueado'])){
                                ?>
                                    <a id="btnComprarAhora" href="pagepay.php?id=<?php echo $dato4["idCurso"]; ?>" class="btn btn-outline-dark my-3">Comprar ahora</a>
                                <?php
                                    }else{
                                        ?>
                                        <a href="pagepay.php?id=<?php echo $dato4["idCurso"]; ?>"> 
    
                                        <a id="btnComprarAhora" onclick="msje_Redireccion()" class="btn btn-outline-dark my-3">Comprar ahora</a>
                                        
                                        <?php
                                    }
                                } else {
                                    if(isset($_SESSION['Logueado'])){
                                ?>
                                    <a id="btnComprarAhora" href="includes/Cursos_crud/inscribirseGratis.php?id=<?php echo $dato4["idCurso"]; ?>" class="btn btn-outline-dark my-3">Comprar ahora</a>
                                <?php
                                    }else{
                                        ?>
                                            <a id="btnComprarAhora" onclick="msje_Redireccion()" class="btn btn-outline-dark my-3">Comprar ahora</a>
                                        <?php
                                    }
                                }
                                ////////
                                ?>
                                
                        <?php
                                
                                
                            }

                            if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $_SESSION['privilegio'] == 5){

                                //////// USUARIO EMPRESA
                                if ($dato4['costoCurso'] != 0) {
                                    if(isset($_SESSION['Logueado'])){
                                ?>
                                    <a id="btnComprarAhora" href="pagepay.php?id=<?php echo $dato4["idCurso"]; ?>" class="btn btn-outline-dark my-3">Comprar ahora</a>
                                <?php
                                    }else{
                                        ?>
                                        <a href="pagepay.php?id=<?php echo $dato4["idCurso"]; ?>"> 
    
                                        <a id="btnComprarAhora" onclick="msje_Redireccion()" class="btn btn-outline-dark my-3">Comprar ahora</a>
                                        
                                        <?php
                                    }
                                } else {
                                    if(isset($_SESSION['Logueado'])){
                                ?>
                                    <a id="btnComprarAhora" href="includes/Cursos_crud/inscribirseGratis.php?id=<?php echo $dato4["idCurso"]; ?>" class="btn btn-outline-dark my-3">Comprar ahora</a>
                                <?php
                                    }else{
                                        ?>
                                            <a id="btnComprarAhora" onclick="msje_Redireccion()" class="btn btn-outline-dark my-3">Comprar ahora</a>
                                        <?php
                                    }
                                }
                                ////////
                                ?>
                                
                        <?php
                                
                                
                            }

                            if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $_SESSION['privilegio'] == 6){

                                //////// SUPER ADMINISTRADOR
                                if ($dato4['costoCurso'] != 0) {
                                    if(isset($_SESSION['Logueado'])){
                                ?>
                                    
                                <?php
                                    }else{
                                        ?>
                                        <a href="pagepay.php?id=<?php echo $dato4["idCurso"]; ?>"> 
    
                                        
                                        
                                        <?php
                                    }
                                } else {
                                    if(isset($_SESSION['Logueado'])){
                                ?>
                                    
                                <?php
                                    }else{
                                        ?>
                                            
                                        <?php
                                    }
                                }
                                ////////
                                ?>
                                
                        <?php
                                
                                
                            }
                    
                        ?>


                            






















                            <p class="font-weight-bold mb-0 my-3">Este curso incluye:</p>


                            <div class="my-1" style="font-size: 13px;">

                                <div>
                                    <i class="far fa-file text-center" style="width: 1.5rem;"></i>
                                    <span class="ml-3"><?php echo $modulos; ?> Módulos con sus respectivos</span>
                                </div>

                                <div style="padding-left: 28px;">
                                    
                                    <span class="ml-3">temas y cuestionarios</span>
                                </div>

                                <!--
                                <div>
                                    <i class="far fa-folder text-center" style="width: 1.5rem;"></i>
                                    <span class="ml-3"><?php echo $temas; ?> Temas</span>
                                </div>
                                -->

                                <!--
                                <div>
                                    <i class="far fa-list-alt text-center" style="width: 1.5rem;"></i>
                                    <span class="ml-3"><?php echo $cuestionarios; ?> Cuestionarios</span>
                                </div>
                                -->

                                <div>
                                    <i class="fas fa-graduation-cap text-center" style="width: 1.5rem;"></i>
                                    <span class="ml-3">La nota mínima aprobatoria<span>
                                </div>

                                <div style="padding-left: 28px;">
                                    
                                    <span class="ml-3">es 14<?php //echo $minimo_respuestas_para_aprobar; ?></span>
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
                        <!-- ///////////////////////////////// -->

                    </div>
                    <!-- CARD///////////////////////////////// -->

                </div>
                <!-- xxxxx -->

            </div>
            <!-- yyyy -->

        </div>
        <!-- zzzz -->

        <!-- mmmm -->
        <div class="bg-light" style="height: 100%;">
            <div class="row py-5" style="height: 100%;background: rgb(224,199,229);background: linear-gradient(0deg, rgba(224,199,229,1) -2%, rgba(255,255,255,1) 77%);">
                <div class="col-12 col-sm-12 col-md-5 col-lg-4 col-xl-3 info-course-left" style="border: 1px solid red;">
                    <h4>Contenido del curso</h4>
                </div>
                <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xl-9 text-dark" style="padding: 55px;margin-top: -65px;margin-bottom: -75px;">
                    <h4 class="font-weight-bold" style="color: #7C83FD;">Contenido del curso</h4>
                    <div class="d-flex">
                        <div class="mr-auto p-2" style="font-weight: 600;">
                            <span class="mr-1"><?php echo $modulos; ?></span>Módulos <i class="fas fa-circle mx-2" style="font-size: 5px;"></i>
                            <span class="mr-1"><?php echo $temas; ?></span>Temas <i class="fas fa-circle mx-2" style="font-size: 5px;"></i>
                            <span class="mr-1"><?php echo $cuestionarios; ?></span>Cuestionarios
                        </div>
                        <!-- <div class="p-2">
                            <h6>Ampliar todas las secciones</h6>
                        </div> -->
                    </div>

                    <?php
                    $i = 0;
                    while ($modulosC = $q6->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <div id="<?php echo 'accordion' . $i  ?>" class="accordion my-3">
                            <div class="card">
                                <!-- ////////////////// -->
                                <div style="background: #7c83fd; cursor:pointer;border-radius: 9px;" class="card-header border-0" data-toggle="collapse"  href="<?php echo '#collapseOne' . $i  ?>" aria-controls="collapse1">
                                    <span><i class="fas fa-sort-down mr-3 cart-text"></i><?php echo $modulosC['nombreModulo'] ?></span>
                                </div>
                                
                                <?php

                                $idModuloC = $modulosC['idModulo'];

                                //Nombre del modulo
                                $pdo7 = Database::connect();
                                $sql7 = "SELECT nombreTema FROM tema WHERE id_modulo='$idModuloC'";
                                $q7 = $pdo7->prepare($sql7);
                                $q7->execute(array());

                                while ($temasC = $q7->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <div id="<?php echo 'collapseOne' . $i ?>" class="collapse" data-parent="<?php echo '#accordion' . $i  ?>">
                                        <div class="card-body py-0" id="nombreTemaCss" style="background: white;" >
                                            
                                            <ul class="px-0">
                                                <ul class="card-body pb-3" >
                                                    Tema: <?php echo $temasC['nombreTema'] ?>
                                                </ul>
                                            </ul>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                <div id="<?php echo 'collapseOne' . $i  ?>" class="collapse" data-parent="#accordion">



                                    <!-- ////////////////// -->
                                    <!--
                                    <div style="background: #F1F7F7;" class="card-body">
                                        Cuestionario
                                    </div>
                                    -->



                                </div>
                            </div>
                            <br><br>
                        </div>
                    <?php
                        $i++;
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- mmmm -->
    

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
 <div class="flex">
    <?php
    if (isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)) {
    ?>  

      <div class="comments-container responsv1" style="border-radius: 40px; margin-top: -1em;" id="foro-curso">


        <h1 style="font-size: 34px;">Foro Educalma</h1>
        <h1 style="font-weight: 400;color: #000;font-size: 20px;margin-bottom: 16px;">Deja un comentario sobre este curso. </h1>
        

        <button id="btnComentar" style="width: 200px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Comentar</button>

        <br>

        <?php
            if($_SESSION['privilegio']==1 || $_SESSION['privilegio']==2){
                echo '
                    <center><button  class="btn btn-danger" onClick="AlertEliminaTodo('.$idCurso.')">

                        Borrar todo

                        <i class="fas fa-trash-alt"></i>
                    
                    </button>
                    </button></center>


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
                                <img src="<?php echo $registro['mifoto'];?>" alt="foto_curso"
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
                   <div class="comment-box" style="width: 612px;">
                        <div class="comment-head">
                            <h6 class="commen-name<?php echo $autor; ?>">
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
                                    <button style="background-color:red; color:white; cursor:pointer;" type="submit" class="boton4 btn btn-sm ml-3" onClick="AlertEliminacion('.$registro['idcomentario'].')">
                        
                                       <i id="botonBorrarComentario" style="color:white;" class="fas fa-trash-alt"></i>

                                       Borrar
                    
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
                <br>
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
                                    <img src="<?php echo $registro2['mifoto'];?>"
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
                       <div class="comment-box" style="width: 612px;">
                            <div class="comment-head">
                                <h6 class="commen-name<?php echo $autor; ?>"><spam><?php echo $registro2['user_men'];?></spam></h6>
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
                                        <button style="background-color:red; color:white; cursor:pointer;" type="submit" class="boton4 btn btn-sm ml-3" onClick="AlertElimiSubComen('.$registro2['idsubcomentario'].')">
                                           
                                            Borrar
                                        
                                            <i style="color:white;" class="fas fa-trash-alt"></i>

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
    <div class="" style="" >
            <img src="assets/images/ilu-nina.png" class="img-nina"alt="" >
    </div>           
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





        <!-- rrrrrrr -->
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
                                    <img src="<?php echo $registro['mifoto'];?>" alt="foto_curso"
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
                    <div class="comment-box" style="width: 612px;">
                            <div class="comment-head">
                                <h6 class="commen-name<?php echo $autor; ?>">
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
                                        <img src="<?php echo $registro2['mifoto'];?>"
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
                        <div class="comment-box" style="width: 612px;">
                                <div class="comment-head">
                                    <h6 class="commen-name<?php echo $autor; ?>"><spam><?php echo $registro2['user_men'];?></spam></h6>
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
        <!-- rrrrrrr -->
        






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

    <!-- FORO -->
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

</body>

</html>
