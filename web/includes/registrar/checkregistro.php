<?php
    ob_start(); 
    session_start();
        

require_once '../../database/databaseConection.php';


$nombre=$_POST['nombres_registrar'];
$ape_pater=$_POST['apellidoPat_registrar'];
$ape_mater=$_POST['apellidoMat_registrar'];
$correo=$_POST['email_user_registrar'];
$pass=$_POST['pass_registrar'];
$telefono=$_POST['telef_registrar'];
$tipo_docu=$_POST['tipo_documento'];
$num_docume=$_POST['num_docu_registrar'];
$sexo=$_POST['sexo'];
$fecha=$_POST['fecha_registrar'];
$pais=$_POST['pais_registrar'];
$imga=$_FILES['imagen']['tmp_name'];

        if($_FILES['imagen']['size']>0){
            $imga = addslashes(file_get_contents($imga));
        }else{
            $aux = "../../assets/images/user.png";
            $imga = addslashes(file_get_contents($aux));

        }

$pdo = Database::connect();
$veri="SELECT * FROM usuarios WHERE email = '$correo' ";
$q = $pdo->prepare($veri);
$q->execute(array());
$dato=$q->fetch(PDO::FETCH_ASSOC);
Database::disconnect();

//$correo=$_POST['correo'];

    if($dato==0){
       //password con hash 
        $password = password_hash($pass, PASSWORD_BCRYPT);

        $pdo = Database::connect();
        // $verif=$pdo->prepare(" INSERT INTO usuarios (privilegio,padreEmpresa,hijoEmpresa,nombres,apellido_pat,apellido_mat,email,pass,telefono,tipo_doc,nro_doc,sexo,fecha_nacimiento,pais,cod_tipoDonador,estado,fecha_registro,mifoto) 
        $verif=$pdo->prepare(" INSERT INTO `usuarios` (privilegio,padreEmpresa,hijoEmpresa,`nombres`,`apellido_pat`,`apellido_mat`,`email`,`pass`,`telefono`,`tipo_doc`,`nro_doc`,`sexo`,`fecha_nacimiento`,`pais`,cod_tipoDonador,estado,fecha_registro,`mifoto`) 
        VALUES('3','0','1',:nombre,:ape_pater,:ape_mater,:correo,:password,:telefono,:tipo_docu,:num_docume,:sexo,:fecha,:pais,'1','1',now(),:imga)");
        $verif->bindParam(":nombre",$nombre,PDO::PARAM_STR);
        $verif->bindParam(":ape_pater",$ape_pater,PDO::PARAM_STR);
        $verif->bindParam(":ape_mater",$ape_mater,PDO::PARAM_STR);
        $verif->bindParam(":correo",$correo,PDO::PARAM_STR);
        $verif->bindParam(":password",$password,PDO::PARAM_STR);
        $verif->bindParam(":telefono",$telefono,PDO::PARAM_STR);
        $verif->bindParam(":tipo_docu",$tipo_docu,PDO::PARAM_INT);
        $verif->bindParam(":num_docume",$num_docume);
        $verif->bindParam(":sexo",$sexo,PDO::PARAM_INT);
        $verif->bindParam(":fecha",$fecha);
        $verif->bindParam(":pais",$pais,PDO::PARAM_STR);
        $verif->bindParam(":imga",$imga);
        $verif->execute();

        Database::disconnect();
       
        /* ---------------------------------------------------------------------- */
   
  /* -------------------------------LOGEO AUTOMATICO------------------------ */
/*
  $_SESSION['Logueado'] = false;
        
  $pdo = Database::connect();
  $sql = "SELECT * FROM usuarios WHERE email = '$correo' AND pass = '$pass'";
  $q = $pdo->prepare($sql);
  $q->execute(array());
  $dato=$q->fetch(PDO::FETCH_ASSOC);
  Database::disconnect();
  

  $_SESSION['start'] = time();
  $_SESSION['expire'] = $_SESSION['start'] + (10 * 60);
  $_SESSION['passSinHash'] = $pass;
  $_SESSION['nombres'] = $dato['nombres']." ".$dato['apellido_pat']." ".$dato['apellido_mat'];
  $_SESSION['nombres_nom'] = $dato['nombres'];
  $_SESSION['nombres_pat'] = $dato['apellido_pat'];
  $_SESSION['nombres_mat'] = $dato['apellido_mat'];
  $_SESSION['privilegio'] = $dato['privilegio'];
  $_SESSION['username'] = $dato['email'];
  $_SESSION['codUsuario'] = $dato['id_user'];
  $_SESSION['telefono']=$dato['telefono'];
  $_SESSION['genero']=$dato['sexo'];
  $_SESSION['tipoDocIdentidad']=$dato['tipo_doc'];
  $_SESSION['nroDocIdentidad']=$dato['nro_doc'];
  $_SESSION['fechaNacimiento']=$dato['fecha_nacimiento'];
  $_SESSION['codigoDonacion']=$dato['cod_tipoDonador'];
  $_SESSION['pais']=$dato['pais'];
  $_SESSION['padre']= $dato['padreEmpresa'];
  $_SESSION['hijo']= $dato['hijoEmpresa'];
  
  //header('Location: ../../miscursos.php'); 
  $_SESSION['Logueado']=true;
  
ob_end_flush();
 */
echo 1;
    }
  else{
    echo 0;
       
    }

?>