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
    
    
     
    if(isset($_GET['nW']))
    { $nW=$_GET['nW']; }
    else{
    $nW=0;}

    // ID del curso Iniscrito
    if(isset($_GET['idCI'])){ 
        $idCI=$_GET['idCI'];}
    else{
        $idCI=0;}


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
                ?>
                </h2>
                <button type="button" <?php if ($access=="d") {
                    echo "disabled";
                }?>  class="btn btn-outline-secondary" id="btnV"
                    onclick="parent.location='includes/curso/VideoSiguiente.php?id=<?php echo $id; ?>&nW=<?php echo $_GET['nW']?>&idtema=<?php echo ($idtema-1)?>&id_modulo=<?php echo $dato['idModulo']?>&idCI=<?php echo $idCI?>'"> <strong> < </strong> Anterior</button>
                <button type="button" class="btn btn-outline-secondary" id="btnV2"> 
                    <?php echo $dato2['nombreTema'];?>
                    <img src="././assets/images/video_icono_32.png"></button>
                <button type="button"<?php if ($access=="d") {
                    echo "disabled";
                }?> class="btn btn-outline-secondary" id="btnV"
                    onclick="parent.location='includes/curso/VideoSiguiente.php?id=<?php echo $id; ?>&validar=1&c_modulo=<?php echo $cont_modulo;?>&c_tema=<?php echo ($cont_tema+1);?>&idmodulo=<?php echo $dato['idModulo']?>&nW=<?php echo $_GET['nW']?>&idCI=<?php echo $idCI?>'">
                    Siguiente <strong> > </strong></button>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</div>

<div class="containervid">

    <div class="contvid" style="max-width: 500px; min-width:350px; height: 270px; padding: 10px; ">
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
    $pdo = Database::connect(); 
    $sql = "SELECT * FROM modulo WHERE id_curso='$id'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $dato = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
    $d=$dato['idModulo'];
    $pdod = Database::connect(); 
    
    $sqli="SELECT c.idModulo,p.idTema,l.idCurso FROM tema p INNER JOIN modulo c ON c.idModulo=p.id_modulo INNER JOIN cursos l ON idCurso= c.id_curso WHERE c.idModulo='$_GET[id_modulo]' AND l.idCurso='$id'";
    $qs = $pdod->prepare($sqli);
    $qs->execute(array());
    // echo "<br>";
    $resultado1=$qs->fetchAll();
    // echo $resultado1[1]['idTema'];
    // $idtema=$_GET['idtema'];
    $nueva=$_GET['idtema'];
    $idtema=$resultado1[intval($_GET['idtema'])-1]['idTema'];
    // echo $idtema;
    



    $pdo2 = Database::connect(); 
    $sql2 = "SELECT * FROM tema WHERE idTema='$idtema'";
    $q2 = $pdo2->prepare($sql2);
    $q2->execute(array());
    $dato2 = $q2->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    $idModu12= $dato2['id_modulo'];

    $pdo6 = Database::connect(); 
    $sql6 = "SELECT * FROM cursos WHERE idCurso='$id'";
    $q6 = $pdo6->prepare($sql6);
    $q6->execute(array());
    $dato6 = $q6->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    $pdo13=Database::connect();
    $sql13="SELECT * FROM modulo WHERE idModulo='$idModu12'";
    $q13=$pdo13->prepare($sql13);
    $q13->execute(array());
    $dato13=$q13->fetch(PDO::FETCH_ASSOC);
?>

<div class="container" style="margin-top: 120px;">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="infoMin">
                <a href=""><?php echo $dato6['nombreCurso'];?></a> <label> > </label> <a
                    href=""><?php echo $dato13['nombreModulo'];?> </a><label> >
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
                <?php $d=$dato['idModulo'];
                $pd8 = Database::connect();
                $im=$_GET['id_modulo'];
                $sq="SELECT * FROM cuestionario where id_modulo=$im";
                $qy = $pd8->prepare($sq);
                $qy->execute();
                $dato8 = $qy->fetch(PDO::FETCH_ASSOC);
                ?>
                <br>
                <!-- Aquí están los botones "Anterior" y "Siguiente" -->
                <button type="button" class="btn btn-outline-secondary" id="btnV"<?php if($nueva<=1){ echo "disabled";}?>
                onclick="parent.location='video.php?id=<?php echo $id; ?>&idtema=<?php echo ($nueva-1); ?>&id_modulo=<?php echo $dato['idModulo']?>&nW=<?php echo $nW?>&idCI=<?php echo $idCI?>'"> <strong>
                <?php if(count($resultado1)<=0){echo "No existo";}?>< </strong> 
                    Anterior 
                </button>

                <button type="button" class="btn btn-outline-secondary" id="btnV2"> 
                    <img src="././assets/images/video_icono_32.png">
                </button>

                <!-- Botón Siguiente 2 -->
                <button type="button" class="botonSiguiente_2 btn btn-outline-secondary" id="btnV">
                    Siguiente<strong> > </strong>
                </button> 

                <!-- Botón Siguiente -->
                <button type="button" class="botonSiguiente btn btn-outline-secondary" id="btnV" <?php if($nueva>=count($resultado1)){?>onclick="parent.location='cuestionario.php?id=<?php echo $id;?>&nW=<?php echo $nW;?>&idModulo=<?php echo $_GET['id_modulo'];?>&up=0&idcues=<?php echo $dato8['idCuestionario'];?>&idCI=<?php echo $idCI?>&cuen=1&nro=0'" hidden multiple>
                    Siguiente<strong> > </strong>
                </button> 
                
                <?php }else{ ?>
                    
                    onclick="parent.location='video.php?id=<?php echo $id; ?>&nW=<?php echo $_GET['nW']?>&idtema=<?php echo ($nueva+1); ?>&id_modulo=<?php echo $_GET['id_modulo']?>&idCI=<?php echo $idCI?>'">Siguiente<strong> > </strong></button>
                    
                    <?php }
                    $si=$dato8['idCuestionario'];
                    $_SESSION['idcue']=$si;
                    //ponlo ente id y idtema  &validar=1&c_modulo=<?php echo $cont_modulo;?><!-- &c_tema=<?php //echo ($cont_tema+1);?> -->
                
                <!-- -->
                            

                            <script>

                                $('.botonSiguiente_2').click(function(){

                                    Swal.fire({

                                        title: "• Se validará tu conocimiento del módulo mediante un cuestionario.<br><br>• Tiene solo 3 intentos para realizarlo. <br><br> • Después de 3 intentos, podrá continuar respondiendo el cuestionario, pero su calificación ya no será válida. <br><br> • Preste mucha atención al video del módulo antes de responder el cuestionario.",  
                                        
                                        confirmButtonText: "Ir al cuestionario",
                                        
                                        showCancelButton: true,
                                        cancelButtonColor: 'red',
                                        cancelButtonText: "Cancelar",
                                    
                                    }).then(resultado => {
        
                                        if (resultado.value) {

                                            $('.botonSiguiente').trigger('click');
            
                                        } else {
            
                                        }
    
                                    });
                                  
                                });
    
                            </script>
 

                            
                    
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