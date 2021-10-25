<!doctype html>
<html lang="en">
	<head>
		<meta charset= "UTF-8">
		<link rel="stylesheet" href="../assets/css/sty.css">
	</head>
	<body></body>
</html>


<?php
   //Incluir la libreria
	include_once"../controlador/ControladorCursos.php";
	//Crear el objeto para el controlador
	$objcursos=new ControladorCursos();
	$listar = $objcursos->ControladorListarCursos();
	echo"<table border=2>
			<tr>
			    <td>Código</td>
				<td>Nombre</td>
				<td>Descripción</td>
				<td>N° Temas</td>
				<td>Costo</td>
				<td>Editar</td>
				<td>Eliminar</td>
				<td>Ver Curso</td>
			</tr>	
	";
	foreach ($listar as $fila) {
		echo"<tr>";
			echo "<td>".$fila[0]."</td>";
			echo "<td>".$fila[1]."</td>";
			echo "<td>".$fila[2]."</td>";
			echo "<td>".$fila[4]."</td>";
			echo "<td>".$fila[5]."</td>";
			echo "<td><a href='VistaModificarCursos.php?id=".$fila[0]."'>Modificar Registro</a></td>";
			echo "<td><a href='../controlador/ControladorEliminarCursos.php?id=".$fila[0]."'>Eliminar Registro</a></td>";
			echo "<td><a href=''><center><span class='icon-eye1'></span></center></a></td>";

		echo "</tr>";

	}

	//echo "<br><a href='vista/VistaListarCursos'>Regresar</a>";
?>
