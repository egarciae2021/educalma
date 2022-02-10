<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORO</title>
    <!-- Stylesheet -->
    <link rel="stylesheet" href="assets/css/styleforo.css">
    <!-- Fuente -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/882c415911.js" crossorigin="anonymous"></script>
</head>

<!-- Hola mundo -->
<div style="margin-top:100px;" class="container abs-center">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="btn btn-light btn-sm" href="curso.php" role="button">Curso</a>
                <a class="btn btn-light btn-sm" href="foro.php">Foro</a>
                <!-- <a class="btn btn-light btn-sm" href="descargas.php">Descargables</a>
                <a class="btn btn-light btn-sm" href="progreso.php">Progreso</a> -->
            </div>
        </div>
    </nav>
</div>


<body>
<?php
 if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
?>
    <?php
    
    require_once '././database/databaseConection.php';

    $idCurso = $_GET['id'];

    $pdo = Database::connect();
    $sql = "SELECT * FROM comentarioforo as c inner join usuarios as a on a.id_user = c.iduser WHERE idcurso = '$idCurso'";
    $stm = $pdo->prepare($sql);
    $stm->execute(array());

    //ID DEL PROFESOR
    $pdo5 = Database::connect();
    $sql5 = "SELECT * FROM cursos WHERE idCurso = '$idCurso'";
    $stm5 = $pdo->prepare($sql5);
    $stm5->execute(array());
    $dato = $stm5->fetch(PDO::FETCH_ASSOC);
    $idProfe = $dato['id_userprofesor'];
    ?>
    <!-- Contenedor Principal -->
    <div class="comments-container">
        <h1>Foro Educalma <?php echo $_SESSION['iduser']?></h1>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Comentar</button>

        <?php
            if($_SESSION['privilegio']==1 || $_SESSION['privilegio']==2){
                echo '
                    <button type="button" class="btn btn-danger" onClick="AlertEliminaTodo(<?php echo $idCurso;?>)">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                ';
            }
        ?>
        
        <ul id="comments-list" class="comments-list">
            <li>
                <?php
                $autor = "";
                while ($registro =  $stm->fetch(PDO::FETCH_ASSOC)) {
                    if($registro['iduser']==$idProfe){
                        $autor = " by-author";
                        
                    }else{
                        $autor = "";
                    }
                ?>
                <div class="comment-main-level">
                    <!-- Avatar -->
                    <div class="comment-avatar">

                        <?php    
                            if($registro['mifoto']!=null){
                        ?>
                                <img src="data:image/*;base64,<?php echo base64_encode($registro['mifoto']);?>" alt="foto_curso"
                            style="width: 60px;height:60px;">
                        <?php
                            }else{
                        ?>
                                <img src="./assets/images/user.png" alt="foto_curso" style="width: 60px;height:60px;">
                        <?php
                            }
                        ?> 
                    </div>
                    <!-- Contenedor del Comentario -->
                    <div class="comment-box">
                        <div class="comment-head">
                            <h6 class="comment-name<?php echo $autor; ?>">
                                <spam><?php echo $registro['nombreUser']; ?></spam>
                            </h6>
                            <span><?php echo $registro['fecha_ingreso']; ?></span>
                            <button type="button" id="modal" class="btn btn-light btn-sm ml-3" data-toggle="modal"
                                data-target="#respuesta<?php echo $registro['idcomentario'] ?>"
                                data-id="<?php echo '5' ?>">Responder</button>
                            <?php
                            if($_SESSION['privilegio']==1 || $_SESSION['iduser']==$idProfe || $registro['iduser']==$_SESSION['iduser']){
                                echo '
                                    <button type="submit" class="btn btn-danger" onClick="AlertEliminacion('.$registro['idcomentario'].')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                ';
                            }
                            ?>
                            <i style="color:white;" class="fa fa-reply"></i>
                            <i style="color:white;" class="fa fa-heart"></i>
                        </div>
                        <div class="comment-content">
                            <?php echo $registro['comentario']; ?>
                        </div>
                    </div>
                </div>
                <!-- Respuestas de los comentarios -->
                <?php
                        $pdo2 = Database::connect();
                        $sql2 = "SELECT * FROM sub_come_foro as s inner join usuarios as u on u.id_user= s.iduser WHERE idcomentario = '$registro[idcomentario]'";
                        $stm2 = $pdo2->prepare($sql2);
                        $stm2->execute(array());

                        $autor = "";
                    while($registro2 =  $stm2->fetch(PDO::FETCH_ASSOC)){
                     
                        if($registro2['iduser']==$idProfe){
                            $autor = " by-author";
                        }else{
                            $autor = "";
                        }
                    ?>
                <ul class="comments-list reply-list">
                    <li>
                        <!-- Avatar -->
                        <div class="comment-avatar">
                            
                            <?php    
                                if($registro2['mifoto']!=null){
                            ?>
                                    <img src="data:image/*;base64,<?php echo base64_encode($registro2['mifoto']);?>"
                                        alt="foto_curso" style="width: 43px;height:43px;">
                            <?php
                                }else{
                            ?>
                                    <img src="./assets/images/user.png" alt="foto_curso" style="width: 43px;height:43px;">
                            <?php
                                }
                            ?> 
                        
                        </div>
                        <!-- Contenedor del Comentario -->
                        <div class="comment-box">
                            <div class="comment-head">
                                <h6 class="comment-name<?php echo $autor; ?>"><a
                                        href="#"><?php echo $registro2['user_men'];?></a></h6>
                                <span><?php echo $registro2['fecha_ingreso']; ?></span>
                                <?php
                                    if($_SESSION['privilegio']==1 || $_SESSION['iduser']==$idProfe || $registro2['iduser']==$_SESSION['iduser']){
                                
                                    echo '
                                        <button type="submit" class="btn btn-danger" onClick="AlertElimiSubComen('.$registro2['idsubcomentario'].')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    ';
                                    }
                                ?>
                                <i style="color:white;" class="fa fa-reply"></i>
                                <i style="color:white;" class="fa fa-heart"></i>
                            </div>
                            <div class="comment-content">
                                <?php echo $registro2['subcomentario'];?>
                            </div>
                        </div>
                    </li>
                </ul>
                <?php 
                }
                ?>
                <!------------------------------------
                        modal para ingresar respuesta
                -------------------------------------->
                <!-- Modal -->
                <div class="modal fade" id="respuesta<?php echo $registro['idcomentario'] ?>" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">:: RESPUESTA ::</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="includes/foroCrud/foroMen.php" method="post">
                                    <div class="form-group">
                                        <label for="mensaje">Responder</label>
                                        <textarea class="form-control" id="mensaje" name="submensaje" rows="3"
                                            required></textarea>
                                        <input type="hidden" name="id_comenta"
                                            value="<?php echo $registro['idcomentario']?>">
                                        <input type="hidden" name="id" value="<?php echo $idCurso?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-secondary">Enviar Respuesta</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </li>
        </ul>
    </div>
    <!------------------------------------
        modal para ingresar mensaje
    -------------------------------------->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">:: FORO ::</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="includes/foroCrud/foroMen.php" method="post">
                        <div class="form-group">
                            <label for="mensaje">Realiza un Comentario</label>
                            <textarea class="form-control" id="mensaje" name="mensaje" rows="3" required></textarea>
                            <input type="hidden" name="id" value="<?php echo  $idCurso; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-secondary">Enviar Mensaje</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    else{
                header('Location:iniciosesion.php');
    }
?>
</body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="assets/js/plugins/eliminarforo.js"></script>

</html>