<?php
ob_start();
@session_start();
if (isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)) {
  require_once 'database/databaseConection.php';
  $pdo4 = Database::connect();
  function ObtenerRegistros(){
    $filtros = array();
    $consulta = "";
    if(isset($_POST["nombre"]) || isset($_POST["curso"]) || isset($_POST["fecha"]) || isset($_POST["fecha-final"]) ||isset($_POST["avance"])|| isset($_POST["estado"])){
      $consulta = "SELECT * FROM cursoinscrito INNER JOIN usuarios ON cursoinscrito.usuario_id = usuarios.id_user INNER JOIN cursos ON cursoinscrito.curso_id = cursos.idCurso ";
      $consulta .= " WHERE ";
      if(isset($_POST["nombre"])){
          if($_POST["nombre"]!=""){
            $consulta .= "usuarios.nombres = ?  AND ";
            array_push($filtros,$_POST["nombre"]);
          }
      }

      if(isset($_POST["curso"])){
          if($_POST["curso"]!=""){
            $consulta .= "cursos.nombreCurso = ?  AND ";
            array_push($filtros,$_POST["curso"]);
          }
      }

      if(isset($_POST["fecha"])){
          if($_POST["fecha"]!=""){
            $consulta .= "cursoinscrito.fechaInscripcion = ?  AND ";
            array_push($filtros,$_POST["fecha"]);
          }
      }

      if(isset($_POST["fecha-final"])){
          if($_POST["fecha-final"]!=""){
            $consulta .= "cursoinscrito.fechaFinalizacion = ?  AND ";
            array_push($filtros,$_POST["fecha-final"]);
          }
      }

      if(isset($_POST["avance"])){
          if($_POST["avance"]!=""){
            if($_POST["avance"]==100){
              $consulta .= "cursoinscrito.avance = ?  AND ";
            }else{
              $consulta .= "cursoinscrito.avance <= ?  AND ";
            }
            array_push($filtros,$_POST["avance"]);
          }
      }

      if(isset($_POST["estado"])){
          if($_POST["estado"]!=""){
            if($_POST["estado"] == 1){
              $consulta .= "cursoinscrito.nota >= 19 AND ";
            }
            else{
              $consulta .= "cursoinscrito.nota < 19 AND ";
            }
          }
      }
      $consulta .= "cursoinscrito.id_cursoInscrito = cursoinscrito.id_cursoInscrito ";
    }

    $response = [$consulta, $filtros]; 
    return $response ;
  }


  
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

            .filters {
              
              background: #7C83FD;
              /*border-radius: 20px !important;*/

            }

            @media screen and (max-width: 720px) {

                 
            }

            @media screen and (max-width: 640px) {

               
            }

            @media (max-width: 429px) {

             
            }

            @media (max-width: 429px) {
             
            }
            

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



<form action="reporteUsuario.php" method="post">
        <div class="col-12 row">

            <div class="col-11">
                        <table class="table">
                                <thead>
                                        <tr class="filters">

                                                <th>
                                                        Nombre:
                                                        <input type="text" id="" name="nombre" class="form-control mt-2" value="" style="border: #bababa 1px solid; color:#000000;" >
                                                </th>
                                                <th>
                                                        Curso:
                                                        <input type="text" id="" name="curso" class="form-control mt-2" value="" style="border: #bababa 1px solid; color:#000000;" >
                                                </th>
                                                <th>
                                                        Fecha de Inscripción:
                                                        <input type="date" id="" name="fecha" class="form-control mt-2" value="" style="border: #bababa 1px solid; color:#000000;" >
                                                </th>
                                                <th>
                                                        Fecha de Finalización:
                                                        <input type="date" id="" name="fecha-final" class="form-control mt-2" value="" style="border: #bababa 1px solid; color:#000000;" >
                                                </th>
                                                
                                                
                                                <th>
                                                        Avance
                                                        <select id="" id="" name="avance" class="form-control mt-2" style="border: #bababa 1px solid; color:#000000;" >
                                                                
                                                                <option value="" >Todos</option>
                                                                <option value=90>En Curso</option>
                                                                <option value=100>Terminado (100%)</option>
                                                        </select>
                                                </th>

                                                <th>
                                                        Estado
                                                        <select id="" id="" name="estado" class="form-control mt-2" style="border: #bababa 1px solid; color:#000000;" >
                                                                
                                                                <option value="">Todos</option>
                                                                <option value=1>Aprobado</option>
                                                                <option value=2>Desaprobado</option>
                                                                
                                                        </select>
                                                        <input type="text" name="show" value="active" style="display:none;">
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




                  <div style="margin-left: 30px;" class="card mt-2">
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
                                  if(isset($_POST["show"])){
                                    $sentencia = $pdo4->prepare(ObtenerRegistros()[0]);
                                    $sentencia->execute(ObtenerRegistros()[1]);
                                    $data = $sentencia->fetchAll();
                                    foreach($data as $usuario){
                                            echo '<tr class="h-100 justify-content-center align-items-center">';
                                            echo '
                                            <td>'.$usuario['id_user'].'</td>
                                            <td>'.$usuario['nombres'].'</td>
                                            <td>'.$usuario['nombreCurso'].'</td>
                                            <td>'.$usuario['fechaInscripcion'].'</td>
                                            <td>'.$usuario['fechaFinalizacion'].'</td>
                                            <td>'.$usuario['avance'].'</td>
                                            <td>'.$usuario['nota'].'</td>

                                            ';
                                      }
                                    Database::disconnect();
                                  }

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






































