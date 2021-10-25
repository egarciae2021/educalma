<?php
include_once 'ControladorCursos.php';
      
      $codigo=$_POST["idCurso"];
      $nombre=$_POST["nombre"];
      $descripcion=$_POST["descripcion"];
      $ntemas=$_POST["ntemas"];
      $costo=$_POST["costo"];

      $objeto_cursos = new ControladorCursos();
      $objeto_cursos->ControladorModificarCursos($codigo,$nombre,$descripcion,$ntemas,$costo);

  header ("Location:../vista/VistaListarCursos.php?err=".$error);  
?>
