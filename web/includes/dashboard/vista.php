<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="./assets/css/s.dashboard.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./assets/lib/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="././assets/css/stylesidebar.css">
    <link rel="stylesheet" href="./assets/css/styledashboard.css">
</head>
<?php
session_start();
require_once 'database/databaseConection.php';

$id = $_SESSION['codUsuario'];

$pdo1 = Database::connect();
$veri1 = "SELECT * FROM cursoinscrito WHERE usuario_id = '$id' order by curso_id desc";
$q1 = $pdo1->prepare($veri1);
$q1->execute(array());
$cuenta4 = $q1->rowCount();
Database::disconnect();

$pdo9 = Database::connect();
$sql9 = "SELECT * FROM certificados WHERE idUser_certif='$id'";
$q9 = $pdo9->prepare($sql9);
$q9->execute();
$cuenta9 = $q9->rowCount();
Database::disconnect();

$pdo12 = Database::connect();
$sql12 = "SELECT * FROM usuarios WHERE id_user='$id'";
$q12 = $pdo12->prepare($sql12);
$q12->execute();
$cuenta12 = $q12->rowCount();
$dato12 = $q12->fetch(PDO::FETCH_ASSOC)

?>

<body>
    <header>
        <div class="btn-toggle" id="btnToggle">
            <a href="#">
                <i class="fas fa-bars"></i>
            </a>
        </div>

        <div class="group-items">
            <a href="#">
                <img src="./assets/images/logo.educalma.svg" alt="Logo Educalma" />
            </a>
            <div class="group-tools">
                <div class="group-icons">
                    <div class="dropdown">
                        <!-- Nombre usuario 1/2 -->
                        <div class="info-user" id="infoUser">
                            <span class="name">Lorenzo G.</span>
                            <span class="type">Administrador</span>
                        </div>
                        <div class="icon" id="iconUser"><i class="fas fa-user"></i></div>
                        <div class="main-data" id="mainData">
                            <ul>
                                <!-- Nombre usuario 2/2-->
                                <div class="info-user">
                                    <span>Lorenzo G.</span>
                                    <span class="type">Administrador</span>
                                </div>
                                <div class="separator"></div>
                                <li><i class="fas fa-cog"></i>Ajustes</li>
                                <li><i class="fas fa-question-circle"></i>Ayuda</li>
                                <div class="separator"></div>
                                <li><i class="far fa-times-circle"></i>Salir</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="main-context" id="mainContex">
        <ul>
            <li><i class="fas fa-chart-pie"></i><a href="user-sidebar.php">Dashboard</a></li>
            <li><i class="fas fa-swatchbook"></i><a href="#">Mis cursos</a></li>
            <li>
                <i class="fas fa-hand-holding-heart"></i><a href="#">Donar cursos</a>
            </li>
            <li>
                <i class="fas fa-plus-circle"></i><a href="#">Nueva categoria</a>
            </li>
            <li><i class="fas fa-arrow-left"></i><a href="#">Regresar</a></li>
            <li><i class="fas fa-arrow-left"></i><a href="#">Item 01</a></li>
            <li><i class="fas fa-arrow-left"></i><a href="#">Item 02</a></li>
            <li><i class="fas fa-arrow-left"></i><a href="#">Item 03</a></li>
            <li><i class="fas fa-arrow-left"></i><a href="#">Item 04</a></li>
            <li><i class="fas fa-arrow-left"></i><a href="#">Item 05</a></li>
            <li><i class="fas fa-arrow-left"></i><a href="#">Item 06</a></li>
            <li><i class="fas fa-arrow-left"></i><a href="#">Item 07</a></li>
            <li><i class="fas fa-arrow-left"></i><a href="#">Item 08</a></li>
            <li><i class="fas fa-arrow-left"></i><a href="#">Item 09</a></li>
            <li><i class="fas fa-arrow-left"></i><a href="#">Item 10</a></li>
            <li><i class="fas fa-arrow-left"></i><a href="#">Item 11</a></li>
            <li><i class="fas fa-arrow-left"></i><a href="#">Item 12</a></li>
            <li><i class="fas fa-arrow-left"></i><a href="#">Item 13</a></li>
            <li><i class="fas fa-arrow-left"></i><a href="#">Item 14</a></li>
            <li><i class="fas fa-arrow-left"></i><a href="#">Item 15</a></li>
            <li><i class="fas fa-arrow-left"></i><a href="#">Item 16</a></li>
            <li><i class="fas fa-arrow-left"></i><a href="#">Item 17</a></li>
            <li><i class="fas fa-arrow-left"></i><a href="#">Item 18</a></li>
            <li><i class="fas fa-arrow-left"></i><a href="#">Item 19</a></li>
            <li><i class="fas fa-arrow-left"></i><a href="#">Item 20</a></li>
        </ul>
    </div>
    
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
                </p>
            </div>
        </div>
    </div>
    <script src="./assets/lib/jquery-3.2.1.slim.min.js"></script>
    <script src="./assets/js/m.dashboard.js"></script>


</body>

</html>