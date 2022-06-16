
<?php   
    //ob_start();
    //@session_start();
    
    //if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
?>

<?php include_once 'includes/Inicio/Head.php' ?>

<?php include_once 'includes/dashboard/head1.php' ?>

<body id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">



    <?php //include_once 'includes/inicio/Loader.php' ?>

    <?php include_once 'includes/Inicio/Header.php' ?>
    <?php //include_once 'includes/dashboard/header1.php' ?>

        <?php //include_once 'includes/dashboard/body1.php' ?>
    <?php include_once 'includes/Lista_cursos/ListaCursoContenido.php' ?>

    <?php include_once 'includes/Inicio/Footer.php' ?>
    <!-- <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="stylesheet" href="assets/css/style1.css"> -->
    <script src="assets/js/home.js"></script>
    <script src="assets/js/buscarCurso.js"></script>
    <!-- <script src="./assets/js/m.dashboard.js"></script> -->
    <?php
        // }else{
        //     header('Location: iniciosesion.php');
        // }
    ?>


</body>