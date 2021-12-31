<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="assets/css/cuestionario_formu.css">

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
    <script src="https://kit.fontawesome.com/f9e5248491.js" crossorigin="anonymous"></script>
    <title>Agregar Temas</title>
</head>

<body>

<?php
// Este codigo hace validacion para que no se pueda acceder a cualquier pagina sin estar logueado
    if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
        $idModulo=$_GET['id_mo'];
        $idCurso=$_GET['idCurso'];
?>

            <?php
                require_once '././database/databaseConection.php';
                

                $pdo2 = Database::connect();
                $sql2 = "SELECT * FROM modulo WHERE idModulo='$idModulo'";
                $q2 = $pdo2->prepare($sql2);
                $q2->execute(array());
                $dato2=$q2->fetch(PDO::FETCH_ASSOC)
                //obtener el id por medio del $_GET['id']
                //recorrer la tabla modulo y buscar el idmodulo=$_GET['id']
                //hacer un array y traer el nombre
            ?>

<!-- Nuevo diseño de formulario -->
<div class="container-fluid">
        <!--                    ======================================
                                            Agregar Temas
                                ====================================== 
        -->
        <div class="container" id="contformulario">
            <div class="seccion">
                <div class="row">

                    <!-- primera columna -->
                    <div class="col-3 pr-0 border-right">
                        <ul class="list-group list-group-flush ">
                            <li class="list-group-item border-bottom ">Curso</li>
                        </ul>
                        <!-- seccion agregar temas a un modulo -->
                        <div class="list-group py-3">
                            <button type="button" class="list-group-item list-group-item-action active">
                                Agrega Temas a un Módulo
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
                                <a class="btn btn-outline-secondary btn-back btn-sm" href="agregarModulos.php?id=<?php echo $idCurso=$_GET['idCurso'];?>" role="button">
                                    <i class="fas fa-arrow-left"></i> Atrás
                                </a>
                            </div>
                            <!-- fin seccion otros -->
                        </div>
                    </div>
                    <!-- fin primera columna -->

                    <!-- Segunda columna -->
                    <div class="col-9 pl-0">
                        <!-- form temas -->
                        <form name="formulario" id="form-agretemas2" method="POST" action="includes/tema/checkAgrTema.php?idCurso=<?php echo $idCurso;?>&id_mo=<?php echo $idModulo;?>">
                    
                            <div class="form-row ">
                                <div class="form-group col-md-12">
                                    <h6 class="font-weight-light text-justify" style="color:#495057;">
                                    Agregue Temas al Módulo: "<strong><?php echo $dato2['nombreModulo'];?></strong>"
                                    </h6>
                                </div>
                            </div>

                            <div class="form-row ">

                                <div class="form-group col-md-6 ">
                                    <label class="form-label">Nombre del tema</label>
                                    <input type="text" class="form-control" name="temas_agregar" id="tema-agregar" placeholder="Ingrese un nombre" aria-label="TemaAgr" aria-describedby="temaAgr-addon" required>
                                </div>

                                <div class="form-group col-md-6 ">
                                    <label class="form-label">Link del vídeo</label>
                                    <input type="text" class="form-control" name="link" id="apellidoMat-registro" placeholder="Ingrese un link" aria-label="ApellidosMat" aria-describedby="apellidoMat-addon" required>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-12">
                                    <label class="form-label">Descripción del tema</label>
                                    <textarea class="form-control" placeholder="Añadir descripción" rows="3" id="descripcio-tema" name="descripcio_tema" required></textarea>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-12">
                                    <a>
                                        <button type="submit" class="btn btn-block btn-add">
                                            <i class="fas fa-plus"></i> Agregar
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </form>

                        <form class="pt-0">

                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label class="form-label">Listado de Temas</label>
                                </div>
                            </div>

                            <!-- Listado de Temas -->
                            
                            <div class="scroll">
                                <div class="form-row">

                                    <?php
                                        error_reporting(0);
                                        require_once 'database/databaseConection.php';
                                        $pdo3 = Database::connect();
                                        $sql3= "SELECT *FROM tema WHERE id_modulo= '$idModulo'";
                                        $q3 = $pdo3->prepare($sql3);
                                        $q3 -> execute(array());
                                        Database::disconnect(); 

                                        while($dato3=$q3->fetch(PDO::FETCH_ASSOC)){                                        
                                    ?>

                                    <div class="form-group col-8 col-md-10 col-sm-8 col-lg-10 col-xl-10">
                                        <input type="text" class="form-control" value="<?php echo $dato3['nombreTema'] ?>" aria-label="Recipient's username with two button addons" disabled>
                                    </div>
                                    </form><!--  -->

                                    <!-- boton editar pregunta -->
                                    <div class="form-group col-2 col-md-1 col-sm-2 col-lg-1 col-xl-1">
                                        <a>
                                            <button class="btn btn-block btn-outline-success" type="button" data-toggle="modal" data-target="#ModaleditarTema<?php echo $dato3['idTema']?>">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </a>

                                        <div class="modal fade" id="ModaleditarTema<?php echo $dato3['idTema']?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class= "modal-title">EDITAR TEMA</h6>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    
                                                        <div class="modal-body">
                                                            <div>
                                                                <div class="inputBox">
                                                                    <h4>Edita el Tema: </h4>
                                                    <form name="formulario" id="editando_preguntas" method="POST" action="includes/tema/checkAgrTema.php?idCur=<?php echo $idCurso;?>&id_mod=<?php echo $idModulo;?>" style="background:#F7F7F7;">
                                                                    <input type="text" name="actu_tema" class="form-control" value="<?php echo $dato3['nombreTema'];?>">
                                                                    <input type="text" name="descripcionT" class="form-control" value="<?php echo $dato3['descripcionTema'];?>">
                                                                    <input type="text" name="linkT" class="form-control" value="<?php echo $dato3['link_video'];?>">
                                                                    <input type="hidden" name="idTema" value="<?php echo $dato3['idTema'];?>">
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
                                    </div>

                                    <!-- boton borrar pregunta -->              
                                    <div class="form-group col-2 col-md-1 col-sm-2 col-lg-1 col-xl-1">
                                        <a>
                                            <button class="btn btn-block btn-outline-danger" type="button" data-toggle="modal" data-target="#ModalquitarTema<?php echo $dato3['idTema']?>">
                                            <i class="fas fa-trash-alt"></i></button>
                                        </a>

                                        <div class="modal fade" id="ModalquitarTema<?php echo $dato3['idTema']?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class= "modal-title">ELIMINAR TEMA</h6>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    
                                                    <div class="modal-body"> 
                                                        <center><h4>¿Estas seguro de eliminar este Tema?</h4></center>
                                                        <form name="formulario" id="eliminando_temas" method="POST" action="includes/tema/checkAgrTema.php?idCurs=<?php echo $idCurso;?>&id_mod=<?php echo $idModulo;?>" style="background:#F7F7F7;">
                                                            <input type="text" name="actuali_pregunta" class="form-control" value="<?php echo $dato3['nombreTema'];?>" disabled>
                                                            <input type="hidden" name="idTemas" value="<?php echo $dato3['idTema'];?>">
                                                                
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-secondary cerrar-modal"><i class="fas fa-trash-alt"></i> Si, Eliminar</button>
                                                        <button type="button" class="btn btn-secondary cerrar-modal" data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                        </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <?php 
                                            }
                                        ?>
                                </div>
                                
                            </div>
                            <hr>
                            <!-- fin de Listado de temas -->
                            

                        <!-- fin form temas -->

                        
                    </div>
                    
                    <!-- fin segunda columna -->
                </div>
            </div>
        </div>
    </div>
<!-- fin nuevo formulario -->



    <?php
    }
    else{
                header('Location:iniciosesion.php');
    }
    ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
<script src="assets/js/validarCategoria.js"></script>
</body>
</html>