<?php 
require_once '../database/databaseConection.php';
  function ObtenerRegistros(){
    $pdo4 = Database::connect();
    $filtros = array();
    $consulta = "";
    if(isset($_POST["nombre"]) || isset($_POST["curso"]) || isset($_POST["fecha"]) || isset($_POST["fecha_final"]) ||isset($_POST["avance"])|| isset($_POST["estado"])){
      $consulta = "SELECT * FROM cursoinscrito INNER JOIN usuarios ON cursoinscrito.usuario_id = usuarios.id_user INNER JOIN cursos ON cursoinscrito.curso_id = cursos.idCurso ";
      $consulta .= " WHERE ";
      if(isset($_POST["nombre"])){
          if($_POST["nombre"]!=""){
            $consulta .= "usuarios.nombres LIKE CONCAT('%',?,'%')  AND ";
            array_push($filtros,$_POST["nombre"]);
          }
      }

      if(isset($_POST["curso"])){
          if($_POST["curso"]!=""){
            $consulta .= "cursos.nombreCurso LIKE CONCAT('%',?,'%')  AND ";
            array_push($filtros,$_POST["curso"]);
          }
      }

      if(isset($_POST["fecha"])){
          if($_POST["fecha"]!=""){
            $consulta .= "cursoinscrito.fechaInscripcion = ?  AND ";
            array_push($filtros,$_POST["fecha"]);
          }
      }

      if(isset($_POST["fecha_final"])){
          if($_POST["fecha_final"]!=""){
            $consulta .= "cursoinscrito.fechaFinalizacion = ?  AND ";
            array_push($filtros,$_POST["fecha_final"]);
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


    $sentencia = $pdo4->prepare($consulta);
    $sentencia->execute($filtros);
    $data = $sentencia->fetchAll();
    $template = "";
    foreach($data as $usuario){
            $template .= '<tr class="h-100 justify-content-center align-items-center">';
            $template .= '
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
    return $template;
  }

  echo ObtenerRegistros();

?>