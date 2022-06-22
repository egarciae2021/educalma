<?php
ob_start();
@session_start();
if (isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)) {
  require_once 'database/databaseConection.php';
?>



  <head>
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css" />
    <link rel="stylesheet" href="includes/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="assets/css/styledash.css">
  </head>


        <style>
            .dataTables_filter{

                /*Centrando el buscador de "Por Empresas".*/
                position: relative;  
                left: -140px;
                float: left;
                /**/

                border-radius: 5px ; 
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

            @media screen and (max-width: 720px) {

                .dataTables_filter{

                    float: right;
                    position: relative;
                    left: 25px;
                }
            }

            @media screen and (max-width: 640px) {

                .dataTables_filter{

                    float: right;
                    position: relative;
                    left: 25px;
                }
            }

            .filtro_1 {

              display: flex;
              color: #737BF1;
              position: relative;
              left: 10px;
 
               
            }

            .txtFiltrarPor {

              font-weight: bold;
            }

            .cbofiltroApDes {

              position: relative;
              top: -10px;
              width: 270px;
            }

          @media (max-width: 429px) {

            .filtro_1{
              display: block;
            }
            }

          @media (max-width: 429px) {
            .cbofiltroApDes{
              right: 11px;
            }
            }
            

        </style>

  
  <main>

    <div class="container-fluid">
      <div class="row mt-5">
        <div class="col-12">
        <div class="title" style="color:#737BF1;">Reporte de Usuarios</div>
          <div class="row">
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

          

                  <br><br>

                  








<div style="position: relative; top: -80px;" class="container mt-5">
    <div class="col-12">
 


    <div class="row">
<div class="col-12 grid-margin">
<div class="card">
<div class="card-body">


<form>
        <div class="col-12 row">


            
            <div class="col-11">

                        <table class="table">
                                <thead>
                                        <tr class="filters">

                                                <th>
                                                        Nombre:
                                                        <input type="text" id="" name="" class="form-control mt-2" value="" style="border: #bababa 1px solid; color:#000000;" >
                                                </th>
                                                <th>
                                                        Curso:
                                                        <input type="text" id="" name="" class="form-control mt-2" value="" style="border: #bababa 1px solid; color:#000000;" >
                                                </th>
                                                <th>
                                                        Fecha de Inscripción:
                                                        <input type="date" id="" name="" class="form-control mt-2" value="" style="border: #bababa 1px solid; color:#000000;" >
                                                </th>
                                                <th>
                                                        Fecha de Finalización:
                                                        <input type="date" id="" name="" class="form-control mt-2" value="" style="border: #bababa 1px solid; color:#000000;" >
                                                </th>
                                                
                                                
                                                <th>
                                                        Avance
                                                        <select id="" id="" name="" class="form-control mt-2" style="border: #bababa 1px solid; color:#000000;" >
                                                                
                                                                <option value="">Todos</option>
                                                                <option value="En_Curso">En Curso</option>
                                                                <option value="Terminado">Terminado (100%)</option>
                                                        </select>
                                                </th>

                                                <th>
                                                        Estado
                                                        <select id="" id="" name="" class="form-control mt-2" style="border: #bababa 1px solid; color:#000000;" >
                                                                
                                                                <option value="Todos">Todos</option>
                                                                <option value="Aprobado">Aprobado</option>
                                                                <option value="Desaprobado">Desaprobado</option>
                                                                
                                                        </select>
                                                </th>
                                                
                                               
                                        </tr>
                                </thead>
                        </table>
                </div>


                <div style="margin-top: 28px; class="col-1">
                    <input type="submit" class="btn" value="Ver" style="margin-top: 38px; background-color: #7C83FD; color: white;">
                </div>


                
            
            


        
        <p style="margin-left: 20px; font-weight: bold; color:#8CC9DB;"><i class="mdi mdi-file-document"></i> <?php ?> Resultados encontrados</p>
</form>




                  <div class="card mt-2">
                    <div class="card-header">
                        <div class="row mb-2">
                            <div class="col-12">
                                <h3 class="card-title" style="color:#737BF1;">Cantidad de Usuarios
                                    <!--<span style="color:#BEC1F3;">(<?php echo $resultUsu['cantidad']; ?>)</span>-->
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tableUsuarios" class="table table-borderless dt-responsive text-left" cellspacing="0" width="100%">
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
                                <tbody>
                                  <?php             
                                    $pdo4 = Database::connect();
                                    $sql4 = "SELECT * FROM `aprobados`";
                                    foreach($pdo->query($sql4) as $aprobados){ //= $q4->fetch(PDO::FETCH_ASSOC)
                                      echo '<tr class="h-100 justify-content-center align-items-center">';
                                      echo '
                                          <td>'. $aprobados['idUsuario'].'</td>
                                          <td>'. $aprobados['nombres'].'</td> 
                                          <td>'. $aprobados['nombreCurso'].'</td>
                                          <td>'. $aprobados['fechaInscripcion'].'</td> 
                                          <td>'. $aprobados['fechaFinalizacion'].'</td>  
                                          <td>'. $aprobados['avance'].'</td>
                                          <td>'. $aprobados['nota'].'</td>
                                      ';
                                          }
                                    Database::disconnect();
                                  ?>  
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

  </main>









<?php
} else {
  header('Location: ../../iniciosesion.php');
}
?>






































