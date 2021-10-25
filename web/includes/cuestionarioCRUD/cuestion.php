<?php 
    require_once '../../database/databaseConection.php';
    $id=$_GET['id'];
    $idModulo=$_GET['idModulo'];
    $contador=$_GET['contador'];
    //para el boton siguientes necesita estas variables
    if(isset($_GET['c_tema']) && isset($_GET['c_modulo'])){
        $c_tema=$_GET['c_tema'];
        $c_modulo=$_GET['c_modulo'];
    }
    //respuestas correctas
    $c=$_POST['c'];
    $verif_resp=$_POST['verif_resp'];

    $pdo = Database::connect();
    $sql = "SELECT * FROM respuestas WHERE respuesta='$verif_resp' AND estado=1";
    $q = $pdo->prepare($sql);
    $q->execute();
    $cuenta = $q->rowCount();
    Database::disconnect();

    if($cuenta==1){
        echo'
            <script>
                //alert("respuesta correcta");
                window.location = "../../cuestionario.php?idModulo='.$idModulo.'&id='.$id.'&contador='.($contador+1).'&c='.($c+1).'&c_tema='.$c_tema.'&c_modulo='.$c_modulo.'";
            </script>
        ';
    }
    else{
        echo'
            <script>
                //alert("respuesta incorrecta");
                window.location = "../../cuestionario.php?idModulo='.$idModulo.'&id='.$id.'&contador='.($contador+1).'&c='.$c.'&c_tema='.$c_tema.'&c_modulo='.$c_modulo.'";
            </script>
        ';
    }


?>