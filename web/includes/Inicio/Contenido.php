<?php

if (!isset($_GET['pag'])) {
  $_GET['pag'] = 1;
}

?>

<head>
  <link rel="stylesheet" href="assets/css/home.css" />
</head>
<!-- PANEL -->
<div class="container-fluid div-container-panel">
  <div class="row">
    <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-6 container-panel">
      <div class="container-title-panel">
        <div class="title-panel">
          Bienvenido! <br> <span>EduCalma</span>
        </div>
        <div class="description-panel">
          ¡Impulsa tu aprendizaje junto a los mejores especialistas en EduCalma desde hoy!
        </div>
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
    <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-6 container-panel-image">
      <div class="container-image-panel">
        <div class="image-panel">
          <img src="./assets/images/edu.png" alt="">
        </div>
      </div>
    </div>
  </div>
</div>



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
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
          <div class="card card-cursos">
            <div class="card-image cursos">
              <img src="./assets/images/cur.png" alt="" />
            </div>
            <div class="card-title">
              <p>Cursos</p>
            </div>
            <div class="card-descripti">
              <p>
                Otorgamos cursos calificados para que el alumno aprenda y
                desarrolle nuevas habilidades.
              </p>
            </div>
          </div>
        </div>



        <!--DESARROLLO PERSONAL-->
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
          <div class="card card-desarrollo-personal">
            <div class="card-image desarrollo-personal">
              <img src="./assets/images/curso culminad.png" alt="" />
            </div>
            <div class="card-title">
              <p>Desarrollo Personal</p>
            </div>
            <div class="card-descripti">
              <p>
                Cada tema enseñado será de buena ayuda en los test de cada sesión.
              </p>
            </div>
          </div>
        </div>



        <!--CERTIFICADOS-->
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
          <div class="card card-certificados">
            <div class="card-image certificados">
              <img src="./assets/images/certificad.png" alt="" />
            </div>
            <div class="card-title">
              <p>Certificados</p>
            </div>
            <div class="card-descripti">
              <p>
                Al concluir el curso se les entregará un certificado por todo lo aprendido en cada sesión.
              </p>
            </div>
          </div>
        </div>


      </div>
      <!--Fin de Tres Cards.-->




      <br><br>




      <div class="row">
        <div class="section-button">
          <a href="ListaCursos.php?pag=1" type="button" class="btn btn-primary btnCom">
            Comienza a ver los cursos
          </a>
        </div>
      </div>


    </div>
  </div>
</div>



