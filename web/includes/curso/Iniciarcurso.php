<?php 
        require_once '././database/databaseConection.php';
        $validacion=1;
        $id=$_GET['id'];

        $pdo1 = Database::connect(); 
        $sql1 = "SELECT * FROM cursos WHERE idCurso='$id'";
        $q1 = $pdo1->prepare($sql1);
        $q1->execute(array());
        $dato1 = $q1->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    ?>
<link rel="stylesheet" href="assets/css/style.css">

<div class="section layout_padding">
    <div class="container">
        <div class="row" style="height: 100px;">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="full">
                    <div class="heading_main text_align_start pdt50">
                        <h2><span style="color: #4F52D6;"><?php echo $dato1['nombreCurso'];?></span></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <hr class="lineahori">
        <div class="row" >
        <div class="col-md-1"></div>
        <div class="col-md-10">
        <div class="contbox">
            <h1>Introducción</h1>
            <p> <?php echo $dato1['introduccion']; ?></p>
        </div>
        </div>
        <div class="col-md-1"></div>
        </div>
    </div>
    <?php 
        $pdo2 = Database::connect(); 
        $sql2 = "SELECT * FROM modulo WHERE id_curso='$id'";
        $q2 = $pdo2->prepare($sql2);
        $q2->execute(array());
        $dato2 = $q2->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        $pdo3 = Database::connect(); 
        $sql3 = "SELECT * FROM tema WHERE id_modulo='$dato2[idModulo]'";
        $q3 = $pdo3->prepare($sql3);
        $q3->execute(array());
        $dato3 = $q3->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    ?>
    <br>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="buttonfaq">
                <a href="video.php?id=<?php echo $id;?>&idtema=<?php echo $dato3['idTema'];?>&validar=<?php echo $validacion;?>">Siguiente</a>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>

    <!-- start FAQ -->
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="conttitu">
                    <h1>Modulos del Curso</h1>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>


        <?php 

            $pdo4 = Database::connect(); 
            $sql4 = "SELECT * FROM modulo WHERE id_curso='$id'";
            $q4 = $pdo4->prepare($sql4);
            $q4->execute(array());
            Database::disconnect();
        
            
        ?>
        <?php while($dato4=$q4->fetch(PDO::FETCH_ASSOC)){ ?>
        <hr class="lineahori">
        <div class="row">

            <div class="col-md-1"></div>

            <div class="col-md-10">

                <div class="accordion_outer">
                    <div class="container">
                        <details>
                            <summary><?php echo $dato4['nombreModulo'];?></summary>
                            <?php 
                                $pdo5 = Database::connect(); 
                                $sql5 = "SELECT * FROM tema WHERE id_modulo='$dato4[idModulo]'";
                                $q5 = $pdo5->prepare($sql5);
                                $q5->execute(array());
                                Database::disconnect();
                                while($dato5=$q5->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            
                            <a href="video.php?id=<?php echo $id;?>&idtema=<?php echo $dato5['idTema'];?>">
                                <div style=" padding: 5px 20px;"><?php echo $dato5['nombreTema'];?></div>
                            </a>
                            <?php }?>
                            <a href="cuestionario.php?id=<?php echo $id;?>&idModulo=<?php echo $dato4['idModulo'];?>">
                                <div style=" padding: 5px 30px;">Cuestionario</div>
                            </a>
                        </details>
                    </div>
                </div>

            </div>

            <div class="col-md-1"></div>

        </div>
        <?php }?>
        <hr class="lineahori">


    </div>
    <br>
    <br>