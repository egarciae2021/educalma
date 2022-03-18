<head></head>
<link rel="stylesheet" href="assets/css/cursos.css">

<style>
    .order-card-custom {
        display: grid;
        grid-template-columns: 1fr;
        max-width: 1800px;
    }

    @media (min-width: 660px) {
        .order-card-custom {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 992px) {
        .order-card-custom {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (min-width: 1300px) {
        .order-card-custom {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (min-width: 1600px) {
        .order-card-custom {
            grid-template-columns: repeat(5, 1fr);
        }
    }

    @media (min-width: 1800px) {
        .order-card-custom {
            grid-template-columns: repeat(5, 1fr);
        }
    }
</style>
</head>

<body style="background-color: #fff;">
    <?php
    if (isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)) {
    ?>
        <br>
        <div class="title_miscursos">
            <h3>Mis Cursos</h3>
        </div>
        <br>

        <!-- la direccion de la nueva imagen para cursos es assets/images/curso_educalma.png -->

        <div class="container-fluid px-0">
            <div class="container-card-course">
                <div class="row pt-1 container order-card-custom" style="margin:0 auto;">

                    <?php
                    error_reporting(0);
                    require_once '././database/databaseConection.php';
                    $pdo = Database::connect();
                    $userID = $_SESSION['codUsuario'];

                    $sql = "SELECT * FROM cursoinscrito where usuario_id='$userID' ORDER BY curso_id DESC";
                    $q = $pdo->prepare($sql);
                    $q->execute(array());
                    $dato = $q->fetch(PDO::FETCH_ASSOC);


                    if (empty($dato)) {
                    } else {

                        $pdo = Database::connect();
                        $sql = "SELECT * FROM cursoinscrito where usuario_id='$userID' ORDER BY curso_id DESC";
                        $q = $pdo->prepare($sql);
                        $q->execute(array());

                        while ($dato2 = $q->fetch(PDO::FETCH_ASSOC)) {
                            $cursoID = $dato2['curso_id'];

                            $pdo3 = Database::connect();
                            $sql3 = "SELECT * FROM cursos where idCurso='$cursoID'";
                            $q3 = $pdo3->prepare($sql3);
                            $q3->execute(array());
                            $dato3 = $q3->fetch(PDO::FETCH_ASSOC);


                            if ($dato3['imagenDestacadaCurso'] != null) {

                                echo '
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                    <div class="card">
                                    <div class="container-card-image">
                                    <img src="data:image/*;base64,' . base64_encode($dato3['imagenDestacadaCurso']) . '" alt="foto_curso" >
                                    </div>
                                    <div class="d-flex info">
                                    <div class="container-card-title px-2">
                                    ' . $dato3['nombreCurso'] . '
                                    </div>
                                    <div class="container-card-description px-2">
                                    ' . substr($dato3['descripcionCurso'], 0, 90) . "..." . '
                                    </div>
                                    <div class="container-card-link px-2">
                                    <a href="curso.php?id=' . $cursoID . '">Ver más -></a>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    
                                    ';
                            } else {

                                echo '
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                    <div class="card">
                                    <div class="container-card-image">
                                    <img src="./assets/images/curso_educalma.png" alt="foto_curso" >
                                    </div>
                                    <div class="d-flex info">
                                    <div class="container-card-title px-2">
                                    ' . $dato3['nombreCurso'] . '
                                    </div>
                                    <div class="container-card-description">
                                    ' . substr($dato3['descripcionCurso'], 0, 90) . "..." . '
                                    </div>
                                    <div class="container-card-link px-2">
                                    <a href="curso.php?id=' . $cursoID .'&idCI='.$dato2['id_cursoInscrito'].'">Ver más -></a>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    
                                    ';
                            }
                        }
                    }
                    echo ' </div>
                    </div>
                </div>';

                    Database::disconnect();

                    ?>

                <?php
            } else {
                header('Location:iniciosesion.php');
            }
                ?>
</body>