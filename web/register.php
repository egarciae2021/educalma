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
$codigo=$_POST['codigo_registrar'];
$estatus=5;
if(empty($codigo)){
    $codigo=null;
    $estatus=3;
}

$password = password_hash($pass, PASSWORD_BCRYPT);

$pdo = Database::connect();
try{
    $verif = $pdo->prepare(" INSERT INTO `usuarios` (privilegio,padreEmpresa,hijoEmpresa,`nombres`,`apellido_pat`,`apellido_mat`,`email`,`pass`,`telefono`,`tipo_doc`,`nro_doc`,`sexo`,`fecha_nacimiento`,`pais`,cod_tipoDonador,estado,fecha_registro,mifoto,cod_Emp) 
    VALUES(:stado,'0','1',:nombre,:ape_pater,:ape_mater,:correo,:password,:telefono,:tipo_docu,:num_docume,:sexo,:fecha,:pais,'1','1',now(),'',:codigo)");
    $verif->bindParam(":stado",$estatus,PDO::PARAM_STR);
    $verif->bindParam(":nombre",$nombre,PDO::PARAM_STR);
    $verif->bindParam(":ape_pater",$ape_pater,PDO::PARAM_STR);
    $verif->bindParam(":ape_mater",$ape_mater,PDO::PARAM_STR);
    $verif->bindParam(":correo",$correo,PDO::PARAM_STR);
    $verif->bindParam(":password",$password,PDO::PARAM_STR);
    $verif->bindParam(":telefono",$telefono,PDO::PARAM_STR);
    $verif->bindParam(":tipo_docu",$tipo_docu,PDO::PARAM_INT);
    $verif->bindParam(":num_docume",$num_docume,PDO::PARAM_STR);
    $verif->bindParam(":sexo",$sexo,PDO::PARAM_INT);
    $verif->bindParam(":fecha",$fecha);
    $verif->bindParam(":pais",$pais,PDO::PARAM_STR);
    $verif->bindParam(":codigo",$codigo,PDO::PARAM_STR);
    $verif->execute();

    if(!empty($codigo) && $codigo!=null){

    // includes/Cursos_crud/inscribirseGratis.php?id=<?php echo $dato4["idCurso"];
    //Pablo ya sabes que se tiene que ahcer, lo unico que tienes que hacer es que se inscriba una vez registrado 
    //te dejo un par de datos pero avanza
    
    $sql2 = "SELECT id_user FROM usuarios ORDER BY id_user DESC LIMIT 1";
    $q2 = $pdo->prepare($sql2);
    $q2->execute();
    $data8 = $q2->fetch(PDO::FETCH_ASSOC);
    $idCurso = $data8['id_user'];

    $sql8 = "SELECT COUNT(id_Curso) FROM empresascursos WHERE codigo_curse='$codigo'";
    $q8 = $pdo->prepare($sql8);
    $cuento=$q8->execute();
    $suma=$q8->fetchColumn();

    $sql1 = "SELECT id_Curso FROM empresascursos WHERE codigo_curse='$codigo'";
    $q1 = $pdo->prepare($sql1);
    $cuento1=$q1->execute();
    $dato3 = $q1->fetchAll(PDO::FETCH_ASSOC);
    for ($i=0; $i <$suma ; ++$i) { 
        $Curso=$dato3[$i]['id_Curso'];
        $veri=$pdo->prepare("INSERT INTO `cursoinscrito`(curso_id, usuario_id, cod_curso, curso_obt, cantidad_respuestas) VALUES (:curso,:id,'', 1, 0)");
        $veri->bindParam(":curso",$Curso,PDO::PARAM_INT);
        $veri->bindParam(":id",$idCurso,PDO::PARAM_INT);
        $veri->execute();
    }
    }
}catch(PDOException $e){
    echo $e->getMessage();
}

Database::disconnect();
