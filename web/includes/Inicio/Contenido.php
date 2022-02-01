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
          <a href="registroUsuario.php" type="button" class="btn btn_registrar_panel">Regístrate!</a>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-6 container-panel-image">
      <div class="container-image-panel">
        <div class="image-panel">
          <img src="./assets/images/—Pngtree—hand drawn online mobile phone_5341169.png" alt="">
        </div>
      </div>
    </div>
  </div>
</div>

<!-- CARDS BRINDA -->
<div class="container container-fluid-brida">
  <div class="row">
    <div class="col-12">
      <div class="row">
        <div class="section-title">
          <h2>¿Qué te brinda <span>Educalma</span>?</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
          <div class="card">
            <div class="card-image">
              <img src="./assets/images/2000920.png" alt="" />
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
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
          <div class="card">
            <div class="card-image">
              <img src="./assets/images/3966968.png" alt="" />
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
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
          <div class="card">
            <div class="card-image">
              <img src="./assets/images/certificado.png" alt="" />
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
      <br>
      <div class="row">
        <div class="section-button">
          <a href="ListaCursos.php?pag=1" type="button" class="btn btn-primary">
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
      <div class="row">
        <div class="section-title">
          <div class="line"></div>
          <h2>Cursos destacados</h2>
        </div>
      </div>
      <div class="row">
        <?php
          $pdo= Database::connect();
          $sql = 'SELECT * FROM cursos c inner join categorias a on a.idCategoria=c.categoriaCurso where c.permisoCurso=1 ORDER BY idCurso DESC LIMIT 3';
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
          <div class="card">
            <div class="row">
              <div class="col-4 col-sm-4 col-md-12 col-lg-4 col-xl-4">
                <div class="container-image-course">
                  <img src="./assets/images/2232688.png" alt="" />
                </div>
              </div>
              <div class="col-8 col-sm-8 col-md-12 col-lg-8 col-xl-8">

                <h4><?php echo $dato['nombreCurso'];?></h4>
                <h5><?php echo substr($dato['descripcionCurso'], 0, 80) . "..."; ?></h5>
                <a href="#" class="btn btn-success mt-2" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $dato['idCurso'];?>">ver
                  informaci&oacute;n ></a>
              </div>
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
            <img src="./assets/images/2232688.png" alt="" width="28px">
            <span class="title-modal">Cursos > Categoría ></span>
            <!-- <h5><?php //echo $dato['nombreCurso'];?></h5> -->
            <span class="title-modal"><?php echo $dato['nombreCategoria']; ?></span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span class="button_close" aria-hidden="true">&times;</span>
          </div>
          <!-- col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6"> -->
          <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="cont_titulos">
              <h4 class="titulo"><?php echo substr($dato['nombreCurso'], 0, 9) . "...";?></h4>
              <span class="descripcion"><?php echo substr($dato['descripcionCurso'], 0, 100) . "..."; ?></span>
              <br><br>
              <?php
               if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
                 ?>
              <a href="<?php echo $paginaRed ?>.php?id=<?php echo $dato['idCurso']; ?>" type="button" class="btn btn-outline-info btn_registrar">
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
          <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <img class="img_nueva" src="data:image/*;base64,<?php echo base64_encode($dato['imagenDestacadaCurso']); ?>" alt="" style="max-width: 100%;">
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
<div class="container-bussines container">
  <div class="info col-12 my-auto mb-2">
    <div class="line"></div>
    <h2 class="text-center">Educalma para empresas</h2>
    <ul>
      <li><i class="fas fa-check-circle mr-3"></i>Mide y analiza los resultados de tu equipo con nuestro servicio.
      </li>
      <li><i class="fas fa-check-circle mr-3"></i>Acompañamiento y seguimiento por un Ejecutivo de Cuenta.</li>
      <li><i class="fas fa-check-circle mr-3"></i>Certificaciones por cada curso del plan completado.</li>
    </ul>
    <div class="box-email">
      <span>Recibe informaci&oacute;n específica para tu empresa</span>
      <div class="input-data">
        <input type="email" placeholder="Escribe tu correo empresarial" id="txtEmail" />
        <button id="btnAction">CONOCE MÁS</button>
      </div>
      <span class="msg-error">Debe ser un correo corporativo.</span>
    </div>
  </div>
  <div class="send-data col-12 my-auto">
    <div class="box-rotate my-5" id="boxRotate">
      <div class="front w-100">
        <div class="box-image d-flex align-items-center justify-content-center w-100">
          <img class="img-fluid" src="./assets/images/—Pngtree—people make puzzles concept team_5356575.png" alt="" />
        </div>
      </div>
      <div class="back">
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
              <span class="title">Correo electrónico</span><input type="text" id="txtCorreo" />
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
                  <div class="btn-select" id="btnPais">
                    <img id="imgPais" src="./assets/images/peru.png" alt="+51" />
                    <input type="text" class="code" id="code" value="+51" readonly />
                  </div>
                  <ul class="sel" id="listPais">
                    <li>
                      <img src="./assets/images/peru.png" alt="+51" />
                      <span>Perú (+51)</span>
                    </li>
                    <li>
                      <img src="./assets/images/estados-unidos.png" alt="+1" />
                      <span>Estados Unidos (+1)</span>
                    </li>
                  </ul>
                </div>
                <input type="tel" id="txtTelMovil" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="group-control">
              <span class="title">Tamaño de la empresa</span><input type="text" id="txtTamEmpresa" />
            </div>
            <div class="group-control">
              <span class="title">N° de suscripciones</span>
              <div class="row-three">
                <div class="icon" id="quitNumber">-</div>
                <input type="number" min="0" value="0" name="" id="numSusc" />
                <div class="icon" id="plusNumber">+</div>
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