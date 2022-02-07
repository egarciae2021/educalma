<?php

ob_start();
@session_start();
    require_once 'database/databaseConection.php';

$idad= $_SESSION['codUsuario'];
    $pdo4 = Database::connect();
    $sql1 = "SELECT id_solicitud FROM solicitud where id_usuario=$idad LIMIT 1";
    $q1 = $pdo4->prepare($sql1);
    $q1->execute();
    $datos1=$q1->fetch(PDO::FETCH_ASSOC);
    echo $idd=$datos1['id_solicitud'];

    $sql2 = "SELECT codigo_curse FROM empresascursos where id_Empresa='$idd' LIMIT 1";
    $q2 = $pdo4->prepare($sql2);
    $q2->execute();
    $datos=$q2->fetch(PDO::FETCH_ASSOC);
    echo $iddad=$datos['codigo_curse'];

?>