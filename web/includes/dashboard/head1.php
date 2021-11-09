<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--========== BOX ICONS ==========-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!--========== CSS ==========-->
    <link rel="stylesheet" href="assets/css/style1.css">
    <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="stylesheet" href="assets/css/style3.css">
    <link rel="stylesheet" href="assets/css/style4.css">
    <link rel="stylesheet" href="assets/css/stymiscursos.css">

    <title>Educalma Dashboard</title>
</head>
<?php
session_start();
require_once 'database/databaseConection.php';

$id = $_SESSION['codUsuario'];

$pdo1 = Database::connect();
$veri1 = "SELECT * FROM cursoinscrito WHERE usuario_id = '$id' order by curso_id desc";
$q1 = $pdo1->prepare($veri1);
$q1->execute(array());
$cuenta4 = $q1->rowCount();
Database::disconnect();

$pdo9 = Database::connect();
$sql9 = "SELECT * FROM certificados WHERE idUser_certif='$id'";
$q9 = $pdo9->prepare($sql9);
$q9->execute();
$cuenta9 = $q9->rowCount();
Database::disconnect();

$pdo12 = Database::connect();
$sql12 = "SELECT * FROM usuarios WHERE id_user='$id'";
$q12 = $pdo12->prepare($sql12);
$q12->execute();
$cuenta12 = $q12->rowCount();
$dato12 = $q12->fetch(PDO::FETCH_ASSOC)

?>
