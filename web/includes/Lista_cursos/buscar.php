<?php
require_once '../../database/databaseConection.php';
?>
<div class="container-fluid px-0" id="result">
    <?php
    function buscar()
    {
    ?>

        <div class="container-card-course">
            <div class="row pt-1 container d-flex justify-content-center" style="margin: 0 auto;">
                <?php
                $pdo2 = Database::connect();
                $busqueda = $_POST['buscar'];
                $sql = "SELECT * FROM cursos WHERE estado=1 AND permisoCurso=1 AND nombreCurso LIKE '%" . $busqueda . "%'";
                $q = $pdo2->query($sql);
                $q->execute(array());
                $contar = $q->rowCount();

                if ($contar == 0) {
                    echo '
                    <h5>No se encontraron coincidencias con "' . $busqueda . '" ➜ Resultados (' . $contar . ')</h5></div>';
                }
                if ($dato = $q->fetch(PDO::FETCH_ASSOC)) {
                    error_reporting(0);
                    $query3 = $pdo2->prepare($sql);
                    $query3->execute();
                    Database::disconnect();
                    while ($dato = $query3->fetch(PDO::FETCH_ASSOC)) {
                        if (isset($_SESSION['codUsuario'])) {
                            $cursoID = $dato['idCurso'];
                            $userID = $_SESSION['codUsuario'];
                            $sql4 = "SELECT * FROM cursoinscrito where curso_id='$cursoID' and usuario_id = '$userID' ";
                            $query4 = $pdo2->prepare($sql4);
                            $query4->execute(array());
                            $dato2 = $query4->fetch(PDO::FETCH_ASSOC);
                            if (empty($dato2)) {
                                $paginaRed = "detallecurso";
                            } else {
                                $paginaRed = "curso";
                            }
                        } else {
                            $paginaRed = "detallecurso";
                        }
                ?>
                        <!--Contenedor del curso publicado-->
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                            <div style="border-radius: 30px;" class="card">

                                <!--Contenedor de la imagen-->
                                <div style="border-radius: 30px 30px 0 0;" class="container-card-image">
                                    <?php    
                                        if($dato['imagenDestacadaCurso']!=null){
                                    ?>
                                            <!--Imagen elegida-->
                                            <img heigth="10px" ; src="data:image/*;base64,<?php echo base64_encode($dato['imagenDestacadaCurso']); ?>" alt="">
                                    <?php
                                        }else{
                                    ?>
                                            <!--Imagen por default-->
                                            <img heigth="10px" ;  src="./assets/images/curso_educalma.png">
                                    <?php
                                        }
                                    ?> 
                                    
                                </div>

                                <!--Contenedor del nombre del curso publicado-->
                                <div class="container-card-title" style="padding-bottom: 1px; color: black;">
                                    <a style="float: left;">
                                        <!--Nombre-->
                                        <center><strong><?php echo $dato['nombreCurso']; ?></strong> </center>
                                    </a>
                                </div>



                                <!--Falta arreglar este problema, pues no quiere mostrar el autor del curso en el buscador.-->
                                <!--Contenedor del nombre del profesor del curso publicado más destacado-->
                                <div class="container-card-description" style="margin-top: 1px; padding-top: 1px; font-size: 11px;">

                                    <!--Código para obtener el nombre del profesor-->
                                    <?php
                                        /* 
                                        $idUsuario = $dato['id_userprofesor'];
                                        $sql = "SELECT * FROM usuarios WHERE id_user = '$idUsuario'";
                                        $q = $pdo->prepare($sql);
                                        $q->execute(array());
                                        $dato5 = $q->fetch(PDO::FETCH_ASSOC);
                                        */
                                    ?>

                                    <a>

                                        <?php 
                                            //if($dato5['privilegio']==1){
                                        ?>

                                                <span style="color: #565656;">Creado por la Fundación CALMA.</span>

                                        <?php 
                                            //}

                                            //if($dato5['privilegio']==2){
                                        ?>
                                               <!-- <span style="color: #565656;">Creado por <?php echo " " . $dato5['nombres'] . " " . $dato5['apellido_pat'] . " " . $dato5['apellido_mat'] . "."?></span> -->
                                        <?php 
                                            //}
                                        ?>
                                    </a>
                                </div>




                         


                                
































                                <!--Falta arreglar este problema, pues no quiere mostrar la palabra comprado.-->
                                <!--Contenedor de la descripción del curso-->
                                <div class="container-card-description" style="padding-bottom: 1px; margin-bottom: 1px; font-size: 13px; position: relative;">
                                    <!--Descripción-->
                                    <p><?php echo substr($dato['descripcionCurso'], 0, 50) . "..."; ?></p>
                                </div>



                                <!--Contenedor del costo del curso, mensaje si se compró o no el curso y del link "Leer Más".-->
                                <div class="container-card-description" style="padding-top: 1px; margin-top: 1px; font-weight: bold; font-size: 15px; color: black; position: relative;">
                                    
                                    <?php if($dato2['id_cursoInscrito'] == NULL){ ?>
                    
                                        <p>
                                            <?php
                                                if($dato['costoCurso']!=0 && $dato['costoCurso'] != "Gratis"){
                                                    echo 'S/ ' . $dato['costoCurso'];
                                                }else{
                                                    echo 'Gratis';
                                                }
                                            ?>
                                        </p>
                    
                                    <?php }else{ ?>
                    
                                        <p>
                                            <?php
                                                if($dato['costoCurso']!=0 && $dato['costoCurso'] != "Gratis"){
                                                    echo 'S/ ' . $dato['costoCurso'],"","<span style='position: relative; left: 100px; color: #63F70E;'>Comprado</span>";
                                                }else{
                                                    echo 'Gratis',"","<span style='margin-left: 110px; color: #63F70E;'>Comprado</span>";
                                                }
                                            ?>
                                        </p>
                                        <!--<p>S/.<?php echo $dato['costoCurso'],"","<span style='position: relative; left: 100px; color: #63F70E;'>Comprado</span>" ?></p>-->
                    
                                    <?php } ?>
        
                                    <!-- Link "Leer Más"-->
                                    <div class="container-card-link" style="margin: auto;">
        
                                    <a href="<?php echo $paginaRed ?>.php?id=<?php echo $dato['idCurso']; ?><?php if(!empty($dato2)){?>&idCI=<?php echo $dato2['id_cursoInscrito']; }?>">
                                        <center><strong>Leer Más</strong> </center>
                                    </a>
        
                                    </div>
                    
                                </div>



                            </div>
                        </div>

                <?php
                    }
                }
                Database::disconnect();
                ?>
            </div>
        </div>
</div>
</div>
</div>
<?php
    }
    buscar();
