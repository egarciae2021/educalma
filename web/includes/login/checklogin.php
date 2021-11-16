<?php
//iniciar componentes de sesión
ob_start(); 
session_start();

require_once '../../database/databaseConection.php';


if(isset($_POST['email_user_login'])){ 
    $username = $_POST['email_user_login'];
}else{
    $username = '';
}
if(isset($_POST['pass_login'])){
    $password_sinHash = $_POST['pass_login'];
}else{
    $password_sinHash = '';
}

$_SESSION['Logueado'] = false;

$pdo = Database::connect();
$sql = "SELECT * FROM usuarios WHERE email = '$username'";
$q = $pdo->prepare($sql);
$q->execute(array());
$dato=$q->fetch(PDO::FETCH_ASSOC);
Database::disconnect();

echo $username." + ".$password_sinHash;
//sacando el pass de la DB
$pass_con_hash = $dato['pass'];
//ESTADO PENDIENTE
if ($dato['estado'] == 1 && password_verify($password_sinHash, $pass_con_hash) === true) {
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (10 * 60);
    $_SESSION['passSinHash'] = $password_sinHash;
    $_SESSION['iduser'] = $dato['id_user'];
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

    if($_SESSION['privilegio'] == 1 || $_SESSION['privilegio'] == 2 || $_SESSION['privilegio'] == 3 || $_SESSION['privilegio'] == 4 || $_SESSION['privilegio'] == 5 || $_SESSION['privilegio'] == 6){
        //echo '<script>swal("Inicio de Sesión Exitoso", "Has iniciado sesión correctamente.", "success");</script>';
        //header('Location: ../../index.php'); 
        $_SESSION['Logueado']=true;
    }else{
        //echo '<script>swal("Falló el Inicio de Sesión", "El Nombre de Usuario y/o Contraseña son Incorrectos.", "error");</script>';
        //header('Location: ../../iniciosesion.php'); 
        $_SESSION['Logueado']=false;
    } 
}else{
	    $_SESSION['estado_actividad']=$dato['estado'];
    }

if($_SESSION['Logueado'] != true){
    $_SESSION['usuario'] = $username;
    //header('Location: ../../iniciosesion.php');
}
//ob_end_flush();
?>