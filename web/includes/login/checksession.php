<?php
    
    ob_start();
    @session_start();
    if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true){
        
    } else{
            session_destroy();
            session_start();
            $_SESSION['acabo']=true;
            header('Location: ../../index.php');
            exit;
        }
    $now = time();
    if ($now > $_SESSION['expire'])
        {
            session_destroy();
            session_start();
            $_SESSION['acabo']=true;
            header('Location: ../../index.php');
            exit;
        }
    ob_end_flush();
?>