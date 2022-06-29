<?php
ob_start();
@session_start();
if (isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)) {
?>



<head>
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css" />
    <link rel="stylesheet" href="includes/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="assets/css/styledash.css">
</head>


<style>
.dataTables_filter {

    /*Centrando el buscador de "Por Empresas".*/
    position: relative;
    left: -140px;
    float: left;
    /**/

    border-radius: 5px;
    border: 1px solid #57B3F7;
    background-repeat: no-repeat;
    background-image: url("./assets/img/buscar.png");
    background-position: 8px 5px;
    background-size: 25px 25px;

}

/*Palabra "Buscar"*/
.dataTables_filter label {

    position: relative;
    top: 5px;

    left: 38px;
    /*font-weight: bold;*/
    width: 280px;

    font-size: 15.4px;

}

/*Caja de texto del buscador*/
.dataTables_filter label .form-control {

    border: 0;
    height: 25px;
    position: relative;
    left: -9px;
    padding: 0;
}

.filters {
    padding: 2%;
    background: #7C83FD;
    /*border-radius: 20px !important;*/

}

@media screen and (max-width:500px) {
    .btn {
        width: 20%;
        margin-bottom: 10%;
    }
}

@media screen and (min-width:500px) {
    .ordernarFiltros{
        overflow: hidden;
    }

    .filters {
        width:90%;
        float:left;
        overflow:hidden;
    }

    .form-group {
        float:left;
        width:130px;
        margin-right:1%;
    }

    .btnVer{
        margin-left:1%;
        float:left;
    }

    .date{
        width:180px;
    }

}

@media screen and (max-width: 720px) {
        .dataTables_filter {

          float: right;
          position: relative;
          left: 25px;
        }
}

@media screen and (max-width: 640px) {
        .dataTables_filter {

          float: right;
          position: relative;
          left: 25px;
        }
}

.numUsers {
                color: #7C83FD;
                float: left; 
                position: relative; 
                top: 50px; 
                font-size: 20px;
            }

            @media (max-width: 620px) {

                .numUsers {
                color: #7C83FD;
                float: left; 
                position: relative; 
                top: 15px; 
                font-size: 20px;
                }
            }

</style>


<main>

    <div style="margin-left: -20px;" class="container-fluid">
        <div class="row mt-5">
            <div class="col-12">
                <div class="title" style="color:#737BF1; margin-left: 38px;">Reporte de Usuarios</div>
                <div style="margin-left: 25px;" class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" href="reporteUsuario.php">
                                        por usuarios
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="reporteEmpresa.php">
                                        por empresas
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>



                <div class=" filtros col-12 " style="width:100%;">
                    <div class=" ml-2" >
                        <div class="col-13 ml-4 ordernarFiltros">
                            <div class="table">
                                <div class="filters" style="color:white;">
                                    <div class="form-group">
                                        Nombre:
                                        <input type="text" id="inputNombre" name="nombre" class="form-control mt-2"
                                            value="" style="border: #bababa 1px solid; color:#000000;">
                                    </div>
                                    <div class="form-group">
                                        Curso:
                                        <input type="text" id="inputCurso" name="curso" class="form-control mt-2"
                                            value="" style="border: #bababa 1px solid; color:#000000;">
                                    </div>
                                    <div class="form-group date">
                                        Fecha de Inscripción:
                                        <input type="date" id="inputInscripcion" name="fecha" class="form-control mt-2"
                                            value="" style="border: #bababa 1px solid; color:#000000;">
                                    </div>
                                    <div class="form-group date">
                                        Fecha de Finalización:
                                        <input type="date" id="inputFinalizacion" name="fecha-final"
                                            class="form-control mt-2" value=""
                                            style="border: #bababa 1px solid; color:#000000;">
                                    </div>


                                    <div class="form-group">
                                        Avance
                                        <select id="inputAvance" name="avance" class="form-control mt-2"
                                            style="border: #bababa 1px solid; color:#000000;">

                                            <option value="">Todos</option>
                                            <option value=90>En Curso</option>
                                            <option value=100>Terminado (100%)</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        Estado
                                        <select id="inputEstado" name="estado" class="form-control mt-2"
                                            style="border: #bababa 1px solid; color:#000000;">

                                            <option value="">Todos</option>
                                            <option value=1>Aprobado</option>
                                            <option value=2>Desaprobado</option>

                                        </select>
                                    </div>


                                </div>
                            </div>
                            <div class="btnVer">
                                <input type="submit" class="btn" value="Ver" onClick="completarTabla()"
                                    style="background-color: #7C83FD; color: white;">
                            </div>
                        </div>



                    </div>
                    <p style="margin-left: 20px; font-weight: bold; color:#8CC9DB;"><i
                            class="mdi mdi-file-document ml-4"></i>Resultados encontrados</p>




                    <div style="margin-left: 30px;" class="card mt-2 row">
                        <div class="card-header">
                            <div class="row mb-2">
                                <div class="col-12">
                                    
                                </div>
                            </div>
                        </div>

                        <div class="card-body">

                            <p class="numUsers" style="color:#737BF1; margin-left: 0; font-size: 20px;">Cantidad de Usuarios
                                <!--<span style="color:#BEC1F3;">(<?php echo $resultUsu['cantidad']; ?>)</span>-->
                            </p>

                            <div style="margin-left: -20px;" class="table-responsive">
                                <table id="tablaCursos" class="table table-borderless dt-responsive text-left"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr style="background-color:#737BF1;">
                                            <th style="border-radius: 10px 0 0 10px;">ID Usuario</th>
                                            <th scope="col">Nombre Completo</th>
                                            <th>Curso</th>
                                            <th>Fecha de Inscripción</th>
                                            <th>Fecha de Finalización</th>
                                            <th>Avance</th>
                                            <th style="border-radius: 0 10px 10px 0;">Nota</th>
                                        </tr>
                                    </thead>
                                    <tbody id="body-table-filter">

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- FIN DE TABLA DE APROBADOS -->

                </div>
            </div>
        </div>

        <br>
        <br>
        <br>
        <script src="assets/js/reporteUsuario.js"></script>
</main>









<?php
} else {
  header('Location: ../../iniciosesion.php');
}
?>