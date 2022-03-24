<?php
    ob_start();
    @session_start();
    require_once '../../database/databaseConection.php';
    $id=$_GET['id'];
    $idModulo=$_GET['idModulo'];
    $contador=$_GET['contador'];
    $id_pregunta=$_GET['id_pregunta'];//idcues?
    $validar=$_SESSION['validar'];
    $up=$_GET['up'];
    $ens=$_GET['cuen'];
    $envi=$_GET['nro'];
    $nW=$_GET['nW'];
    $idCI=$_GET['idCI'];
    
    //para el boton siguientes necesita estas variables
    if(isset($_GET['c_tema']) && isset($_GET['c_modulo'])){
        $c_tema=$_GET['c_tema'];//idTema?
        $c_modulo=$_GET['c_modulo'];
    }
    //respuestas correctas
    $correcta=$_POST['correcta'];
    $verif_resp=$_POST['verif_resp'];

    $contadorP=$_POST['contadorP'];

    $pdo = Database::connect();
    $sql = "SELECT * FROM respuestas WHERE respuesta='$verif_resp' AND estado=1 AND id_Pregunta='$id_pregunta'";
    $q = $pdo->prepare($sql);
    $q->execute();
    $cuenta = $q->rowCount();
    Database::disconnect();

    $pdo = Database::connect();
    $sql23 = "SELECT * FROM respuestas WHERE respuesta='$verif_resp' AND id_Pregunta='$id_pregunta'";
    $q23 = $pdo->prepare($sql23);
    $q23->execute();
    $datoRes=$q23->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    $respuesta1 = $datoRes['idRespuesta'];

    //Cantidad de preguntas
    $pdo16 = Database::connect();
    $q16 = $pdo16->query("SELECT COUNT(preguntas.idPregunta) AS 'preguntas'  from cursos 
                        INNER JOIN modulo ON cursos.idCurso = modulo.id_curso
                        INNER JOIN cuestionario ON cuestionario.id_modulo = modulo.idModulo
                        INNER JOIN preguntas on cuestionario.idcuestionario = preguntas.id_cuestionario
                        WHERE cursos.idCurso = '$id' GROUP BY cursos.idCurso");
    $Cant_preg = $q16->fetchColumn();
    Database::disconnect();
    //promedio de nota
    $NotaInd = 20 / $Cant_preg;

    if($cuenta==1){
        // CALCULAR LA CANTIDAD DE RESPUESTS ACERTADAS 
        if($validar==0){
            $pdo = Database::connect();
            $idUsuer= $_SESSION['codUsuario'];
            $sql = "SELECT cantidad_respuestas, nota FROM cursoinscrito WHERE curso_id = '$id' and usuario_id= '$idUsuer'";
            $q = $pdo->prepare($sql);
            $q->execute(array());
            $dato=$q->fetch(PDO::FETCH_ASSOC);
            Database::disconnect();
            
    
            $cantidad_respuesta=$dato['cantidad_respuestas']; 
            
            // SUMA LA CANTIDAD DE RESPUESTAS ACERTADAS 
            $pdo=Database::connect();
            $sql = "UPDATE cursoinscrito SET cantidad_respuestas=$cantidad_respuesta+1 WHERE curso_id ='$id' and usuario_id= '$idUsuer'";
            $q = $pdo->prepare($sql);
            $q->execute();
            Database::disconnect();

            $nota = $dato['nota'];

            //SUMA LOS PUNTOS POR CADA RESPUESTA ACERTADA
            /*
            $pdo=Database::connect();
            $sql = "UPDATE cursoinscrito SET nota=$nota+$NotaInd WHERE curso_id ='$id' and usuario_id= '$idUsuer' ";
            $q = $pdo->prepare($sql);
            $q->execute();
            Database::disconnect();
            */
        }
        
        
        echo'
            <script>
                //alert("respuesta correcta");
                window.location = "../../cuestionario.php?id='.$id.'&nW='.($nW).'&c='.($correcta+1).'&contadorP='.($contadorP.','.$id_pregunta.'-'.$respuesta1).'&idModulo='.$idModulo.'&up='.($up+1).'&idcues='.$_SESSION['idcue'].'&idCI='.($idCI).'&cuen='.($ens+1).'&nro='.($envi+1).'";
            </script>
        ';
       

    }
    else{
        
        echo'
            <script>
                //alert("respuesta incorrecta");
                window.location = "../../cuestionario.php?id='.$id.'&nW='.($nW).'&c='.$correcta.'&contadorP='.($contadorP.','.$id_pregunta.'-'.$respuesta1).'&idModulo='.$idModulo.'&up='.($up+1).'&idcues='.$_SESSION['idcue'].'&idCI='.($idCI).'&cuen='.($ens+1).'&nro='.($envi+1).'";
            </script>
        ';
        
    }


?>