<?php
   
    if(!isset($_GET['pag'])){
        $_GET['pag']=1;
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
                    <button type="button" class="btn btn_registrar_panel">Registrate!</button>
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
<!-- MODAL -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <img src="./assets/images/2232688.png" alt="" width="28px">
                        <span class="title-modal">Cursos > Categoría ></span>
                        <span class="title-modal">Nombre-Categoría</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="button_close" aria-hidden="true">&times;</span>
                    </div>
                    <!-- col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6"> -->
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="cont_titulos">
                            <h3 class="titulo">LLOREM IPSUM DOLOR</h3>
                            <span class="descripcion">Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sit
                                amet, consectetur adipiscing elit</span>
                            <br><br>
                            <button type="button" class="btn btn-outline-info btn_registrar">
                                <i class="far fa-play-circle"></i>
                                Comienza este curso
                            </button>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <img class="img_nueva" src="./assets/images/_111437543_197389d9-800f-4763-8654-aa30c04220e4.png" alt="" style="max-width: 100%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CARDS BRINDA -->
<div class="container-fluid container-fluid-brida">
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
                            <p>Cursos</p>
                        </div>
                        <div class="card-descripti">
                            <p>
                                Cada tema enseñado será de buena ayuda en los test de cada sesion.
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
                            <p>Cursos</p>
                        </div>
                        <div class="card-descripti">
                            <p>
                                Al concluir el curso se les entregará un certificado por todo lo aprendido en cada sesion.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="section-button">
                    <button type="button" class="btn btn-success">
                        Comienza a ver los cursos
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CARDS CURSOS -->
<div class="container-fluid container-fluid-course">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="section-title">
                    <div class="line"></div>
                    <h2>Cursos destacados</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-4">
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
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-4">
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
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-4">
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
                </div>
            </div>
        </div>
    </div>
</div>
<!-- EMPRESAS -->
<div class="container container-empresas">
    <div class="info-part">
        <div class="line"></div>
        <h2>Educalma para empresas</h2>
        <ul>
            <li><i class="fas fa-check-circle mr-3"></i>Mide y analiza los resultados de tu equipo con nuestro servicio.
            </li>
            <li><i class="fas fa-check-circle mr-3"></i>Acompañamiento y seguimiento por un Ejecutivo de Cuenta.</li>
            <li><i class="fas fa-check-circle mr-3"></i>Certificaciones por cada curso de plan compleado.</li>
        </ul>
        <span>Recibe informaci&oacute;n específica para tu empresa</span>
        <div class="box-email">
            <div class="row">
                <input type="email" placeholder="Escribe tu correo empresarial" id="txtEmail" />
                <button id="btnAction">CONOCE MÁS</button>
            </div>
            <span class="msg-error">Debe ser un correo corporativo.</span>
        </div>
    </div>
    <div class="turn-container">
        <div class="box-rotate" id="boxRotate">
            <div class="front">
                <div class="box-image">
                    <img src="./assets/images/—Pngtree—people make puzzles concept team_5356575.png" alt="" />
                </div>
            </div>
            <div class="back">
                <div class="header">
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
                            <span class="title">Nombre Completo</span><input type="text" name="" id="" />
                        </div>
                        <div class="group-control">
                            <span class="title">Correo electrónico</span><input type="text" name="" id="" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="group-control">
                            <span class="title">Empresa</span><input type="text" name="" id="" />
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
                                <input type="tel" name="" id="" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="group-control">
                            <span class="title">Tamaño de la empresa</span><input type="text" name="" id="" />
                        </div>
                        <div class="group-control">
                            <span class="title">Número de suscripciones</span>
                            <div class="row-three">
                                <div class="icon" id="quitNumber">-</div>
                                <input type="number" min="0" value="0" name="" id="numSusc" />
                                <div class="icon" id="plusNumber">+</div>
                            </div>
                        </div>
                    </div>
                    <div class="group-control">
                        <span>¿Qué objetivo tiene tu equipo?</span>
                        <textarea rows="2"></textarea>
                    </div>
                    <div class="box-btn">
                        <button>COMENZAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
