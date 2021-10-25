
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="./assets/css/s.dashboard.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./assets/lib/fontawesome/css/all.min.css" />
  <link rel="stylesheet" href="././assets/css/stylesidebar.css">
  <link rel="stylesheet" href="./assets/css/styledashboard.css">

  <!-- <link rel="stylesheet" href="./assets/css/dashboardPcss/miscursos.css"> -->

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
