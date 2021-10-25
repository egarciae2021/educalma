<?php include_once 'includes/Inicio/Head.php' ?>

<body id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">
<?php include_once 'includes/Inicio/Loader.php' ?>

<?php 
// Sesión
    ob_start();
    @session_start();
    $now = time();
    if(isset($_SESSION['acabo'])){
      echo '<script>swal({title: "Su Sesión Terminó",icon: "warning",allowEscapeKey: false,allowOutsideClick:false,text: "Ingrese sus Datos Nuevamente para continuar.",showConfirmButton: false});</script>';
      session_destroy(); 
    }
?>

<?php include_once 'includes/Inicio/Header.php' ?>

<?php include_once 'includes/login/Login.php' ?>

<?php
    //---- logueado o no 
    if(isset($_SESSION['Logueado'])){
        if($_SESSION['Logueado']===true){
            if(isset($_SESSION['expire']) && $now < $_SESSION['expire']){
                echo '<script>window.location="index.php";</script>';   
            }
        }else{
            if(isset($_SESSION['estado_actividad']) && $_SESSION['estado_actividad'] != 1){
              echo '<script>';
              echo 'swal("Falló Inicio de Sesión", "Este usuario no está activo.", "error")';
              echo '</script>';
              session_destroy();
            } else{
                echo '<script>swal("Falló Inicio de Sesión", "El Nombre de Usuario y/o Contraseña son Incorrectos.", "error");</script>';    
                session_destroy();
            }
        }
    }
    ob_end_flush();
?>

<?php include_once 'includes/Inicio/Footer.php' ?>
</body>
