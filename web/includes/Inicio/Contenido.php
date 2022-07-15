<?php

if (!isset($_GET['pag'])) {
  $_GET['pag'] = 1;
}

?>



<head>
  <link rel="stylesheet" href="assets/css/home.css" />

  <style>

    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap");
    @import url("https://fonts.googleapis.com/css2?family=Old+Standard+TT&display=swap");
    @import url("https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap");
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap");
    @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,600;1,100&family=Zen+Antique+Soft&display=swap");
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@100;300;500&display=swap");
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@700&family=Poppins:wght@400;700&family=Work+Sans&display=swap");
    
    /*Título*/
    .title-panel .txtBienvenido {
      
      color: black;
      font-family: 'Baloo Tamma 2';
      font-size: 100px;
      position: relative;
      top: 55px;
    }

    /*Título*/
    .title-panel .txtEducalma {

      color: #737BF1;
      font-family: 'Baloo Tamma 2';
      font-size: 125px;
    }
  </style>
</head>



<!--Inicio del Hero-->
<div class="container-fluid div-container-panel">
  <div class="row">
    <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-6 container-panel">
      <div class="container-title-panel">



        <!--Título-->
        <div class="title-panel">
          <span class="txtBienvenido">BIENVENIDO! </span> 
          <br> 
          <span class="txtEducalma">EduCalma</span>
        </div>



        <!--Descripción-->
        <div class="description-panel">
          ¡Impulsa tu aprendizaje junto a los mejores especialistas en EduCalma desde hoy!
        </div>



        <!---->
        <div class="button-panel">
            <?php

                /*
                if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $_SESSION['privilegio'] == 1){
                  
                  echo "<a href='user-sidebar.php' type='button' class='btn btn_registrar_panel'>Dashboard</a>";
                }
                else if(isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $_SESSION['privilegio'] == 2){
                  
                  echo "<a href='user-sidebar.php' type='button' class='btn btn_registrar_panel'>Dashboard</a>";

                }else if(isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $_SESSION['privilegio'] == 3){

                  echo "<a href='sidebarCursos.php' type='button' class='btn btn_registrar_panel'>Cursos comprados</a>";

                }else if(isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $_SESSION['privilegio'] == 4){

                  echo "<a href='sidebarCursos.php' type='button' class='btn btn_registrar_panel'>Cursos comprados</a>";

                }else if(isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $_SESSION['privilegio'] == 5){

                  echo "<a href='sidebarCursos.php' type='button' class='btn btn_registrar_panel'>Cursos comprados</a>";
                
                }else if(isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $_SESSION['privilegio'] == 6){
                  
                  echo "<a href='user-sidebar.php' type='button' class='btn btn_registrar_panel'>Dashboard</a>";
                }
                */

            ?>
        </div>



      </div>
    </div>



    <!--Imagen-->
    <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-6 container-panel-image">
      <div class="container-image-panel">
        <div class="image-panel">
          <img src="./assets/images/edu.png" alt="">
        </div>
      </div>
    </div>



  </div>
</div>
<!--Fin del Hero-->



