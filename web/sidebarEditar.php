<?php   
    ob_start();
    @session_start();
?>
<?php include_once 'includes/dashboard/head1.php' ?>

<head>
<link rel="shortcut icon" href="assets/images/logo_edu.png">
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
