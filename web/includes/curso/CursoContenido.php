<head>
   <link rel="stylesheet" type="text/css" href="assets/css/contenidocurso.css"/>
   <link rel="stylesheet" type="text/css" href="assets/css/styleforo.css"/>
</head>
<style>
   .boton4 {
   position: relative;
   }
   .boton4:hover {
   color: rgba(255, 255, 255, 1) !important;
   box-shadow: 0 4px 16px rgba(49, 138, 172, 1);
   transition: all 0.2s ease;
   }
   .color1{
      color: #e0c7e5;
   }

   .img-nina{
      width: 26em;
      position: relative;
      display: flex;
      float: right;
      left: 100px;
      margin-top: -43em;
   }

   @media only screen and (min-width:275px) and (max-width:1326px){
      .img-nina{
      width: 26em;
      position: relative;
      display: flex;
      float: right;
      left: 100px;
      margin-top: -43em;
   }
   }

   @media (max-width: 767px) {
      .responsv1 {
     width: 100%;
  }}

  @media (max-width: 360px) {
      .respons7 {
     width: 100%;
     display: flex;
     justify-content: center;
  }}

  @media (max-width: 375px) {
      .respons7 {
     width: 100%;
     display: flex;
     justify-content: center;
  }}

  @media (max-width: 414px) {
      .respons7 {
     width: 100%;
     display: flex;
     justify-content: center;
  }}


  @media (min-width: 1200px) {
      .responsv5 {
      flex: 0 0 38%;
      max-width: 50%;
      margin-left: 150px;
  }

}

@media (min-width: 1200px) {
      .image-course {
      margin-left: -90px;
  }

}

@media (min-width: 1200px) {
      .largoresponsv {
      margin-left: -12em;
  }

}

@media (max-width: 360px) {
      .img-nina {
      width: 19em;
      position: relative;
      left: 35px;
      margin-top: 3em;
      float: unset;
  }

}

@media (max-width: 375px) {
      .img-nina {
      width: 19em;
      position: relative;
      left: 35px;
      margin-top: 3em;
      float: unset;
  }

}

@media (max-width: 414px) {
      .img-nina {
      width: 19em;
      position: relative;
      left: 35px;
      margin-top: 3em;
      float: unset;
  }

}

@media only screen and (min-width:820px) and (max-width:1180px) {
      .container-fluid .container-detalle-informacion .col-8 .container-info-course-detalle{
         width: 25em;
         line-height: 1.7;
      }
      .container-fluid .container-detalle-informacion .col-8{
         left: 44px;
      }
      .parrafo{
         width: 15em;
      }
      .respons1{
         flex: 0 0 40%;
         max-width: 40%;
      }
      .respons7{
         width: 30em;
      }
      .col-md-5{
         flex: 0 0 45%;
         max-width: 45%;
      }
      .img-fluid{
         margin-top: 12px;
      }
      .img-nina{
         float: none;
         width: 26em;
         position: relative;
         display: flex;
         left: 236px;
      }
} 

@media (max-width: 360px) {
      .btn-light {
      position: relative;
      top: 10px;
      }

      .comment-box .comment-head i {
      position: relative;
      top: -13px;
      }
  }

  @media (min-width: 1200px) {
      .col-xl-4 {
      flex: 0 0 28%;
      max-width: 28%;
  }

}

