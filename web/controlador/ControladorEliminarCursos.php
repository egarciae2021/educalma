<?php
include_once 'ControladorCursos.php';
      
      $codigo=$_GET["id"];
      $objeto_cursos = new ControladorCursos();
      $objeto_cursos->ControladorEliminarCursos($codigo);

  header ("Location:../agregarcurso.php?err=".$error);  
?>
