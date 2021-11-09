<head>
    <link rel="stylesheet" href="././assets/css/stymiscursos.css">
</head>
<body>
<br>
<div class="title_miscursos">
    <h3>Mis Cursos</h2>
</div>

<br><br>
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

                    echo '
                <div class="blog-post-cursos">
                <div class="blog-post_img_cursos">
                    <img src="data:image/*;base64,'.base64_encode($dato3['imagenDestacadaCurso']).'" alt="foto_curso" >
                </div>
        
                <div class="blog-post_info" >
                    <h1 class="blog-post_title">'.$dato3['nombreCurso'].'</h1>
                    <p class="blog-posrt_text">
                            '.$dato3['descripcionCurso'].'
                    </p>
                    
                    <a href="curso.php?id='.$cursoID.'" class="blog-post_cta_cursos">Ver ahora</a>
                </div>
                </div>
            </div>
            </div>

            <br>
            <br>
            ';

                }

            }
        

            Database::disconnect();
            
    ?>


<br>
<br>
</body>