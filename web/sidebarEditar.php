<?php   
    ob_start();
    @session_start();
?>
<?php include_once 'includes/dashboard/head1.php' ?>

<head>
    <link rel="shortcut icon" href="assets/images/logo_edu.png">

    <style>
        /*Colores gradientes para el fondo de la página que edita usuarios.*/
        body {
            background: linear-gradient(to bottom, #FFFFFF 9%, #E0C7E5, #E7F4FF);
        }

        /*Este es el border sombreado que tiene cada caja de texto de la página para editar usuarios. Esta clase "is-valid"
          se usa en el archivo sidebarEditar.js.*/
        .is-valid {
            border-color: #EED9FA !important;
            box-shadow: 0 0 8px 0 #CFA3E8 !important;
        }

        .is-invalid {
            border-color: red !important;
            box-shadow: 0 0 8px 0 red !important;
        }

        h3 {
            color: black !important;
            font-weight: bold !important;
        }
    </style>

</head>

<body>
    
    <?php include_once 'includes/dashboard/header1.php' ?>

    <?php include_once 'includes/dashboard/body1.php' ?>

    <?php include_once 'includes/dashboard/editarusuario1.php' ?>

    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/m.dashboard.js"></script>
    <script>
        function cambiarImg() {
            var pdrs = document.getElementById('inputGroupFile04').files[0].name;
            document.getElementById('infoImg').innerHTML = pdrs;
            console.log()
        }
    </script>
</body>

</html>