<!-- CARDS BRINDA -->
<div class="container container-fluid-brida">
  <div class="row">
    <div class="col-12">
      
      <div class="divBrinda row"> <!--/////////////////////////-->
        <div class="section-title">
          <h2>¿Qué te ofrece <span>Educalma</span>?</h2>
        </div>
      </div>



      <!--Tres Cards-->
      <div class="row tresCards">  


        <!--CURSOS-->
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 d-flex justify-content-center mb-3">
          <div class="card h-100" style="padding: 2rem 1rem; max-width: 300px;">
            <div class="card-image text-center mb-3">
              <img style="width: 100px; height: 100px;" src="./assets/images/cur.png" alt="" />
            </div>
            <div class="card-title text-center mb-0">
              <p class="text-uppercase">Cursos</p>
            </div>
            <div class="card-descripti">
              <p class="text-black text-center mx-auto" style="width: 90%;">
                Otorgamos cursos calificados para que el alumno aprenda y
                desarrolle nuevas habilidades.
              </p>
            </div>
          </div>
        </div>



        <!--DESARROLLO PERSONAL-->
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 d-flex justify-content-center mb-3">
          <div class="card h-100" style="padding: 2rem 1rem; max-width: 300px;">
            <div class="card-image text-center mb-3">
              <img style="width: 66px; height: 100px;" src="./assets/images/curso culminad.png" alt="" />
            </div>
            <div class="card-title text-center mb-0">
              <p class="text-uppercase">Desarrollo Personal</p>
            </div>
            <div class="card-descripti">
              <p class="text-black text-center mx-auto" style="width: 90%;">
                Cada tema enseñado será de buena ayuda en los test de cada sesión.
              </p>
            </div>
          </div>
        </div>



        <!--CERTIFICADOS-->
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 d-flex justify-content-center mb-3">
          <div class="card h-100" style="padding: 2rem 1rem; max-width: 300px;">
            <div class="card-image text-center mb-3">
              <img style="width: 100px; height: 100px;" src="./assets/images/certificad.png" alt="" />
            </div>
            <div class="card-title text-center mb-0">
              <p class="text-uppercase">Certificados</p>
            </div>
            <div class="card-descripti">
              <p class="text-black text-center mx-auto" style="width: 90%;">
                Al concluir el curso se les entregará un certificado por todo lo aprendido en cada sesión.
              </p>
            </div>
          </div>
        </div>
        <!-- <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
          <div class="card card-certificados">
            <div class="card-image certificados">
              <img src="./assets/images/certificad.png" alt="" />
            </div>
            <div class="card-title">
              <p style="font-weight: bold; color: #7C83FD">Certificados</p>
            </div>
            <div class="card-descripti">
              <p style="color: black; font-weight: 500;">
                Al concluir el curso se les entregará un certificado por todo lo aprendido en cada sesión.
              </p>
            </div>
          </div>
        </div> -->


      </div>
      <!--Fin de Tres Cards.-->

    </div>
  </div>
</div>



