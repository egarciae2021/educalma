<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscrito</title>
    <link rel="stylesheet" href="././assets/css/styleinscrito.css">
</head>
<body>

<!--<section class="contbody">

<body>
    <section class="contbody">
        <div class="contdetinfo">
            <?php
                require_once '././database/databaseConection.php';
                $idCurso= $_GET['idCurso'];

                $pdo2 = Database::connect();
                $sql2 = "SELECT * FROM cursos WHERE idCurso='$idCurso'";
                $q2 = $pdo2->prepare($sql2);
                $q2->execute(array());
                $dato2=$q2->fetch(PDO::FETCH_ASSOC)
            ?>
            <div class="detboxinfo">
                <h1>Cursos: <strong><?php echo $dato2['nombreCurso'];?></strong> </h1>

            </div>

            <div class="detboxinfo2">
                <img src="./images/polygon.png">
                <h1>Por Ronald Richards</h1>
                <p>M1: Clase 5 - Metodo de intervención</p>
            </div>
            
                    <div class="videocurso">
               <iframe width="120%" height="215"
              src="https://www.youtube.com/embed/cv3cTM4T2DA">
              </iframe>
                    </div>
        </div>

    </div>
     </section>  -->

     <?php

        require_once '././database/databaseConection.php';
        $pdo = Database::connect();

        $sql = "SELECT * FROM modulo where id_curso= '$_GET[idCurso]' ORDER BY idModulo ASC";
        $q = $pdo->prepare($sql);
        $q->execute(array());

        $cont = 1;
        while($registro = $q->fetch(PDO::FETCH_ASSOC) ){
            $cont = $cont + 1;
            if($cont > 2 ){
                return ;
            }
       
        $aux = $registro['idModulo'];

        $sql = "SELECT * FROM tema where id_modulo= '$aux' ORDER BY idTema ASC";
        $q = $pdo->prepare($sql);
        $q->execute(array());
            

        $cont2 = 1;
        while($registro2 = $q->fetch(PDO::FETCH_ASSOC) ){
            $cont2 = $cont2 + 1;
            if($cont2 > 2 ){
                return ;
            }


     ?>

     <br><br>
     <br>
     <br>
     <br>
     <div class= "container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
            <h1 style="color: #4F52D6"><img src="./assets/images/polygon.png"> <strong> M1: <?php echo $registro2['nombreTema'] ?></strong></h1>
            </div>
            <div class="col-md-2"></div>
        </div>
     </div> 
     <br>
     <br>

     <div class= "container">
    <div class="row">
    <div class="col-md-2"></div>
        <div class="col-md-8" style="background-color: #4F52D6;">
             <div class="embed-responsive embed-responsive-16by9" >
              <?php 
              $url=$registro2['link_video'];
              function getYoutubeEmbedUrl($url){

                $urlParts   = explode('/', $url);
                $vidid      = explode( '&', str_replace('watch?v=', '', end($urlParts) ) );
            
                return 'https://www.youtube.com/embed/' . $vidid[0] ;
            }
              $link = getYoutubeEmbedUrl($registro2['link_video']);
              
              ?>

                <iframe src="<?php echo $link;?>"
                    frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen class="responsive-iframe" ></iframe>
	         </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    <br>
<br>
</div>   

<?php
        }
    }


    $pdo = Database::disconnect();

            ?>

</body>

</html>