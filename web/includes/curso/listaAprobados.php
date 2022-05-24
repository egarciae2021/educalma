<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">      
    <link rel="stylesheet" href="assets/css/styledash.css">
    <link rel="stylesheet" href="assets/css/agrecursos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/js/plugins/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/css/stylebuttonAtras.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <?php require_once "includes/Inicio/Head.php"; ?>    
</head>
<body>
    <?php
    // Este codigo hace validacion para que no se pueda acceder a cualquier pagina sin estar logueado

    if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="titlemc"></div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
    <br>
    <br>
    <br>

    <div class="col-12 mt-5 text-center">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Alumnos Aprobados</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body"> 
                <div class="table-responsive">
                    <table id="example1" class="table table-borderless text-center dt-responsive text-center" cellspacing="0" width="100%" >
                        <thead >
                            <tr >
                                <th style="border-radius: 10px 0 0  10px;">Nombre</th>
                                <th>DNI</th>
                                <th>Curso</th>
                                <th>Nota</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                               
                                $pdo4 = Database::connect();
                                $sql4 = "SELECT * FROM `aprobados`";
                                /* max$q4 = $pdo4->prepare($sql4);
                                $q4->execute(array());*/
                                foreach($pdo->query($sql4) as $aprobados){ //= $q4->fetch(PDO::FETCH_ASSOC)
                            echo '<tr class="h-100 justify-content-center align-items-center">';
                            echo '
                                <td>'. $aprobados['nombres'].'</td>
                                <td>'. $aprobados['nro_doc'].'</td>
                                <td>'. $aprobados['nombreCurso'].'</td> 
                                <td>'. $aprobados['nota'].'</td>
                                <td>'. $aprobados['fecha'].'</td>
                            ';
                                }
                            Database::disconnect();
                            ?>    
                        </tbody>    
                    </table>
                </div>
            </div>   
        </div>      
    </div>       




    <?php    }
    else{
                header('Location:iniciosesion.php');
    }
    ?>
</body>
</html>
