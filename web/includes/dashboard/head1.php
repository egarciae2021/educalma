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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css" />
    <!-- Pogo Slider CSS -->
    <link rel="stylesheet" href="assets/css/plugins/pogo-slider.min.css" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="assets/css/plugins/responsive.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/plugins/custom.css" />

    <link rel="stylesheet" href="includes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="includes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="includes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- <link rel="stylesheet" href="../../main.css"> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>

      <!-- DataTables -->
    <link rel="stylesheet" href="includes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="includes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="includes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <title>Educalma Dashboard</title>
</head>
<?php
@session_start();
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
