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

    background: #7C83FD;
    /*border-radius: 20px !important;*/

}

@media screen and (max-width: 720px) {}

@media screen and (max-width: 640px) {}

@media (max-width: 429px) {}

@media (max-width: 429px) {}
</style>


<main>

    <div class="container-fluid">
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



                    <div class="col-12 row">

                        <div class="col-11">
                            <table class="table">
                                <thead>
                                    <tr class="filters">

                                        <th>
                                            Nombre:
                                            <input type="text" id="inputNombre" name="nombre" class="form-control mt-2" value=""
                                                style="border: #bababa 1px solid; color:#000000;">
                                        </th>
                                        <th>
                                            Curso:
                                            <input type="text" id="inputCurso" name="curso" class="form-control mt-2" value=""
                                                style="border: #bababa 1px solid; color:#000000;">
                                        </th>
                                        <th>
                                            Fecha de Inscripción:
                                            <input type="date" id="inputInscripcion" name="fecha" class="form-control mt-2" value=""
                                                style="border: #bababa 1px solid; color:#000000;">
                                        </th>
                                        <th>
                                            Fecha de Finalización:
                                            <input type="date" id="inputFinalizacion" name="fecha-final" class="form-control mt-2"
                                                value="" style="border: #bababa 1px solid; color:#000000;">
                                        </th>


                                        <th>
                                            Avance
                                            <select  id="inputAvance" name="avance" class="form-control mt-2"
                                                style="border: #bababa 1px solid; color:#000000;">

                                                <option value="">Todos</option>
                                                <option value=90>En Curso</option>
                                                <option value=100>Terminado (100%)</option>
                                            </select>
                                        </th>

                                        <th>
                                            Estado
                                            <select  id="inputEstado" name="estado" class="form-control mt-2"
                                                style="border: #bababa 1px solid; color:#000000;">

                                                <option value="">Todos</option>
                                                <option value=1>Aprobado</option>
                                                <option value=2>Desaprobado</option>

                                            </select>
                                        </th>


                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <div style="margin-top: 28px; class=" col-1">
                            <input type="submit" class="btn" value="Ver" onClick="completarTabla()"
                                style="margin-top: 38px; background-color: #7C83FD; color: white;">

                        </div>


                        <p style="margin-left: 20px; font-weight: bold; color:#8CC9DB;"><i
                                class="mdi mdi-file-document"></i> <?php ?> Resultados encontrados</p>




                <div style="margin-left: 30px;" class="card mt-2">
                    <div class="card-header">
                        <div class="row mb-2">
                            <div class="col-12">
                                <h3 style="color:#737BF1; margin-left: 30px; font-size: 20px;">Cantidad de Usuarios
                                    <!--<span style="color:#BEC1F3;">(<?php echo $resultUsu['cantidad']; ?>)</span>-->
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tableUsuarios" class="table table-borderless dt-responsive text-left"
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