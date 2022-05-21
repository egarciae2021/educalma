<head>
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css" />
    <link rel="stylesheet" href="includes/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="assets/css/styledash.css">
</head>









<main>
    <!-- Por usuarios -->
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-12">
                <div class="title" style="color:#737BF1;">Administrar</div>
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="user-sidebar.php">
                                        por cursos
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="userdash.php">
                                        por usuarios
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="empredash.php">
                                        por empresas
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link active" href="aprobdash.php">
                                        por aprobados
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- cambiar de usuarios a aprobados -->
                <?php
                $pdo3 = Database::connect();
                $sqlUsu = "SELECT COUNT(*) AS cantidad FROM usuarios WHERE estado = 1";
                $qUsua = $pdo3->prepare($sqlUsu);
                $qUsua->execute(array());
                $resultUsu = $qUsua->fetch(PDO::FETCH_ASSOC);
                ?>

                <!-- TABLA DE APROBADOS  -->
                <div class="card mt-2">

                    <div class="card-header">
                        <div class="row mb-2">
                            <div class="col-12">
                                <h3 class="card-title" style="color:#737BF1;">Cantidad de aprobados
                                    <span style="color:#BEC1F3;">(<?php echo $resultUsu['cantidad']; ?>)</span>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tableUsuarios" class="table table-borderless dt-responsive text-left" cellspacing="0" width="100%">
                                <thead>
                                    <tr style="background-color:#737BF1;">
                                        <th style="border-radius: 10px 0 0 10px;">
                                            Tipo
                                        </th>
                                        <th scope="col">Estado de Curso</th>
                                        <th>Nota</th>
                                        <th>Nombres</th>
              
                                        <th>Fecha de Finalización</th>
                                    
                                        <th style="border-radius: 0 10px 10px 0;">
                                            Acción
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    















































                </div>
                <!-- FIN DE TABLA DE APROBADOS -->

                











































</main>