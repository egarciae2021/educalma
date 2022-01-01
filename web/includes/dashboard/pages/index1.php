<?php
ob_start();
@session_start();
?>
<?php include_once 'includes/dashboard/head1.php' ?>

<body>
    <?php include_once 'includes/dashboard/header1.php' ?>

    <?php include_once 'includes/dashboard/body1.php' ?>

    <?php 
        if ($_SESSION['privilegio'] == 1){
            include_once 'includes/dashboard/contenidoAdmin.php';
        }else{
            include_once 'includes/dashboard/contenido.php';
        }
    ?>
    <script src="./assets/js/plugins/jquery.min.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/buscarLista.js"></script>
</body>

</html>
