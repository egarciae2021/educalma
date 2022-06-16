<head>
    <link rel="stylesheet" href="assets/css/cursos.css">
</head>

<style>
    .order-card-custom {
        display: grid;
        grid-template-columns: 1fr;
        max-width: 1600px;
        min-width: 100px;
       /*  gap: 10px;
        width: 90%; */
        /* max-width: 1270px; */
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

    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@100;300;500&display=swap");
    .container-fluid .row .col-10 .section-title-course {
        font-family: "Inter", sans-serif;
        font-style: normal;
        font-weight: bold;
        font-size: 24px;
        text-transform: uppercase;
        color: #7c83fd;
        padding: 1rem 3rem 0.5rem 3rem;
        width: 100%;
    }
    .container-fluid .row .col-12 .section-title-course hr {
        width: 100%;
        border: 2px solid #99ccff;
        margin: 0.5rem 0rem 1rem 0rem;
    }
    .container-fluid .row .col-12 .card {
        max-width: 423px;
        max-height: 179px;
        margin: 0 auto;
        margin-bottom: 2rem;
        display: flex;
        margin-left:auto;
        margin-right:auto;
    }
    .container-fluid .row .col-10 .card .col-5 .container-image {
        width: 100%;
        height: 165px;
        position: relative;
        display: flex;
        justify-content: center;
        overflow: hidden;
    }

    .container-fluid .row .col-10 .card .col-5 .container-image img {
        max-height: 100%;
        max-width: 100%;
    }
    .container-fluid .row .col-10 .card .col-7 {
        padding: 1rem;
    }

    .container-fluid .row .col-10 .card .col-7 .container-title {
        font-family: "Inter", sans-serif;
        font-style: normal;
        font-weight: bold;
        font-size: 18px;
        text-transform: uppercase;
        color: #000000;
        
    }

    .container-fluid .row .col-10 .card .col-7 .container-title a {
        font-size: 18px;
        color: #4f52d6;
    }
    .container-fluid .row .col-10 .card .col-7 .container-descrition {
        font-family: "Inter", sans-serif;
        font-weight: normal;
        font-size: 16px;
        color: #b4b4b4;
        margin-top: 0.5rem;
        padding-right: 3rem;
        min-width: 270px;
        min-height: 80px;
        display: flex;
        
    }

    .container-fluid .row .col-10 .card .col-7 .container-link {
        font-family: "Inter", sans-serif;
        font-weight: bold;
        font-size: 16px;
        color: #33c6e7;
        margin-top: 1rem;
        text-decoration: none;
    }

    .container-fluid .row .col-10 .card .col-7 .container-link a {
        text-decoration: none;
        color: #33c6e7;
        text-align: justify;
    }

    @media (max-width: 1241px) {
        .container-fluid .row .col-10 .card .col-7 .container-descrition {
            font-size: 14px;
            padding-right: 2rem;
        }
        .container-fluid .row .col-10 .card .col-7 .container-link {
            font-size: 14px;
        }
    }

    @media (max-width: 1055px) {
        .container-fluid .row .col-10 .card .col-7 {
            padding: 1rem 0.5rem;
        }
        .container-fluid .row .col-10 .card .col-7 .container-descrition {
            font-size: 13px;
            padding-right: 1rem;
        }
        .container-fluid .row .col-10 .card .col-7 .container-link {
            font-size: 13px;
        }
    }

    @media (max-width: 930px) {
        .container-fluid .row .col-10 .card .col-7 .container-descrition {
            padding-right: 1.5rem;
        }
    }

    @media (max-width: 767px) {
        .container-fluid .row .col-10 .card .col-7 .container-descrition {
            font-size: 16px;
            padding-right: 3rem;
        }
        .container-fluid .row .col-10 .card .col-7 .container-link {
            font-size: 16px;
        }
    }

    @media (max-width: 440px) {
        .container-fluid .row .col-10 .card .col-7 .container-descrition {
            font-size: 14px;
            padding-right: 4rem;
        }
        .container-fluid .row .col-10 .card .col-7 .container-link {
            font-size: 14px;
        }
    }

    @media (max-width: 379px) {
        .container-fluid .row .col-10 .card .col-7 .container-descrition {
            font-size: 13px;
            padding-right: 3rem;
        }
        .container-fluid .row .col-10 .card .col-7 .container-link {
            font-size: 13px;
        }
    }
    /*cartillas*/

    .container-fluid .row .section-title-courses {
        font-family: "Inter", sans-serif;
        font-style: normal;
        font-weight: bold;
        font-size: 24px;
        text-transform: uppercase;
        color: #7c83fd;
        padding: 1rem 3.5rem;
        width: 100%;
    }

    .container-fluid .container-card-course .row {
        margin: 0;
        padding: 0;
        width: 100%;
    }
    .container-fluid .container-card-course .row .col-10 {
        padding: 0.8rem;
    }

    .container-fluid .container-card-course .row .col-10 .card {
        max-width: 320px;
        max-height: 400px;
        height: 100%;
        width: 100%;
        border-radius: 0;
        margin: 0 auto;
        border: 1px solid lightgray;
        text-align: justify;
    }
    .container-fluid
    .container-card-course
    .row
    .col-10
    .card
    .container-card-image {
        width: 100%;
        height: 165px;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }
    .container-fluid
    .container-card-course
    .row
    .col-10
    .card
    .container-card-image
    img {
        min-height: 100%;
        min-width: 100%;
    }

    .container-fluid
    .container-card-course
    .row
    .col-10
    .card .container-card-title {
        text-transform: uppercase;
        color: dimgray;
        font-family: "Inter", sans-serif;
        font-style: normal;
        font-weight: bold;
        font-size: 0.8rem;
        padding: 0.5rem 0.5rem;
        }

    .container-fluid
    .container-card-course
    .row
    .col-10
    .card .container-card-description{
        color: gray;
        font-family: "Inter", sans-serif;
        font-size: 0.8rem;
        padding: 0.5rem;
        }

    .container-card-link{
      position: relative;
      left: 10px;
        
    }

    .card{
        width: 294.42px;
        height: 366.21px;
        border: 1px solid gray;
        }

    .card .container-card-link a{
        display: inline-block;
        padding: 10px;
        margin-top: 10px;
        text-decoration: none;
        color: #e7e7e7;
        background-color:#168eb3;
        border-radius: 50px;
        transition: all 400ms ease;
        margin-bottom: 5px;
        width: 150px;
    }

    .card .container-card-link a:hover{
        background-color: #127b9b;
    }

    .container-fluid
    .container-card-course
    .row
    .col-10
    .card
    .container-card-image {
        width: 100%;
        height: 165px;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .container-fluid
    .container-card-course
    .row
    .col-11
    .card
    .container-card-image
    img {
        min-height: 100%;
        min-width: 100%;
    }

</style>


<body style="background-color: #fff;">
    <?php
    if (isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)) {
    ?>
    <div style="position: relative; top: 20px;" class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <div class="row mb-4 mt-4" style="background-color: #e7f4ff; margin-left: 25px; margin-right: 25px; border-radius: 50px;">
                    <div class="container section-title-course">
                        <i class="fas fa-shapes mr-3"></i>  Cursos Comprados
                        <hr>
                    </div>
                </div>
            </div>
        </div>

        <!-- la direccion de la nueva imagen para cursos es assets/images/curso_educalma.png -->

        <div class="container-fluid px-0">
            <div class="container-card-course">
                <div class="row pt-1 container order-card-custom" style="margin:10px auto;">

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
                                    <div class="col-10 col-sm-12 col-md-4 col-lg-4 col-xl-3">
                                        <div style="border-radius: 30px;" class="card">
                                            <div style="border-radius: 30px 30px 0 0;" class="container-card-image">
                                                <img src="data:image/*;base64,' . base64_encode($dato3['imagenDestacadaCurso']) . '" alt="foto_curso" >
                                            </div>
                                    
                                            <div class="container-card-title" style="color: black;">
                                                <a style="float: left;"><strong>' . $dato3['nombreCurso'] . '</strong></a>
                                            </div>
                                            <br>
                                            <div class="container-card-description" style="font-size: 13px; position: relative;">
                                            ' . substr($dato3['descripcionCurso'], 0, 90) . "..." . '
                                            </div>
                                        
                                            <div class="container-card-link" style="margin: auto;">
                                                <p><a href="curso.php?id=' . $cursoID . '&idCI='.$dato2['id_cursoInscrito'].'"><strong>Ver más <i class="fa fa-arrow-right" aria-hidden="true"></i></strong></a></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    ';
                            } else {

                                echo '
                                    <div class="col-10 col-sm-12 col-md-4 col-lg-4 col-xl-3">
                                        <div style="border-radius: 30px;" class="card">
                                            <div style="border-radius: 30px;" class="container-card-image">
                                                <img src="./assets/images/curso_educalma.png" alt="foto_curso" >
                                            </div>
                                    
                                            <div class="container-card-title" style="color: black;">
                                                <a style="float: left;"><strong>' . $dato3['nombreCurso'] . '</strong></a>
                                            </div>
                                            <br>
                                            <div class="container-card-description" style="font-size: 13px; position: relative; align-items:justify;">
                                            ' . substr($dato3['descripcionCurso'], 0, 90) . "..." . '
                                            </div>
                                            
                                            <div class="container-card-link" style="margin: auto;">
                                                 <p><a href="curso.php?id=' . $cursoID .'&idCI='.$dato2['id_cursoInscrito'].'"><strong>Ver más <i class="fa fa-arrow-right" aria-hidden="true"></i></strong></a></p>
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
    </div>
</body>