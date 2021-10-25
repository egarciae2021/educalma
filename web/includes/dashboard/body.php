<div class="banner-area">
</div>

<div class="content-area">
    <div class="wrapper-flex">
        <div class="container">
            <div class='banner-img'></div>
            <img src='./assets/images/cursos.jpg' alt='profile image' class="profile-img">
            <h1 class="name">3 últimos Cursos inscritos</h1>
            <p class="description">
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
                            <center>
                                <h5> <a href=""><?php echo $dato3['nombreCurso']; ?></a></h5>
                            </center>

                <?php
                        }
                    }
                }

                ?>
            </p>
        </div>

        <div class="container">
            <div class='banner-img'></div>
            <img src='./assets/images/cursosterminados.jpg' alt='profile image' class="profile-img">
            <p class="name"><?php echo $cuenta9; ?> curso(s) completado(s)</p>
            <p class="description">

            </p>

        </div>

        <div class="container">
            <div class='banner-img'></div>
            <img src='./assets/images/cursosinscritos.jpg' alt='profile image' class="profile-img">
            <p class="name"><?php echo $cuenta4; ?> curso(s) <br> inscrito(s)</p>
            <p class="description">
            </p>

        </div>
        <div class="container">
            <div class='banner-img'></div>
            <img src='./assets/images/profesores.jpg' alt='profile image' class="profile-img">
            <p class="name">Tus Profesores</p>
            <p class="description">
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
                                        <div class="imgbx"><img src="data:image/*;base64,<?php echo base64_encode($dato11['mifoto']); ?>" alt="foto_curso" style="width: 50px;"></div>
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
            </p>
        </div>
    </div>
</div>