<?php
    //iniciar componentes de sesión
    ob_start(); 
    session_start();

    require_once '../../database/databaseConection.php';

    $user_id = $_POST['user_id'];
    $token = $_POST['token'];
    $password = $_POST['pass_registrar'];
    $conn_password = $_POST['pass-confirm_registrar'];

    if (validaPassword($password, $conn_password)){
        
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $pdo = Database::connect();		
        $respuesta=$pdo->prepare("UPDATE usuarios SET pass = '$passwordHash', token_password='', password_request=0 WHERE id_user = '$user_id' AND token_password = '$token'");
        //$respuesta->execute();

        if($respuesta->execute()){
            //echo "se cambio la contraseña";
			echo 1;
            // header('Location: ../../login.php');
		} else {
            //echo "No se pudo cambiar la contraseña";
			echo 2;	
		}
        
    }else{
        //echo "las contraseñas no coinciden";
        echo 0;	
    }



    function validaPassword($var1, $var2)
	{
		if (strcmp($var1, $var2) !== 0){
			return false;
		} else {
			return true;
		}
	}



?>