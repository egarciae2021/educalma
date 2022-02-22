<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Cursos</title>
    <link rel="stylesheet" href="././assets/css/stymiscursos.css">
</head>
<body>


<div class="container">
    <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="titlemc">
            <h1>Mis Cursos</h1>
        </div>
    </div>
    <div class="col-md-1"></div>
    </div>
</div>

<br><br>
<br><br>
<Br>

<div class="container">

    <?php 
            error_reporting(0);
            require_once '././database/databaseConection.php';
            $pdo = Database::connect();
            $userID = $_SESSION['codUsuario'];

            $sql = "SELECT * FROM cursoinscrito where usuario_id='$userID' ORDER BY curso_id DESC";
            $q = $pdo->prepare($sql);
            $q->execute(array());
            $dato=$q->fetch(PDO::FETCH_ASSOC);


            if(empty($dato)){
           
               
            }else{
               
                $pdo = Database::connect();
                $sql = "SELECT * FROM cursoinscrito where usuario_id='$userID' ORDER BY curso_id DESC";
                $q = $pdo->prepare($sql);
                $q->execute(array());

                while($dato2=$q->fetch(PDO::FETCH_ASSOC)){
                    $cursoID = $dato2['curso_id'];
                   
                    $pdo3 = Database::connect();
                    $sql3 = "SELECT * FROM cursos where idCurso='$cursoID'";
                    $q3 = $pdo3->prepare($sql3);
                    $q3->execute(array());
                    $dato3=$q3->fetch(PDO::FETCH_ASSOC);    

                    

                        if($dato3['imagenDestacadaCurso']!=null){
                        
                            echo '
                            <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">

                                <div class="blog-post">
                                <div class="blog-post_img">
                                    <img src="data:image/*;base64,'.base64_encode($dato3['imagenDestacadaCurso']).'" alt="foto_curso">
                                </div>
                        
                                <div class="blog-post_info" >
                                    <h1 class="blog-post_title">'.$dato3['nombreCurso'].'</h1>
                                    <p class="blog-posrt_text">
                                            '.$dato3['descripcionCurso'].'
                                    </p>
                                    
                                    <a href="curso.php?id='.$cursoID.'" class="blog-post_cta">Ver ahora</a>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            </div>

                            <br>
                            <br>
                            ';
                    
                        }else{

                            echo '
                            <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">

                                <div class="blog-post">
                                <div class="blog-post_img">
                                <img src="./assets/images/curso_educalma.png" alt="foto_curso" >
                                </div>
                        
                                <div class="blog-post_info" >
                                    <h1 class="blog-post_title">'.$dato3['nombreCurso'].'</h1>
                                    <p class="blog-posrt_text">
                                            '.$dato3['descripcionCurso'].'
                                    </p>
                                    
                                    <a href="curso.php?id='.$cursoID.'" class="blog-post_cta">Ver ahora</a>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            </div>

                            <br>
                            <br>
                            ';
                    
                        }

                }

            }
        

            Database::disconnect();
            
    ?>

</div>

<br>
<br>

</body>
</html>