<!-- CARDS CURSOS -->
<div class="container container-fluid-course">


  <div class="row">
    <div class="col-12">

      <style>
        @media (max-width: 600px) {

          .divCursosDestacados {
            position: relative;
            top: 30px;
          }

        }
      </style>
      <div class="divCursosDestacados row"> <!--/////////////////////////-->
        <div class="section-title">
          <div class=""></div>
          <h2 class="txtCurDes" >Cursos destacados</h2>
        </div>
      </div>


      <div class="row">
        <?php
          $pdo= Database::connect();
          $sql = 'SELECT * FROM cursos c inner join categorias a on a.idCategoria=c.categoriaCurso where c.permisoCurso=1 AND estado=1 ORDER BY idCurso DESC LIMIT 3';
          $query = $pdo->prepare($sql);
          $query->execute();
          $conteo=0;

          while ($dato = $query->fetch(PDO::FETCH_ASSOC)) {

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

        <style>

          .card .face {
              position: absolute;
              width: 100%;
              height: 100%;
              backface-visibility: hidden;
              border-radius: 10px;
              overflow: hidden;
              transition: .5s;
          }

          .card .front {
              transform: perspective(600px) rotateY(0deg);
              position: relative;
              top: 1px;
          }

          .card .front img {
              position: absolute;
              width: 100%;
              height: 100%;
              object-fit: cover;
          }

          .card .front h3 {
              position: absolute;
              bottom: 0;
              width: 100%;
              height: 45px;
              line-height: 45px;
              color: #fff;
              background: rgba(0,0,0,.4);
              text-align: center;
          }

          .card .back {
              transform: perspective(600px) rotateY(180deg);
              color: #f3f3f3;
              padding-left: 3rem;
              padding-right: 3rem;
              display: flex;
              flex-direction: column;
              justify-content: end;
              text-align: start;
          }

          .card .back .link {
          
          }

          .card .back .link a {
              color: #f3f3f3;
          }

          .card .back h3 {
              font-size: 30px;
              margin-top: 20px;
              letter-spacing: 2px;
          }

          .card .back p {
              letter-spacing: 1px;
          } 

          .card:hover .front {
              transform: perspective(600px) rotateY(180deg);
          }

          .card:hover .back {
              transform: perspective(600px) rotateY(360deg);
          }

          @media (max-width: 600px) {

            .cardsCursosDest{
              margin-top: 30px;
            }

            .card .front {
              transform: perspective(600px) rotateY(0deg);
              position: relative;
              top: -30px;
            }
            .txtCurDes {
              margin-bottom: 4rem;
            }

          }


        </style>

     
            <div class="card mb-4" style="background: transparent; width: 350px; height: 350px;">


                <!--ADELANTE-->
                <div class="p-2 face front cardsCursosDest" style="width: 100%; height: 100%; border-radius: 10px;
                  background: rgb(124,131,253);
                  background: linear-gradient(180deg, rgba(124,131,253,1) 0%, rgba(224,199,229,1) 100%);">
                  <div class="face front cardsCursosDest">

                      <!--IMAGEN-->
                      <!--Contenedor de la imagen-->
                      <div style="border-radius: 30px 30px 0 0;" class="container-card-image">                      
                          <?php
                          if ($dato['imagenDestacadaCurso'] != null) {
                          ?>
                              <!--Imagen-->
                              <img class="imgCurso" style="" src="<?php echo $dato['imagenDestacadaCurso']; ?>" alt="">
                          <?php
                          } else {
                          ?>
                              <img class="imgCurso" src="./assets/images/curso_educalma.png">
                          <?php
                          }
                          ?>

                      </div>

                      <!--NOMBRE CURSO-->
                      <h3 class="mb-0" style="bottom: 45px; height: 64px;
                      background: rgb(124,131,253);
                      background: linear-gradient(0deg, rgba(124,131,253,.7) 0%, rgba(255,255,255,0) 100%);"></h3>
                      <h3 class="text-white mb-0" style="background: rgba(124,131,253,.7); font-size: 24px;">
                        <?php echo $dato['nombreCurso'];?>
                      </h3>
                  </div>
                </div>

                <!--ATRÁS-->
                <style>
                  .back::before {
                    background-color: rgba(124,131,253,.5);
                    content: '';
                    display: block;
                    height: 100%;
                    position: absolute;
                    top: 0;
                    left: 0;
                    z-index: -1;
                    width: 100%;
                  }
                </style>
                
                <div class="face back" style="background: url(
                  <?php if ($dato['imagenDestacadaCurso'] != null) {
                    echo('data:image/*;base64,'); echo base64_encode($dato['imagenDestacadaCurso']);
                  } else {
                    echo('./assets/images/curso_educalma.png');
                  }
                    ?>
                  ) no-repeat;
                  background-size: 100% 100%;">

                    <!--NOMBRE CURSO-->
                    <h4 class="mb-0" style="font-weight: 600;"><?php echo $dato['nombreCurso'];?></h4>

                    <!--AUTOR-->
                    <!--Contenedor del nombre del profesor del curso publicado más destacado-->
                    <div class="container-card-description mb-2" style="font-size: .9rem;">

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

                                    <span>Creado por la Fundación CALMA.</span>

                            <?php 
                                }

                                if($dato5['privilegio']==2){
                            ?>
                                    <span>Creado por <?php echo " " . $dato5['nombres'] . " " . $dato5['apellido_pat'] . " " . $dato5['apellido_mat'] . "."?></span>
                            <?php 
                                }
                            ?>
                        </a>

                    </div>

                    <!--DESCRIPCIÓN-->
                    <h5 class="my-3" style="text-align: left; font-size: .9rem;"><?php echo $dato['descripcionCurso']; ?></h5>

                    <!--PRECIO-->
                    <div class="d-flex justify-content-center">
                                    
                                    <p class="mb-2" style="font-size: .9rem;">
                                        <?php
                                            if($dato['costoCurso']!=0 && $dato['costoCurso'] != "Gratis"){
                                                echo 'Costo S/ ' . $dato['costoCurso'];
                                            }else{
                                                echo 'Gratuito por tiempo limitado';
                                            }
                                        ?>
                                    </p>
                
                          
                    
                    </div>
                  
                    <!--BOTÓN-->
                    <div class="link d-flex justify-content-center mb-3">
                        <?php
                        if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
                        ?>
                        <a style="color: #7c83fd; background: white; border-radius: 30px;" href="<?php echo $paginaRed ?>.php?id=<?php echo $dato['idCurso']; ?><?php if(!empty($dato2)){?>&idCI=<?php echo $dato2['id_cursoInscrito']; }?>" type="button" class="btn btn-outline-info btn_registrar">
                          <i class="far fa-play-circle"></i>
                          <span class="d-inline-block position-relative" style="top: -.04rem;">Comienza a ver el curso</span>
                        </a>
                        <?php
                        }else{
                        ?>
                          <a style="color: #7c83fd; background: white; border-radius: 30px;" href="iniciosesion.php" type="button" class="btn btn-outline-info btn_registrar">
                            <i class="far fa-play-circle"></i>
                            <span class="d-inline-block position-relative" style="top: -.04rem;">Comienza a ver el curso</span>
                          </a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        






















<!-- MODAL -->
<div class="modal fade bd-example-modal-lg<?php echo $dato['idCurso'];?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-xl">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <img src="./assets/images/imagen_curso_destacado.png" alt="" width="28px">
            <span class="title-modal">Cursos > Categoría ></span>
            <!-- <h5><?php //echo $dato['nombreCurso'];?></h5> -->
            <span class="title-modal"><?php echo $dato['nombreCategoria']; ?></span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span class="button_close" aria-hidden="true">&times;</span>
          </div>
          <!-- col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6"> -->
          <div class="">



          
            <div class="cont_titulos">
              <h4 class="titulo"><?php echo $dato['nombreCurso'];?></h4>
              <span class="descripcion"><?php echo substr($dato['descripcionCurso'], 0, 500); ?></span>
              <br><br>
              <?php
               if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
                 ?>
              <a href="<?php echo $paginaRed ?>.php?id=<?php echo $dato['idCurso']; ?><?php if(!empty($dato2)){?>&idCI=<?php echo $dato2['id_cursoInscrito']; }?>" type="button" class="btn btn-outline-info btn_registrar">
                <i class="far fa-play-circle"></i>
                Comienza este curso
              </a>
              <?php
               }else{
                ?>
                <a href="iniciosesion.php" type="button" class="btn btn-outline-info btn_registrar">
                  <i class="far fa-play-circle"></i>
                  Comienza este curso
                </a>
                <?php
               }
              ?>
            </div>




          </div>
          <div class="">
            <?php    
                if($dato['imagenDestacadaCurso']!=null){
            ?>
                    <img class="img_nueva" src="data:image/*;base64,<?php echo base64_encode($dato['imagenDestacadaCurso']); ?>" alt="" style="max-width: 100%;">
            <?php
                }else{
            ?>
                    <img class="img_nueva" height="50px"  src="./assets/images/curso_educalma.png"  alt="" style="max-width: 100%;">
            <?php
                }
            ?> 
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

        <?php
          }
          Database::disconnect();
        ?>
      </div>
    </div>
  </div>
