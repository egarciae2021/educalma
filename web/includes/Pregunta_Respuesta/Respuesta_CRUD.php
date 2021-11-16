<?php
    require_once '../../database/databaseConection.php';
    /*
        AGREGAR PREGUNTAS
    */
    if(isset($_POST['respuesta'])){
        $respuesta=$_POST['respuesta'];
        $pregunta=$_POST['pregunta'];
        $id_pregunta=$_POST['idpregunta'];
        $id_modulo=$_GET['id_modulo'];

        //insertar pregunta 
            $pdo4 = Database::connect(); 
            $verif4=$pdo4->prepare("INSERT INTO respuestas (respuesta, id_Pregunta,estado)VALUES ('$respuesta','$id_pregunta',0) ");
            $verif4->execute(array());

            Database::disconnect();
            echo'
                <script>
                    alert("respuesta agregada");
                    window.location = "../../Form_respue_cuestionario.php?id_modulo='.$id_modulo.'&id_pregunta='.$id_pregunta.'&pregunta='.$pregunta.'";
                </script>
            ';
            exit();
    }
    /*
        EDITAR PREGUNTA
    */

    if(isset($_POST['actu_respuesta'])){
        $actu_respuesta=$_POST['actu_respuesta'];
        $id_respuesta=$_POST['idrespuesta'];
        
        $id_modulo=$_GET['id_modulo'];
        $pregunta=$_POST['pregunta'];
        $id_pregunta=$_POST['idpregunta'];
        

        $pdo = Database::connect();  
        $veri="UPDATE respuestas SET respuesta='$actu_respuesta' WHERE idRespuesta = '$id_respuesta' ";
        $q = $pdo->prepare($veri);
        $q->execute(array());
        $dato=$q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        echo'
            <script>
                alert ("Actualizado exitosamente");
                window.location = "../../Form_respue_cuestionario.php?id_modulo='.$id_modulo.'&id_pregunta='.$id_pregunta.'&pregunta='.$pregunta.'";
            </script>
        ';
        exit();
    }
    /*=====================
        ELIMINAR PREGUNTA
    =======================*/
    if(isset($_GET['id_resp'])){
        $id_modulo=$_GET['id_modulo'];
        $id_respuesta=$_GET['id_resp'];
        $id_pregunta=$_GET['id_pregunta'];
        $pregunta=$_GET['pregunta'];

        /* Eliminar todos los temas del modulo*/
        $pdo1 = Database::connect();  
        $verif1=$pdo1->prepare("DELETE FROM respuestas where idRespuesta = '$id_respuesta'");

        $verif1->execute(array());
        Database::disconnect();
        echo'
            <script>
                window.location = "../../Form_respue_cuestionario.php?id_modulo='.$id_modulo.'&id_pregunta='.$id_pregunta.'&pregunta='.$pregunta.'";
            </script>
        ';
    }
?>