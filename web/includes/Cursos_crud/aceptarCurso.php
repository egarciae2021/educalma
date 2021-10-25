<?php
    require_once '../../database/databaseConection.php';


    $id=$_GET['id_curso'];

    $pdo2 = Database::connect();  
    $veri2="UPDATE cursos SET permisoCurso='1' WHERE idCurso = '$id' ";
    $q2 = $pdo2->prepare($veri2);
    $q2->execute(array());
    $dato2=$q2->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    echo'
        <script>
            alert ("Aceptado exitosamente");
            window.location = "../../agregarcurso.php";
        </script>
    ';


    ?>