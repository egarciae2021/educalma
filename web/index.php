<?php
ob_start();
@session_start();
?>

<!--No olvidar que en el archivo Head.php, están las rutas de sus archivos CSS-->
<?php include_once 'includes/Inicio/Head.php' ?>

<head>

    <link rel="shortcut icon" href="assets/images/logo_edu.png">

    <!--Whatsapp-->
    <link rel="stylesheet" href="./assets/css/whatsapp.css">

    <!-- <style>
        @media (max-width: 600px){
            .btnWth {
                margin-bottom: 150px;
            }
        }
    </style> -->

</head>

<body id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">
    
    <?php include_once 'includes/Inicio/Header.php' ?>



    <!--Whatsapp-->
   
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <a href="https://api.whatsapp.com/send?phone=51910571087&text=Hola%21%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20los%20cursos%20." class="float btnWth" target="_blank">
            <i class="fa fa-whatsapp my-float"></i>
        </a>
 
    

    
    <!---->
    <?php include_once 'includes/Inicio/Contenido.php' ?>
    
    <?php include_once 'includes/Inicio/Footer.php' ?>
    
    <script src="assets/js/home.js"></script>

</body>

</html>