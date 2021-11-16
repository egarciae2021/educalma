<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="jquery-min.js"></script>
    <link rel="stylesheet" href="././assets/css/styleprogreso.css">
</head>
<?php
// Este codigo hace validacion para que no se pueda acceder a cualquier pagina sin estar logueado__Pablo Loyola

 if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
?>
<?php
    
    require_once '././database/databaseConection.php';
    if(isset($_GET['validar'])){

        $id=$_GET['id'];
        //$idtema=$_GET['idtema'];

        $pdo6 = Database::connect(); 
        $sql6 = "SELECT * FROM cursos WHERE idCurso='$id'";
        $q6 = $pdo6->prepare($sql6);
        $q6->execute(array());
        $dato6 = $q6->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        if(!isset($_GET['c_modulo'])){
            $_GET['c_modulo']=1;
        }
        $cont_modulo=$_GET['c_modulo'];

        $pdo = Database::connect(); 
        $sql = "SELECT * FROM modulo WHERE id_curso='$id'";
        $q = $pdo->prepare($sql);
        $q->execute(array());
        Database::disconnect();
        $contaM=1;
        while($contaM<$cont_modulo){
            $dato = $q->fetch(PDO::FETCH_ASSOC);
            $contaM++;
        }
        $dato = $q->fetch(PDO::FETCH_ASSOC);

        if(!isset($_GET['c_tema'])){
            $_GET['c_tema']=1;
        }
        $cont_tema=$_GET['c_tema'];

            $pdo2 = Database::connect(); 
            $sql2 = "SELECT * FROM tema WHERE id_modulo='$dato[idModulo]'";
            $q2 = $pdo2->prepare($sql2);
            $q2->execute(array());
                        
            Database::disconnect();
            $contaT=1;
            while($contaT<$cont_tema){
                $dato2 = $q2->fetch(PDO::FETCH_ASSOC);
                $contaT++;
            }
            $dato2 = $q2->fetch(PDO::FETCH_ASSOC);

    ?>
<div class="container" style="margin-top: 120px;">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="infoMin"> 
            <h2><?php 
                    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $components = parse_url($url);
                    parse_str($components['query'], $results);
                    if (array_key_exists('a', $results)) {
                        $access=$results["a"]; 
                    }else{
                        $access="true";
                    }
                ?></h2>
                <a href="Cursoiniciar.php?id=<?php echo $id;?>" <?php if ($access=="d") {
                    echo 'style="pointer-events: none;"';
                }?>
                ><?php echo $dato6['nombreCurso'];?></a> <label> > </label> <a
                    href=""><?php echo $dato['nombreModulo'];?> </a>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>
<br>
<div>
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <h2><?php 
                    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $components = parse_url($url);
                    parse_str($components['query'], $results);
                    if (array_key_exists('a', $results)) {
                        $access=$results["a"]; 
                    }else{
                        $access="true";
                    }
                ?></h2>
                <button type="button" <?php if ($access=="d") {
                    echo "disabled";
                }?>  class="btn btn-outline-secondary" id="btnV"
                    onclick="parent.location='includes/curso/VideoSiguiente.php?id=<?php echo $id;?>&c_modulo=<?php echo $cont_modulo;?>&c_tema=<?php echo ($cont_tema-1);?>&idmodulo=<?php echo $dato['idModulo']?>'"> <strong> < </strong> Anterior</button>
                <button type="button" class="btn btn-outline-secondary" id="btnV2"> 
                    <?php echo $dato2['nombreTema'];?>
                    <img src="././assets/images/video_icono_32.png"></button>
                <button type="button"<?php if ($access=="d") {
                    echo "disabled";
                }?> class="btn btn-outline-secondary" id="btnV"
                    onclick="parent.location='includes/curso/VideoSiguiente.php?id=<?php echo $id; ?>&c_modulo=<?php echo $cont_modulo;?>&c_tema=<?php echo ($cont_tema+1);?>&idmodulo=<?php echo $dato['idModulo']?>'">
                    Siguiente <strong> > </strong></button>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</div>

<div class="containervid">

    <div class="contvid" style="width: 500px; height: 270px; padding: 10px;">
        <?php 
              $url=$dato2['link_video'];
              function getYoutubeEmbedUrl($url){

                $urlParts   = explode('/', $url);
                $vidid      = explode( '&', str_replace('watch?v=', '', end($urlParts) ) );
            
                return 'https://www.youtube.com/embed/' . $vidid[0] ;
            }
              $link = getYoutubeEmbedUrl($dato2['link_video']);
              
              ?>
        <iframe width="100%" height="100%" src="<?php echo $link;?>" title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
        </iframe>
    </div>
</div>

<br>



<?php    
    }
    else{
    
   ?>




<?php 
    
    $id=$_GET['id'];
    $idtema=$_GET['idtema'];

    $pdo = Database::connect(); 
    $sql = "SELECT * FROM modulo WHERE id_curso='$id'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $dato = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    $pdo2 = Database::connect(); 
    $sql2 = "SELECT * FROM tema WHERE idTema='$idtema'";
    $q2 = $pdo2->prepare($sql2);
    $q2->execute(array());
    $dato2 = $q2->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    $pdo6 = Database::connect(); 
    $sql6 = "SELECT * FROM cursos WHERE idCurso='$id'";
    $q6 = $pdo6->prepare($sql6);
    $q6->execute(array());
    $dato6 = $q6->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
?>

<div class="container" style="margin-top: 120px;">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="infoMin">
                <a href=""><?php echo $dato6['nombreCurso'];?></a> <label> > </label> <a
                    href=""><?php echo $dato['nombreModulo'];?> </a><label> >
                </label><a href=""><?php echo $dato2['nombreTema'];?></a>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>
<br>
<div>
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <button type="button" class="btn btn-outline-secondary" id="btnV"
                    onclick="parent.location='Cursoiniciar.php?id=<?php echo $_GET['id']?>'"> <strong>
                        < </strong> Anterior</button>
                <button type="button" class="btn btn-outline-secondary" id="btnV2"> <img
                        src="././assets/images/video_icono_32.png"></button>
                <button type="button" class="btn btn-outline-secondary" id="btnV"
                    onclick="parent.location='includes/curso/VideoSiguiente.php?id=<?php echo $id; ?>&idtema=<?php echo $idtema; ?>'">
                    Siguiente <strong> > </strong></button>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</div>

<div class="containervid">

    <div class="contvid" style="width: 500px; height: 270px; padding: 10px;">
        <?php 
              $url=$dato2['link_video'];
              function getYoutubeEmbedUrl($url){

                $urlParts   = explode('/', $url);
                $vidid      = explode( '&', str_replace('watch?v=', '', end($urlParts) ) );
            
                return 'https://www.youtube.com/embed/' . $vidid[0] ;
            }
              $link = getYoutubeEmbedUrl($dato2['link_video']);
              
              ?>
        <iframe width="100%" height="100%" src="<?php echo $link;?>" title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
        </iframe>
    </div>
</div>

<br>
<?php }?>
<?php
    }
    else{
                header('Location:iniciosesion.php');
    }
?>