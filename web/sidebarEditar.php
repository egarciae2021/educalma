<?php include_once 'includes/dashboard/head.php' ?>

<body>
<?php include_once 'includes/dashboard/header.php' ?>

<?php include_once 'includes/dashboard/editarusuario.php' ?>
<script src="./assets/lib/jquery-3.2.1.slim.min.js"></script>
    <script src="./assets/js/m.dashboard.js"></script>
    <script>
        function cambiarImg() {
            var pdrs = document.getElementById('inputGroupFile04').files[0].name;
            document.getElementById('infoImg').innerHTML = pdrs;
        }
    </script>
</body>
</html>