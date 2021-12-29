<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/agretemas.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="assets/js/plugins/sweetalert2.min.css">

    <style>
        label.error{
    	color: crimson;
        font-style: normal;
        font-size: 16px;
        padding-top: 5px;
        /* max-width:300px; 
        padding: 10px;*/
        margin:0;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
    </script>

    <title>Agregar Módulo</title>
</head>

<body>

    <?php
    // Este codigo hace validacion para que no se pueda acceder a cualquier pagina sin estar logueado
    if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
    ?>

    <?php
    require_once '././database/databaseConection.php';
    $_GET['id'];
    $pdo = Database::connect();
    $sql = "SELECT * FROM cursos WHERE idCurso='$_GET[id]'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $dato=$q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
    ?>
    
    <div>
            <?php
                    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $envio=substr($url, strrpos($url, '=') + 1);
                    $_SESSION['ids']=$envio;
            ?>
    </div>

<!-- Nuevo form -->
    <div class="container-fluid">
        <div class="container" id="contformulario">
            <div class="seccion">
                <div class="row">

                     <!-- primera columna -->
                     <div class="col-3 pr-0 border-right">
                        <ul class="list-group list-group-flush ">
                            <li class="list-group-item border-bottom ">Curso</li>
                        </ul>
                        <!-- seccion agregar modulo -->
                        <div class="list-group py-3">
                            <button type="button" class="list-group-item list-group-item-action active">
                                Agregar un Módulo
                            </button>
                            <!-- seccion otros -->
                            <ul class="list-group list-group-flush py-3">
                                <li class="list-group-item border-top-0" style="color:#495057;">Otros</li>
                            </ul>

                            <div class="list-group lista2 text-left">
                                <a href="sidebarCursos.php" class="list-group-item list-group-item-action">
                                    <i class="fas fa-book"></i> Mis Cursos
                                </a>
                                <a href="ListaCursos.php?pag=1" class="list-group-item list-group-item-action">
                                    <i class="fas fa-eye"></i> Ver todos los Cursos
                                </a>
                                <a href="publicarcursos.php?pag=1" class="list-group-item list-group-item-action">
                                    <i class="fad fa-books"></i> Publicar cursos
                                </a>
                                <a class="btn btn-outline-secondary btn-back btn-sm" href="agregarcurso.php" role="button">
                                    <i class="fas fa-arrow-left"></i> Atrás
                                </a>
                            </div>

                            <!-- fin seccion otros -->
                        </div>
                    </div>
                    <!-- fin primera columna -->

                    <!-- segunda columna -->
                    <div class="col-9 pl-0">
                        
                        <!--                        =====================================
                                                                Agregar Módulo
                                                    =====================================
                        -->
                        <form name="formulario" id="form-agretemas" method="POST" action="includes/modulo/Modulo_CRUD.php?id=<?php echo $dato['idCurso'];?>" style="background:#F7F7F7;">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <h5 class="font-weight-light" style="color:#495057;">
                                    Agregue módulos a su Curso
                                    </h5>
                                </div>
                            </div>

                            <div class="form-row pb-3">
                                <div class="form-group col-8 col-xl-10 col-lg-10">
                                    <label class="form-label">Nombre del módulo</label>
                                    <input type="text" class="form-control" name="modulo_agregar" id="modulo-agregar" placeholder="Ingrese un nombre" aria-label="ModuloAgr" aria-describedby="ModuloAgr" aria-describedby="moduloAgr-addon" minlength="2" required>
                                </div>
                                
                                <div class="form-group col-4 col-xl-2 col-lg-2" >
                                    <label class="form-label" style="color:transparent;">-</label>
                                    <br>
                                    <a class="btn btn-block btn-primary text-white" type="button" role="button" data-toggle="modal" data-target="#staticBackdrop">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                </div>
                            </div>
                            
                            <div class="form-row ">
                                <div class="form-group col-6 col-md-6 ">
                                    <button class="btn btn-block btn-add">
                                    <i class="fas fa-plus"></i> Añadir
                                    </button>
                                </div>

                                <div class="form-group col-6 col-md-6 ">
                                    <button type="button" id="salir_agregar" class="btn btn-block btn-dark">
                                    <i class="fas fa-sign-out-alt"></i> Finalizar
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <!-- fin segunda columna -->
                </div>
            </div>
        </div>
    </div>
<!-- FIN Nuevo form -->



<!-- Modal listado de modulo -->

              <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                   tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">LISTADO DE MÓDULOS</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div style="height: 400px; overflow:auto;">
                                    <div>
                                        <?php

                                    require_once '././database/databaseConection.php';
                                    $_GET['id'];
                                    $pdo2 = Database::connect();
                                    $sql2 = "SELECT * FROM modulo WHERE id_curso='$_GET[id]'";
                                    $q2 = $pdo2->prepare($sql2);
                                    $q2->execute(array());

                                    while($dato2=$q2->fetch(PDO::FETCH_ASSOC)){

                                        $pdo3 = Database::connect();
                                        $idd = $dato2['idModulo'];
                                        $sql3 = "SELECT * FROM tema WHERE id_modulo='$idd'";
                                        $q3 = $pdo3->prepare($sql3);
                                        $q3->execute(array());

                                    ?>

                                        <div>
                                            <input type="text" class="form-control" value="Módulo: <?php echo $dato2['nombreModulo']?>" aria-label="Recipient's username with two button addons" disabled>

                                            <!--agregar temas-->
                                         <div class="caja-opciones">
                                                <a
                                                    href="agregartema.php?id_mo=<?php echo $dato2['idModulo']?>&idCurso=<?php echo $_GET['id']?>">
                                                    <button style="font-size: 10px;" class="btn btn-outline-secondary btn-modulos" type="submit">
                                                    <i class="fas fa-plus"></i> Agregar Tema</button>
                                                </a>
                                                <!--quitar modulos-->
                                                
                                                <a>
                                                    <button style="font-size: 10px;" class="btn btn-outline-secondary btn-modulos" type="button" data-toggle="modal" data-target="#ModalquitarModulo<?php echo $dato2['idModulo'];?>">
                                                    <i class="fas fa-edit"></i> Quitar Módulo</button>
                                                </a>
                                                <div class="modal fade" id="ModalquitarModulo<?php echo $dato2['idModulo'];?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h6 class= "modal-title">QUITAR MÓDULO</h6>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form name="formulario" id="form-agretemas5" action="includes/modulo/Modulo_CRUD.php?id_modulo=<?php echo $dato2['idModulo']?>&id_curso=<?php echo $_GET['id']?>" target="dummyframe" method="POST">   
                                                                <div class="modal-body">
                                                                        <div>
                                                                            <div>
                                                                            
                                                                                <div class="inputBox">
                                                                                    <center><h4>¿Estas seguro de eliminar este modulo?</h4></center>
                                                                                    <input type="text" class="form-control" value="<?php echo $dato2['nombreModulo'];?>" aria-label="ModuloAgr" disabled>
                                                                                    <input type="hidden" name="idmodulo" value="<?php echo $dato2['idModulo'];?>">
                                                                                </div>
                                                                            
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-secondary cerrar-modal"><i class="fas fa-trash-alt"></i> Si, Eliminar</button>
                                                                    <button type="button" class="btn btn-secondary cerrar-modal" data-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!--editar modulo-->
                                                
                                                <a>
                                                    <button style="font-size: 10px;" class="btn btn-outline-secondary btn-modulos" type="button" data-toggle="modal" data-target="#ModalEditarModulo<?php echo $dato2['idModulo'];?>">
                                                    <i class="fas fa-edit"></i> Editar Módulo</button>
                                                </a>
                                                <div class="modal fade" id="ModalEditarModulo<?php echo $dato2['idModulo'];?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h6 class= "modal-title">EDITAR MÓDULO</h6>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form name="formulario" id="form-agretemas3" action="includes/modulo/Modulo_CRUD.php?id=<?php echo $dato2['id_curso'];?>" target="dummyframe" method="POST">   
                                                                <div class="modal-body">
                                                                        <div>
                                                                            <div>
                                                                            
                                                                                <div class="inputBox">
                                                                                    <center><h4>Renombrar Módulo:</h4></center>
                                                                                    <input type="text" class="form-control" name="actu_nomb_agregar" id="actu-nomb-agregar" value="<?php echo $dato2['nombreModulo'];?>" 
                                                                                    placeholder="" aria-label="ModuloAgr" aria-describedby="moduloAgr-addon" required>
                                                                                    <input type="hidden" name="idmodulo" value="<?php echo $dato2['idModulo'];?>">
                                                                                </div>
                                                                            
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-secondary cerrar-modal"><i class="fas fa-redo"></i> Actualizar</button>
                                                                    <button type="button" class="btn btn-secondary cerrar-modal" data-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--agregar cuestionario-->
                                                <a
                                                    href="Form_pregun_cuestionario.php?id_modulo=<?php echo $dato2['idModulo']?>">
                                                    <button style="font-size: 10px;" class="btn btn-outline-secondary btn-modulos" type="button">
                                                    <i class="fas fa-plus"></i> Agregar Cuestionario</button>
                                            </a>
                                         </div>
                                        </div>

                                        <?php 
                                        } 
                                        Database::disconnect(); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary cerrar-modal" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    }
    else{
                header('Location:iniciosesion.php');
    }
    ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
<script src="assets/js/plugins/sweetalert2.all.min.js"></script>
<script src="assets/js/validarCategoria.js"></script>
<script src="assets/js/validarModulo.js"></script>

</body>
</html>