</style>
<body>
   <?php
      if (isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)) {
        ?>
   <?php
      // ob_start(); 
      // session_start();
      require_once '././database/databaseConection.php';
      $id = $_GET['id'];
      if(isset($_GET['idCI'])){ 
          $idCI=$_GET['idCI'];}
      else{
          $idCI=0;}
      
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
      $sql6 = "SELECT * FROM cursoinscrito WHERE curso_id = '$id' and usuario_id= '$idUser56'";
      $q6 = $pdo6->prepare($sql6);
      $q6->execute(array());
      $dato=$q6->fetch(PDO::FETCH_ASSOC);
      
    //   datos del usuario actual
      $pdo16 = Database::connect();
      $idUser67=$_SESSION['iduser'];
      $sql6 = "SELECT * FROM usuarios WHERE id_user= '$idUser67'";
      $q60 = $pdo16->prepare($sql6);
      $q60->execute(array());
      $dato90=$q60->fetch(PDO::FETCH_ASSOC);





      // $cantidad_respuesta_acertadas=1;
      
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
            <div class="container-detalle-course col-12 col sm-12 col-md-6 col-lg-6 col-xl-6 responsv5">
               <div class="row container-title-course">
                  <div class="col-auto icon-course pr-0">
                     <!-- <img src="assets/images/curso-por-internet.png" class="mr-2" alt="" style="height: 100px;">-->
                  </div> 
                  <div class="col title-course" style="color: #7C83FD; margin-left: -14px;">
                     <?php echo $dato4['nombreCurso']; ?>
                  </div>
               </div>
               <div style="padding-top: 25px;color:#000" class="description-course puntos-suspensivos">
                  <?php echo $dato4['descripcionCurso']; ?>
               </div>
               <div class="rankin-course my-3">
                  <i class="fas fa-star m-1 color1"></i><i class="fas fa-star m-1 color1"></i><i class="fas fa-star m-1 color1"></i><i
                     class="fas fa-star m-1 color1"></i><i class="fas fa-star m-1 color1"></i>
                  <span class="ml-4">20</span> Opiniones
               </div>
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
               <!-- <span style="color: #565656; font-size: 14px;">Creado por la Fundación CALMA.</span> -->
               <?php 
                  }
                  
                  if($dato20['privilegio']==2){
                  ?>
               <span style="color: #565656; font-size: 14px;">Creado por <?php echo " " . $dato20['nombres'] . " " . $dato20['apellido_pat'] . " " . $dato20['apellido_mat'] . "."?></span>
               <?php 
                  }
                  ?>
               <div class="start-course mt-5">
                  <div class="row container-start-course py-2 ml-1 my-3" style="position: relative; left: -10px;">
                     <div class="col-6 pr-0" style="display: flex;justify-content: space-around;">
                        <h5 class="m-0">Mira la primera clase de este curso!</h5>
                     </div>
                     <div class="col-6" style="display: flex;justify-content: space-around;">
                        <a class="hvr-radial-out button-theme" href="Cursoiniciar.php?id=<?php echo $id;?>&idCI=<?php echo $idCI?>"<?php if ($query==0 || $vere==false) {
                           echo 'style="pointer-events: none;"';}?> >
                        <button id="btnComienzaAhora" type="button" class="btn container-button" hidden multiple>
                        COMIENZA AHORA
                        </button>
                        </a>
                        <button id="btnComienzaAhora_2" class="btn container-button">
                        COMIENZA AHORA
                        </button>
                     </div>
                  </div>
               </div>
            </div>
            <div class="container-image-course col-12 col sm-12 col-md-6 col-lg-6 col-xl-6 responsv5">
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
               <a href="#informacion">Introducción</a>
            </div>
            <div class="nav-link-course">
               <?php 
                  // PONER EN EL BOTON DEL CERTIFICADO
                  if($dato['nota']>=18 && $dato['avance']>=99 ){
                     $codCertificado = $dato90['codigo_alumno']."".$dato['cod_curso'];
                     $codAlumnoC = $dato90['codigo_alumno'];
                     $codCursoC = $dato['cod_curso'];
                     $pdoConsultaC = Database::connect();
                     $sqlConsultaC = "SELECT COUNT(codCertificado) Cantidad FROM certificados WHERE codCertificado = '$codCertificado'";
                     $qiConsultaC = $pdoConsultaC->prepare($sqlConsultaC);
                     $qiConsultaC->execute();
                     $datoConsulta = $qiConsultaC -> fetch(PDO::FETCH_ASSOC);
                     $CantidadCertificado = $datoConsulta['Cantidad'];
                     Database::disconnect();

                     if($CantidadCertificado < 1){
                        $pdo2 = Database::connect();
                        try{
                              $verif2=$pdo2->prepare("INSERT INTO `certificados` (`codCertificado`, `codAlumno`, `codCurso`) VALUES (:codCer, :codA, :codC)");
                              $verif2->bindParam(":codCer",$codCertificado,PDO::PARAM_STR);
                              $verif2->bindParam(":codA",$codAlumnoC,PDO::PARAM_STR);
                              $verif2->bindParam(":codC",$codCursoC,PDO::PARAM_STR);
                              $verif2->execute();
                        }catch(PDOException $e){
                              echo $e->getMessage();
                        }
                        Database::disconnect();
                     }

                      echo '<a style="cursor: pointer;" id="solcert" onclick="con_certificado()">Certificado</a>';     
                      //'<a style="cursor: pointer;" data-filter=".seo" href="plugins/ejemplo.php?idCurso='.$id.'&idUsu='.$idUser56.'">Certificado</a>';
                      $validar=1;/*
                      $pdo21 = Database::connect();
                      $verif21=$pdo21->prepare("UPDATE `cursoinscrito` SET `solicitudcertificado`='si' WHERE `id_cursoInscrito`=$idCI AND `usuario_id`=$idUser56;");
                      $verif21->execute();
                      Database::disconnect(); 
                      */ 
                      //break;
                  }
                  else {
                      echo '<a style="cursor: pointer;" onclick="sin_certificado()">Certificado</a>';
                      $validar=0;
                  }
                  /*
                  switch($dato['nota']){
                      case 20:
                          $pdo21 = Database::connect();
                          $verif21=$pdo21->prepare("UPDATE `cursoinscrito` SET `solicitudcertificado`='si' WHERE `id_cursoInscrito`=$idCI AND `usuario_id`=$idUser56;");
                          $verif21->execute();
                          Database::disconnect(); 
                          echo '<a style="cursor: pointer;" id="solcert" onclick="con_certificado()">Certificado</a>'; 
                          $validar=1;
                          break;
                      default:
                          echo '<a style="cursor: pointer;" onclick="sin_certificado()">Certificado</a>';
                          $validar=0;
                          break;
                      }*/
                  
                  $_SESSION['validar']=$validar;
                  
                  ?>
          
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
            <div class="container"  style="width:auto; overflow:hidden;">
               <div class="row py-0 respons"style="display:flex; flex-direction:row ;margin-top:25px ;">
                  <!-- <div class="col-4">
                     <img src="assets/img/cursophp.png" alt=""> 
                     </div>-->
                  <!--div class="col-md-5 col-lg-5 order-1 "style="align-self: flex-end; margin-top:25px;" -->
                  <div class="col col-md-4"  id="informacion">
                     <h5 style="color: #7C83FD;font-weight: 600;font-size: 24px;">Introducción</h5>
                     <p class="parrafo" style="margin-top: 15px;text-align: justify;"><?php echo $dato4['introduccion']; ?></p>
                  </div>
                  <!--div class="col-8"-->
                  <div class="col-8"  id="informacion">
                     <h5 style="color: #7C83FD;font-weight: 600;text-transform: initial;">¿Que incluye este curso?</h5>
                     <div class="container-info-course-detalle" style="margin-top: 2em;border-radius: 20px;border: 2px solid #7C83FD;">
                        <h5>Tabla de contenido del curso</h5>
                        <div class="row pt-2" style="color: #000;padding-top: 0.6rem!important;">
                           <div class="col-12 col-sm-6 col-lg-6">
                              <div><i class="far fa-file"></i></div>
                              <?php echo $modulos; ?> Modulos
                           </div>
                           <div class="col-12 col-sm-6 col-lg-6">
                              <div><i class="fas fa-folder"></i></div>
                              <?php echo $temas; ?> Temas
                           </div>
                           <div class="col-12 col-sm-6 col-lg-6">
                              <div><i class="fas fa-infinity"></i></div>
                              <?php echo $cuestionarios; ?> Cuestionarios
                           </div>
                           <div class="col-12 col-sm-6 col-lg-6">
                              <div><i class="fas fa-mobile-alt"></i></div>
                              Nota mínima <?php echo $nota37; ?>
                           </div>
                           <div class="col-12 col-sm-6 col-lg-6">
                              <div><i class="fas fa-list-ol"></i></div>
                              Cant. de preguntas <?php echo $preguntas; ?>
                           </div>
                           <div class="col-12 col-sm-6 col-lg-6">
                              <div><i class="fas fa-trophy"></i></div>
                              Certificado de Finalización
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-12 respons1"   style="width:756px; height:auto; float:left; position: relative; " id="certificado-temario">
               <h5 style="color: #7C83FD;font-weight: 600;font-size: 24px;">Temario del curso</h5>
               <?php 
                  $nW=0;
                      while ($modulosC = $q6->fetch(PDO::FETCH_ASSOC)) {
                          $nW=$nW+1;
                  ?>
               <div class="respons7">
                  <a id="btnInicioModulo" href="video.php?id=<?php echo $id;?>&idtema=<?php echo 1;?>&id_modulo=<?php echo $modulosC['idModulo']?>&nW=<?php echo $nW-1?>&idCI=<?php echo $idCI?>" class="btn px-4 mb-2 puntos-suspensivos responsv1"  style="background:#fff; width:55%; text-align:left;">
                  <i class="fas fa-play mr-3"></i>
                  <span style="color:black; width:100%;white-space: initial;"><?php echo $modulosC['nombreModulo'] ?></span>
                  </a>
               </div>
               <?php 
                  }
                  ?>
            </div>
            <div class="col-md-5 col-lg-5 order-1 " style="width:auto; float:right; position: relative; " >
               <h5 style="color: #7C83FD;font-weight: 600;font-size: 23px;">Certificación del curso</h5>
               <img src="assets/images/certificado.jpg" class="img-fluid"alt="">
               <div class="info">
                  <!--Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse sapiente, harum, vero molestiae magnam
                     blanditiis cum omnis magni-->
               </div>
            </div>
         </div>
         <!--foro educalma-->
         <div class="largoresponsv" style="width:100%;">
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
            <?php
               if (isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)) {
               ?>
            <!-- COMIENZOOOOOOOOOOOOOO - Contenedor de todo. El que tiene esquinas curveadas. -->
            <div id="contenedorTodo" class="comments-container"  style="border-radius: 40px;">
               <!-- TITULO FORO EDUCALMA -->
               <h1 id="tituloForoEducalma">Comenta sobre el curso</h1>
               <h4 style="font-size: 16px;">Deja un comentario sobre este curso.</h4> 
               <!-- TITULO FORO EDUCALMA -->
               <!-- BOTON COMENTAR -->
               <button id="btnComentar2" style="width: 10em;height: 45px; border-radius: 8px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Comentar</button>
               <h1 style="margin-top: 43px;">Destacados</h1>
               <!-- BOTON COMENTAR -->
               <!-- BOTON ELIMINAR TODO -->
               <!--botonEliminarTodo Le quite los estilos(style="position: relative; left: 10px; top: -10px" type="button"), hace que el boton 
                  se vea fuera del contenedor -->
               <div id="botonEliminarTodo">
                  <br>
                  <?php
                     if($_SESSION['privilegio']==1 || $_SESSION['privilegio']==2){
                     echo '
                         <button class="btn btn-danger" onClick="AlertEliminaTodo('.$idCurso.')  ">
                             
                             Borrar todo
                     
                             <i class="fas fa-trash-alt"></i>
                     
                         </button>
                     ';
                     }
                     ?>
               </div>
               <!-- BOTON ELIMINAR TODO -->
               <!-- LISTA DE COMENTARIOS -->
               <ul id="comments-list" class="comments-list">
                  <!-- lilililili -->
                  <li>
                     <!-- tttttttttt -->
                     <?php
                        $autor = "";
                        while ($registro =  $stm->fetch(PDO::FETCH_ASSOC)) {
                            if($registro['iduser']==$idProfe){
                                $autor = " by-author";
                                
                            }else{
                                $autor = "";
                            }
                        ?>
                     <!-- tttttttttt -->
                     <!-- COMENTARIOOOOOOOOOOOOOOOOOOOOOOOOOOOOO -->
                     <div id="divComentario" class="comment-main-level" >
                        <!-- AVATAR -->
                        <div id="avatarComentario" class="comment-avatar">
                           <?php    
                              if($registro['mifoto']!=null){
                              ?>
                           <img id="imagenAvatarComentario" src="data:image/*;base64,<?php echo base64_encode($registro['mifoto']);?>" alt="foto_curso" style="width: 60px;height:60px;">
                           <?php
                              }else{
                              ?>
                           <img id="imagenAvatarComentario" src="./assets/images/user.png" alt="foto_curso" style="width: 60px;height:60px;">
                           <?php
                              }
                              ?> 
                        </div>
                        <!-- AVATAR -->
                        <!-- CONTENEDOR DEL COMENTARIO -->
                        <div id="contenedorComentario" class="comment-box">
                           <!-- HEAD -->
                           <div id="headComentario" class="comment-head">
                              <!-- Nombre de Usuario del Comentario -->
                              <h6 class="comment-name<?php echo $autor; ?>">
                                 <span id="nombreUsuarioComentario"><?php echo $registro['nombreUser']; ?></span>
                              </h6>
                              <!-- Nombre de Usuario del Comentario -->
                              <!-- yyyyyyyyyyyyyyyyyyy -->
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
                              <!-- yyyyyyyyyyyyyyyyyyy -->
                              <button type="button" id="modal" class="btn btn-light btn-sm ml-3" data-toggle="modal"
                                 data-target="#respuesta<?php echo $registro['idcomentario'] ?>"
                                 data-id="<?php echo '5' ?>">Responder
                              </button>
                              <!-- Botón Borrar Comentario -->
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
                              <!-- Botón Borrar Comentario -->
                              <!-- Flecha compartir -->
                              <a class="fb-xfbml-parse-ignore" target="_blank" href="http://www.facebook.com/sharer.php?s=100&p[url]=http://educalma.fundacioncalma.org/detallecurso.php?id=<?php echo $idCurso;?>&p[title]=prueba&p[summary]=descripcion_contenido&display=page" 
                                 onclick="window.open(this.href, this.target, 'width=300,height=400')">
                              <i id="flechaCompartirComentario" style="color:white;" class="fa fa-reply"></i>
                              </a>
                              <!-- Flecha compartir -->
                              <!-- Corazón -->
                              <i id="corazonComentario" style="color: white;" class="fa fa-heart"></i>
                              <!-- Corazón -->
                           </div>
                           <!-- HEAD -->
                           <!-- Contenido del comentario -->
                           <div id="contenidoComentario" class="comment-content">
                              <?php echo $registro['comentario']; ?>
                           </div>
                           <!-- Contenido del comentario -->
                        </div>
                        <!-- CONTENEDOR DEL COMENTARIO -->
                     </div>
                     <!-- COMENTARIOOOOOOOOOOOOOOOOOOOOOOOOOOOOO -->
                     <br>
                     <!-- ooooooooo -->
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
                     <!-- ooooooooo -->
                     <!-- LISTA DE SUBCOMENTARIOS -->
                     <ul id="listaSubComentarios" class="comments-list reply-list">
                        <!-- iiiiiiiiii -->
                        <li>
                           <div id="divSubcomentario">
                              <!-- AVATAR -->
                              <div id="avatarSubcomentario" class="comment-avatar">
                                 <?php    
                                    if($registro2['mifoto']!=null){
                                    ?>
                                 <img id="imagenAvatarSubcomentario" src="data:image/*;base64,?php echo base64_encode($registro2['mifoto']);?>" 
                                    alt="foto_curso" style="width: 43px;height:43px;">
                                 <?php
                                    }else{
                                    ?>
                                 <img id="imagenAvatarSubcomentario" src="./assets/images/user.png" alt="foto_curso" style="width: 43px;height:43px;">
                                 <?php
                                    }
                                    ?> 
                              </div>
                              <!-- AVATAR -->
                              <!-- CONTENEDOR DEL SUBCOMENTARIO -->
                              <div id="contenedorSubcomentario" class="comment-box">
                                 <!-- oeoeoeoeoeo -->
                                 <div id="headSubcomentario" class="comment-head">
                                    <h6 class="comment-name<?php echo $autor; ?>">
                                       <span id="nombreUsuarioSubcomentario"><?php echo $registro2['user_men'];?></span>
                                    </h6>
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
                                    <!-- Botón Borrar Subcomentario -->
                                    <?php
                                       if($_SESSION['privilegio']==1 || $_SESSION['iduser']==$idProfe || $registro2['iduser']==$_SESSION['iduser']){
                                       
                                       echo '
                                       
                                           <button style="background-color:red; color:white; cursor:pointer;" type="submit" class="boton4 btn btn-sm ml-3" onClick="AlertElimiSubComen('.$registro2['idsubcomentario'].')">
                                               
                                               <i id="botonBorrarSubcomentario" style="color:white;" class="fas fa-trash-alt"></i>
                                       
                                               Borrar
                                           
                                           </button>
                                       ';
                                       }
                                       ?>
                                    <!-- Botón Borrar Subcomentario -->
                                    <!-- Flecha Compartir Subcomentario -->
                                    <i id="flechaCompartirSubcomentario" style="color:white;" class="fa fa-reply"></i>
                                    <!-- Flecha Compartir Subcomentario -->
                                    <!-- Corazón Subcomentario -->
                                    <i id="corazonSubcomentario" style="color:white;" class="fa fa-heart"></i>
                                    <!-- Corazón Subcomentario -->
                                 </div>
                                 <!-- oeoeoeoeoeo -->
                                 <!-- Contenido del subcomentario. -->
                                 <div id="contenidoSubcomentario" class="comment-content">
                                    <?php echo $registro2['subcomentario'];?>
                                 </div>
                                 <!-- Contenido del subcomentario. -->
                              </div>
                              <!-- CONTENEDOR DEL SUBCOMENTARIO -->
                           </div>
                        </li>
                        <!-- iiiiiiiiii -->
                     </ul>
                     <!-- LISTA DE SUBCOMENTARIOS -->
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
                  <!-- lilililili -->
               </ul>
               <!-- LISTA DE COMENTARIOS -->
            </div>
            <div class="" style="" >
               <img src="assets/images/ilu-nina.png" class="img-nina"alt="" >
            </div>
            <!-- COMIENZOOOOOOOOOOOOOO - Contenedor de todo. El que tiene esquinas curveadas.-->
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
                                 <h6 class="comment-name<?php echo $autor; ?>">
                                    <spam><?php echo $registro2['user_men'];?></spam>
                                 </h6>
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
              title: 'Nota minima no alcanzada',
              text: 'Necesita aprobar el curso para descargar su certificado'
          })
      }

        // function descargar(){
        //      
        //         // # Pon su ruta absoluta, no importa qué tipo sea
        //         $rutaArchivo ="http://test-apicalma.site/plugins/certificate/".$dato90['codigo_alumno'].$dato['cod_curso'].".pdf";

        //         // # Obtener nombre sin ruta completa, únicamente para sugerirlo al guardar
        //         $nombreArchivo = basename($rutaArchivo);

        //         // # Algunos encabezados que son justamente los que fuerzan la descarga
        //         header('Content-Type: application/octet-stream');
        //         header("Content-Transfer-Encoding: Binary");
        //         header("Content-disposition: attachment; filename=$nombreArchivo");
        //         // # Leer el archivo y sacarlo al navegador
        //         readfile($rutaArchivo); 
        //         
        // }
      
      function con_certificado() {
      
          Swal.fire({
              icon: 'success',
              title: 'Nota minima alcanzada',
              text: 'Su certificado se descargara en breve '
          })   
              const Url="/plugins/ejemplo2.php";

              var formData = new FormData();
            
              formData.append('nombre_curso','<?php echo $dato4['nombreCurso'] ;?>');
              formData.append('cod_alumno','<?php echo  $dato90['codigo_alumno']; ?>');
              formData.append('cod_curso', '<?php echo $dato['cod_curso'] ;?>');
              formData.append('nombre_estudiante', '<?php echo $dato90['nombres']." ".$dato90['apellido_pat']." ".$dato90['apellido_mat'] ;?>'); 

            var request = new XMLHttpRequest();
            request.onreadystatechange = dataLoaded;
            request.open("POST", Url);
            request.send(formData);

            function dataLoaded()
{
            if( this.status==200)
            {
               console.log("Respuesta del servidor"); 
            //    Se debe cambiar la url desde donde esta los certificados
               var Url2 = "http://test-apicalma.site/plugins/certificate/<?php echo  $dato90['codigo_alumno']; ?><?php echo $dato['cod_curso'] ;?>.pdf"
               setTimeout(function(){console.log("Se esta descargando el certificado");window.open(Url2, '_blank');}, 2000);
               
            }
            else
            {
                console.log("Aun no hay respuesta");
            }
}
            

            //   fetch(Url, {
            //   method: 'POST',
            //   body: formData,
            //   })
            //   .then(response => response.text();) 
            //   .then(data => console.log(data)) 
      
         
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
   <script>
      $('#btnComienzaAhora_2').click(function(){
      
          Swal.fire({
      
              icon: 'warning',
      
              title: 'Se dará inicio al primer módulo del curso.',
      
              html:
      
              '<h5 style="color: black;">• Se validará tu conocimiento del módulo mediante un cuestionario.</h5>'
              +
              '<h5 style="color: black;">• Tiene solo 3 intentos para realizarlo.</h5>'
              +
              '<h5 style="color: black;">• Después de 3 intentos, podrá continuar respondiendo el cuestionario, pero su calificación ya no será válida.</h5>'
              +
              '<h5 style="color: black;">• Preste mucha atención al video del módulo antes de responder el cuestionario.</h2>',
      
              confirmButtonText: "Iniciar el curso",
              
              showCancelButton: true,
              cancelButtonColor: 'red',
              cancelButtonText: "Cancelar",
          
          }).then(resultado => {
      
              if (resultado.value) {
      
                  $('#btnComienzaAhora').trigger('click');
      
              } else {
      
              }
      
          });
        
      });
      
      
      
   </script>
</body>