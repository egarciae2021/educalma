<?php
// Registrar solicitud

// DB
require_once '../../database/databaseConection.php';

// Correo corporativo
$data = [
	"txtEmail" => $_POST["txtEmail"],
	"nomCompleto" => $_POST["nomCompleto"],
	"txtCorreo" => $_POST["txtCorreo"],
	"txtEmpresa" => $_POST["txtEmpresa"],
	"code" => $_POST["code"],
	"txtTelMovil" => $_POST["txtTelMovil"],
	"tamEmpresa" => $_POST["tamEmpresa"],
	"numSusc" => $_POST["numSusc"],
	"objEmpresa" => $_POST["objEmpresa"],
];

$pdo4 = Database::connect();
$sql4 = "CALL PROC_NUEVA_SOLICITUD (:txtEmail, :nomCompleto, :txtCorreo, :txtEmpresa, :code, :txtTelMovil, :tamEmpresa, :numSusc, :objEmpresa)";
$q4 = $pdo4->prepare($sql4);
$q4->execute( $data);

$registro =  $q4->fetch(PDO::FETCH_ASSOC);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($registro);
