<?php   
    ob_start();
    @session_start();
?>
<?php include_once 'includes/Inicio/Head.php' ?>
<?php include_once 'includes/dashboard/head1.php' ?>

<head>
<link rel="shortcut icon" href="assets/images/logo_edu.png">
</head>

<body id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98"> <!--id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98"-->
<?php include_once 'includes/Inicio/Loader.php' ?>



<?php include_once 'includes/dashboard/header1.php' ?>
<?php include_once 'includes/dashboard/body1.php' ?>

<?php include_once 'includes/curso/listarcurso.php' ?>
<link rel="stylesheet" href="assets/css/style2.css">
<link rel="stylesheet" href="assets/css/style1.css">
<?php //include_once 'includes/Inicio/Footer.php' ?>
<script src="assets/js/home.js"></script>
<script src="./assets/js/m.dashboard.js"></script>
</body>