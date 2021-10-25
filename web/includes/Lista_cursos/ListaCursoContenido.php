<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nosotros</title>
    <link rel="stylesheet" href="././assets/css/styleban.css">
</head>

<body>

    <?php
    require_once 'database/databaseConection.php';
    $pdo = Database::connect();

    $sql = "SELECT * FROM categorias ";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    Database::disconnect();
    ?>

    <!-- Contenido -->

    <div class="section layout_padding">
        <div class="container">
      
            <br>

            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <!--NOMBRE DE LA CATEGORIA-->
                    <?php
                    
                    if (isset($_GET['idcate'])){
                        $pdo7 = Database::connect();
                        $idcatee = $_GET['idcate'];
                        $sql7 = "SELECT * FROM categorias where idCategoria='$idcatee'";
                        $q7 = $pdo7->prepare($sql7);
                        $q7->execute(array());
                        $datoAdicional = $q7->fetch(PDO::FETCH_ASSOC);
                        $msg = ": Categoria ".$datoAdicional['nombreCategoria']."";
                    }else{
                        $msg = "";

                    }
                   
                    
                    ?>
                <h1 style="color: #4F52D6; font-size:35px;font-weight: bold;"> Cursos<span style="color: #7C83FD; font-size:25px;"><?php echo $msg; ?></span></h1>
                    <div class="card-deck">
                        
                        <!--recorre los cursos-->
                        <?php
                        
                        error_reporting(0);
                        $pdo2 = Database::connect();

                        if (isset($_GET['idcate'])){
                            $idcate=$_GET['idcate'];
                            $sql2 = "SELECT * FROM cursos WHERE categoriaCurso='$idcate'";
                        }else{
                            $sql2 = "SELECT * FROM cursos ";
                        }
                       
                        $q2 = $pdo2->prepare($sql2);
                        $q2->execute(array());
                        
                        ?>
                        <?php

                        $contx = 0;
                        while ($dato2 = $q2->fetch(PDO::FETCH_ASSOC)) {
                            $contx = $contx + 1;

                            //ALGORITMO CURSO INSCRITO Y NO INSCRITO
                            if (isset($_SESSION['codUsuario'])) {
                                $pdo5 = Database::connect();

                                $cursoID = $dato2['idCurso'];
                                $userID = $_SESSION['codUsuario'];

                                $sql5 = "SELECT * FROM cursoinscrito where curso_id='$cursoID' and usuario_id = '$userID'";
                                $q5 = $pdo5->prepare($sql5);
                                $q5->execute(array());
                                $dato5 = $q5->fetch(PDO::FETCH_ASSOC);

                                if (empty($dato5)) {
                                    $paginaRed = "detallecurso";
                                } else {
                                    $paginaRed = "curso";
                                }
                            } else {
                                $paginaRed = "detallecurso";
                            }

                        ?>
                            <div class="col-lg-3 col-md-5 col-sm-6 col-12">

                                <?php echo '<img src="data:image/*;base64,' . base64_encode($dato2['imagenDestacadaCurso']) . '"
                                class="card-img-top imgd roundedimg img-responsive" alt="190" style=" height:180px; ">'; ?>
                                <div class="card-body">
                                    <label class="card-text" style="font-size:15px; color: #4F52D6"><strong><?php echo $dato2['nombreCurso']; ?></strong></label>
                                    <label class="card-text" style="font-size:14px;"><?php echo $dato2['descripcionCurso']; ?></label>
                                    <div class="ins">
                                        <a href="<?php echo $paginaRed ?>.php?id=<?php echo $dato2['idCurso']; ?>"><button type="button" style="width: 80%; height: 40px; font-size:13px;" class="roundedpill w165 mdl2 btn btn-lg btn-block btn-outline-primary">Empezar Curso</button></a>
                                    </div>
                                </div>

                            </div>
                        <?php
                        }
                        Database::disconnect();

                        ?>

                    </div>
                    <nav aria-label="Page navigation calma" class="pdt50">

                        <ul class="pagination justify-content-end">
                            <a style="font-size: 16px; color: #4F52D6; cursor: pointer; " href='#prese'><img src="./assets/images/Up_icon_16.png"> Back to Top</a>
                            <label>⠀⠀⠀⠀</label>
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Página</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Siguiente</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-1"></div>

            </div>
        </div>

        <br>
        <br>

        <br>
        <br>
        <!-- Fila 4 -->
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="card-deck">

                        <div class="col-lg-3 col-md-5 col-sm-6 col-12"></div>


                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>

    <!-- End Contenido -->
</body>

</html>