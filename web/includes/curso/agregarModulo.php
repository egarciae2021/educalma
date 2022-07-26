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
        label.error {
            color: crimson;
            font-style: normal;
            font-size: 16px;
            padding-top: 5px;
            /* max-width:300px; 
            padding: 10px;*/
            margin: 0;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
    </script>

    <title>Agregar Módulo</title>
</head>

<body>

    <?php
    // Este codigo hace validacion para que no se pueda acceder a cualquier pagina sin estar logueado
    if (isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)) {
    ?>

        <?php
        require_once '././database/databaseConection.php';
        $_GET['id'];
        $pdo = Database::connect();
        $sql = "SELECT * FROM cursos WHERE idCurso='$_GET[id]'";
        $q = $pdo->prepare($sql);
        $q->execute(array());
        $dato = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        ?>

        <div>
            <?php
            $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $envio = substr($url, strrpos($url, '=') + 1);
            $_SESSION['ids'] = $envio;
            ?>
        </div>

        <!-- Nuevo form -->
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
                                

                                <!-- seccion otros
                                <ul class="list-group list-group-flush py-3">
                                    <li class="list-group-item border-top-0" style="color:#495057;">Componentes del curso</li>
                                </ul> -->

                                <div class="list-group lista2 text-left">

                                    <!--
                                    <a href="editarcurso.php?id=<?php echo $envio ?>" class="btn btn-outline-secondary btn-back btn-sm">
                                        <i class="fas fa-pencil-alt"></i> Editar datos del curso
                                    </a>
                                    -->

                                    <!--
                                    <button typer="button" id="salir_public" class="btn btn-outline-secondary btn-back btn-sm" style="cursor: pointer; position: relative; top: -40px;">
                                        <i class="fad fa-books"></i> Ver cursos no publicados
                                    </button>
                                    -->

                                    <a style="" class="btn btn-outline-secondary btn-back btn-sm" href="javascript:history.back()" role="button" style="position: relative; top: -20px;">
                                        <i class="fas fa-arrow-left"></i> Atrás
                                    </a>
                                </div>

                                <!-- fin seccion otros -->
                            </div>
                        </div>
                        <!-- fin primera columna -->













































                        <!-- segunda columna -->
                        <div class="col-9 pl-0">

                            <!--                =====================================
                                                                Agregar Módulo
                                                    =====================================
                                -->
                            <form name="formulario" id="form-agretemas" method="POST" action="includes/modulo/Modulo_CRUD.php?id=<?php echo $dato['idCurso']; ?>">
                                
                                <div type="button" class="list-group-item list-group-item-action active" style="background: #4F52D6; text-align: center; font-size: 26px;">
                                    Agregar módulo
                                </div>    

                            

                                <div style="position: relative; top: 10px;" class="form-row pb-2">
                                    
                                    <div class="form-group col-12" hidden multiple>
                                        <label class="form-label">Nombre del módulo</label>
                                        <input type="text" class="form-control" name="modulo_agregar" id="modulo_agregar" placeholder="Ingrese un nombre" aria-label="ModuloAgr" aria-describedby="ModuloAgr" aria-describedby="moduloAgr-addon" minlength="2" value="Módulo #" required>
                                    </div>

                                    <!-- <div class="form-group col-4 col-xl-2 col-lg-2" >
                                                <label class="form-label" style="color:transparent;">-</label>
                                                <br>
                                                <a class="btn btn-block btn-primary text-white" type="button" role="button" data-toggle="modal" data-target="#staticBackdrop">
                                                    <i class="fas fa-eye"></i> Ver
                                                </a>
                                            </div> -->
                                </div>


                                <div class="form-row">
                                    <div style="margin-top: 20px; margin-left: auto; margin-right: auto;" class="form-group col-6 col-md-6 "><input type="hidden">
                                        <button style="background-color: #74F077" type="button" id="actumodulo_2" class="btn btn-modulos" onclick="alertaModulo()">
                                            <i class="fas fa-plus"></i> Agregar Módulo
                                        </button>
                                    </div>

                                    <!-- Mensaje de alerta modulo agregado -->
                                    <script>

                                        function alertaModulo() {

                                            const agregar = document.querySelector('#modulo_agregar');
                                            let formulario = document.querySelector('#form-agretemas');

                                            if (agregar.value.length != 0 && agregar.value.length != 1) {

                                                Swal.fire({

                                                    icon: 'success',

                                                    title: 'Modulo agregado',

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

                                    
                                </div>

                            </form>


<div style="border: #4F52D6 2px solid; border-radius: 5px;">


                            <!-- añadido nuevo -->
                            <form style="margin-top: 20px;" class="pt-0">
                                <div style="position: relative; top: 30px;" class="form-row">

                                    <!--
                                    <div class="form-group col-12" style="text-align: center;">
                                        <label style="font-size: 24px; position: relative; top: -10px;" class="form-label">Listado de módulos del curso:</label>
                                    </div>
                                    -->

                                </div>

                                <!-- lista - codigo php -->
                                <!-- <div class="overflow-auto"> -->

                                <div>
                                    <div style="position: relative; top: 10px;" class="form-row">

                                        <?php
                                        require_once '././database/databaseConection.php';
                                        $_GET['id'];
                                        $pdo2 = Database::connect();
                                        $sql2 = "SELECT * FROM modulo WHERE id_curso='$_GET[id]'";
                                        $q2 = $pdo2->prepare($sql2);
                                        $q2->execute(array());

                                        while ($dato2 = $q2->fetch(PDO::FETCH_ASSOC)) {

                                            $pdo3 = Database::connect();
                                            $idd = $dato2['idModulo'];
                                            $sql3 = "SELECT * FROM tema WHERE id_modulo='$idd'";
                                            $q3 = $pdo3->prepare($sql3);
                                            $q3->execute(array());
                                        ?>

                                            <div class="form-group col-12">

                                                

                                                <input style="background-color: #C4C5FB;" type="text" class="form-control" value="<?php echo $dato2['nombreModulo'] ?>" aria-label="Recipient's username with two button addons" disabled>

                                                <!--agregar temas-->
                                                <div class="caja-opciones">

                                                    <!-- boton agregar tema -->
                                                    <a href="agregartema.php?idCurso=<?php echo $_GET['id'] ?>&id_mo=<?php echo $dato2['idModulo'] ?>">
                                                        <button style="background-color: #74F077" class="btn btn-modulos" type="button">
                                                            <i class="fas fa-plus"></i> Agregar Tema
                                                        </button>
                                                    </a>

                                                    <!--boton quitar modulos-->
                                                    <a>
                                                        <button class="btn btn-modulos" type="button" data-toggle="modal" data-target="#ModalquitarModulo<?php echo $dato2['idModulo']; ?>">
                                                            <i class="fas fa-edit"></i> Quitar Módulo
                                                        </button>
                                                    </a>

                                                    <!-- modal quitar modulos -->
                                                    <div class="modal fade" id="ModalquitarModulo<?php echo $dato2['idModulo']; ?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">

                                                                <div class="modal-header">
                                                                    <h6 class="modal-title">QUITAR MÓDULO</h6>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <!-- action="includes/modulo/Modulo_CRUD.php?id_modulo=<?php echo $dato2['idModulo'] ?>&id_curso=<?php echo $_GET['id'] ?>"  -->
                                                                <form name="formulario" id="form-agretemas5" target="dummyframe" method="POST">
                                                                    <div class="modal-body px-4">
                                                                        <center>
                                                                            <h6>¿Estás seguro de eliminar este módulo?</h6>
                                                                        </center>
                                                                        <input type="text" class="form-control" value="<?php echo $dato2['nombreModulo']; ?>" aria-label="ModuloAgr" disabled>
                                                                        <input type="hidden" name="idmodulo" value="<?php echo $dato2['idModulo']; ?>">
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <!-- <button type="submit" class="btn btn-add"><i class="fas fa-trash-alt"></i> Si, Eliminar</button> -->
                                                                        <a href="includes/modulo/Modulo_CRUD.php?id_modulo=<?php echo base64_encode($dato2['idModulo']) ?>&id_curso=<?php echo base64_encode($_GET['id']) ?>" type="button" class="btn btn-add"><i class="fas fa-trash-alt"></i>Si, Eliminar</a>
                                                                        <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- boton editar modulo-->
                                                    <!--
                                                    <a>
                                                        <button class="btn btn-modulos" type="button" data-toggle="modal" data-target="#ModalEditarModulo<?php echo $dato2['idModulo']; ?>">
                                                            <i class="fas fa-edit"></i> Editar Módulo
                                                        </button>
                                                    </a>
                                                    -->

                                                    <!-- modal editar modulo -->
                                                    <div class="modal fade" id="ModalEditarModulo<?php echo $dato2['idModulo']; ?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">

                                                                <div class="modal-header">
                                                                    <h6 class="modal-title">EDITAR MÓDULO</h6>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>

                                                                <form name="formulario" class="bg-transparent" id="form-agretemas3" action="includes/modulo/Modulo_CRUD.php?id=<?php echo $dato2['id_curso']; ?>" target="dummyframe" method="POST">
                                                                    <div class="modal-body px-4">
                                                                        <h6>Renombrar Módulo:</h6>
                                                                        <input type="text" class="form-control" name="actu_nomb_agregar" id="actu-nomb-agregar" value="<?php echo $dato2['nombreModulo']; ?>" placeholder="" aria-label="ModuloAgr" aria-describedby="moduloAgr-addon" required>
                                                                        <input type="hidden" name="idmodulo" value="<?php echo $dato2['idModulo']; ?>">
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-add"><i class="fas fa-redo"></i> Actualizar</button>
                                                                        <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--boton agregar cuestionario-->
                                                    <a href="Form_pregun_cuestionario.php?id=<?php echo $_GET['id'] ?>&id_modulo=<?php echo $dato2['idModulo'] ?>">
                                                        <button style="background-color: #74F077" class="btn btn-modulos" type="button">
                                                            <i class="fas fa-plus"></i> Agregar Cuestionario
                                                        </button>
                                                    </a>

                                                    <br>

                                                </div>
                                                <!-- fin agregar temas -->
                                                
                                            </div>

                                            

                                        <?php
                                        }
                                        Database::disconnect();
                                        ?>

                                    </div>



                                    </div>

                                    
                                    
                                </div>
                            </form>
                            <!-- fin añadido nuevo -->


                            <div class="btn">
                                <button style="width: 200px;" type="button" id="salir_agregar" class="btn btn-block btn-dark">
                                    <i class="fas fa-sign-out-alt"></i> Finalizar registro
                                </button>
                            </div>


                        </div>
                        <!-- fin segunda columna -->

                        


























                    </div>
                </div>
            </div>
        </div>
        <!-- FIN Nuevo form -->

    <?php
    } else {
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