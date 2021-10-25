
<?php
   //Incluir la libreria
  include_once"../controlador/ControladorCursos.php";
  //Crear el objeto para el controlador
  $objcursos=new ControladorCursos();
  $listar = $objcursos->ControladorDatosCursos($_GET["id"]);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
  <h3>Modificar datos de los Cursos</h3>
  <form action="../controlador/ControladorModificarCursos.php" method="post">
    <?php foreach ($listar as $fila) { ?>
      <input type="text" name="nombre" value="<?php echo $fila["nombreCurso"]; ?>" placeholder="Ingresar Nombre" required>
      <input type="text" name="descripcion" value="<?php echo $fila["descripcionCurso"]; ?>" placeholder="Ingresar Descripcion" required>
      <input type="text" name="ntemas" value="<?php echo $fila["cantidadTemas"]; ?>" placeholder="N° Temas" required>
      <input type="text" name="costo" value="<?php echo $fila["costoCurso"]; ?>" placeholder="Ingresar Costo del Curso" required>   
      <input type="hidden" name="idCurso" value="<?php echo $fila["idCurso"]; ?>">
    <?php } ?>    
    <input type="submit" name="submit" value="Registrar">
  </form>
<br><br>
 

  <a href="VistaListarCursos.php">Regresar</a>
  </body>
</html>