
<?php   
    //ob_start();
    //@session_start();
    
    //if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
?>

<?php include_once 'includes/Inicio/Head.php' ?>

<?php include_once 'includes/dashboard/head1.php' ?>

<head>
    <style>

        .header {
            margin-left: -95px;
        }

        .listaCursos {
            margin-left: -30px;
        }

        @media (max-width: 600px){

            .header {
                margin-left: -15px;
            }

            .listaCursos {
                margin-left: 10px;
            }

        }

    </style>
</head>

<body id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">


    <div class="header">
        <?php include_once 'includes/Inicio/Header.php' ?>
    </div>
    

    <div class="listaCursos">
        <?php include_once 'includes/Lista_cursos/ListaCursoContenido.php' ?>
    <div>
 

    <script src="assets/js/home.js"></script>
    <script src="assets/js/buscarCurso.js"></script>
   
</body>