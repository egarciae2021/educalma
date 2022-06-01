<?php   
    ob_start();
    @session_start();
?>
<?php include_once 'includes/Inicio/Head.php' ?>

<head>
    <link rel="shortcut icon" href="assets/images/logo_edu.png">
</head>

<body id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">

    <?php //include_once 'includes/Inicio/Loader.php' ?>
    
    <?php include_once 'includes/Inicio/Header.php' ?>

    <?php include_once 'includes/curso/Preguntas_Cuestionar.php' ?>
    
    <?php include_once 'includes/Inicio/Footer.php' ?>
    
    <script src="assets/js/home.js"></script>

</body>