<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/agrecursos.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/js/plugins/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/css/stylebuttonAtras.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <style>
        .subir {
            padding: 5px 10px;
            background: #5451D6;
            font-size: .8rem;
            color: #fff;
            border: 0px solid #fff;
            border-radius: 8px;
        }

        .subir:hover {
            color: #fff;
            background: #8886f3;
        }

        /*label*/
        .form-group .error {
            color: crimson;
            font-style: normal;
            font-size: 16px;
            padding-top: 5px;
            /* max-width:300px; 
        padding: 10px;*/
            margin: 0;
        }

        .form-group .col-12{
            
            -ms-word-break: break-all;
     word-break: break-all;

    
     word-break: break-word;

-webkit-hyphens: auto;
   -moz-hyphens: auto;
    -ms-hyphens: auto;
        hyphens: auto;

        }

        #actucurso_2 {

            position: relative;
            top: -120px;
        }
    </style>
    <title>Editar Curso</title>
</head>

<body>
    <?php
    // Este codigo hace validacion para que no se pueda acceder a cualquier pagina sin estar logueado

    if (isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)) {
        $id = $_GET['id'];
    ?>

        <!-- formulario -->
        <div class="container-fluid">
            <!--                    ======================================
                                            Editar Curso
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
                            <?php
                            require_once 'database/databaseConection.php';
                            $pdo3 = Database::connect();
                            $sql3 = "SELECT * FROM cursos WHERE idCurso = '$id'";
                            $q3 = $pdo3->prepare($sql3);
                            $q3->execute(array());
                            $dato2 = $q3->fetch(PDO::FETCH_ASSOC);

                            if ($dato2['costoCurso'] == "Gratis") {
                                $dato2['costoCurso'] = 0;
                            }
                            ?>
                            <!-- seccion donar un curso -->
                            <div class="list-group">

                                <!-- seccion otros 
                            <ul class="list-group list-group-flush py-3">
                                <li class="list-group-item border-top-0" style="color:#495057;">Componentes del Curso</li>
                            </ul>-->
                                <div class="list-group lista2 text-left form-row">
                              
                                    <!--
                                    </a>
                                        <a href="sidebarCursos.php" class="list-group-item list-group-item-action">
                                        <i class="fas fa-book"></i> Mis Cursos
                                    </a> 
                                    -->
                                    
                                    <a href="agregarModulos.php?id=<?php echo $id ?>" class="btn btn-outline-secondary btn-back btn-sm" style="background-color: #2BD82E; cursor: pointer; position: relative;">
                                        <i class="fas fa-plus-square"></i> Editar módulos
                                    </a>

                                    <!--
                                    <button typer="button" id="salir_public" class="btn btn-outline-secondary btn-back btn-sm" style="cursor: pointer; position: relative; top: -50px;">
                                        <i class="fad fa-books"></i> Ver lista de cursos <br> No publicados
                                    </button>
                                    -->

                                    <!-- <a href="publicarcursos.php?pag=1" class="list-group-item list-group-item-action">
                                    <i class="fad fa-books"></i> Publicar cursos
                                </a> -->
                                    <a class="btn btn-outline-secondary btn-back btn-sm" href="user-sidebar.php" role="button" style="cursor: pointer;">
                                        <i class="fas fa-arrow-left"></i> Atrás
                                    </a>
                                </div>
                                <!-- fin seccion otros -->
                            </div>
                        </div>
                        <!-- fin primera columna -->
                        <?php
                        require_once 'database/databaseConection.php';
                        $pdo3 = Database::connect();
                        $sql3 = "SELECT * FROM cursos WHERE idCurso = '$id'";
                        $q3 = $pdo3->prepare($sql3);
                        $q3->execute(array());
                        $dato2 = $q3->fetch(PDO::FETCH_ASSOC);

                        if ($dato2['costoCurso'] == "Gratis") {
                            $dato2['costoCurso'] = 0;
                        }
                        ?>
                        <!-- segunda columna -->
                        <div class="col-9 pl-0">


                            <form name="formulario" id="form-leditcursos" method="POST" enctype="multipart/form-data" action="includes/Cursos_crud/Cursos_CRUD.php?id=<?php echo $dato2['idCurso']; ?>">

                                <div type="button" class="list-group-item list-group-item-action active" style="position: relative; top: -30px; background: #4F52D6; text-align: center; font-size: 24px;">
                                    <i class="fas fa-pencil-alt"></i> Editar datos del curso: <br> <span style="color: black;"> <?php echo $dato2['nombreCurso']; ?> <span>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group col-md-12 col-lg-12">
                                            <label class="form-label">Nombre del curso: <?php echo $dato2['nombreCurso']; ?></label>
                                            <input required style="background: #EAE7FA; color: black;" type="text" name="nomb_actu_cursos" id="names-agrecursos" class="form-control " value="<?php echo $dato2['nombreCurso']; ?>" aria-label="Nombrecurso" aria-describedby="names-addon">
                                        </div>

                                        <div class="form-group col-md-12 col-lg-12">
                                            <label class="form-label">Costo del curso</label>
                                            <input required style="background: #EAE7FA; color: black;" type="number" min='0.00' max= '999' step="0.10" id="precio-curso" name="prec_curso" class="form-control" value="<?php echo number_format($dato2['costoCurso'],2); ?>" aria-label="Dirigido" aria-describedby="names-addon">
                                        </div>

                                        <div class="form-group col-md-12 col-lg-12">
                                            <label class="form-label">Público Dirigido</label>
                                            <input required style="background: #EAE7FA; color: black;" type="text" name="publi_cursos" id="publicar_cursos" class="form-control " value="<?php echo $dato2['dirigido']; ?>" aria-label="Nombrecurso" aria-describedby="names-addon">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="form-label">Descripción del curso</label>
                                            <textarea required style="background: #EAE7FA; color: black;" class="form-control" id="desc-curso" name="desc_curso" rows="4"><?php echo $dato2['descripcionCurso']; ?></textarea>
                                        </div>

                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group col-12 ">
                                            <label class="form-label">*Agregar imagen del curso</label>
                                            <br>
                                            <div class="column" style="margin:auto;">
                                                <label for="file-upload" class="btn btn-block btn-agregar">
                                                    <i class="fas fa-cloud-upload-alt" aria-hidden="true"></i>
                                                    Insertar imagen
                                                </label>
                                                <input type="file" id="file-upload" name="txtimagenAct" onchange='cambiar()' style='display: none;' aria-label="Upload" aria-describedby="inputGroupFileAddon04" accept="image/*" ; multiple />

                                                <div class="content-imagen">
                                                    <img class="content-img" src="<?php echo $dato2['imagenDestacadaCurso'] ?>">
                                                </div>
                                            </div>

                                            <div class="column" style="margin:auto;">
                                                <div id="info"></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-label">Introducción del Curso: </label>
                                            <textarea required style="background: #EAE7FA; color: black;" class="form-control" name="intRR_cursos" rows="5"><?php echo $dato2['introduccion']; ?></textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group col-12">
                                    <input type="hidden" name="idcurso" value="<?php echo $dato2['idCurso']; ?>">
                                    <button type="submit" id="actucurso" class="btn btn-block btn-agregar" hidden multiple><i class="fas fa-redo"></i> Guardar datos modificados</button>
                                </div>

                            </form>

                            <div class="form-group col-12">
                                <input type="hidden" name="idcurso">
                                <button style="background-color: #2BD82E;" type="submit" id="actucurso_2" class="btn btn-block btn-agregar" onclick="alertaCursoActualizado()"><i class="fas fa-redo"></i> Guardar nuevos datos</button>
                            </div>

                    

                            <!-- Mensaje de alerta curso actualizado -->
                            <script>
                                let precio = document.getElementById('precio-curso').value;
                                function alertaCursoActualizado() {
                                    let titulo='';
                                    if (precio == document.getElementById('precio-curso').value) {
                                        
                                        titulo = 'Datos actualizados correctamente';
                                    }else{
                                        titulo = 'Valor de curso actualizado correctamente'
                                    }
                                    
                                    Swal.fire({

                                        icon: 'success',

                                        title: titulo,

                                        allowOutsideClick: false,

                                        confirmButtonText: "Ok",

                                    }).then((result) => {

                                        if (result.isConfirmed) {

                                            $('#actucurso').trigger('click');

                                        } else if (result.isDenied) {


                                        }
                                    })

                                }
                                
                            </script>













                        </div>
                        <!-- fin segunda columna -->
                    </div>
                </div>
            </div>
        </div>
        <!-- fin formulario -->


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
        <script src="assets/js/validarCategoria.js"></script>
        <script src="assets/js/funciones.js"></script>
        <script src="assets/js/plugins/sweetalert2.all.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="assets/js/validarModulo.js"></script>


    <?php
    } else {
        header('Location:iniciosesion.php');
    }
    ?>
</body>

</html>