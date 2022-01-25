<?php
// Este codigo hace validacion para que no se pueda acceder a cualquier pagina sin estar logueado__Pablo Loyola
ob_start();
@session_start();
 if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
?>
<!--========== CONTENTS ==========-->
<main>
    <section class="about" id="about">
        <div class="image col">
            <img src="./assets/images/about-img.png" alt="">
        </div>

        <div class="content col">
            <span>Tu tablero</span>
            <h3 class="title">El secreto real del éxito es el entusiasmo !</h3>

            <div class="icons-container">
                <a class="icons" id="open-modal">
                    <img src="./assets/images/serv-3.png" alt="">
                    <h3>Tus ultimos cursos</h3>
                </a>

                <a class="icons" id="open-modal1">
                    <img src="./assets/images/serv-3.png" alt="">
                    <h3>Cursos completados</h3>
                </a>
                <a class="icons" id="open-modal2">
                    <img src="./assets/images/serv-3.png" alt="">
                    <h3>Cursos inscritos</h3>
                </a>
                <a class="icons" id="open-modal3">
                    <img src="./assets/images/serv-3.png" alt="">
                    <h3>Tus profesores</h3>
                </a>
            </div>
        </div>
    </section>
</main>


<!--========== COURSE ==========-->
<section class="modal container">
    <div class="modal__container" id="modal-container">
        <div class="modal__content">
            <div class="modal__close close-modal" title="Close">
                <i class="fas fa-times"></i>
            </div>
            <img src="./assets/images/img1.png" alt="" class="modal__img">
            <h1 class="modal__title">3 Últimos Cursos Inscritos!</h1>
            <?php
            $contar = 0;
            while ($dato1 = $q1->fetch(PDO::FETCH_ASSOC)) {
                $contar = $contar + 1;
                if ($contar <= 3) {
                    $pdo3 = Database::connect();
                    $veri3 = "SELECT * FROM cursos WHERE idCurso = '$dato1[curso_id]' ";
                    $q3 = $pdo3->prepare($veri3);
                    $q3->execute(array());
                    Database::disconnect();
                    while ($dato3 = $q3->fetch(PDO::FETCH_ASSOC)) {
            ?>
                        <p class="modal__description"><a href=""><?php echo $dato3['nombreCurso']; ?></a></p>
            <?php
                    }
                }
            }
            ?>
            <button class="modal__button-link close-modal">
                Close
            </button>
        </div>
    </div>

    <!-- MODAL 2 -->
    <div class="modal__container1" id="modal-container1">
        <div class="modal__content1">
            <div class="modal__close close-modal1" title="Close1">
                <i class="fas fa-times"></i>
            </div>
            <img src="./assets/images/img1.png" alt="" class="modal__img">
            <h1 class="modal__title"><?php echo $cuenta9; ?> Cursos Completados!</h1>
            <button class="modal__button-link close-modal1">
                Close
            </button>
        </div>
    </div>

    <!-- MODAL 3 -->
    <div class="modal__container2" id="modal-container2">
        <div class="modal__content2">
            <div class="modal__close close-modal2" title="Close2">
                <i class="fas fa-times"></i>
            </div>
            <img src="./assets/images/img1.png" alt="" class="modal__img">
            <h1 class="modal__title"><?php echo $cuenta4; ?> Cursos Inscritos!</h1>
            <button class="modal__button-link close-modal2">
                Close
            </button>
        </div>
    </div>

    <!-- MODAL 4 -->
    <div class="modal__container3" id="modal-container3">
        <div class="modal__content3">
            <div class="modal__close close-modal3" title="Close3">
                <i class="fas fa-times"></i>
            </div>
            <img src="./assets/images/img3.png" alt="" class="modal__img">
            <h1 class="modal__title">Tus profesores!</h1>
            <table>
                <tbody>
                    <!--Profesores-->
                    <?php
                    $pdo10 = Database::connect();
                    $veri10 = "SELECT * FROM cursoinscrito WHERE usuario_id = '$id' ";
                    $q10 = $pdo10->prepare($veri10);
                    $q10->execute(array());
                    $IDPROFE = array();
                    $existe = 0;
                    while ($dato10 = $q10->fetch(PDO::FETCH_ASSOC)) {
                        $idCur = $dato10['curso_id'];
                        $pdo11 = Database::connect();
                        $veri11 = "SELECT * FROM cursos AS c INNER JOIN usuarios AS u ON c.id_userprofesor = u.id_user where idCurso = '$idCur' ";
                        $q11 = $pdo10->prepare($veri11);
                        $q11->execute(array());
                        while ($dato11 = $q11->fetch(PDO::FETCH_ASSOC)) {
                            $idPro = $dato11['id_user'];
                            $tamanio = count($IDPROFE);
                            $existe = 0;
                            for ($x = 0; $x < $tamanio; $x++) {
                                if ($idPro == $IDPROFE[$x]) {
                                    $existe = 1;
                                }
                            }
                            if ($existe != 1) {
                    ?>
                                <tr style="position:center;">
                                    <td>
                                        <div class="imgbx">
                                            
                                            <?php    
                                                if($dato11['mifoto']!=null){
                                            ?>
                                                    <img src="data:image/*;base64,<?php echo base64_encode($dato11['mifoto']); ?>" alt="foto_curso" style="width: 50px;">
                                            <?php
                                                }else{
                                            ?>
                                                    <img src="./assets/images/user.png" alt="foto_curso" style="width: 50px;">
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <span>⠀⠀</span>
                                    </td>
                                    <td>
                                        <h4> <?php echo $dato11['apellido_pat'] . " " . $dato11['apellido_mat']; ?> <br><span><?php echo $dato11['email']; ?> </span></h4>
                                    </td>
                                </tr>
                    <?php
                            }
                            array_push($IDPROFE, $idPro);
                        }
                    } ?>
                </tbody>
            </table>
            <button class="modal__button-link close-modal3">
                Close
            </button>
        </div>
    </div>
</section>
<?php
    }
    else{
        header('Location: ../../iniciosesion.php');
    }
?>
