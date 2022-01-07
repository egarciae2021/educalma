<?php
    require_once '../../database/databaseConection.php';
    /*
        AGREGAR PREGUNTAS
    */
    if(isset($_POST['pregunta'])){
        $nombre=$_POST['pregunta'];
        $id_modulo=$_GET['id_modulo'];

        //agregando el idmodulo a la tabla cuestionario
            //verifica si el idmodulo existe para no volver a insertarla en la tabla cuestionario 
            $pdo = Database::connect();
            $sql = "SELECT * FROM cuestionario WHERE id_modulo = '$id_modulo' ";
            $q = $pdo->prepare($sql);
            $q->execute();
            $cuenta = $q->rowCount();
            Database::disconnect();
            
            if($cuenta==0){
                $pdo2 = Database::connect();
                try{
                    // $verif2=$pdo2->prepare("INSERT INTO cuestionario (id_modulo, puntaje, estado)VALUES ('$id_modulo',0,1) ");
                    $verif2=$pdo2->prepare("INSERT INTO `cuestionario` (`id_modulo`, puntaje, estado)VALUES (:id_modulo,0,1) ");
                    $verif2->bindParam(":id_modulo",$id_modulo,PDO::PARAM_INT);
                    $verif2->execute();
                }catch(PDOException $e){
                    echo $e->getMessage();
                }
                Database::disconnect();
            }

        //buscar el id del cuestionario para insertarlo en la tabla pregunta
            $pdo3 = Database::connect();
            $sql3 = "SELECT * FROM cuestionario WHERE id_modulo = '$id_modulo' ";
            $q3 = $pdo3->prepare($sql3);
            $q3->execute(array());
            $dato3 = $q3->fetch(PDO::FETCH_ASSOC);
            $id_cues = $dato3['idCuestionario'];

        //insertar pregunta 
            $pdo4 = Database::connect(); 
            // $verif4=$pdo4->prepare("INSERT INTO preguntas (pregunta, id_cuestionario)VALUES ('$nombre','$dato3[idCuestionario]') ");
            try{
                $verif4=$pdo4->prepare("INSERT INTO `preguntas` (`pregunta`, `id_cuestionario`)VALUES (:nombre,:id_cues)");
                $verif4->bindParam(":nombre",$nombre,PDO::PARAM_STR);
                $verif4->bindParam(":id_cues",$id_cues,PDO::PARAM_INT);
                $verif4->execute();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            
            Database::disconnect();
            echo'
                <script>
                    // alert("pregunta agregada");
                    window.location = "../../Form_pregun_cuestionario.php?id='.$_GET['id'].'&id_modulo='.$id_modulo.'";
                </script>
            ';
    }
    /*
        EDITAR PREGUNTA
    */

    if(isset($_POST['actuali_pregunta'])){
        $id_modulo=$_GET['id_modulo'];
        $preg_actu=$_POST['actuali_pregunta'];
        $idPreg=$_POST['id_pregunta'];
        $id=$_GET['id'];
   

        $pdo = Database::connect();  
        $veri="UPDATE preguntas SET pregunta='$preg_actu' WHERE idPregunta = '$idPreg' ";
        $q = $pdo->prepare($veri);
        $q->execute(array());
        $dato=$q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        echo'
            <script>
                window.location = "../../Form_pregun_cuestionario.php?id='.$id.'&id_modulo='.$id_modulo.'";
            </script>
        ';
    }
    /*=====================
        ELIMINAR PREGUNTA
    =======================*/
    if(isset($_GET['id_modulo'])){
        $id_modulo=$_GET['id_modulo'];
        $id_pregu=$_GET['id_pregunta'];

        /* Eliminar todos los temas del modulo*/
        $pdo1 = Database::connect();  
        $verif1=$pdo1->prepare("DELETE FROM respuestas where id_Pregunta = '$id_pregu'");

        $verif1->execute(array());
        Database::disconnect();


        /*Eliminar el modulo*/
        $pdo = Database::connect();  
        $verif=$pdo->prepare("DELETE FROM preguntas where idPregunta = '$id_pregu'");

        $verif->execute(array());
        Database::disconnect();
        echo'
            <script>
                window.location = "../../Form_pregun_cuestionario.php?id='.$_GET['id'].'&id_modulo='.$id_modulo.'";
            </script>
        ';
    }
?>