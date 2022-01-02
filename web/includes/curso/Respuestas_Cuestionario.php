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
    <title>Cuestionario - respuestas</title>
</head>

<body>

<?php
    if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
?>
    
<!--Contenido del cuestionario-->

<?php
    $id_pregunta=$_GET['id_pregunta'];
    $pregunta=$_GET['pregunta'];
?>

<!-- Nuevo form -->

<?php $idmodulo=$_GET['id_modulo'];?>

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
                                Cuestionario de Respuestas
                            </button>
                            <!-- seccion otros -->
                            <ul class="list-group list-group-flush py-3">
                                <li class="list-group-item border-top-0" style="color:#495057;">Otros</li>
                            </ul>
                            <div class="list-group lista2 text-left">
                                <!-- <a href="sidebarCursos.php" class="list-group-item list-group-item-action">
                                    <i class="fas fa-book"></i> Mis Cursos
                                </a> -->
                                <a href="editarcurso.php?id=<?php echo $_GET['id'] ?>" class="list-group-item list-group-item-action">
                                <i class="fas fa-pencil-alt"></i> Editar curso
                                </a>

                        <a href="agregarModulos.php?id=<?php echo $_GET['id_modulo']; ?>" class="list-group-item list-group-item-action">
                                    <i class="fas fa-plus-square"></i> Agregar Modulos
                                </a>
                                <!-- <a href="ListaCursos.php?pag=1" class="list-group-item list-group-item-action">
                                    <i class="fas fa-eye"></i> Ver todos los Cursos
                                </a> -->
                                <button typer="button" id="salir_public" class="list-group-item list-group-item-action" style="cursor: pointer">
                                    <i class="fad fa-books"></i> Publicar cursos
                                </button>
                                <a class="btn btn-outline-secondary btn-back btn-sm" href="Form_pregun_cuestionario.php?id=<?php echo $_GET['id']; ?>&id_modulo=<?php echo $idmodulo=$_GET['id_modulo'];?>" role="button">
                                    <i class="fas fa-arrow-left"></i> Atrás
                                </a>
                            </div>

                            <!-- fin seccion otros -->
                        </div>
                    </div>
                    <!-- fin primera columna -->

                    <!-- segunda columna -->
                    <div class="col-9 pl-0">
                        <form id="respuestas_cuestionario" action="includes/Pregunta_Respuesta/Respuesta_CRUD.php?id=<?php echo $_GET['id'] ?>&id_modulo=<?php echo $idmodulo;?>" method="POST" enctype="multipart/form-data">
                    
                            <div class="form-row ">
                                <div class="form-group col-md-12">
                                    <h5 class="font-weight-light text-justify" style="color:#495057;">
                                    Agregue Respuestas a su Pregunta
                                    </h5>
                                </div>
                            </div>

                            <div class="form-row ">
                                <div class="form-group col-md-12">
                                    <label class="form-label">Respuesta</label>
                                    <textarea type="text"  class="form-control" name="respuesta" placeholder="Ingrese una respuesta" minlength="3" rows="3" required></textarea>
                                        <div>
                                            <input type="hidden" class="form-control" name="idpregunta" value="<?php echo $id_pregunta;?>">
                                        </div>
                                        <div>
                                            <input type="hidden" class="form-control" name="pregunta" value="<?php echo $pregunta;?>">
                                        </div>
                                </div>
                            </div>
                            
                            <div class="form-row ">
                                <div class="form-group col-md-12">
                                    <a>
                                        <button class="btn btn-block btn-add" type="submit"><i class="fas fa-plus"></i> Añadir</button>
                                    </a>
                                </div>
                            </div>
                        </form>  
                        <form class="pt-0">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="form-label">Listado de Respuestas</label>
                                </div>
                            </div>

                            <!-- lista de preguntas - codigo php -->
                            <!-- <div class="overflow-auto"> -->
                            
                            <div class="scroll">
                                <div class="form-row">

                                    <?php
                                        require_once 'database/databaseConection.php';
                                        $pdo = Database::connect();
                                        $sql = "SELECT * FROM cuestionario WHERE id_modulo='$idmodulo'";
                                        $q = $pdo->prepare($sql);
                                        $q->execute(array());
                                        $registro = $q->fetch(PDO::FETCH_ASSOC);
                                        Database::disconnect();

                                        $pdo1 = Database::connect();
                                        $sql1 = "SELECT * FROM respuestas WHERE id_Pregunta='$id_pregunta'";
                                        $q1 = $pdo1->prepare($sql1);
                                        $q1->execute(array());
                                        Database::disconnect();
                                    ?>
                                    
                                    <?php while($registro1 = $q1->fetch(PDO::FETCH_ASSOC)){?>

                                    <div class="form-group col-8 col-md-10 col-sm-8 col-lg-10 col-xl-10">
                                        <input type="text" value="<?php echo $registro1['respuesta'];?>" class="form-control" disabled>
                                    </div>
                        </form>

                                    <!-- boton editar pregunta -->
                                    <div class="form-group col-2 col-md-1 col-sm-2 col-lg-1 col-xl-1">
                                        <!-- <a class="btn btn-block btn-outline-success" data-toggle="modal" data-target="#ModaleditarResp<?php echo $registro1['idRespuesta']?>">
                                            <i class="far fa-edit"></i>
                                        </a> -->
                                        <a>
                                            <button class="btn btn-block btn-outline-success" type="button" data-toggle="modal" data-target="#ModaleditarResp<?php echo $registro1['idRespuesta']?>">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </a>

                                        <div class="modal fade" id="ModaleditarResp<?php echo $registro1['idRespuesta']?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class= "modal-title">EDITAR RESPUESTA</h6>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    
                                                        <div class="modal-body">
                                                            <div>
                                                                <div class="inputBox">
                                                                    <h4>Edita la respuesta: </h4>
                                                    <form name="formulario" id="editando_preguntas" method="POST" action="includes/Pregunta_Respuesta/Respuesta_CRUD.php?id=<?php echo $_GET['id'] ?>&id_modulo=<?php echo $idmodulo;?>" style="background:#F7F7F7;">
                                                                    <input type="text" name="actu_respuesta" class="form-control" id="" value="<?php echo $registro1['respuesta'];?>">
                                                                    <input type="hidden" name="idrespuesta" value="<?php echo $registro1['idRespuesta'];?>">
                                                                    <input type="hidden" name="pregunta" value="<?php echo $pregunta;?>">
                                                                    <input type="hidden" name="idpregunta" value="<?php echo $id_pregunta;?>">
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
                                        <!-- <a class="btn btn-block btn-outline-danger" data-toggle="modal" data-target="#ModalquitarResp<?php echo $registro1['idRespuesta']?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </a> -->
                                        <a>
                                            <button class="btn btn-block btn-outline-danger" type="button" data-toggle="modal" data-target="#ModalquitarResp<?php echo $registro1['idRespuesta']?>">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </a>

                                        <div class="modal fade" id="ModalquitarResp<?php echo $registro1['idRespuesta']?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class= "modal-title">ELIMINAR RESPUESTA</h6>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    
                                                        <div class="modal-body">
                                                            <div>
                                                                <div class="inputBox">
                                                                    <center><h4>¿Estas seguro de eliminar esta respuesta? </h4></center>
                                                    <form name="formulario" id="eliminando_respuestas" method="POST" action="includes/Pregunta_Respuesta/Respuesta_CRUD.php?id=<?php echo $_GET['id'] ?>&id_resp=<?php echo $registro1['idRespuesta'];?>&id_modulo=<?php echo $idmodulo;?>&id_pregunta=<?php echo $id_pregunta?>&pregunta=<?php echo $pregunta;?>">
                                                                    <input type="text" name="actu_respuesta" class="form-control" id="" value="<?php echo $registro1['respuesta'];?>" disabled>
                                                                    <input type="hidden" name="id_resp" value="<?php echo $registro1['idRespuesta'];?>">
                                                                    <input type="hidden" name="pregunta" value="<?php echo $pregunta;?>">
                                                                    <input type="hidden" name="id_pregunta" value="<?php echo $id_pregunta;?>">
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
                                    </div>

                                    <?php }?>

                                </div>
                            </div>
                            <hr>
                            <!-- fin lista de preguntas -->
                        
                        
                        
                        <div class="row">
                            <div class="col-12">
                                <form action="includes/tema/checkAgrTema.php?id=<?php echo $_GET['id']?>&idpregunta=<?php echo $id_pregunta;?>&id_modulo=<?php echo $idmodulo;?>&pregunta=<?php echo $pregunta;?>" class="pt-0" method="POST">
                            
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <h5 class="font-weight-light text-justify" style="color:#495057;">
                                            Elija la respuesta correcta
                                            </h5>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-8 col-xs-8 col-md-9 col-sm-8 col-lg-10 col-xl-10">
                                            <select class="form-control" name="respu_correcta" id="inputGroupSelect04" aria-label="Example select with button addon">
                                                <option value="" selected="" disabled="">Seleccionar</option>

                                                <?php
                                                $pdo2 = Database::connect();
                                                $sql2 = "SELECT * FROM respuestas WHERE id_Pregunta='$id_pregunta'";
                                                $q2 = $pdo2->prepare($sql2);
                                                $q2->execute(array());
                                                Database::disconnect();
                                                while($registro2 = $q2->fetch(PDO::FETCH_ASSOC)){
                                                ?>

                                                
                                                <option value="<?php echo $registro2['idRespuesta'];?>">
                                                
                                                <?php echo $registro2['respuesta'];?>
                                            
                                                </option>

                                                <?php }?>

                                            </select>
                                        </div>

                                        <div class="form-group col-4 col-xs-4 col-md-3 col-sm-4 col-lg-2 col-xl-2">
                                            <button class="btn btn-block btn-primary text-white" type="submit">Correcto
                                            </button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <!-- fin segunda columna -->
                </div>
            </div>
        </div>
    </div>
<!-- FIN Nuevo form -->



<?php
    }
    else{
                header('Location:iniciosesion.php');
    }
?>
<!-- Validaciones Autor:Jorge Martinez-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
<script src="assets/js/validarCategoria.js"></script>
<script src="assets/js/plugins/sweetalert2.all.min.js"></script>
<script src="assets/js/validarModulo.js"></script>
</body>
</html>