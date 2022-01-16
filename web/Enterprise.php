<?php
ob_start();
@session_start();
    if(($_SESSION['privilegio']==1)){
?>
<?php include_once 'includes/dashboard/head1.php' ?>

<body>
    <?php include_once 'includes/dashboard/header1.php' ?>

    <?php include_once 'includes/dashboard/body1.php' ?>

    <?php include_once 'includes/Business/Empresas.php' ?>
    <!-- <script src="./assets/js/plugins/jquery.min.js"></script> -->
    <!-- ALL JS FILES -->
    <script src="./assets/js/plugins/jquery.min.js"></script>
    <script src="./assets/js/plugins//popper.min.js"></script>
    <script src="./assets/js/plugins/bootstrap.min.js"></script>
    <script src="./assets/js/plugins/sweetalert2.all.min.js"></script>

    <script src="./assets/js/main.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="includes/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="includes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="includes/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="includes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="includes/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="includes/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="includes/plugins/jszip/jszip.min.js"></script>
    <script src="includes/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="includes/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="includes/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="includes/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="includes/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script> -->
    
    

    <script src="./assets/js/datatableFunctions.js"></script>

</body>
<?php
    }else{
        header('Location: iniciosesion.php');
    }
?>
</html>
