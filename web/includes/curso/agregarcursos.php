<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/agrecursos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/js/plugins/sweetalert2.min.css">
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

    <?php require_once "includes/Inicio/Head.php"; ?>

    <style>
        .subir {
            padding: 5px 10px;
            background: #5451D6;
            color: #fff;
            border: 0px solid #fff;
            border-radius: 8px;
        }

        .subir:hover {
            color: #fff;
            background: #8886f3;
        }
        
  	    label.error{
    	color: red;
        font-style: italic;
        font-size: 13px;
        max-width:300px;
        padding: 10px;
        margin:0;
        }
    </style>

    <title>Agregar Cursos</title>
</head>

<body>

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

    <br><br>
    <br>
    <br>
    <br>
    <!--contenido-->
    <div class="contai container-fluid">
        <div class="title">
            <h2 class="mb-4" style="color:#4F52D6;font-size: 300%;font-family: 'Oswald', sans-serif;">
                <center>Bienvenido a EduCalma</center>
            </h2>
        </div>
        <!--contenido de los  curso -->
        <div class="row justify-content-center">
            <!--formulario curso -->
            <div class="col-10">
                <div class=" card" style="border-radius:8px">
                    <div class="card-header text-white " style="border-radius:8px; background:#7C83FD">
                        <h1 class="text-white text-center mt-2"><i class="fas fa-book"></i> Dona un Curso</h1>
                    </div>
                    <div class="card-body">
                        <div class="cont_formu" style="border-radius:8px;">
                            <!--
                                        ======================================
                                                    Agregar Curso
                                        ======================================
                                         
                                    -->

                                    <!--    ESTA MAL EL ID EN EL FORM  id="form-agrecursos" lo cambie por otro id, Giancarlo S. -->
                                    <form  name="formulario" id="newUserForm" method="POST" action="includes/Cursos_crud/Cursos_CRUD.php" target="dummyframe" onsubmit="return comprobarDatosFormulario()" enctype="multipart/form-data">
                                <div class="row">
                                    <!--nombre -->
                                    <div class="col-6 mb-3">
                                        <label for="names-agrecursos" style="font-size:15pt">Nombre del Curso: </label>
                                        <input style="border-radius:8px; border-color:#99CCFF ;" type="text" name="nombres_agrecursos" id="names-agrecursos" class="form-control form-control-lg" placeholder="" aria-label="Nombrecurso" aria-describedby="names-addon">
                                    </div>
                                    <!--Categoria -->
                                    <div class="col-6 mb-3">
                                        <label for="categoria" style="font-size:15pt">Categoria: </label>
                                        <select id="categoria" name="categoria" class="form-control form-control-sm " style="border-radius:8px; border-color:#99CCFF; font-size:15pt;" >
                                            <option value="">.............</option>

                                            <?php
                                            require_once 'database/databaseConection.php';
                                            $pdo4 = Database::connect();

                                            $sql4 = "SELECT * FROM categorias";
                                            $q4 = $pdo4->prepare($sql4);
                                            $q4->execute(array());

                                            while ($registro =  $q4->fetch(PDO::FETCH_ASSOC)) {

                                            ?>
                                                <option value="<?php echo $registro['idCategoria'] ?>"><?php echo $registro['nombreCategoria'] ?></option>

                                            <?php

                                            }

                                            Database::disconnect();
                                            ?>
                                        </select>

                                    </div>
                                    <!--descripcion -->
                                    <div class="col-6 mb-3">
                                        <div class="form-floating">
                                            <label for="descripcio-curso" style="font-size:15pt">Descripción del Curso: </label>
                                            <textarea class="form-control" maxlength="250" style="border-radius:8px; border-color:#99CCFF" ; placeholder="" id="descripcio-curso" name="descripcio_curso"></textarea>
                                        </div>
                                    </div>
                                    <!--Introduccion del curso -->
                                    <div class="col-6 mb-3">
                                        <div class="form-floating">
                                            <label for="intro-curso" style="font-size:15pt">Introducción del Curso: </label>
                                            <textarea class="form-control" style="border-radius:8px; border-color:#99CCFF" placeholder="" id="intro-curso" name="intro_curso" ;></textarea>
                                        </div>
                                    </div>
                                    <!--Precio 
                                <div class="mb-3">
                                    <input type="number" style="border-radius:8px; border-color:#99CCFF" ; step="any" name="precio_curso" id="precio-curso" class="form-control form-control-lg " placeholder="Precio del Curso" aria-label="PrecioCurso" aria-describedby="precio-curso">
                                </div>-->

                                    <!--publico dirigido -->
                                    <div class="col-6 mb-3">
                                        <label for="publico_dirigidoo" style="font-size:15pt">Publico Dirigido: </label>
                                        <input style="border-radius:8px; border-color:#99CCFF ;" type="text" name="publico_dirigido" id="publico_dirigidoo" class="form-control form-control-lg" placeholder="" aria-label="Dirigido" aria-describedby="names-addon">
                                    </div>

                                    <!--Imagen -->
                                    <div class="col-6 form-group mt-0">
                                        <div class="row">
                                                <p class="col-12 mt-0">*Agregar Imágen Del Curso</p>
                                                <div class="col-lg-5 align-self-center">
                                                    <label for="file-upload" class="subir" style="text-align:center;">
                                                        <i class="fas fa-cloud-upload-alt"></i> Subir archivo
                                                    </label>
                                                    <input id="file-upload" name="txtimagen" onchange='cambiar()' type="file" style='display: none;' accept="image/*" />
                                                </div>
                                                <div class="col-lg-7 text-left align-self-center" id="info"></div>
                                        </div>

                                    </div>
                                </div>
                                      <div class="card-footer bg-transparent ">
                                          <!--BOTONES DE AGREGAR  -->
                                            <div class="col-12 ml-5" style=" padding: 2% 0px;">

                                                 <button type="submit"  class="boton" style="background:#9888DC;color:#FFFFFF;font-size:15pt; border-radius:8px"><i class="fas fa-plus "></i> Agregar</button>
                                                  <!--boton modal <i class="fas fa-plus "></i>
                                                 <button type="button" class="btn btn-success ml-auto" data-toggle="modal" data-target="#exampleModal">
                                                            ver
                                                 </button>-->
                                            </div>
                                        </div>
                                   </form>
                        </div>
                    </div>
                   
                   
                </div>
            </div>
            <!--tabla de curso -->
            <div class="col-12 mt-5 text-center">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Listado de Cursos</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php
                        require_once 'database/databaseConection.php';
                        $pdo3 = Database::connect();

                        if ($_SESSION['privilegio'] == 2) {
                            $idProfe = $_SESSION['codUsuario'];
                            $sql3 = "SELECT * FROM cursos WHERE id_userprofesor='$idProfe' order by idCurso DESC";
                        } else {
                            $idProfe = $_SESSION['codUsuario'];
                            $sql3 = "SELECT * FROM cursos WHERE permisoCurso=0 order by idCurso DESC";
                        }

                        $q3 = $pdo3->prepare($sql3);
                        $q3->execute();
                        $curso = $q3->fetchAll(PDO::FETCH_ASSOC);

                        ?>
                        <div class="table-responsive">
                            <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>

                                    <tr>
                                        <th>Nombre</th>
                                        <th>Categoria</th>
                                        <th>Publico dirigido</th>
                                        <th>imagen</th>
                                        <th>Introducción</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($curso as $curso) {
                                        $idCate = $curso['categoriaCurso'];
                                        $sql4 = "SELECT * FROM categorias WHERE idCategoria = '$idCate'";
                                        $q4 = $pdo4->prepare($sql4);
                                        $q4->execute(array());
                                        $datoCate = $q4->fetch(PDO::FETCH_ASSOC)
                                    ?>
                                        <tr>
                                            <td><?php echo $curso['nombreCurso']; ?></td>
                                            <td><?php echo $datoCate['nombreCategoria']; ?></td>
                                            <td><?php echo $curso['dirigido']; ?></td>
                                            <td><img height="50px" src="data:image/*;base64,<?php echo base64_encode($curso['imagenDestacadaCurso']) ?>"></td>
                                            <td><?php echo $curso['introduccion']; ?></td>
                                            <td>
                                                <?php

                                                if ($_SESSION['privilegio'] == 2) {


                                                ?>
                                                    <!--para agregar modulo-->
                                                    <a href="agregarModulos.php?id=<?php echo $curso['idCurso']; ?>">
                                                        <button class="btn btn-primary" type="button"><i class="far fa-plus-square  fa-2x"></i> </button>
                                                    </a>
                                                    <!--para editar curso-->
                                                    <a href="editarcurso.php?id_curso=<?php echo $curso['idCurso']; ?>">
                                                        <button class="btn btn-success" type="button"><i class="far fa-edit fa-2x"></i></button>
                                                    </a>
                                                    <!--para quitar curso-->
                                                    <a href="includes/Cursos_crud/Cursos_CRUD.php?id_curso=<?php echo $curso['idCurso']; ?>">
                                                        <button class="btn btn-danger" type="button"><i class="far fa-bell-slash fa-2x"></i></button>
                                                    </a>
                                                <?php
                                                } else {
                                                ?>
                                                    <!--para quitar curso-->
                                                    <a href="includes/Cursos_crud/aceptarCurso.php?id_curso=<?php echo $curso['idCurso']; ?>">
                                                        <button class="btn btn-ligth" type="button">Publicar</button>
                                                    </a>

                                                <?php

                                                }
                                                ?>

                                                <!--ver curso-->
                                                <a href="curso.php?id=<?php echo $curso['idCurso']; ?>">
                                                    <i class="far fa-eye fa-2x"></i>
                                                </a>
                                            </td>

                                        </tr>
                                    <?php }
                                    Database::disconnect();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.card -->
        </div>

    </div>
    <!--
                    ======================================
                                Lista Curso
                    ======================================
                    -->


    <!--nuevo-->



    <!--modal-->
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listado de cursos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?php
                    require_once 'database/databaseConection.php';
                    $pdo3 = Database::connect();

                    if ($_SESSION['privilegio'] == 2) {
                        $idProfe = $_SESSION['codUsuario'];
                        $sql3 = "SELECT * FROM cursos WHERE id_userprofesor='$idProfe' order by idCurso DESC";
                    } else {
                        $idProfe = $_SESSION['codUsuario'];
                        $sql3 = "SELECT * FROM cursos WHERE permisoCurso=0 order by idCurso DESC";
                    }


                    $q3 = $pdo3->prepare($sql3);
                    $q3->execute(array());
                    ?>


                    <div class="mb-3 mt-5">
                        <table class="table">
                            <thead>
                                <tr class="bg-primary">
                                    <th>Nombre</th>
                                    <th>imagen</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <?php
                            while ($dato3 = $q3->fetch(PDO::FETCH_ASSOC)) {

                            ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $dato3['nombreCurso'] ?></td>
                                        <td><img height="50px" src="data:image/*;base64,<?php echo base64_encode($dato3['imagenDestacadaCurso']) ?>"></td>
                                        <td class="text-center">

                                            <?php

                                            if ($_SESSION['privilegio'] == 2) {


                                            ?>
                                                <!--para agregar modulo-->
                                                <a href="agregarModulos.php?id=<?php echo $dato3['idCurso']; ?>">
                                                    <button class="btn btn-primary" type="button"><i class="far fa-plus-square  fa-2x"></i> </button>
                                                </a>
                                                <!--para editar curso-->
                                                <a href="editarcurso.php?id_curso=<?php echo $dato3['idCurso']; ?>">
                                                    <button class="btn btn-success" type="button"><i class="far fa-edit fa-2x"></i></button>
                                                </a>
                                                <!--para quitar curso-->
                                                <a href="includes/Cursos_crud/Cursos_CRUD.php?id_curso=<?php echo $dato3['idCurso']; ?>">
                                                    <button class="btn btn-danger" type="button"><i class="far fa-bell-slash fa-2x"></i></button>
                                                </a>
                                            <?php
                                            } else {
                                            ?>
                                                <!--para quitar curso-->
                                                <a href="includes/Cursos_crud/aceptarCurso.php?id_curso=<?php echo $dato3['idCurso']; ?>">
                                                    <button class="btn btn-ligth" type="button">Publicar</button>
                                                </a>

                                            <?php

                                            }
                                            ?>

                                            <!--ver curso-->
                                            <a href="curso.php?id=<?php echo $dato3['idCurso']; ?>">
                                                <i class="far fa-eye fa-2x"></i>
                                            </a>

                                            <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleVer">
                                                      
                                                        <i class="far fa-eye fa-2x"></i>
                                                    </button>-->

                                        </td>
                                    </tr>
                                </tbody>
                            <?php
                            }
                            Database::disconnect();
                            ?>
                        </table>

                    </div>







                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!--
                    ======================================
                                ver Curso
                    ======================================
                    -->
    <?php
    require_once 'database/databaseConection.php';
    $pdo3 = Database::connect();

    $sql3 = "SELECT * FROM cursos WHERE permisoCurso = '1' order by idCurso DESC";
    $q3 = $pdo3->prepare($sql3);
    $q3->execute(array());
    $dato3 = $q3->fetch(PDO::FETCH_ASSOC)
    ?>

    <?php
    $sql4 = "SELECT * FROM categorias";
    $q4 = $pdo4->prepare($sql4);
    $q4->execute(array());
    $datoCate = $q4->fetch(PDO::FETCH_ASSOC)
    ?>


    <!-- Modal para visualizar los iten de los cursos -->


    <!-- Modal -->
    <div class="modal fade" id="exampleVer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listado de Todos los Item de los cursos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="accordion" id="accordionExample">
                        <!--nombre de los cursos-->
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#nombrecurso" aria-expanded="true" aria-controls="collapseOne">
                                        Nombre del Curso:
                                    </button>
                                </h2>
                            </div>

                            <div id="nombrecurso" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <h2> <?php echo $dato3['nombreCurso'] ?></h2>
                                </div>
                            </div>
                        </div>
                        <!--Descripcion de los cursos-->
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#descripcion" aria-expanded="false" aria-controls="collapseTwo">
                                        Descripción:
                                    </button>
                                </h2>
                            </div>
                            <div id="descripcion" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <h2> <?php echo $dato3['descripcionCurso'] ?></h2>
                                </div>
                            </div>
                        </div>
                        <!--Categoria del cursos-->

                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#categoria" aria-expanded="false" aria-controls="collapseThree">
                                        Categoria del curso:
                                    </button>
                                </h2>
                            </div>
                            <div id="categoria" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    <h2> <?php echo $datoCate['nombreCategoria'] ?></h2>
                                </div>
                            </div>
                        </div>
                        <!--Costo del cursos-->

                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#costo" aria-expanded="false" aria-controls="collapseTwo">
                                        Costo del Curso:
                                    </button>
                                </h2>
                            </div>
                            <div id="costo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <h2> S/. <?php echo $dato3['costoCurso'] ?></h2>
                                </div>
                            </div>
                        </div>
                        <!--Imagen del cursos-->

                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#imagen" aria-expanded="false" aria-controls="collapseTwo">
                                        Imagen:
                                    </button>
                                </h2>
                            </div>
                            <div id="imagen" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <img height="50px" src="data:image/*;base64,<?php echo base64_encode($dato3['imagenDestacadaCurso']) ?>">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <?php Database::disconnect(); ?>

    <br><br>
    <br>
    <br>
    <br>

    <script>
        function cambiar() {
            var pdrs = document.getElementById('file-upload').files[0].name;
            document.getElementById('info').innerHTML = pdrs;
        }
    </script>
    <?php require_once "includes/Inicio/Footer.php"; ?>
    <script type="text/javascript">
        /*    $(document).ready(function() {
            $('#example').DataTable({
                language: {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sSearch": "Buscar:",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "sProcessing": "Procesando...",
                },
                //para usar los botones   
                responsive: "true",
                dom: 'Bfrtilp',
                buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> ',
                        titleAttr: 'Exportar a Excel',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i> ',
                        titleAttr: 'Exportar a PDF',
                        className: 'btn btn-danger'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> ',
                        titleAttr: 'Imprimir',
                        className: 'btn btn-info'
                    },
                ]
            });
        });*/
    </script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
    <script src="assets/js/validarCategoria.js"></script>
    <script src="assets/js/plugins/sweetalert2.all.min.js"></script>

</body>

</html>