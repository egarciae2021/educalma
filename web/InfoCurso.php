<?php   
    ob_start();
    @session_start();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
    <script src="assets/js/validarCategoria.js"></script>
    <script src="assets/js/plugins/sweetalert2.all.min.js"></script>
    <script src="assets/js/pagination.js"></script>
<?php include_once 'includes/Inicio/Head.php' ?>

<body id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">
<?php include_once 'includes/Inicio/Loader.php' ?>

<?php include_once 'includes/Inicio/Header.php' ?>

<?php include_once 'includes/curso/infcurs.php' ?>


<?php include_once 'includes/Inicio/Footer.php' ?>
<script src="assets/js/home.js"></script>

</body>