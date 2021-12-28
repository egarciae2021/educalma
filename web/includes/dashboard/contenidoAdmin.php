<?php
// Este codigo hace validacion para que no se pueda acceder a cualquier pagina sin estar logueado__Pablo Loyola
ob_start();
@session_start();
 if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
?>
<!--==========









AQUI ESCRIBES




==========-->





<?php
    }
    else{
        header('Location: ../../iniciosesion.php');
    }
?>
