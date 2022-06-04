<?php   
    ob_start();
    @session_start();
    //if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
?>
















<head>
    <!-- Site Icons -->
    <link rel="shortcut icon" href="assets/images/educalmalogo.svg">
 
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css" />



    <!-- ADMINLTE3 -->
    <!-- Google Font: Source Sans Pro -->
    <!-- Font Awesome --> 
    <link rel="stylesheet" href="includes/plugins/fontawesome-free/css/all.min.css">
    
    <link rel="stylesheet" href="includes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="includes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <link rel="stylesheet" href="includes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- <link rel="stylesheet" href="../../main.css"> -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>



    <!-- sweetAlert2 -->
    <!-- <script src="./assets/js/plugins/sweetalert2.min.js"></script> Importar SweetAlert2 -->
    <!-- <link href="./assets/css/plugins/sweetalert2.min.css" rel="stylesheet"/> Importar SweetAlert2 -->
    <link rel="stylesheet" href="assets/lib/sweetalert2/sweetalert2.min.css">
    <script src="assets/lib/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- Script de funciones para SweetAlert y Dropdown -->
    <script src="assets/js/validarCategoria.js"></script>
    <script src="assets/js/funciones.js"></script>
</head>


















<?php include_once 'includes/dashboard/head1.php' ?>

<head>

    <link rel="shortcut icon" href="assets/images/logo_edu.png">

     <!--Para el archivo header1.php.-->
     <style>

        .txtEstudiante {
            position: relative;
            top: 15px;
        }

    </style>
    
</head>

<body style="background-color: white;" id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">

    <?php //include_once 'includes/inicio/Loader.php' ?>

    <?php //include_once 'includes/Inicio/Header.php' ?>

    <?php include_once 'includes/dashboard/header1.php' ?>

    <?php include_once 'includes/dashboard/body1.php' ?>

    <?php include_once 'includes/Lista_cursos/ListaCursoContenido.php' ?>

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