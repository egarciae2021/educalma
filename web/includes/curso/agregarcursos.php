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

    <?php require_once "includes/Inicio/Head.php"; ?>

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
  	    .form-group .error{
    	color: crimson;
        font-style: normal;
        font-size: 16px;
        padding-top: 5px;
        /* max-width:300px; 
        padding: 10px;*/
        margin:0;
        }
    </style>
    <title>Agregar Cursos</title>
</head>
<body>
<?php
// Este codigo hace validacion para que no se pueda acceder a cualquier pagina sin estar logueado

 if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
?>
  
<!-- formulario -->
<div class="container-fluid">
        <!--                    ======================================
                                            Agregar Curso
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
                        <!-- seccion donar un curso -->
                        <div class="list-group py-3">
                            <button type="button" class="list-group-item list-group-item-action active">
                                Donar un Curso
                            </button>
                            <!-- seccion otros -->
                            <ul class="list-group list-group-flush py-3">
                                <li class="list-group-item border-top-0" style="color:#495057;">Componentes del Curso</li>
                            </ul>
                            <div class="list-group lista2 text-left">
                            <!-- <a href="sidebarCursos.php" class="list-group-item list-group-item-action">
                                <i class="fas fa-pencil-alt"></i> Editar curso
                                </a> -->
                                <a href="sidebarCursos.php" class="list-group-item list-group-item-action">
                                    <i class="fas fa-book"></i> Mis Cursos
                                </a>
                                <a href="ListaCursos.php?pag=1" class="list-group-item list-group-item-action">
                                    <i class="fas fa-eye"></i> Ver los modulos del curso
                                </a>
                                <a href="publicarcursos.php?pag=1" class="list-group-item list-group-item-action">
                                    <i class="fad fa-books"></i> Publicar cursos
                                </a>
                                <a class="btn btn-outline-secondary btn-back btn-sm" href="sidebarCursos.php" role="button">
                                    <i class="fas fa-arrow-left"></i> Atrás
                                </a>
                            </div>
                            <!-- fin seccion otros -->
                        </div>
                    </div>
                    <!-- fin primera columna -->

                    <!-- segunda columna -->
                    <div class="col-9 pl-0">
                        <form name="formulario" id="newUserForm" method="POST" action="includes/Cursos_crud/Cursos_CRUD.php"  onsubmit="return comprobarDatosFormulario()" enctype="multipart/form-data">
                            <div class="form-row ">
                                <div class="form-group col-md-6 ">
                                    <label class="form-label">Nombre del curso</label>
                                    <input type="text" name="nombres_agrecursos" id="names-agrecursos" class="form-control "  placeholder="Ingrese un nombre" aria-label="Nombrecurso" aria-describedby="names-addon">
                                </div>
                                <div class="form-group col-md-6 ">
                                    <label class="form-label">Categoría</label>
                                    <select id="categoria" name="categoria" class="form-control">
                                        <option value="" selected disabled>Seleccionar</option>
                                        
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
                            </div>

                            <div class="form-row ">

                                <div class="form-group col-md-6">
                                    <label class="form-label">Descripción del curso</label>
                                    <textarea class="form-control" placeholder="Añadir descripción" id="descripcio-curso" name="descripcio_curso" rows="3"></textarea>
                                </div>

                                <div class="form-group col-md-6 ">
                                    <div class="form-group ">
                                        <label class="form-label">Introducción del Curso</label>
                                        <textarea class="form-control " placeholder="Añadir introducción" id="intro-curso" name="intro_curso" rows="3"></textarea>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="form-row ">

                                <div class="form-group col-md-6 ">
                                    <label class="form-label">Público Dirigido</label>
                                    <input type="text " id="publico_dirigidoo" name="publico_dirigido" placeholder="Ingrese público dirigido" class="form-control" aria-label="Dirigido" aria-describedby="names-addon">
                                </div>

                                <div class="form-group col-md-6 ">
                                    <label class="form-label">*Agregar imagen del curso</label>
                                    <br>
                                    <!-- <button type="button " class="btn btn-outline-danger  ">
                                        <i class="fas fa-cloud-upload-alt " aria-hidden="true "></i>
                                        Insertar imagen
                                    </button> -->

                                    <div class="column" style="margin:auto;">
                                        <label for="file-upload" class="btn btn-outline-danger">
                                            <i class="fas fa-cloud-upload-alt" aria-hidden="true"></i>
                                            Insertar imagen
                                        </label>
                                        <input  type="file" id="file-upload" name="txtimagen" onchange='cambiar()' style='display: none;' 
                                        aria-label="Upload" aria-describedby="inputGroupFileAddon04" accept="image/*"; multiple/>
                                    </div>

                                    <div class="column" style="margin:auto;">
                                        <div id="info"></div>
                                    </div>

                                </div>

                            </div>

                            <div class="form-row ">
                                <input type="submit" class="btn btn-block btn-add"  value="Agregar">
                            </div>

                        </form>
                    </div>
                    <!-- fin segunda columna -->
                </div>
            </div>
        </div>
    </div>
<!-- fin formulario -->



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

                                           
                                                <!--para agregar modulo-->
                                                <a href="agregarModulos.php?id=<?php echo $dato3['idCurso']; ?>">
                                                    <button class="btn btn-primary" type="button"><i class="far fa-plus-square  fa-2x"></i> </button>
                                                </a>
                                                <!--para editar curso-->
                                                <a href="editarcurso.php?id_curso=<?php echo $dato3['idCurso']; ?>">
                                                    <button class="btn btn-success" type="button"><i class="far fa-edit fa-2x"></i></button>
                                                </a>
                                                
                                            <?php
                                         if($_SESSION['privilegio'] == 1){
                                            ?>
                                                <!--para quitar curso-->
                                                <a href="includes/Cursos_crud/Cursos_CRUD.php?id_curso=<?php echo $dato3['idCurso']; ?>">
                                                    <button class="btn btn-danger" type="button"><i class="far fa-bell-slash fa-2x"></i></button>
                                                </a>
                                                <!--para publicar curso-->
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
                                        CategorÍa del curso:
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
    <?php
    }
    else{
                header('Location:iniciosesion.php');
    }
?>
</body>
</html>