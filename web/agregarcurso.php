<?php   
    ob_start();
    @session_start();
?>
<?php //include_once 'includes/Inicio/Head.php' ?>
<?php include_once 'includes/dashboard/head1.php' ?>

<body id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">
<?php // include_once 'includes/Inicio/Loader.php' ?>

<?php //include_once 'includes/Inicio/Header.php' ?>

<?php include_once 'includes/dashboard/header1.php' ?>
<?php include_once 'includes/dashboard/body1.php' ?>

<?php include_once 'includes/curso/agregarcursos.php' ?>


<?php include_once 'includes/Inicio/Footer.php' ?>
<script src="assets/js/home.js"></script>

</body>