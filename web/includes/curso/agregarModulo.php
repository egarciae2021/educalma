<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/agretemas.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/js/plugins/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
    </script>
    <style>
         label.error{
    	color: red;
        font-style: italic;
        font-size: 13px;    
        max-width:400px;
        padding: 10px;
        margin:0;
        }
    </style>
    <title>Módulo</title>
</head>

<body>
<?php
// Este codigo hace validacion para que no se pueda acceder a cualquier pagina sin estar logueado

 if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
?>
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="titlemc">
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>

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

<div class="container-fluid">
        <div class="title">
            <?php
                    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $envio=substr($url, strrpos($url, '=') + 1);
                    $_SESSION['ids']=$envio;
                    ?>
        </div>
 </div>

<div class="container-contformulario">
    <div class="contformulario" id="contformulario">
        <div class="row">
             <!--
                                        ======================================
                                                    Agregar Módulo
                                        ======================================
                                         
            -->
            <form name="formulario" id="form-agretemas" method="POST" action="includes/modulo/Modulo_CRUD.php?id=<?php echo $dato['idCurso'];?>" style="background:#F7F7F7;">   

                    <a href="agregarcurso.php" class="boton2" style="padding: .3rem; width: 20%;">Atras <-</a>
                <div class="container-fluid">
                    <div class="title">
                        <div class="mb-4">
                            <center>Agrega Módulos a un Curso</center>
                        </div>
                    </div>
                </div>
                <div class="inputBox">
                    <h3 class="cambio-enlinea">Nombre del Módulo:</h3>
                    <div class="btn-ver" style="text-align: right;">
                        <button type="button" class="btn btn-outline-secondary boton-ver"  data-toggle="modal" data-target="#staticBackdrop">
                            <i class="fas fa-eye"></i> Ver</button>
                    </div>
                    <input type="text" name="modulo_agregar" id="modulo-agregar" placeholder="" aria-label="ModuloAgr" aria-describedby="ModuloAgr" aria-describedby="moduloAgr-addon" required>
                </div>
                <div class="inputBox">
                    <button class="boton1"><i class="fas fa-plus"></i> Añadir</buton>
                    <button type="button" id="salir_agregar" class="boton2"><i class="fas fa-sign-out-alt"></i> Finalizar</buton>
                </div>
            </form>
            <div class="image">
                <img src="./assets/images/card_02.jpg" alt="">
            </div>
            <div class="image2">
                <img src="./assets/images/card_01.jpg" alt="">
            </div>
        </div>
    </div>
</div>
</div>
                <!--
                Modal listado de modulo
                -->

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
                                <div style="height: 400px;">
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

                                        <div class="mb-3">
                                            <input type="text" class="form-control" value="Módulo: <?php echo $dato2['nombreModulo']?>" aria-label="Recipient's username with two button addons" disabled>

                                            <!--agregar temas-->
                                         <div class="caja-opciones">
                                                <a
                                                    href="agregartema.php?id_mo=<?php echo $dato2['idModulo']?>&idCurso=<?php echo $_GET['id']?>">
                                                    <button style="font-size: 10px;" class="btn btn-outline-secondary btn-modulos" type="submit">
                                                    <i class="fas fa-plus"></i> Agregar Tema</button>
                                                </a>
                                                <!--quitar modulos-->
                                                <a
                                                    href="includes/modulo/Modulo_CRUD.php?id_modulo=<?php echo $dato2['idModulo']?>&id_curso=<?php echo $_GET['id']?>">
                                                    <button style="font-size: 10px;" class="btn btn-outline-secondary btn-modulos" type="button">
                                                    <i class="fas fa-trash"></i> Quitar Módulo</button>
                                                </a>
                                                <!--editar modulo-->
                                                <a
                                                    href="editarModulo.php?id_modulo=<?php echo $dato2['idModulo']?>&id_curso=<?php echo $_GET['id']?>">
                                                    <button style="font-size: 10px;" class="btn btn-outline-secondary btn-modulos" type="button">
                                                    <i class="fas fa-edit"></i> Editar Módulo</button>
                                                </a>
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
