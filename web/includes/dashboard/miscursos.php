<head>
    <link rel="stylesheet" href="./assets/css/dashboardPcss/miscursos.css">
</head>


<section class="cursos" id="cursos">
    <h1 class="heading">Mis <span>Cursos</span></h1>
    <div class="box-container">
        <?php

        require_once 'database/databaseConection.php';
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

                echo '
            
            <div class="box">
                    <img src="data:image/*;base64,' . base64_encode($dato3['imagenDestacadaCurso']) . '" alt=profile image class=curso-img>
                    <h3>' . $dato3['nombreCurso'] . '</h3>
                    <p>' . $dato3['descripcionCurso'] . '</p>
                    <br><a href="curso.php?id=' . $cursoID . '" class="btn">Ver ahora</a><br>
                </div>
        
    ';
            }
        }


        Database::disconnect();

        ?></div>
</section>
