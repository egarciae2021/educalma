<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />
    <link rel=StyleSheet href="assets/css/ratingEstrella.css" type="text/css" media=screen>
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Mukta:wght@600&display=swap" rel="stylesheet">

    

    <script src="./assets/js/plugins/sweetalert2.all.min.js"></script>

    <style> 
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&family=Mukta:wght@600&display=swap'); 

        /* WEBKIT BROWSERS - CHROME, OPERA AND SAFARI */
       progress::-webkit-progress-bar {
           background-color: #E3E8E2;
           border-radius: 10px;
       }
 
       progress::-webkit-progress-value {
           background-image:
               -webkit-linear-gradient(45deg, transparent 40%, rgba(0, 0, 0, .1) 40%, rgba(0, 0, 0, .1) 70%, transparent 70%),
               -webkit-linear-gradient(top, rgba(255, 255, 255, .25), rgba(0, 0, 0, .25)),
               -webkit-linear-gradient(left, #5BF543, #5BF543);
           border-radius: 20px;
       }
 
       /* MOZILLA FIREFOX */
       progress::-moz-progress-bar {
           background-image:
               -moz-linear-gradient(45deg, transparent 33%, rgba(0, 0, 0, 0.1) 40%, rgba(0, 0, 0, 0.1) 70%, transparent 70%),
               -moz-linear-gradient(top, rgba(255, 255, 255, 0.25), rgba(0, 0, 0, 0.25)),
               -moz-linear-gradient(left, #5BF543, #5BF543);
           border-radius: 20px;
       }
 
       /* MICROSOFT EDGE & IE */
       .custom-progress::-ms-fill {
           border-radius: 18px;
           background: repeating-linear-gradient(45deg, #5BF543, #5BF543 10px,#5BF543 10px, #5BF543 20px);
       }
 

       .opciones {
            margin-top: -65px;
            text-align: right;
            
       }

        @media (max-width: 720px){

            .opciones {
                margin-top: 10px;
                text-align: center;
            }
       }




    </style>

    <link rel="stylesheet" href="././assets/css/stylecuestionario.css">
    <!-- iconos -->
    <script src="https://kit.fontawesome.com/abc76d5c4d.js" crossorigin="anonymous"></script>

    <script>
        $('.correcto').click(function() {
    $(this).find('input').prop('checked', true)    
    });
    </script>

    <title>Cuestionario</title>
</head>

<body style="background: linear-gradient(to bottom, #FFFFFF 10%, #E0C7E5, #E7F4FF 100%);">
    <?php
    // Este codigo hace validacion para que no se pueda acceder a cualquier pagina sin estar logueado__Pablo Loyola

    if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $envi=substr($url, strrpos($url, '=') + 1);
        //$envi."<br>";
        $en=substr($url, strrpos($url, '&') - 1);
        $ens=substr($en,0,1);
        $up=substr($url, strrpos($url, 'p') + 2);
        $up=substr($up,0,1);
        // echo $up."<br>";
        // echo $ens."<br>";
        // echo $envi."<br>";

    ?>
    
        <!--contenido de cuestionario-->
        <?php
        require_once '././database/databaseConection.php';
        $id=$_GET['id'];
        $idModulo=$_GET['idModulo'];
        if(isset($_GET['c_tema']) && isset($_GET['c_modulo'])){
            $c_tema=$_GET['c_tema'];
            $c_modulo=$_GET['c_modulo'];
        }
        //echo $c_tema.'/';
        //echo $c_modulo;
        //esta variable solo me cuenta las respuestas correctas
        if(!isset($_GET['c'])){
            $_GET['c']=0;
        }
        $correcta=$_GET['c'];
        //contador de las preguntas respondidas
        if(!isset($_GET['contador'])){
            $_GET['contador']=0;
        }
        $contador=$_GET['contador'];

        // *****************************************************************//
        if(!isset($_GET['contadorP'])){
            $_GET['contadorP']=null;
        }
        $contadorP=$_GET['contadorP'];

        // *****************************************************************//
        // ID del curso Iniscrito
        if(isset($_GET['idCI'])){ 
            $idCI=$_GET['idCI'];}
        else{
            $idCI=0;}


        //selectionamos el id del cuestionario del modulo 1
        $pdo3 = Database::connect();//intentos
        $sql4 = "SELECT intentos FROM modulocurso WHERE id_Modulo='$idModulo' AND id_cursoInsc = '$id' ";
         $q4= $pdo->prepare($sql);
         $q4->execute(array());
         $fila4=$q4->fetch(PDO::FETCH_ASSOC);

         $pdo170 = Database::connect();
         $sqlitIntentos="SELECT intentos FROM progresocursoinscrito WHERE idModulo='$idModulo' AND id_cursoInscrito = '$idCI' ";
         $qiIntentos=$pdo170 -> prepare($sqlitIntentos);
         $qiIntentos->execute();
         $datoIntentos= $qiIntentos-> fetch(PDO::FETCH_ASSOC);
         if(empty($datoIntentos)){
            $intentos = 3;
            
         }else{
            $intentos=$datoIntentos['intentos'];//$fila4['intentos'];
         }
         
         


        $pdo = Database::connect();
        $sql = "SELECT * FROM cuestionario WHERE id_modulo='$idModulo'";
        $q = $pdo->prepare($sql);
        $q->execute(array());
        $fila=$q->fetch(PDO::FETCH_ASSOC);

        //nombre del curso
       $nombre_curso = Database::connect()->query("SELECT nombreCurso FROM cursos WHERE idCurso='$id'")->fetch(PDO::FETCH_ASSOC);
       Database::disconnect();
       //nombre del modulo
       $nombre_modulo = Database::connect()->query("SELECT nombreModulo FROM modulo WHERE idModulo='$idModulo'")->fetch(PDO::FETCH_ASSOC);
       Database::disconnect();

        //nombre del modulo
         
        $pdo169 = Database::connect();   
         $sqlitResTemp = "SELECT nota FROM progresocursoinscrito WHERE idModulo=$idModulo AND id_cursoInscrito = $idCI ";
         $qiResTemp = $pdo169 -> prepare($sqlitResTemp);
         $qiResTemp ->execute();
         $datoResTemp =  $qiResTemp -> fetch(PDO::FETCH_ASSOC);
         if(empty($datoResTemp)){
            $resultadoTemp = 0;
         }else{
            $resultadoTemp = $datoResTemp['nota'];
         }
        //primero se envia $correcta a la bd y luego se compara se llama con otra 
        //y se compara con el nuevo $correcta


        
        //saber cantidad de preguntas existen
            $pdo2 = Database::connect();
            $sql2 = "SELECT * FROM preguntas WHERE id_cuestionario='$fila[idCuestionario]'";
            $q2 = $pdo2->prepare($sql2);
            $q2->execute();
            $cuenta2 = $q2->rowCount();
            $filaCor=$q2->fetchAll(PDO::FETCH_ASSOC);
            Database::disconnect();
        //generar las preguntas que tengan el id_cuestionario
        $pdo1 = Database::connect();
        $sql1 = "SELECT * FROM preguntas WHERE id_cuestionario='$fila[idCuestionario]'";
        $q1 = $pdo1->prepare($sql1);
        $q1->execute(array());
        $reco=0;
        while($reco<$contador){
            $fila1=$q1->fetchAll(PDO::FETCH_ASSOC);
            $reco++;
        }
    ?>

    









    <?php 
            $pdo2 = Database::connect(); 
            $sql2 = "SELECT * FROM modulo WHERE id_curso='$id'";
            $q2 = $pdo2->prepare($sql2);
            $q2->execute();
            $dato2 = $q2->fetch(PDO::FETCH_ASSOC);
            Database::disconnect();

            $pdo3 = Database::connect(); 
            $sql3 = "SELECT * FROM tema WHERE id_modulo='$dato2[idModulo]'";
            $q3 = $pdo3->prepare($sql3);
            $q3->execute();
            $dato3 = $q3->fetch(PDO::FETCH_ASSOC);
    ?>




















            <br>
            <br>

            <div>
                <div class="container" style="margin-top: 120px;"></div>

                <div style="background: none; width: 80%; margin: auto; margin-bottom: 50px;">
                    <div class="col-md-12" style="padding-bottom: 40px; font-size: 19px;">
                        <div class="infoMin">
                            <a href="">
                                <?php echo $nombre_curso['nombreCurso']?> </a> <label> > </label>
                            <a href="">
                                <?php echo $nombre_modulo['nombreModulo']?> </a> <label> > </label>
                            <a href=""> Cuestionario </a>
                        </div>
                    </div>
                     




                    <?php
                        if($envi==$cuenta2){

                            //Calcular Nota Final
                            if($cuenta2 == $correcta){
                                $notaFinal = 20;
                            }else{
                                $notaFi = $correcta * 20 / $cuenta2;
                                $notaFinal = number_format($notaFi);
                            }

                            //Verificar si ya aprobó el curso.

                            $pdoAprobado = Database::connect(); 
                            $sqlAprobado="SELECT solicitudcertificado FROM cursoinscrito where id_cursoInscrito=$idCI";
                            $qiAprobado = $pdoAprobado->prepare($sqlAprobado);
                            $qiAprobado->execute();
                            $datoAprobado = $qiAprobado->fetch(PDO::FETCH_ASSOC);
                            $esAprobado=$datoAprobado['solicitudcertificado'];
                            Database::disconnect();

                            //Verificar si existe registro de haber realizado el modulo.
                            $pdo150 = Database::connect(); 
                            $sqlit="SELECT COUNT(idModCurso) cantidad FROM progresocursoinscrito where id_cursoInscrito=$idCI and idModulo = $idModulo";
                            $qi = $pdo150->prepare($sqlit);
                            $qi->execute();
                            $datoii = $qi->fetch(PDO::FETCH_ASSOC);
                            $cantidad=$datoii['cantidad'];
                            Database::disconnect();
                            $intentos = 3;
                            $intentoParaModal = $intentos;
                            //Dependiendo de la verificación se procede a insertar o actualizar valores.
                            if($esAprobado!=2){
                                if($cantidad<1){
                                    $pdo2 = Database::connect();
                                    try{
                                        $verif2=$pdo2->prepare("INSERT INTO `progresocursoinscrito` (`id_cursoInscrito`, idModulo, nota, intentos)VALUES ($idCI, $idModulo, $notaFinal, $intentos) ");
                                        $verif2->execute();
                                    }catch(PDOException $e){
                                        echo $e->getMessage();
                                    }
                                    Database::disconnect();
                                }else{
    
                                    $pdo1 = Database::connect();
                                    $sqlitIntNotas="SELECT intentos, nota, estado FROM progresocursoinscrito WHERE idModulo='$idModulo' AND id_cursoInscrito = '$idCI' ";
                                    $qiIntNotas=$pdo1 -> prepare($sqlitIntNotas);
                                    $qiIntNotas->execute();
                                    $datoIntNotas= $qiIntNotas-> fetch(PDO::FETCH_ASSOC);
                                    $intentos=$datoIntNotas['intentos'];//$fila4['intentos'];
                                    $notaSFinal = $datoIntNotas['nota'];
                                    $estadoMod = $datoIntNotas['estado'];
                                    $intentoParaModal = $intentos;
                                    if($notaSFinal < $notaFinal){
                                        $notaSFinal = $notaFinal;
                                    }
    
                                    if($intentos>0){
                                        if($estadoMod == 3){
                                            $intentos--; ///////////////
                                            $estadoMod = 1;
                                            $pdo2 = Database::connect();
                                            try{
                                                $verif2=$pdo2->prepare("UPDATE `progresocursoinscrito` SET `nota` = $notaSFinal, `intentos` = $intentos, `estado` = $estadoMod WHERE `id_cursoInscrito`=$idCI AND `idModulo`=$idModulo");
                                                $verif2->execute();
                                            }catch(PDOException $e){
                                                echo $e->getMessage();
                                            }
                                            Database::disconnect();  
                                        }else if($estadoMod == 2){
                                            $estadoMod = 1;
                                            $pdo2 = Database::connect();
                                            try{
                                                $verif2=$pdo2->prepare("UPDATE `progresocursoinscrito` SET `estado` = $estadoMod WHERE `id_cursoInscrito`=$idCI AND `idModulo`=$idModulo");
                                                $verif2->execute();
                                            }catch(PDOException $e){
                                                echo $e->getMessage();
                                            }
                                            Database::disconnect(); 
                                        }
                                        
                                    }
                                }
                            }
                            

                            //Calcular Avance de Curso y almacenarlo en BD
                            $pdo160 = Database::connect(); 
                            $sqlitProgreT = "SELECT COUNT(idModulo) Total FROM modulo WHERE id_curso = $id";
                            $qiProgreT = $pdo160->prepare($sqlitProgreT);
                            $qiProgreT->execute();
                            $datoProgreT = $qiProgreT -> fetch(PDO::FETCH_ASSOC);
                            $ProgreT = $datoProgreT['Total'];
                            Database::disconnect();
    
                            $pdo161 = Database::connect(); 
                            $sqlitProgreP = "SELECT COUNT(idModCurso) Parcial FROM progresocursoinscrito WHERE id_cursoInscrito = $idCI";
                            $qiProgreP = $pdo161->prepare($sqlitProgreP);
                            $qiProgreP->execute();
                            $datoProgreP = $qiProgreP -> fetch(PDO::FETCH_ASSOC);
                            $ProgreP = $datoProgreP['Parcial'];
                            Database::disconnect();
                            
                            if($ProgreP>0)
                                $Avance = $ProgreP/$ProgreT * 100;
                            else
                                $Avance = 0;
                            $AvanceFinal = number_format($Avance);
                            if($esAprobado!=2){
                                $pdo162 = Database::connect();
                                if($AvanceFinal == 100){
                                    $sqlitUAvance = "UPDATE cursoinscrito SET avance = $AvanceFinal, nota = ROUND((SELECT AVG(nota) FROM progresocursoinscrito WHERE id_cursoInscrito = $idCI), 2), solicitudcertificado=(CASE WHEN nota>=18 THEN 2 ELSE 1 END), fechaFinalizacion = NOW() WHERE id_cursoInscrito = $idCI";
                                }else{
                                    $sqlitUAvance = "UPDATE cursoinscrito SET avance = $AvanceFinal, nota = 0 WHERE id_cursoInscrito = $idCI";
                                }
                                
                                $qiUAvance = $pdo162->prepare($sqlitUAvance);
                                $qiUAvance->execute();
                                Database::disconnect();
                            }
                            
                            //Verificar si el curso ha sido calificado por el usuario.
                            $pdo140 = Database::connect();
                            $idUser=$_SESSION['codUsuario'];
                            $sqlitRating = "SELECT COUNT(id_puntaje) Cantidad FROM puntaje_curso WHERE id_curso = $id AND id_user=$idUser";
                            $qiRating = $pdo140->prepare($sqlitRating);
                            $qiRating->execute();
                            $datoRating = $qiRating -> fetch(PDO::FETCH_ASSOC);
                            $ConsultaRating = $datoRating['Cantidad'];
                            Database::disconnect();

                            /*Verificar Aprobación del Curso
                            $pdoConsultaCurso = Database::connect();
                            $sqlConsultaCurso= "SELECT nota, avance FROM cursoinscrito WHERE id_cursoInscrito = $idCI";
                            $qConsultaCurso = $pdoConsultaCurso->prepare($sqlConsultaCurso);
                            $qConsultaCurso->execute();
                            $datoConsultaCurso = $qConsultaCurso -> fetch(PDO::FETCH_ASSOC);
                            $notaCurso = $datoConsultaCurso['Cantidad'];
                            Database::disconnect();*/
                    ?>
                    <!--barra de avanace del curso -->
                   <!-- <h4 style="text-align: right; ">
                    <span style="text-align: center; color: #9383F3;">Avance de curso : </span> 
                    <progress style="width:; background:#E3E8E2;" max="100" value="<?php echo($AvanceFinal)?>"></progress>
                    <span style="text-align: center; color: #9383F3;"><?php echo($AvanceFinal)?>%</span>
                    </h4> 
                        -->

                   
                    <h1 style="color: #4F52D6; font-size: 30px; padding: 15px; text-align: center;">
                        <strong style="font-weight: bold; color: #7C83FD;">Cuestionario</strong>
                    </h1>
                    
                    <div class="opciones">
                        <!---->
                        <p style ="margin-right: 60px;">Reintentos: <?php if($esAprobado!=2){echo $intentos;}else{echo "Ilimitados";}?></p> 
                    
                        <!---->
                        <h6 style="font-weight: bold;">Fin de cuestionario</h6>
                        
                        <!---->
                        <div style="">
                        <?php
                                if($ConsultaRating<1){
                            ?>

                            <button style="width: 160px; background: #7C83FD; border: #7C83FD; color: white;" type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#btnTerminar">Terminar</button>
                            <?php
                                }else{
                            ?>
                            <a href="curso.php?id=<?php echo $id;?>&idCI=<?php echo $idCI;?>"><button id="botonTerminar" type="button" class="btn btn-outline-secondary">Terminar</button></a>
                            <?php
                                }
                        ?>
                        </div>
                    </div>

                         
                        <div style="text-align: center;">
                            
                            <!-- Modal -->
                            <?php
                                if($AvanceFinal == 100){
                            ?>
                            <div class="modal fade" id="btnTerminar" tabindex="-1" role="dialog" aria-labelledby="btnTerminarTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="btnTerminarTitle">Responde</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <div class="container">
                                        <div class="feedback" id="caja">
                                        <h5>Califica el curso<h5>
                                        <div class="rating">
                                            <input type="radio" name="rating" id="rating-5" value="5">
                                            <label for="rating-5"></label>
                                            <input type="radio" name="rating" id="rating-4" value="4">
                                            <label for="rating-4"></label>
                                            <input type="radio" name="rating" id="rating-3" value="3">
                                            <label for="rating-3"></label>
                                            <input type="radio" name="rating" id="rating-2" value="2">
                                            <label for="rating-2"></label>
                                            <input type="radio" name="rating" id="rating-1" value="1">
                                            <label for="rating-1"></label>
                                    
                                        <div class="emoji-wrapper">
                                            <div class="emoji">
                                                <svg class="rating-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                                <path d="M512 256c0 141.44-114.64 256-256 256-80.48 0-152.32-37.12-199.28-95.28 43.92 35.52 99.84 56.72 160.72 56.72 141.36 0 256-114.56 256-256 0-60.88-21.2-116.8-56.72-160.72C474.8 103.68 512 175.52 512 256z" fill="#f4c534"/>
                                                <ellipse transform="scale(-1) rotate(31.21 715.433 -595.455)" cx="166.318" cy="199.829" rx="56.146" ry="56.13" fill="#fff"/>
                                                <ellipse transform="rotate(-148.804 180.87 175.82)" cx="180.871" cy="175.822" rx="28.048" ry="28.08" fill="#3e4347"/>
                                                <ellipse transform="rotate(-113.778 194.434 165.995)" cx="194.433" cy="165.993" rx="8.016" ry="5.296" fill="#5a5f63"/>
                                                <ellipse transform="scale(-1) rotate(31.21 715.397 -1237.664)" cx="345.695" cy="199.819" rx="56.146" ry="56.13" fill="#fff"/>
                                                <ellipse transform="rotate(-148.804 360.25 175.837)" cx="360.252" cy="175.84" rx="28.048" ry="28.08" fill="#3e4347"/>
                                                <ellipse transform="scale(-1) rotate(66.227 254.508 -573.138)" cx="373.794" cy="165.987" rx="8.016" ry="5.296" fill="#5a5f63"/>
                                                <path d="M370.56 344.4c0 7.696-6.224 13.92-13.92 13.92H155.36c-7.616 0-13.92-6.224-13.92-13.92s6.304-13.92 13.92-13.92h201.296c7.696.016 13.904 6.224 13.904 13.92z" fill="#3e4347"/>
                                                </svg>
                                                <svg class="rating-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                                <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                                <path d="M328.4 428a92.8 92.8 0 0 0-145-.1 6.8 6.8 0 0 1-12-5.8 86.6 86.6 0 0 1 84.5-69 86.6 86.6 0 0 1 84.7 69.8c1.3 6.9-7.7 10.6-12.2 5.1z" fill="#3e4347"/>
                                                <path d="M269.2 222.3c5.3 62.8 52 113.9 104.8 113.9 52.3 0 90.8-51.1 85.6-113.9-2-25-10.8-47.9-23.7-66.7-4.1-6.1-12.2-8-18.5-4.2a111.8 111.8 0 0 1-60.1 16.2c-22.8 0-42.1-5.6-57.8-14.8-6.8-4-15.4-1.5-18.9 5.4-9 18.2-13.2 40.3-11.4 64.1z" fill="#f4c534"/>
                                                <path d="M357 189.5c25.8 0 47-7.1 63.7-18.7 10 14.6 17 32.1 18.7 51.6 4 49.6-26.1 89.7-67.5 89.7-41.6 0-78.4-40.1-82.5-89.7A95 95 0 0 1 298 174c16 9.7 35.6 15.5 59 15.5z" fill="#fff"/>
                                                <path d="M396.2 246.1a38.5 38.5 0 0 1-38.7 38.6 38.5 38.5 0 0 1-38.6-38.6 38.6 38.6 0 1 1 77.3 0z" fill="#3e4347"/>
                                                <path d="M380.4 241.1c-3.2 3.2-9.9 1.7-14.9-3.2-4.8-4.8-6.2-11.5-3-14.7 3.3-3.4 10-2 14.9 2.9 4.9 5 6.4 11.7 3 15z" fill="#fff"/>
                                                <path d="M242.8 222.3c-5.3 62.8-52 113.9-104.8 113.9-52.3 0-90.8-51.1-85.6-113.9 2-25 10.8-47.9 23.7-66.7 4.1-6.1 12.2-8 18.5-4.2 16.2 10.1 36.2 16.2 60.1 16.2 22.8 0 42.1-5.6 57.8-14.8 6.8-4 15.4-1.5 18.9 5.4 9 18.2 13.2 40.3 11.4 64.1z" fill="#f4c534"/>
                                                <path d="M155 189.5c-25.8 0-47-7.1-63.7-18.7-10 14.6-17 32.1-18.7 51.6-4 49.6 26.1 89.7 67.5 89.7 41.6 0 78.4-40.1 82.5-89.7A95 95 0 0 0 214 174c-16 9.7-35.6 15.5-59 15.5z" fill="#fff"/>
                                                <path d="M115.8 246.1a38.5 38.5 0 0 0 38.7 38.6 38.5 38.5 0 0 0 38.6-38.6 38.6 38.6 0 1 0-77.3 0z" fill="#3e4347"/>
                                                <path d="M131.6 241.1c3.2 3.2 9.9 1.7 14.9-3.2 4.8-4.8 6.2-11.5 3-14.7-3.3-3.4-10-2-14.9 2.9-4.9 5-6.4 11.7-3 15z" fill="#fff"/>
                                                </svg>
                                                <svg class="rating-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                                <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                                <path d="M336.6 403.2c-6.5 8-16 10-25.5 5.2a117.6 117.6 0 0 0-110.2 0c-9.4 4.9-19 3.3-25.6-4.6-6.5-7.7-4.7-21.1 8.4-28 45.1-24 99.5-24 144.6 0 13 7 14.8 19.7 8.3 27.4z" fill="#3e4347"/>
                                                <path d="M276.6 244.3a79.3 79.3 0 1 1 158.8 0 79.5 79.5 0 1 1-158.8 0z" fill="#fff"/>
                                                <circle cx="340" cy="260.4" r="36.2" fill="#3e4347"/>
                                                <g fill="#fff">
                                                    <ellipse transform="rotate(-135 326.4 246.6)" cx="326.4" cy="246.6" rx="6.5" ry="10"/>
                                                    <path d="M231.9 244.3a79.3 79.3 0 1 0-158.8 0 79.5 79.5 0 1 0 158.8 0z"/>
                                                </g>
                                                <circle cx="168.5" cy="260.4" r="36.2" fill="#3e4347"/>
                                                <ellipse transform="rotate(-135 182.1 246.7)" cx="182.1" cy="246.7" rx="10" ry="6.5" fill="#fff"/>
                                                </svg>
                                                <svg class="rating-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                                    <path d="M407.7 352.8a163.9 163.9 0 0 1-303.5 0c-2.3-5.5 1.5-12 7.5-13.2a780.8 780.8 0 0 1 288.4 0c6 1.2 9.9 7.7 7.6 13.2z" fill="#3e4347"/>
                                                    <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                                    <g fill="#fff">
                                                    <path d="M115.3 339c18.2 29.6 75.1 32.8 143.1 32.8 67.1 0 124.2-3.2 143.2-31.6l-1.5-.6a780.6 780.6 0 0 0-284.8-.6z"/>
                                                    <ellipse cx="356.4" cy="205.3" rx="81.1" ry="81"/>
                                                    </g>
                                                    <ellipse cx="356.4" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347"/>
                                                    <g fill="#fff">
                                                    <ellipse transform="scale(-1) rotate(45 454 -906)" cx="375.3" cy="188.1" rx="12" ry="8.1"/>
                                                    <ellipse cx="155.6" cy="205.3" rx="81.1" ry="81"/>
                                                    </g>
                                                    <ellipse cx="155.6" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347"/>
                                                    <ellipse transform="scale(-1) rotate(45 454 -421.3)" cx="174.5" cy="188" rx="12" ry="8.1" fill="#fff"/>
                                                </svg>
                                                <svg class="rating-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                                    <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                                    <path d="M232.3 201.3c0 49.2-74.3 94.2-74.3 94.2s-74.4-45-74.4-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b"/>
                                                    <path d="M96.1 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2C80.2 229.8 95.6 175.2 96 173.3z" fill="#d03f3f"/>
                                                    <path d="M215.2 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff"/>
                                                    <path d="M428.4 201.3c0 49.2-74.4 94.2-74.4 94.2s-74.3-45-74.3-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b"/>
                                                    <path d="M292.2 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2-77.8-65.7-62.4-120.3-61.9-122.2z" fill="#d03f3f"/>
                                                    <path d="M411.3 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff"/>
                                                    <path d="M381.7 374.1c-30.2 35.9-75.3 64.4-125.7 64.4s-95.4-28.5-125.8-64.2a17.6 17.6 0 0 1 16.5-28.7 627.7 627.7 0 0 0 218.7-.1c16.2-2.7 27 16.1 16.3 28.6z" fill="#3e4347"/>
                                                    <path d="M256 438.5c25.7 0 50-7.5 71.7-19.5-9-33.7-40.7-43.3-62.6-31.7-29.7 15.8-62.8-4.7-75.6 34.3 20.3 10.4 42.8 17 66.5 17z" fill="#e24b4b"/>
                                                </svg>
                                                <svg class="rating-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <g fill="#ffd93b">
                                                        <circle cx="256" cy="256" r="256"/>
                                                        <path d="M512 256A256 256 0 0 1 56.8 416.7a256 256 0 0 0 360-360c58 47 95.2 118.8 95.2 199.3z"/>
                                                    </g>
                                                    <path d="M512 99.4v165.1c0 11-8.9 19.9-19.7 19.9h-187c-13 0-23.5-10.5-23.5-23.5v-21.3c0-12.9-8.9-24.8-21.6-26.7-16.2-2.5-30 10-30 25.5V261c0 13-10.5 23.5-23.5 23.5h-187A19.7 19.7 0 0 1 0 264.7V99.4c0-10.9 8.8-19.7 19.7-19.7h472.6c10.8 0 19.7 8.7 19.7 19.7z" fill="#e9eff4"/>
                                                    <path d="M204.6 138v88.2a23 23 0 0 1-23 23H58.2a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#45cbea"/>
                                                    <path d="M476.9 138v88.2a23 23 0 0 1-23 23H330.3a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#e84d88"/>
                                                    <g fill="#38c0dc">
                                                        <path d="M95.2 114.9l-60 60v15.2l75.2-75.2zM123.3 114.9L35.1 203v23.2c0 1.8.3 3.7.7 5.4l116.8-116.7h-29.3z"/>
                                                    </g>
                                                    <g fill="#d23f77">
                                                        <path d="M373.3 114.9l-66 66V196l81.3-81.2zM401.5 114.9l-94.1 94v17.3c0 3.5.8 6.8 2.2 9.8l121.1-121.1h-29.2z"/>
                                                    </g>
                                                    <path d="M329.5 395.2c0 44.7-33 81-73.4 81-40.7 0-73.5-36.3-73.5-81s32.8-81 73.5-81c40.5 0 73.4 36.3 73.4 81z" fill="#3e4347"/>
                                                    <path d="M256 476.2a70 70 0 0 0 53.3-25.5 34.6 34.6 0 0 0-58-25 34.4 34.4 0 0 0-47.8 26 69.9 69.9 0 0 0 52.6 24.5z" fill="#e24b4b"/>
                                                    <path d="M290.3 434.8c-1 3.4-5.8 5.2-11 3.9s-8.4-5.1-7.4-8.7c.8-3.3 5.7-5 10.7-3.8 5.1 1.4 8.5 5.3 7.7 8.6z" fill="#fff" opacity=".2"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <h5>Déjanos un comentario</h5>
                                    <input type="text" name="text" id="coment1" maxLength="250">
                                        <label for="coment1"></label>
                                    <br>
                                    <h5>Realiza la siguiente encuesta de satifaccion</h5>
                                    <a href="https://docs.google.com/forms/d/e/1FAIpQLSfLNgkgG3cjR8gAYaC3BPhyraDkbraC78WVO3KcqYPWyu8Kcg/viewform"><button class="btn btn-primary" type="submit">Ir a la encuesta</button><a>
                                </div>
                            </div>
                                    </div>






                                    <div class="modal-footer">
<!--                                     <a href="curso.php?id=<?php echo $id;?>&idCI=<?php echo $idCI;?>"><button id="botonTerminar" type="button" data-toggle="modal" class="btn btn-outline-secondary" data-target="#btnTerminar">Guardar</button></a>
 -->     
                                        <button id="botonTerminar" type="button" data-toggle="modal" class="btn btn-outline-secondary" data-target="#btnTerminar" >Guardar</button>
                                        <script>
                                            $("#botonTerminar").click((event)=>{
                                                const rating = $("input[name='rating']:checked").val()
                                                console.log(rating)
                            
                                                const coment = $("#coment1").val()
                                                console.log(coment)
                                                const queryString = new URLSearchParams()
                                                queryString.append('rating', rating)
                                                queryString.append('coment', coment)
                                                const prepQuery = new URLSearchParams(window.location.search)
                                                queryString.append('id',prepQuery.get('id'))
                                                queryString.append('idCI',prepQuery.get('idCI'))
                                                window.location="curso.php?"+queryString
                                                /* window.location.search = queryString.toString()  */
                                                console.log(queryString.toString())
                                            /*  window.location="./rating.php" */

                                            })

                                            
                                        
                                        </script>   
                                        
                                    </div>






                                    </div>
                                </div>
                            </div>
                            <?php
                                }else{?>
                                <div class="modal fade" id="btnTerminar" tabindex="-1" role="dialog" aria-labelledby="btnTerminarTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <i class="fa fa-exclamation-circle fa-5x" aria-hidden="true" style="color:orange;"></i>
                                            <br>
                                            <br>
                                            <h5><strong>Completa todos los módulos para completar el curso.</strong></h5>
                                            <a>
                                                <button id="actualizarConteo_2" type="button" onclick='showAlert()' class="btn btn-outline-secondary">Reintentar</button>
                                            </a>
                
                                            <?php
                                            
                                                // $pdow = Database::connect(); 
                                                // $sqli = "SELECT * FROM modulo WHERE id_curso='$id'";
                                                // $qi = $pdow->prepare($sqli);
                                                // $qi->execute(array());
                                                // $datoi = $qi->fetch(PDO::FETCH_ASSOC);
                                                // Database::disconnect();
                                                // $di=$datoi['idModulo'];
                                                // $pdodi = Database::connect(); 
                                                
                                                // $sqli="SELECT c.idModulo,p.idTema,l.idCurso FROM tema p INNER JOIN modulo c ON c.idModulo=p.id_modulo INNER JOIN cursos l ON idCurso= c.id_curso WHERE c.idModulo='$di' AND l.idCurso='$id'";
                                                // $qst = $pdow->prepare($sqlt);
                                                // $qst->execute(array());
                                                // echo "<br>";
                                                // $resultado1t=$qst->fetchAll();
                                                // echo $resultado1t[1]['idTema'];
                                                // // $idtema=$_GET['idtema'];
                                                // $nuevat=$_GET['idtema'];
                                                // $idtemat=$resultado1t[intval($_GET['idtema'])-1]['idTema'];
                
                                                // echo $nuevat;
                                                $pdo19 = Database::connect(); 
                                                $sqlit="SELECT idModulo FROM modulo where id_curso=$id order by idModulo DESC LIMIT 1";
                                                $qi = $pdo19->prepare($sqlit);
                                                $qi->execute();
                                                $datoi = $qi->fetch(PDO::FETCH_ASSOC);
                                                $idmodu=$datoi['idModulo'];
                
                                                $pdo32 = Database::connect();
                                                $sqlit32="SELECT idModulo FROM modulo where id_curso=$id order by idModulo ASC";
                                                $qi32 = $pdo32->prepare($sqlit32);
                                                $qi32->execute(array());
                                                $datoi32 = $qi32->fetchAll(PDO::FETCH_ASSOC);
                                                $nW=$_GET['nW'];
                                                if($idModulo<$idmodu){
                                                    $idmodulito=$datoi32[$nW+1]['idModulo'];
                                            ?>
                                                    <a href="video.php?id=<?php echo $id?>&idtema=1&id_modulo=<?php echo ($idmodulito)?>&nW=<?php echo $_GET['nW']+1?>&idCI=<?php echo $idCI?>"><button type="button" class="btn btn-outline-secondary">Siguiente</button></a>
                                                    <!-- <a href="video.php?id=?php echo $id?>&idtema=1&id_modulo=<php echo ($idModulo+1)?>"><button type="button" class="btn btn-outline-secondary">Siguiente</button></a> -->
                                            <?php
                                                }
                                            ?>
                                        </div> 
                                    </div> 
                                </div>
                            <?php } ?>


                            
                            <!-- -->
                            <?php if($intentoParaModal==0){?>

                                <script>
    
                                    Swal.fire({

                                        icon: 'warning',

                                        html:

                                        '<h5 style="color: black;">• Tu número de intentos está agotado.</h5>'
                                        +
                                        '<h5 style="color: black;">• Podrá seguir respondiendo el cuestionario, pero su calificación ya no será válida.</h5>',
                                        
                                    }).then((result) => {
                                        
                                        $('#botonTerminar').trigger('click');
                                    })
                                
                                </script>

                            <?php }?>
                            




                            <!-- -->
                            <?php 
                            
                            if($intentos==1){?>
                                
                                <script>

                                    function showAlert(){

                                        
                                        Swal.fire({

                                            icon: 'warning',

                                            html:

                                            '<h5 style="color: black;">• Le queda solo un intento.</h5>'
                                            +
                                            '<h5 style="color: black;">• No olvide que después de haber realizado 3 intentos, podrá seguir respondiendo el cuestionario, pero su calificación ya no será válida.</h5>'
                                            +
                                            '<h5 style="color: black;">• Preste mucha atención al video del módulo antes de volver a responder el cuestionario.</h5>',

                                            confirmButtonText: "Volver a responder el cuestionario",

                                            showDenyButton: true,
                                            denyButtonColor: '#7A5CBB',
                                            denyButtonText: '<a style="color: white; text-decoration: none;" href="video.php?id=<?php echo $id;?>&idtema=<?php echo 1;?>&id_modulo=<?php echo $idModulo?>&idCI=<?php echo $idCI?>">Volver a ver el video del módulo</a>',

                                            showCancelButton: true,
                                            cancelButtonColor: 'red',
                                            cancelButtonText: "Cancelar",

                                        }).then((result) => {

                                            if (result.isConfirmed) {
    
                                                $('#actualizarConteo').trigger('click');

                                            } else if (result.isDenied) {

 
                                            }
                                        })

                                    }

                                </script>

                            <?php
                            
                            } else if($intentos==2){?>
                                
                                <script>

                                    function showAlert(){

                                        Swal.fire({

                                            icon: 'warning',

                                            html:

                                            '<h5 style="color: black;">• Te quedan 2 intentos.</h5>'
                                            +
                                            '<h5 style="color: black;">• Preste mucha atención al video del módulo antes de volver a responder el cuestionario.</h5>',

                                            confirmButtonText: "Volver a responder el cuestionario",

                                            showDenyButton: true,
                                            denyButtonColor: '#7A5CBB',
                                            denyButtonText: '<a style="color: white; text-decoration: none;" href="video.php?id=<?php echo $id;?>&idtema=<?php echo 1;?>&id_modulo=<?php echo $idModulo?>&idCI=<?php echo $idCI?>">Volver a ver el video del módulo</a>',
                                            

                                            showCancelButton: true,
                                            cancelButtonColor: 'red',
                                            cancelButtonText: "Cancelar",

                                        }).then((result) => {

                                            if (result.isConfirmed) {
    
                                                $('#actualizarConteo').trigger('click');

                                            } else if (result.isDenied) {

 
                                            }
                                        })

                                    }

                                </script>
                        
                        
                            <?php
                        
                        
                            }else{?>


                                <script>

                                    function showAlert(){

                                        $('#actualizarConteo').trigger('click');
                                    }
                                    
                                </script>

                            <?php }?>






                            <a href="cuestionario.php?id=<?php echo $id?>&nW=<?php echo $_GET['nW']?>&idModulo=<?php echo $idModulo;?>&up=0&idCues=<?php echo $fila['idCuestionario'];?>&idCI=<?php echo $idCI?>&cuen=1&nro=0">
                                <button id="actualizarConteo" type="submit" onclick='' class="btn btn-outline-secondary" hidden multiple>Reintentar</button>
                            </a>

                        </div>


                        <div style="margin-top: 40px;">
                            <div style="border-radius: 20px 20px 0 0; background: #7C83FD; color: white;" class="card-header">
                                Resultado de las
                                <?php echo $cuenta2;?> preguntas
                            </div>
                            <div class="card-body" style="background-color: #fff; border-radius: 0 0 20px 20px;">
                                <h5 style="font-size: large; margin-left: 10px; margin-bottom: 30px; color: #7C83FD; background-color: #fff;">Respuestas Correctas:
                                    <?php echo $correcta;?>
                                </h5>
                                <?php
                                $porciones = explode(",", $contadorP);
                                $cont = 1;
                                foreach ($filaCor as $filaCor) {
                                    
                                    $separado = $porciones[$cont];
                                    $separado1 = explode("-", $separado);
                                    
                                    $idpregunta = $separado1[0];
                                    $idrespuesta = $separado1[1];

                                    $pdo23 = Database::connect();
                                    //echo $idpregunta;
                                    $sql23 = "SELECT * FROM respuestas WHERE id_Pregunta='$idpregunta'";
                                    $q23 = $pdo23->prepare($sql23);
                                    $q23->execute(array());

                                    $sql24 = "SELECT * FROM respuestas WHERE id_Pregunta='$idpregunta'";
                                    $q24 = $pdo23->prepare($sql24);
                                    $q24->execute(array());

                                    $puntaje = false;
                                    $puntRes = 20 / $cuenta2;
                                    $conF = 0;
                                    $conT = 0;
                                    $conTotal = 0;
                                    while($fila24=$q24->fetch(PDO::FETCH_ASSOC)){
                                        if($fila24['idRespuesta'] == $idrespuesta && $fila24['estado']==1){
                                            $puntaje = true;
                                        }
                                    }
                                ?>
                                    <!-- nuevo -->
                                    <div style="background: #E7F4FF;" class="card c-rpta mx-7 mt-2">
                                        <div style="background: #7C83FD;" class="card-header">
                                                <div class="row">
                                                    <!--div class="col-sm-6 text-left"></div-->
                                                    <div class="col-sm-12 text-right" style="color:#768EE8; color: white; font-weight: 900;">Puntos: &nbsp; <?php echo (($puntaje)?''.round($puntRes).'/'.round($puntRes).' pts':'0/'.round($puntRes).' pts')?> </div>
                                                </div> 
                                        </div>
                                        <!--<div class="list-group list-group-flush small text-left text-secondary font-weight-normal my-3" style="color: black !important; font-weight: bold; font-size: 20px; margin-left:10px;">
                                             <?php echo $filaCor['pregunta'];?> 
                                        </div>-->
                                        <ul style="background: #E7F4FF;" class="list-group list-group-flush text-justify">
                                        
                                            <?php while($fila23=$q23->fetch(PDO::FETCH_ASSOC)){
                                            ?>

                                                <label style="color: black;">
                                                    <div class="form-check" style="">
                                                        <?php if($fila23['idRespuesta'] == $idrespuesta){?>

                                                            <label class="form-check-label" for="exampleRadios1" <?php echo (($fila23['estado']==1)?'style="font-family: Mukta; background:#C7D8B8; width:100%; height:auto; padding:1px;"':'style="font-family: Mukta; background:#DD95EB; width:100%; height:auto; padding:1px;"')?>>
                                                            <input type="checkbox" name="verif_resp" disabled  checked value="<?php echo $fila23['idRespuesta'];?>" style="width: 1.3em;
    height: 1.3em;
    background-color: #B5B5B5;
    border-radius: 50%;
    vertical-align: middle;
    border: 1px solid #7C83FD;
    appearance: none;
    -webkit-appearance: none;
    outline: none;
    cursor: pointer;">
                                                             <?php echo  $fila23['respuesta'];?> </label>

                                                        <?php }else{?>

                                                            <label class="form-check-label" for="exampleRadios1" <?php echo (($fila23['estado']==1)?'style="font-family: Mukta; background:#C7D8B8; width:100%; height:auto; padding:1px;"':'style="color:black; font-family: Mukta; width:100%; height:auto; padding:1px;"')?>>
                                                            <input type="checkbox" name="verif_resp" disabled  value="<?php echo $fila23['idRespuesta'];?>" style="width: 1.3em;
    height: 1.3em;
    background-color: white;
    border-radius: 50%;
    vertical-align: middle;
    border: 1px solid #7C83FD;
    appearance: none;
    -webkit-appearance: none;
    outline: none;
    cursor: pointer;">
                                                             <?php echo  $fila23['respuesta'];?> </label>
                                                             
                                                        <?php }?>
                                                    </div>
                                                </label>
                                            <?php }?>
                                            
                                        </ul>
                                        
                                    </div>
                                            
                                    <!-- fin nuevo -->

                                <?php
                                    $cont++;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    <?php
                        
                    } 
                    ?>
                    
                    <?php 
                    if($envi<$cuenta2){
                        if($fila1=$q1->fetchAll()){
                            if($envi==0 || $envi==$cuenta2-1){
                                $valorEstado=1;
                                if($envi==0){
                                    $valorEstado = 2;
                                }
                                if($envi==$cuenta2-1){
                                    $valorEstado = 3;
                                }
                                $pdo151 = Database::connect(); 
                                $sqlita="SELECT COUNT(idModCurso) cantidad FROM progresocursoinscrito where id_cursoInscrito=$idCI and idModulo = $idModulo";
                                $qi2 = $pdo151->prepare($sqlita);
                                $qi2->execute();
                                $datoiii = $qi2->fetch(PDO::FETCH_ASSOC);
                                $cantidad2=$datoiii['cantidad'];
                                Database::disconnect();
                                //Dependiendo de la verificación se procede actualizar el estadi
                                //1: Revisado 2: Iniciado 3: Terminado
                                if($cantidad2>0){

                                    $pdo1 = Database::connect();
                                    $sqlitIntNotas="SELECT estado FROM progresocursoinscrito WHERE idModulo='$idModulo' AND id_cursoInscrito = '$idCI' ";
                                    $qiIntNotas=$pdo1 -> prepare($sqlitIntNotas);
                                    $qiIntNotas->execute();
                                    $datoIntNotas= $qiIntNotas-> fetch(PDO::FETCH_ASSOC);
                                    $estadoMod = $datoIntNotas['estado'];

                                    if($valorEstado==2 || ($valorEstado != 2 && $estadoMod != 1) || ($cuenta2==1)){
                                        $pdo2 = Database::connect();
                                        try{
                                            $pdo152 = Database::connect();
                                            $sqlitEstado = "UPDATE progresocursoinscrito SET estado = $valorEstado where id_cursoInscrito=$idCI and idModulo = $idModulo";
                                            $qiUEst = $pdo152->prepare($sqlitEstado);
                                            $qiUEst->execute();
                                        }catch(PDOException $e){
                                            echo $e->getMessage();
                                        }
                                        Database::disconnect();
                                    }else{
                                        //header('Location:sidebarCursos.php');
                                        header('Location:curso.php?id='.urlencode($id).'&idCI='.urlencode($idCI));
                                    }
                                    
                                }
                            }
                            
                            $pdo2 = Database::connect();
                            $idpregunta=$fila1[$up]['idPregunta'];
                            //echo $idpregunta;
                            $sql2 = "SELECT * FROM respuestas WHERE id_Pregunta='$idpregunta'";

                            $q2 = $pdo2->prepare($sql2);
                            $q2->execute(array());
                    ?>

                            <h5 style="background: #7C83FD; padding: 20px 35px; color: #fff; margin-top: -20px;">
                                <?php echo $fila1[$envi]['pregunta'];?>
                            </h5>
                            <form style="padding: 30px; background: #fff;margin-top: -7px;" action="includes/cuestionarioCRUD/cuestion.php?contador=<?php echo $contador;?>&id=<?php echo $id;?>&c=<?php $correcta ?>&idModulo=<?php echo $idModulo;?>&validar=<?php echo 0; ?>&up=<?php echo $up ?>&cuen=<?php echo $ens ?>&nro=<?php echo $envi?>&id_pregunta=<?php echo $idpregunta ?>&nW=<?php echo $_GET['nW']?>&idCI=<?php echo $idCI?>"
                                method="POST" id="formcito">
                                <?php while($fila2=$q2->fetch(PDO::FETCH_ASSOC)){ 
                                            //checked
                                        ?>      
                                                                           
                                <div style="padding: 10px; border-radius: 5px; background: #E2EDF8; margin-bottom: 20px;">
                                    <div class="form-check">
                                        <label class="form-check-label" style=" width: 100%; margin-left: 22px; font-size: 1.20rem">
                                        <input class="form-check-input" style="margin-top: 2px;height: 25px;width: 25px;left: 22px"type="radio" name="verif_resp" value="<?php echo $fila2['respuesta'];?>">
                                        <input type="hidden" name="correcta" value="<?php echo $correcta;?>">
                                        <input type="hidden" name="contadorP" value="<?php echo $contadorP;?>">
                                         <?php echo $fila2['respuesta'];?> </label>
                                    </div>
                                </div>
                                
                                <?php }?>
                                <div style="text-align: right;">
                                    <?php 
                                            $pdo8 = Database::connect();
                                            $sqlit="SELECT idModulo FROM modulo where id_curso=$id order by idModulo DESC LIMIT 1";
                                            $qi = $pdo8->prepare($sqlit);
                                            $qi->execute();
                                            $datoi = $qi->fetch(PDO::FETCH_ASSOC);
                                            $idmodu=$datoi['idModulo'];
                                            //echo $idModulo;


                                            if($envi<$cuenta2 && $ens<=$cuenta2){
                                    ?>
                                                <button type="submit" style="background-color: #7C83FD;color: #fff;width: 9em; height: 44px;"id="env" class="btn btn-outline-primary">Siguiente</button>
                                    <?php
                                            }



                                            //     else if($idModulo==$idmodu){
                                            //         
                                            //         <button type="submit" id="env" class="btn btn-outline-primary" onclick="parent.location='curso.php?id=<?php echo $id'">Siguiente</button> -->
                                            //         
                                            //     }
                                            //     else{
                                            
                                            //     <button type="submit" id="env" class="btn btn-outline-primary" onclick="parent.location='video.php?id=<?php echo $id&idtema=1&id_modulo=<?php echo ($idModulo+1)'">Siguiente</button> -->
                                            
                                                // }
                                        ?>
                                </div>
                            </form>

                        <?php 
                            }
                        ?>

                        </div>
                        </div>

                        <br>
                        <br>
                        <br>
                        <br>
                        <br>

                        <?php
                }
                }
                else{
                            header('Location:iniciosesion.php');
                }
            ?>

    <script type="text/javascript">

        var form = document.getElementById('formcito');
        form.onsubmit = function() {
            if (form.verif_resp.value == "") {
                Swal.fire(
                    'Seleccione una respuesta',
                    '',
                    'error'
                )
                return false;
            }
        }

        $('#actualizarConteo').click(function(){
            var intentos=$($intentos-1).val();
            var notaTemp=$($correcta).val();
            $.post()
        });



    </script>

</body>

</html>