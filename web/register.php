<?php
require_once './database/databaseConection.php';

$nombre = $_POST['nombres_registrar'];
$ape_pater = $_POST['apellidoPat_registrar'];
$ape_mater = $_POST['apellidoMat_registrar'];
$correo = $_POST['email_user_registrar'];
$pass = $_POST['pass_registrar'];
$telefono = $_POST['telef_registrar'];
$tipo_docu = $_POST['tipo_documento'];
$num_docume = $_POST['num_docu_registrar'];
$sexo = $_POST['sexo'];
$fecha = $_POST['fecha_registrar'];
$pais = $_POST['pais_registrar'];

$password = password_hash($pass, PASSWORD_BCRYPT);

$pdo = Database::connect();
$verif = $pdo->prepare(" INSERT INTO usuarios (privilegio,padreEmpresa,hijoEmpresa,nombres,apellido_pat,apellido_mat,email,pass,telefono,tipo_doc,nro_doc,sexo,fecha_nacimiento,pais,cod_tipoDonador,estado,fecha_registro,mifoto) 
VALUES 
('3','0','1','$nombre','$ape_pater','$ape_mater','$correo','$password','$telefono','$tipo_docu','$num_docume','$sexo','$fecha','$pais','1','1',now(),'')");
$verif->execute();

Database::disconnect();
