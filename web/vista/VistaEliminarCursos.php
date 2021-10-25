
<?php
   //Incluir la libreria
	include_once"../controlador/ControladorCursos.php";
	//Crear el objeto para el controlador
	$objcursos=new ControladorCursos();
	$listar = $objcursos->ControladorListarCursos();
	echo"<table border=2>
			<tr>
				<td>CODIGO</td>
				<td>nombre</td>
			</tr>	
	";
	foreach ($listar as $fila) {
		echo"<tr>";
			echo "<td>".$fila[0]."</td>";
			echo "<td>".$fila[2]."</td>";
		echo "</tr>";

	}

	echo "<br><a href='VistaListarCursos.php'>Regresar</a>";
?>
