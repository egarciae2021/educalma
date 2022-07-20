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
        .form-group .error{
            color: crimson;
            font-style: normal;
            font-size: 16px;
            padding-top: 5px;
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
                        <!--ul class="list-group list-group-flush ">
                            <li class="list-group-item border-bottom ">Curso</li>
                        </ul-->
                        <!-- seccion agregar temas a un módulo -->
                        <div class="list-group">
                            
                            <!-- seccion otros -->
                            <!--ul class="list-group list-group-flush py-3">
                                <li class="list-group-item border-top-0" style="color:#495057;">Otros</li>
                            </ul-->
                            <div class="list-group lista2 text-left">

                                <!-- <a href="sidebarCursos.php" class="list-group-item list-group-item-action">
                                    <i class="fas fa-book"></i> Mis Cursos
                                </a> -->

                                <!--
                                <a href="editarcurso.php?id=<?php echo $_GET['idCurso']; ?>" class="btn btn-outline-secondary btn-back btn-sm" style="">
                                    <i class="fas fa-pencil-alt"></i> Editar datos del curso
                                </a>
                                -->

                                <!--
                                <a href="agregarModulos.php?id=<?php echo $_GET['idCurso']; ?>" class="btn btn-outline-secondary btn-back btn-sm" style="position: relative; top: -50px;">
                                    <i class="fas fa-plus-square"></i> Agregar módulos al curso
                                </a>
                                -->

                                <!-- <a href="ListaCursos.php?pag=1" class="list-group-item list-group-item-action">
                                    <i class="fas fa-eye"></i> Ver todos los Cursos
                                </a> -->

                                <!--
                                <button typer="button" id="salir_public" class="btn btn-outline-secondary btn-back btn-sm" style="cursor: pointer; position: relative; top: -100px;">
                                    <i class="fad fa-books"></i> Ver cursos no publicados
                                </button>
                                -->

                                <a style="cursor: pointer;" class="btn btn-outline-secondary btn-back btn-sm" href="agregarModulos.php?id=<?php echo $idCurso=$_GET['idCurso'];?>" role="button">
                                    <i class="fas fa-arrow-left"></i> <span class="atras">Atrás</span>
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
                    
                            <div type="button" class="list-group-item list-group-item-action active" style="margin-bottom: 20px; background: #4F52D6; text-align: center; font-size: 24px;">
                                Tema del <?php echo $dato2['nombreModulo'];?>
                            </div>

                            <!--/////////////////-->
                            <div id="agregarTema" >
                                <div class="form-row ">
    
                                    <div class="form-group col-md-6 ">
                                        <label class="form-label">Nombre del tema</label>
                                        <input type="text" class="form-control" name="temas_agregar" id="temas_agregar" placeholder="Ingrese un nombre" aria-label="TemaAgr" aria-describedby="temaAgr-addon" required>
                                        <label for="temas_agregar" style="color:red; display:none" id="temaValido">Ingresar Nombre valido</label>
                                    </div>
    
                                    <div class="form-group col-md-6 ">
                                        <label class="form-label">Link del vídeo</label>
                                        <input type="text" class="form-control" name="link" id="link" placeholder="Ingrese un link" aria-label="ApellidosMat" aria-describedby="apellidoMat-addon" required>

                                    </div>
    
                                </div>
    
                                <div class="form-row">
    
                                    <div class="form-group col-12">
                                        <label class="form-label">Descripción del tema</label>
                                        <textarea class="form-control" placeholder="Añadir descripción" rows="3" id="descripcio_tema" name="descripcio_tema" required></textarea>
                                        <label for="linkValidate" style="color:red; display:none" id="DescripcionValida">Ingresar Descripción valida</label>
                                    </div>
                                </div>
    
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <a>
                                            <button style="background-color: #74F077" type="submit" class="btn btn-block btn-add" id="buttonEnviar">
                                                <i class="fas fa-save"></i> Guardar Tema
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                                
                            <!--/////////////////-->




                            

                            <!-- Mensaje de alerta  -->
 
                                    <!-- Mensaje de alerta  -->
                                    <script>

                                        function alertaAgregar() {
 
                                            const agregar = document.querySelector('#descripcio_tema,#link,#temas_agregar');
                                            let formulario = document.querySelector('#o');
                                            
                                            if (agregar.value.length != 0 && agregar.value.length != 1) {
                                                Swal.fire({
 
                                                    icon: 'success',
 
                                                    title: 'Agregado Correctamente',
 
                                                    allowOutsideClick: false,
 
                                                    confirmButtonText: "Ok",
 
                                                }).then((result) => {
 
                                                    if (result.isConfirmed) {
 
                                                        formulario.submit();
 
                                                    } else if (result.isDenied) {}
                                                });
                                            } else {
                                                event.preventDefault();
                                                event.stopPropagation();
                                            }
 
                                        }
                                    </script>


                        </form>

                

                        

                            

                            <!-- Tema registrado -->
                            <div class="scroll">

                                <div class="form-row temaRegister">
                                    
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

                                    <!--//////-->
                                    <div class="form-group col-8 col-md-10 col-sm-8 col-lg-10 col-xl-10">
                                        <span style="color: red;">Tema registrado: </span>
                                        <br>
                                        <input style="color: black;" type="text" class="form-control" value="<?php echo $dato3['nombreTema'] ?>" aria-label="Recipient's username with two button addons" disabled>
                                    </div>

                                    <!-- boton editar tema -->
                                    <div class="form-group col-2 col-md-1 col-sm-2 col-lg-1 col-xl-1">
                                        <br>
                                        <a>
                                            <button class="btn btn-block btn-outline-success" type="button" data-toggle="modal" data-target="#ModaleditarTema<?php echo $dato3['idTema']?>">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </a>
                                    </div>

                                    <!-- boton borrar tema -->              
                                    <div class="form-group col-2 col-md-1 col-sm-2 col-lg-1 col-xl-1">
                                        <br>
                                        <a>
                                            <button class="btn btn-block btn-outline-danger" type="button" data-toggle="modal" data-target="#ModalquitarTema<?php echo $dato3['idTema']?>">
                                            <i class="fas fa-trash-alt"></i></button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <script>
                                let childs = document.querySelector('.temaRegister').childNodes;
                                let butonIngresar = document.querySelector('#agregarTema');
                                
                                if (childs){
                                    butonIngresar.classList.add('display-none');
                                }
                            </script>
                        

                        <!-- Modal Editar tema --> 
                        <div class="modal fade" id="ModaleditarTema<?php echo $dato3['idTema']?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h6 class= "modal-title">EDITAR TEMA</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>











                                    <form name="formulario" class="p-0 bg-0" style="background: transparent;" id="editando_preguntas" method="POST" action="includes/tema/checkAgrTema.php?idCur=<?php echo $idCurso;?>&id_mod=<?php echo $idModulo;?>">
                                        
                                        <div class="modal-body px-4">


                                            <h6>Nombre del Tema:</h6>
                                            <input  type="text" name="actu_tema" id="nombreTema" class="form-control" value="<?php echo $dato3['nombreTema'];?>" required>
                                            
                                            <h6 class="pt-3">Descripción:</h6>
                                            <textarea  class="form-control" rows="3" id="descripcionTema" name="descripcionT" required><?php echo $dato3['descripcionTema'];?></textarea>
                                
                                            <h6 class="pt-3">Link del vídeo:</h6>
                                            <input  type="text" name="linkT" id="idTema"class="form-control" value="<?php echo $dato3['link_video'];?>" required>


                                            <input type="hidden" name="idTema" value="<?php echo $dato3['idTema'];?>">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-add"><i class="fas fa-redo"></i> Actualizar</button>
                                            <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-lg btn-block" id="actualizar" onclick="alertaActualizar()">
                                        <i class="fas fa-redo" ></i> Actualizar</button>
       
                                    </form>








                                </div>
                            </div>
                        </div>

                        <!-- Modal Borrar tema --> 
                        <div class="modal fade" id="ModalquitarTema<?php echo $dato3['idTema']?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h6 class= "modal-title">ELIMINAR TEMA</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    
                                    <form name="formulario" class="p-0" id="eliminando_temas" style="background: transparent;" method="POST" action="includes/tema/checkAgrTema.php?idCurs=<?php echo $idCurso;?>&id_mod=<?php echo $idModulo;?>">
                                        <div class="modal-body px-4">
                                            <center><h6>¿Estás seguro de eliminar este Tema?</h6></center>
                                            <input type="text" name="actuali_pregunta" class="form-control" value="<?php echo $dato3['nombreTema'];?>" disabled>
                                            <input type="hidden" name="idTemas" value="<?php echo $dato3['idTema'];?>">
                                            </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-add"><i class="fas fa-trash-alt"></i> Sí, Eliminar</button>
                                            <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <?php
                        }
                        ?>
                        
                    </div> 
                    <hr>
                </div>
               
                <!-- fin de Listado de temas -->
                <!-- fin form temas -->
            </div>
            <!-- fin segunda columna -->
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
<!-- <script src="assets/js/validarLink.js"></script> La validación ahora está incluida en validarCategoria.js -->
<script src="assets/js/validarCategoria.js"></script>
<!-- <script src="assets/js/validarAgreTema.js"></script> en validarCategoria.js -->
<script src="assets/js/plugins/sweetalert2.all.min.js"></script>
<!-- <script src="assets/js/validarModulo.js"></script> Script no utilizado en esta vista -->
<!-- <script src="assets/js/ValidarNombreTema.js"></script> en validarCategoria.js -->
<!-- <script src="assets/js/ValidarDescripcion.js"></script> en validarCategoria.js -->
</body>
</html>
