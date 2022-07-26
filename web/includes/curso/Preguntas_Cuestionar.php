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
    <title>Cuestionario - preguntas</title>
</head>

<body>

<?php
    if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
?>

<!-- Nuevo form -->

<?php $idmodulo=$_GET['id_modulo'];?>
<div class="container-fluid">
        <div class="container" id="contformulario">
            <div class="seccion">
                <div class="row">













                     <!-- primera columna -->
                     <div class="col-3 pr-0 border-right">
                        <!--ul class="list-group list-group-flush ">
                            <li class="list-group-item border-bottom ">Curso</li>
                        </ul-->
                        <!-- seccion agregar modulo -->
                        <div class="list-group">
                            
                            <!-- seccion otros -->
                            <!--ul class="list-group list-group-flush py-3">
                                <li class="list-group-item border-top-0" style="color:#495057;">Componentes del curso</li>
                            </ul-->

                            <div class="list-group lista2 text-left">
                                <a href="editarcurso.php?id=<?php echo $_GET['id']?>" class="btn btn-outline-secondary btn-back btn-sm" style="">
                                    <i class="fas fa-pencil-alt"></i> Editar datos del curso
                                </a>

                                <!--
                                <a href="agregarModulos.php?id=<?php echo $_GET['id'] ?>" class="btn btn-outline-secondary btn-back btn-sm" style="position: relative; top: -50px;">
                                        <i class="fas fa-plus-square"></i> Agregar módulos y/o temas
                                </a>
                                -->

                                    <!-- <a href="sidebarCursos.php" class="list-group-item list-group-item-action">
                                        <i class="fas fa-book"></i> Mis Cursos
                                    </a> -->
                                    <!-- <a href="ListaCursos.php?pag=1" class="list-group-item list-group-item-action">
                                        <i class="fas fa-eye"></i> Ver todos los Cursos
                                    </a> -->
                                <button typer="button" id="salir_public" class="btn btn-outline-secondary btn-back btn-sm" style="cursor: pointer; position: relative; top: -50px;">
                                    <i class="fad fa-books"></i> Ver lista de cursos <br> No publicados
                                </button>
                                <a class="btn btn-outline-secondary btn-back btn-sm" style="cursor: pointer;" href="agregarModulos.php?id=<?php echo $id=$_SESSION['ids'];?>" role="button">
                                    <i class="fas fa-arrow-left"></i> Atrás
                                </a>
                            </div>

                            <!-- fin seccion otros -->
                        </div>
                    </div>
                    <!-- fin primera columna -->




















                    <!-- segunda columna -->
                    <div class="col-9 pl-0">
                        <form id="preguntas_cuestionario" action="includes/Pregunta_Respuesta/Pregunta_CRUD.php?id=<?php echo $_GET['id']; ?>&id_modulo=<?php echo $idmodulo;?>" method="POST">
            
                            <button type="button" class="list-group-item list-group-item-action active" style="background: #4F52D6; text-align: center; font-size: 24px;">
                                Registro de preguntas para el cuestionario del módulo:
                            </button>
                          

                            <div class="form-row" style="position: relative; top: 20px;">
                                <div class="form-group col-12">
                                    <label class="form-label">Pregunta</label>
                                    <textarea style="" type="text" name="pregunta" class="form-control" placeholder="Ingrese una pregunta" rows="3" minlength="3" required></textarea>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <a>
                                        <button style="background-color: #74F077; position: relative; top: 10px;" class="btn btn-block btn-add" type="submit"><i class="fas fa-plus"></i> Añadir</button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    
                    
                        <form style="border: #4F52D6 2px solid; border-radius: 5px;" class="pt-0">
                            <div class="form-row">
                                <div class="form-group col-12" style="position: relative; top: 10px; text-align: center;">
                                    <label style="font-size: 24px;" class="form-label">Preguntas del cuestionario del módulo:</label>
                                </div>
                            </div>
                    
                            <!-- lista de preguntas - codigo php -->
                            <!-- <div class="overflow-auto"> -->
                            <div>
                                <div class="form-row">

                                    <?php
                                        error_reporting(0);
                                        require_once 'database/databaseConection.php';
                                        $pdo = Database::connect();
                                        $sql = "SELECT * FROM cuestionario WHERE id_modulo='$idmodulo'";
                                        $q = $pdo->prepare($sql);
                                        $q->execute(array());
                                        $registro = $q->fetch(PDO::FETCH_ASSOC);
                                        Database::disconnect();

                                        $pdo1 = Database::connect();
                                        $sql1 = "SELECT * FROM preguntas WHERE id_cuestionario='$registro[idCuestionario]'";
                                        $q1 = $pdo1->prepare($sql1);
                                        $q1->execute(array());
                                        Database::disconnect();
                                        while($registro1 = $q1->fetch(PDO::FETCH_ASSOC)){
                                    ?>

                                    <div class="form-group col-8 col-md-7 col-sm-9 col-lg-7 col-xl-8">
                                        <input type="text" value="Pregunta: <?php echo $registro1['pregunta'];?>" class="form-control" disabled>
                                    </div>

                                    <!-- boton agregar respuesta -->
                                    <div class="form-group col-2 col-md-3 col-sm-1 col-lg-3 col-xl-2">
                                        <a style="background-color: #74F077;" class="btn btn-block btn-add" href="Form_respue_cuestionario.php?id=<?php echo $_GET['id']; ?>&id_pregunta=<?php echo $registro1['idPregunta']?>&id_modulo=<?php echo $idmodulo;?>&pregunta=<?php echo $registro1['pregunta']?>">
                                            <i class="fas fa-plus-square"></i> Respuesta
                                        </a>
                                    </div>
                                    
                                    <!-- boton editar pregunta -->
                                    <a class="form-group col-1 col-md-1 col-sm-1 col-lg-1 col-xl-1">
                                        <button class="btn btn-block btn-outline-success" type="button" data-toggle="modal" data-target="#ModaleditarPregun<?php echo $registro1['idPregunta']?>">
                                        <i class="far fa-edit"></i></button>
                                    </a>

                                    <!-- boton borrar pregunta -->
                                    <a class="form-group col-1 col-md-1 col-sm-1 col-lg-1 col-xl-1">
                                        <button class="btn btn-block btn-outline-danger" type="button" data-toggle="modal" data-target="#ModalquitarPregun<?php echo $registro1['idPregunta']?>">
                                        <i class="fas fa-trash-alt"></i></button>
                                    </a>
                        </form>
                        
                            <!-- Modal de Editar Pregunta -->
                            <div class="modal fade" id="ModaleditarPregun<?php echo $registro1['idPregunta']?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h6 class= "modal-title">EDITAR PREGUNTA</h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form name="formulario" class="p-0 bg-transparent" id="editando_preguntas" method="POST" action="includes/Pregunta_Respuesta/Pregunta_CRUD.php?id=<?php echo $_GET['id']; ?>&id_modulo=<?php echo $registro['id_modulo'];?>" >
                                            <div class="modal-body px-4">
                                                <h6>Edita la pregunta: </h6>
                                                    <input type="text" name="actuali_pregunta" class="form-control" value="<?php echo $registro1['pregunta'];?>">
                                                    <input type="hidden" name="id_pregunta" value="<?php echo $registro1['idPregunta'];?>">
                                            </div>
                                                
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-add"><i class="fas fa-redo"></i> Actualizar</button>
                                                <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal de Borrar Pregunta -->
                            <div class="modal fade" id="ModalquitarPregun<?php echo $registro1['idPregunta']?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h6 class= "modal-title">ELIMINAR PREGUNTA</h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                            
                                        <form name="formulario" class="p-0 bg-transparent" id="elimando_pregunta" method="POST" action="includes/Pregunta_Respuesta/Pregunta_CRUD.php?id=<?php echo $_GET['id']?>&id_modulo=<?php echo $idmodulo;?>&id_pregunta=<?php echo $registro1['idPregunta']?>">   
                                            <div class="modal-body px-4"> 
                                                <center><h6>¿Estas seguro de eliminar esta pregunta?</h6></center>
                                                <input type="text" name="actuali_pregunta" class="form-control" value="<?php echo $registro1['pregunta'];?>" disabled>
                                                    <input type="hidden" name="id_pregunta" value="<?php echo $registro1['idPregunta'];?>">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-add"><i class="fas fa-trash-alt"></i> Sí, Eliminar</button>
                                                <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                
                            <?php }?>

                    </div>
                </div>
                    <!-- fin lista de preguntas -->
                        
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