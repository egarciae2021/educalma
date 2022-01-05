<?php
    require_once '../../database/databaseConection.php';


    $id=$_GET['id_curso'];
    $pag=$_GET['pag'];

    $pdo2 = Database::connect();  
    $veri2="UPDATE cursos SET permisoCurso='1', fechaPulicacion = now()  WHERE idCurso = '$id' ";
    $q2 = $pdo2->prepare($veri2);
    $q2->execute(array());
    $dato2=$q2->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    echo'
        <script>
            window.location = "../../publicarcursos.php?pag='.$pag.'";
        </script>
    ';


    ?>