<!-- CARDS CURSOS -->
<div class="container container-fluid-course">


  <div class="row">
    <div class="col-12">

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

          while($dato=$query->fetch(PDO::FETCH_ASSOC)){
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


        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-4">
          <div class="card destacados">
            <div class="row ">
              <div class="col-4 col-sm-4 col-md-12 col-lg-4 col-xl-4 ">
                <div class="container-image-course">
                  <img class="imgCurso" src="./assets/images/imagen_curso_destacado.png" alt="" />
                </div>
              </div>
              <div class="col-8 col-sm-8 col-md-12 col-lg-8 col-xl-8">

                <h4><?php echo $dato['nombreCurso'];?></h4>
                <h5 style="height: 60px;"><?php echo substr($dato['descripcionCurso'], 0, 70) . "..."; ?></h5>
                <a style="margin-top: 10px; margin-bottom: 10px;" href="#" class="btn btn-success mt-2" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $dato['idCurso'];?>">
                ver información >
                </a>
                
              </div>
            </div>
              <style>
                .destacados:hover{
                  box-shadow: 5px 5px 20px rgba(0,0,0,0.4);
	                transform: translateY(-3%);
                }
              </style>
          </div>
        </div>

        <!-- MODAL -->
<div class="modal fade bd-example-modal-lg<?php echo $dato['idCurso'];?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-xl">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <img src="./assets/images/2232688.png" alt="" width="28px">
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
              <span class="descripcion"><?php echo substr($dato['descripcionCurso'], 0, 500) . "..."; ?></span>
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
        <!-- <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-4">
          <div class="card">
            <div class="row">
              <div class="col-4 col-sm-4 col-md-12 col-lg-4 col-xl-4">
                <div class="container-image-course">
                  <img src="./assets/images/2232688.png" alt="" />
                </div>
              </div>
              <div class="col-8 col-sm-8 col-md-12 col-lg-8 col-xl-8">
                <h4>CURSO DESTACADO1</h4>
                <h5>Lorem ipsum dolor sit amet, consectetur adipiscing ... </h5>
                <a href="#" class="btn btn-success mt-2" data-toggle="modal" data-target=".bd-example-modal-lg">ver
                  informaci&oacute;n ></a>
              </div>
            </div>
          </div>
        </div> -->
        <!-- <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-4">
          <div class="card">
            <div class="row">
              <div class="col-4 col-sm-4 col-md-12 col-lg-4 col-xl-4">
                <div class="container-image-course">
                  <img src="./assets/images/2232688.png" alt="" />
                </div>
              </div>
              <div class="col-8 col-sm-8 col-md-12 col-lg-8 col-xl-8">
                <h4>CURSO DESTACADO1</h4>
                <h5>Lorem ipsum dolor sit amet, consectetur adipiscing ... </h5>
                <a href="#" class="btn btn-success mt-2" data-toggle="modal" data-target=".bd-example-modal-lg">ver
                  informaci&oacute;n ></a>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>
</div>
<!-- EMPRESAS -->
<div class="container-bussines container divEmp">


  <div class="info col-12 mt-5"> <!--/////////////////////////-->

    <h2 class="text-center">Educalma para empresas</h2>
    <br>
    <ul>
      <li style="color:#5FB2EF;"><i class="fas fa-check fa-lg mr-3 " style="color:#7249F3;"></i>Mide y analiza los resultados de tu equipo con nuestro servicio.</li>
      <li style="color:#5FB2EF;"><i class="fas fa-check fa-lg mr-3" style="color:#7249F3;"></i>Acompañamiento y seguimiento por un Ejecutivo de Cuenta.</li>
      <li style="color:#5FB2EF;"><i class="fas fa-check fa-lg mr-3" style="color:#7249F3;"></i>Certificaciones por cada curso del plan completado.</li>
    </ul>
    <div class="box-email">

      <!--span style="position: relative; top: -30px;">Recibe informaci&oacute;n específica para tu empresa</span-->
      
      <!--<div class="input-data">-->

        <!--<input type="email" placeholder="Escribe tu correo empresarial" id="txtEmail" />-->
        <br>
          <button id="btnAction" style="position: relative; background-color:#737BF1; font-weight:bold;">MÁS INFORMACIÓN</button>
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
        <div class="formu">
          <div class="row">
            <div class="group-control">
              <span class="title">Nombre Completo</span><input type="text" id="nomCompleto" />
            </div>
            <div class="group-control">
              <span class="title">Correo electrónico</span><input type="text" id="txtEmail" />
            </div>
          </div>
          <div class="row">
            <div class="group-control">
              <span class="title">Empresa</span><input type="text" id="txtEmpresa" />
            </div>
            <div class="group-control">
              <span class="title">Teléfono móvil</span>
              <div class="row-icon">
                
                <div class="selItem">
                  
                  <div class="btn-select">
                    <div id="btnPais">
                      <img id="imgPais" src="./assets/images/peru.png" style="cursor: pointer;"/>
                    </div>
                    <input type="text" class="code" id="code" value="+51" style="width:120%;" maxlength="4" onKeypress="return ((event.charCode >= 48 && event.charCode <= 57) || event.charCode == 43)" readonly />
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

                <input type="tel" id="txtTelMovil" style="position:relative; left:7px; width:96%" maxlength="15" onKeypress="if (event.keyCode < 46 || event.keyCode > 57) event.returnValue = false;"/>

              </div>
            </div>
          </div>
          <div class="row">
            <!--div class="group-control">
              <span class="title">Tamaño de la empresa</span>
              <div  class="">
              
                <input  class="text-center" type="text" min="0" value="0" name="" id="txtTamEmpresa" onKeypress="if (event.keyCode < 49 || event.keyCode > 57) event.returnValue = false;"/>
                
              </div>
            </div-->
            <div class="group-control">
              <span class="title">Tamaño de la empresa</span>
              <div  class="row-three">
              <div class="icon" id="quitNumber">-</div>
                <input  class="text-center" type="text" min="0" value="0" name="" id="numSusc" onKeypress="if (event.keyCode < 49 || event.keyCode > 57) event.returnValue = false;"/>
                <div class="icon" id="plusNumber">+</div>
              </div>
            </div>

            <div class="group-control">
              <span class="title">N° de suscripciones</span>
              <div class="row-three">
                <div class="icon" id="restaNumber1">-</div>
                <input  class="text-center" type="text" min="0" value="0" name="" id="txtTamEmpresa" onKeypress="if (event.keyCode < 49 || event.keyCode > 57) event.returnValue = false;"/>
                <div class="icon" id="sumNumber1">+</div>
              </div>
            </div>
           </div>
         

          <div class="group-control">
            <span>¿Qué objetivo tiene tu equipo?</span>
            <textarea rows="2" id="objEmpresa"></textarea>
          </div>
          <div class="box-btn">
            <button id="btnSendRequest">COMENZAR</button>
          </div>
        </div>
      </div>
    </div>
  </div>











</div>
<!-- EMPRESAS SHEYLA -->
<!-- <div class="container container-fluid-empresa" style="border: 1px solid red;">
  <div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-8 col-xl-6" style="border: 1px solid red;">
      <div class="line"></div>
      <h2 class="">Educalma para empresas</h2>
      <ul>
        <li><i class="fas fa-check-circle mr-3"></i>Mide y analiza los resultados de tu equipo con nuestro servicio.
        </li>
        <li><i class="fas fa-check-circle mr-3"></i>Acompañamiento y seguimiento por un Ejecutivo de Cuenta.</li>
        <li><i class="fas fa-check-circle mr-3"></i>Certificaciones por cada curso de plan compleado.</li>
      </ul>


      <div class="box-email">
        <span>Recibe informaci&oacute;n específica para tu empresa</span>
        <div class="row mt-2">
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8 mb-2" style="border: 1px solid red;">
            <input type="email" placeholder="Escribe tu correo empresarial" id="txtEmail" />
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4" style="border: 1px solid red;">
            <button id="btnAction">CONOCE MÁS</button>
          </div>


        </div>
        <span class="msg-error">Debe ser un correo corporativo.</span>

      </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" style="border: 1px solid red;">
    <img class="img-fluid" src="./assets/images/empresas.jpg" alt="" />
    </div>
  </div>
</div> -->