</div>























<!-- EMPRESAS -->
<div class="container-bussines container divEmp">


  <div class="info col-12 mt-5"> <!--/////////////////////////-->

    <h2 style="position: relative; top: 30px;" class="text-center">Educalma para empresas</h2>
    <br>
    <ul style="margin-left: 40px;">
      <li style="color:#282C71;"><i class="fas fa-check fa-lg mr-3 " style="color: #7c83fd;"></i>Mide y analiza los resultados de tu equipo con nuestro servicio.</li>
      <li style="color:#282C71;"><i class="fas fa-check fa-lg mr-3" style="color: #7c83fd;"></i>Acompañamiento y seguimiento por un Ejecutivo de Cuenta.</li>
      <li style="color:#282C71;"><i class="fas fa-check fa-lg mr-3" style="color: #7c83fd;"></i>Certificaciones por cada curso del plan completado.</li>
    </ul>
    <div class="box-email">

      <!--span style="position: relative; top: -30px;">Recibe informaci&oacute;n específica para tu empresa</span-->
      
      <!--<div class="input-data">-->

        <!--<input type="email" placeholder="Escribe tu correo empresarial" id="txtEmail" />-->
        <style>
          #btnAction {

            margin-left: 200px;
          }

          @media (max-width: 600px){
            #btnAction {

              margin-left: 50px;
            }
          }
        </style>
        <br>
          <button id="btnAction" style="width: 200px; position: relative; top: -50px; background-color:#737BF1; font-weight:500;">MÁS INFORMACIÓN</button>
        <br>

      <!--</div>-->
      <span class="msg-error">Debe ser un correo corporativo.</span>
    </div>
  </div>












  
  <div class="send-data col-12 my-auto" id="sendData">

    <div class="box-rotate my-5" id="boxRotate">
      



      <div class="front" id="front">
        
        <div class="box-image d-flex align-items-center justify-content-center">
          &nbsp;&nbsp; <img class="img-fluid" src="./assets/images/EDU-EMP.png" alt="" />
        </div>

      </div>




      
      <div style="" class="back">
        <div class="header w-100">
          <div class="box-image">
            <img src="./assets/images/Rectangle 51.png" alt="" />
          </div>
          <div class="box-text">
            <h3>CAPACITA A TU EQUIPO</h3>
            <span>Completa los datos y te ayudaremos a crear un plan alineado a
              los objetivos del equipo y tu empresa.</span>
          </div>
        </div>

        <style>
          .group-control .error{
            color: crimson;
            font-style: normal;
            font-size: 16px;
            padding-top: 5px;
            /* max-width:300px; 
            padding: 10px;*/
            margin:0;
          }
        </style>

        <form id="validacion" class="formu">
            <div class="row">
              <div class="group-control">
                <span class="title">Nombre Completo</span><input name="nomCompleto" type="text" id="nomCompleto" onkeypress="return valNombre(event);" aria-describedby="names-addon"/>
              </div>
              <div class="group-control">
                <span class="title">Correo electrónico</span><input name="txtEmail" type="email" id="txtEmail" pattern="/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/" aria-describedby="names-addon"/>
              </div>
            </div>
            <div class="row">
              <div class="group-control">
                <span class="title">Empresa</span><input name="txtEmpresa" type="text" id="txtEmpresa" onkeypress="return valNombre(event);" maxlength="50" aria-describedby="names-addon"/>
              </div>
              <div class="group-control">
                <span class="title">Teléfono móvil</span>
                <div class="row-icon">
                  <div class="selItem">
                    <div class="btn-select">
                      <div id="btnPais">
                        <img id="imgPais" src="./assets/images/peru.png" style="cursor: pointer;"/>
                      </div>
                      <input type="tel" class="code" id="code" value="+51" style="width:120%;" maxlength="4" onKeypress="return ((event.charCode >= 48 && event.charCode <= 57) || event.charCode == 43)" readonly/>
                    </div>
  
                    <ul class="sel" id="listPais" style="height:300px; width:430%; overflow:auto;">
  
                      <li style="border-bottom: 1px solid black;">
                        <img src="./assets/images/peru.png" alt="+51" />
                        <span>Perú (+51)</span>
                      </li>
  
                      <li>
                        <img src="./assets/images/argentina.png" alt="+54" />
                        <span>Argentina (+54)</span>
                      </li>
                      <li>
                        <img src="./assets/images/bolivia.png" alt="+591" />
                        <span>Bolivia (+591)</span>
                      </li>
                      <li>
                        <img src="./assets/images/brasil.png" alt="+55" />
                        <span>Brasil (+55)</span>
                      </li>
                      <li>
                        <img src="./assets/images/chile.png" alt="+56" />
                        <span>Chile (+56)</span>
                      </li>
                      <li>
                        <img src="./assets/images/colombia.png" alt="+57" />
                        <span>Colombia (+57)</span>
                      </li>
                      <li>
                        <img src="./assets/images/costa-rica.png" alt="+506" />
                        <span>Costa Rica (+506)</span>
                      </li>
                      <li>
                        <img src="./assets/images/cuba.png" alt="+53" />
                        <span>Cuba (+53)</span>
                      </li>
                      <li>
                        <img src="./assets/images/ecuador.png" alt="+593" />
                        <span>Ecuador (+593)</span>
                      </li>
                      <li>
                        <img src="./assets/images/el-salvador.png" alt="+503" />
                        <span>El Salvador (+503)</span>
                      </li>
                      <li>
                        <img src="./assets/images/estados-unidos.png" alt="+1" />
                        <span>Estados Unidos (+1)</span>
                      </li>
                      <li>
                        <img src="./assets/images/guatemala.png" alt="+502" />
                        <span>Guatemala (+502)</span>
                      </li>
                      <li>
                        <img src="./assets/images/honduras.png" alt="+504" />
                        <span>Honduras (+504)</span>
                      </li>
                      <li>
                        <img src="./assets/images/mexico.png" alt="+52" />
                        <span>México (+52)</span>
                      </li>
                      <li>
                        <img src="./assets/images/nicaragua.png" alt="+505" />
                        <span>Nicaragua (+505)</span>
                      </li>
                      <li>
                        <img src="./assets/images/panama.png" alt="+507" />
                        <span>Panamá (+507)</span>
                      </li>
                      <li>
                        <img src="./assets/images/paraguay.png" alt="+595" />
                        <span>Paraguay (+595)</span>
                      </li>
                      <li>
                        <img src="./assets/images/republica-dominicana.png" alt="+1" />
                        <span>República Dominicana (+1)</span>
                      </li>
                      <li>
                        <img src="./assets/images/uruguay.png" alt="+598" />
                        <span>Uruguay (+598)</span>
                      </li>
                      <li>
                        <img src="./assets/images/venezuela.png" alt="+58" />
                        <span>Venezuela (+58)</span>
                      </li>
  
                      <ol style="border-top: 1px solid black; cursor: pointer;">
                        <img id="otro" src="./assets/images/otro.png" alt="+" />
                        <span>Otro</span>
                      </ol>
                      
                    </ul>
  
                  </div>
  
                  <input name="txtTelMovil" type="tel" id="txtTelMovil" style="position:relative; left:7px; width:96%" maxlength="9" onKeypress="if (event.keyCode < 46 || event.keyCode > 57) event.returnValue = false;" aria-describedby="names-addon"/>
  
                </div>
              </div>
            </div>
            <div class="row">
              <style>
  
                .select {
                  border: none;
                  background: #cce4fc;
                  width: 285px;
                  height: 35px;
                }
  
                @media (max-width: 600px) {
  
                  .select {
  
                    width: 270px;
                  }
                }
              </style>
              <div class="group-control">
                <span class="title">Tamaño de la empresa</span>
                <div  class="row-three">
                  <select class="select" type="text" name="numSusc" id="numSusc" aria-describedby="names-addon">
                    <option disabled selected>Seleccione tamaño</option>
                    <option>Microempresa</option>
                    <option>Pequeña Empresa</option>
                    <option>Mediana Empresa</option>
                    <option>Gran Empresa</option>
                  </select>
                </div>
              </div>
  
              <div class="group-control">
                <span class="title">N° de suscripciones</span>
                <div class="row-three">
                  <div class="icon" id="restaNumber1">-</div>
                  <input name="txtTamEmpresa" class="text-center" type="text" min="0" value="0" id="txtTamEmpresa" aria-describedby="names-addon"/>
                  <div class="icon" id="sumNumber1">+</div>
                </div>
              </div>
            </div>
            <div class="group-control">
              <span>¿Qué objetivo tiene tu equipo?</span>
              <textarea rows="2" id="objEmpresa" name="objEmpresa" onkeypress="return valNombre(event);" maxlength="250" aria-describedby="names-addon"></textarea>
            </div>
            <div class="box-btn">
              <button id="btnSendRequest" type="submit">COMENZAR</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="assets/js/valNombre.js"></script>