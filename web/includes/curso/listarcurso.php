<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styledash.css">
    <link rel="stylesheet" href="assets/css/agrecursos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/js/plugins/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/css/stylebuttonAtras.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <?php require_once "includes/Inicio/Head.php"; ?>    

   
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
                <div class="titlemc"></div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <!-- <br>
    <br> -->
    <!--contenido-->
    <!-- <div class="container-fluid">
        <h2><a href="user-sidebar.php" class="btn-before-custom">Volver</a></h2> -->
        <!-- <h2 class="mb-4" style="text-align: center; color:#4F52D6; font-size: 300%;font-family: 'Oswald', sans-serif;">
                <center>Publicación de cursos</center>
        </h2>
    </div> -->
        <!--contenido de los cursos -->

    <!--tabla de curso -->
            <div class="col-12 mt-5 text-center">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Listado de Cursos por Publicar</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php
                        require_once 'database/databaseConection.php';
                        $pdo3 = Database::connect();

                    $sqlz = "SELECT * FROM cursos where permisoCurso=0 order by idCurso DESC ";
                    $qz = $pdo3->prepare($sqlz);
                    $qz->execute();

                    $contar=$qz->rowCount();
                    $cantidad_paginas=6;
                    $page=$contar/$cantidad_paginas;
                    $page=ceil($page);
                    if ($contar>0) {
                        if($_GET['pag']>$page||$_GET['pag']<1){
                            header('Location:publicarcursos.php?pag=1');
                        }
                    }
                    $inicio=($_GET['pag']-1)*$cantidad_paginas;


                        if ($_SESSION['privilegio'] == 2) {
                            $idProfe = $_SESSION['codUsuario'];
                            $sql3 = "SELECT * FROM cursos WHERE id_userprofesor='$idProfe' order by idCurso DESC";
                        } else {
                            $idProfe = $_SESSION['codUsuario'];
                            $sql3 = "SELECT * FROM cursos WHERE permisoCurso=0 order by idCurso DESC LIMIT $inicio,$cantidad_paginas";
                        }

                        $q3 = $pdo3->prepare($sql3);
                        $q3->execute();
                        $curso = $q3->fetchAll(PDO::FETCH_ASSOC);

                        ?>
                        <div class="table-responsive">
                
                             <table id="example1" class="table table-borderless text-center dt-responsive text-center" cellspacing="0" width="100%" >
                                <thead>
                                    <tr>
                                        <th style="border-radius: 10px 0 0  10px;">Nombre</th>
                                        <th>Categoría</th>
                                        <th>Público dirigido</th>
                                        <th>Imagen</th>
                                        <th>Descripción</th>
                                        <th>Precio</th>
                                        <th>N° Módulos</th>
                                        <th>N° Temas</th>
                                        <th>N° Cuestionarios</th>
                                        <th style="border-radius: 0 10px 10px 0;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($curso as $curso) {
                                        $pdo4 = Database::connect();
                                        $idCate = $curso['categoriaCurso'];
                                        $sql4 = "SELECT * FROM categorias WHERE idCategoria = '$idCate'";
                                        $q4 = $pdo4->prepare($sql4);
                                        $q4->execute(array());
                                        $datoCate = $q4->fetch(PDO::FETCH_ASSOC)
                                    ?>

                                    <?php

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $idCurso = $curso['idCurso'];

        //Cantidad de modulos del curso
        $pdo13 = Database::connect();
        $q13 = $pdo13->query("SELECT count(*) FROM modulo WHERE id_curso='$idCurso'");
        $cantidad_modulos = $q13->fetchColumn();

        //Cantidad de temas
        $pdo14 = Database::connect();
        $q14 = $pdo14->query("SELECT  COUNT(tema.idTema) AS 'TEMA' from tema 
                                                    INNER JOIN modulo ON tema.id_modulo = modulo.idModulo
                                                    INNER JOIN  cursos ON cursos.idCurso = modulo.id_curso
                                                    WHERE cursos.idCurso = '$idCurso'
                                                    GROUP BY cursos.idCurso");
        $cantidad_temas = $q14->fetchColumn();

        //Cantidad de Cuestionarios
        $pdo15 = Database::connect();
        $q15 = $pdo15->query("SELECT  COUNT(cuestionario.idCuestionario) AS 'Cuestionario'  from cursos 
                                                    INNER JOIN modulo ON cursos.idCurso = modulo.id_curso
                                                    INNER JOIN  cuestionario ON cuestionario.id_modulo = modulo.idModulo
                                                    WHERE cursos.idCurso = '$idCurso'
                                                    GROUP BY cursos.idCurso");
        $cantidad_cuestionarios = $q15->fetchColumn();

        //Cantidad de preguntas
        $pdo16 = Database::connect();
        $q16 = $pdo16->query("SELECT COUNT(preguntas.idPregunta) AS 'preguntas'  from cursos 
                                                    INNER JOIN modulo ON cursos.idCurso = modulo.id_curso
                                                    INNER JOIN cuestionario ON cuestionario.id_modulo = modulo.idModulo
                                                    INNER JOIN preguntas on cuestionario.idcuestionario = preguntas.id_cuestionario
                                                    WHERE cursos.idCurso = '$idCurso'
                                                    GROUP BY cursos.idCurso");
        $cantidad_preguntas = $q16->fetchColumn();

        //Cantidad de respuestas
        $pdo5 = Database::connect();
        $q5=$pdo5->query("SELECT count(*) FROM respuestas res INNER JOIN preguntas pre ON res.id_Pregunta=pre.idPregunta
                                                    INNER JOIN cuestionario cues ON cues.idCuestionario=pre.id_cuestionario
                                                    INNER JOIN modulo mo ON mo.idModulo=cues.id_modulo
                                                    INNER JOIN cursos cur ON cur.idCurso= mo.id_curso
                                                    where cur.idCurso='$idCurso' and res.estado=1");
                                                    
        $cantidad_respuestas= $q5->fetchColumn();

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                    ?>
                                        <tr class="h-100 justify-content-center align-items-center">

                                            <td><?php echo $curso['nombreCurso']; ?></td>
                                            
                                            <td><?php echo $datoCate['nombreCategoria']; ?></td>
                                            
                                            <td><?php echo $curso['dirigido']; ?></td>
                                            
                                            <td>
                                                <?php    
                                                    if($curso['imagenDestacadaCurso']!=null){
                                                ?>
                                                        <img height="50px" src="data:image/*;base64,<?php echo base64_encode($curso['imagenDestacadaCurso']) ?>">
                                                <?php
                                                    }else{
                                                ?>
                                                        <img height="50px"  src="./assets/images/curso_educalma.png">
                                                <?php
                                                    }
                                                ?>      
                                            </td>

                                            <td><?php echo substr($curso['descripcionCurso'],0,100)."..."; ?></td>
                                            
                                            <td><?php echo $curso['costoCurso'];?></td>
                                            
                                            <td><?php 
                                            
                                            if($cantidad_modulos<1){

                                                echo "0";
                                            }else{

                                                echo $cantidad_modulos;
                                            }
                                            
                                            
                                            ?></td>

                                            <td><?php 
                                            
                                            if($cantidad_temas<1){

                                                echo "0";
                                            }else{

                                                echo $cantidad_temas;
                                            }

                                            ?></td>

                                            <td><?php
                                            
                                            if($cantidad_cuestionarios<1){

                                                echo "0";
                                            }else{

                                                echo $cantidad_cuestionarios;
                                            }

                                            ?></td>

                                            <td>
                                                <?php

                    
                                                ?>
                                                    <!--para agregar modulo-->
                                                    <a href="agregarModulos.php?id=<?php echo $curso['idCurso']; ?>">
                                                        <button style="width: 10px;" id="btnAgregarModulos" class="btn btn-add" type="button"><i class="far fa-plus-square"></i> </button>
                                                    </a>
                                                    <!--para editar curso-->
                                                    <a style="" href="editarcurso.php?id=<?php echo $curso['idCurso']; ?>">
                                                        <button style="width: 10px;" class="btn btn-edit" type="button"><i class="far fa-edit"></i></button>
                                                    </a>
                                                    <!--para quitar curso-->
                                                    <!-- <a href="includes/Cursos_crud/Cursos_CRUD.php?id_curso=<?php echo $curso['idCurso']; ?>">
                                                        <button class="boton_personalizado" type="button"><i class="far fa-bell-slash fa-2x"></i></button>
                                                    </a> -->
                                                <?php
                                                 if($_SESSION['privilegio'] == 1) {

                                                ?>
                                                    <!--para publicar curso-->
                                                    <a style="" href="includes/Cursos_crud/aceptarCurso.php?id_curso=<?php echo $curso['idCurso']; ?>&pag=<?php echo $_GET['pag'];?>">
                                                        <button style="width: 10px;" id="btnPublicarCurso" class="btn btn-upload" type="button" hidden multiple>Publicar</button>
                                                    </a>

                                                    <a>
                                                        <button style="width: 10px;" id="" class="btn btn-upload" type="button" onclick="alertaCursoPublicado()">Publicar <br> Curso</button>
                                                    </a>

                                                <?php

                                                }
                                                ?>

                                                <!--ver curso-->
                                                <!-- <a href="curso.php?id=<?php echo $curso['idCurso']; ?>">
                                                    <i class="far fa-eye fa-2x"></i>
                                                </a> -->
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
                                    <!--PAGINADOR-->       
                                    <nav aria-label="Page navigation calma" class="pdt50">
                        <ul class="pagination justify-content-end">
                            <li class="page-item <?php if($_GET['pag']<=1)echo 'disabled'?>">
                                <a class="page-link" href="publicarcursos.php?pag=<?php echo $_GET['pag']-1;?>">
                                Anterior
                                </a>
                            </li>
                            <?php for($i=0;$i<$page;$i++):?>
                            <li class="page-item <?php echo $_GET['pag']==$i+1?'activate':''?>"><a class="page-link" href="publicarcursos.php?pag=<?php echo $i+1;?>"><?php echo $i+1;?></a>
                            </li>
                            <?php endfor?>
                            <li class="page-item <?php if($_GET['pag']>=$page) echo 'disabled'?>">
                            <a class="page-link" href="publicarcursos.php?pag=<?php echo $_GET['pag']+1;?>">Siguiente</a>
                        </li>
                        </ul>
                    </nav>
                    <!--PAGINADOR-->
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
                        $sql3 = "SELECT * FROM cursos WHERE permisoCurso=0 order by idCurso DESC LIMIT $inicio,$cantidad_paginas";
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
                                        <td>
                                        
                                            <?php    
                                                if($dato3['imagenDestacadaCurso']!=null){
                                            ?>
                                                    <img height="50px" src="data:image/*;base64,<?php echo base64_encode($dato3['imagenDestacadaCurso']) ?>">
                                            <?php
                                                }else{
                                            ?>
                                                    <img height="50px"  src="./assets/images/curso_educalma.png">
                                            <?php
                                                }
                                            ?> 
                                        </td>
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

                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleVer">
                                                      
                                                        <i class="far fa-eye fa-2x"></i>
                                                    </button>

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
    $q4 = $pdo3->prepare($sql4);
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
                                    <?php    
                                        if($dato3['imagenDestacadaCurso']!=null){
                                    ?>
                                            <img height="50px" src="data:image/*;base64,<?php echo base64_encode($dato3['imagenDestacadaCurso']) ?>">
                                    <?php
                                        }else{
                                    ?>
                                            <img height="50px"  src="./assets/images/curso_educalma.png">
                                    <?php
                                        }
                                    ?> 
                                    
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
    <br>
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
                "fnInitComplete": function(){
                    // Enable THEAD scroll bars
                    $('.dataTables_scrollHead').css('overflow', 'auto');
  
                    // Sync THEAD scrolling with TBODY
                    $('.dataTables_scrollHead').on('scroll', function () {
                    $('.dataTables_scrollBody').scrollLeft($(this).scrollLeft());
                    });                    
                },
                scrollY: 854, 
                scrollX: 200, 

                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                dom: '<"top"flBp>t<"bottom"pBl>',
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
            }),
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

<script>

        //Mensaje de alerta curso publicado
        function alertaCursoPublicado(){

                                        Swal.fire({

                                            icon: 'warning',

                                            title: '¿Está seguro que desea publicar el curso?',

                                            allowOutsideClick: false,

                                            confirmButtonText: "Sí",
                                            
                                            showCancelButton: true,
                                            cancelButtonColor: 'red',
                                            cancelButtonText: "No",

                                        }).then((result) => {

                                            if (result.isConfirmed) {
    
                                                Swal.fire({

                                                    icon: 'success',

                                                    title: 'Curso publicado correctamente',

                                                    allowOutsideClick: false,

                                                    allowOutsideClick: false,

                                                    confirmButtonText: "Ok",

                                                }).then((result) => {

                                                    if (result.isConfirmed) {

                                                        $('#btnPublicarCurso').trigger('click');

                                                    } else if (result.isDenied) {

 
                                                    }
                                                })

                                            } else if (result.isDenied) {

 
                                            }
                                        })

        }
        

</script>



</body>
</html>