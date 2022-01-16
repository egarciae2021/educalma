<?php
// Registrar solicitud

// DB
require_once '../../database/databaseConection.php';
$pdo4 = Database::connect();
$nombre=$_POST["nomCompleto"];//

$email=$_POST["txtEmail"];

$correoE=$_POST["txtCorreo"];
$Empre=$_POST["txtEmpresa"];
$code=$_POST["code"];
$telefono=$_POST["txtTelMovil"];
$num=$_POST["tamEmpresa"];
$subs=$_POST["numSusc"];
$objEmp=$_POST["objEmpresa"];

$pass="123";
$password = password_hash($pass, PASSWORD_BCRYPT);

try{
    $verif = $pdo4->prepare(" INSERT INTO `usuarios` (privilegio,padreEmpresa,hijoEmpresa,`nombres`,`apellido_pat`,`apellido_mat`,`email`,`pass`,`telefono`,`tipo_doc`,`nro_doc`,`sexo`,`fecha_nacimiento`,`pais`,cod_tipoDonador,estado,fecha_registro,mifoto) 
    VALUES('4','0','1',:nombre,'','',:correo,:password,:telefono,'','','','','','1','0',now(),'')");
    $verif->bindParam(":nombre",$nombre,PDO::PARAM_STR);
    // $verif->bindParam(":ape_pater",$ape_pater,PDO::PARAM_STR);
    // $verif->bindParam(":ape_mater",$ape_mater,PDO::PARAM_STR);
    $verif->bindParam(":correo",$email,PDO::PARAM_STR);
    $verif->bindParam(":password",$password,PDO::PARAM_STR);
    $verif->bindParam(":telefono",$telefono,PDO::PARAM_STR);
    // $verif->bindParam(":tipo_docu",$tipo_docu,PDO::PARAM_INT);
    // $verif->bindParam(":num_docume",$num_docume,PDO::PARAM_STR);
    // $verif->bindParam(":sexo",$sexo,PDO::PARAM_INT);
    // $verif->bindParam(":fecha",$fecha);
    // $verif->bindParam(":pais",$pais,PDO::PARAM_STR);
    $verif->execute();
}catch(PDOException $e){
    echo $e->getMessage();
}
try{
$id_usu =$pdo4->prepare("SELECT id_user FROM `usuarios` order by id_user DESC LIMIT 1");
$id_usu->execute();
$id_usu=$id_usu->fetch(PDO::FETCH_ASSOC);
$id_usu=$id_usu['id_user'];

//Correo corporativo
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
	"id_user" => $id_usu
];

$sql4 = "CALL PROC_NUEVA_SOLICITUD (:txtEmail, :nomCompleto, :txtCorreo, :txtEmpresa, :code, :txtTelMovil, :tamEmpresa, :numSusc, :objEmpresa,:id_user)";
$q4 = $pdo4->prepare($sql4);
$q4->execute( $data);

$registro =  $q4->fetch(PDO::FETCH_ASSOC);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($registro);
}catch(PDOException $e){
	echo "<script>alert('$e');</script>";
}
