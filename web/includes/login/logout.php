<?php

session_start();
unset ($_SESSION['iduser'],$_SESSION['nombres'],$_SESSION['username'],$_SESSION['start'],$_SESSION['privilegio'],$_SESSION['codUsuario'],$_SESSION['Logueado'],$_SESSION['expire'],$_SESSION['acabo'],$_SESSION['estado_actividad'],$_SESSION['usuario'],$_SESSION['telefono'],$_SESSION['genero'],$_SESSION['pais'],$_SESSION['tipoDocIdentidad'],$_SESSION['nroDocIdentidad'],$_SESSION['fechaNacimiento'],$_SESSION['codigoDonacion'],$_SESSION['passSinHash'],$_SESSION['nombres_nom'],$_SESSION['nombres_pat'],$_SESSION['nombres_mat'],$_SESSION['padre'],$_SESSION['hijo']);
session_destroy();

header('Location: ../../index.php');

?>