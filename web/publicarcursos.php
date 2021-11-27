<?php   
    ob_start();
    @session_start();
?>
<?php include_once 'includes/Inicio/Head.php' ?>

<body id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">
<?php include_once 'includes/Inicio/Loader.php' ?>

<?php include_once 'includes/Inicio/Header.php' ?>

<?php include_once 'includes/curso/listarcurso.php' ?>


<?php include_once 'includes/Inicio/Footer.php' ?>

</body>