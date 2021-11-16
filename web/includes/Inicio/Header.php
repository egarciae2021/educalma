<?php
ob_start();
@session_start();
require_once 'database/databaseConection.php';
?>
<style>
    .li_cursos {
        border: #768b99 1px solid;

    }
</style>
<header class="top-header w-100">
    <div class="container">
        <div class="row">
            <div class="w-100  pl-5 pr-5">
                <nav class="navbar header-nav navbar-expand-lg">
                    <div class="container-fluid d-flex justify-content-between">
                        <a class="navbar-brand" href="index.php"><img src="assets/images/Logo.svg" alt="image"></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-wd" aria-controls="navbar-wd" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navbar-wd">
                            <ul class="navbar-nav">
                                <li><a class="nav-link text-primary" href="nosotros.php">Nosotros</a></li>

                                <?php
                                $pdo4 = Database::connect();
                                $sql4 = "SELECT * FROM categorias";
                                $q4 = $pdo4->prepare($sql4);
                                $q4->execute(array());
                                ?>
                                <li>
                                    <div class="dropdown">
                                        <button type="button" class="dropdown-toggle" id="curso-btn" data-toggle="dropdown">
                                            Cursos</button>



                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="ListaCursos.php">Todos</a>
                                            <?php

                                            while ($registro =  $q4->fetch(PDO::FETCH_ASSOC)) {

                                                echo '<a class="dropdown-item" href="ListaCursos.php?idcate=' . $registro['idCategoria'] . '">' . $registro['nombreCategoria'] . '</a>';
                                            }

                                            ?>

                                        </div>
                                    </div>
                                </li>
                                <!--<li class="li_cursos dropdown">
                                    <a class="nav-link text-primary" href="ListaCursos.php">Cursos</a>
                                </li>-->

                            </ul>
                        </div>

                        <?php
                             Database::disconnect();
                            
                        if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true) {
                     
                            $pdo = Database::connect();
                            $idUsuario = $_SESSION['codUsuario'];
                            $sql = "SELECT * FROM usuarios WHERE id_user = '$idUsuario'";
                            $q = $pdo->prepare($sql);
                            $q->execute(array());
                            $dato = $q->fetch(PDO::FETCH_ASSOC);
                            Database::disconnect();
                        ?>

                            <div class="collapse navbar-collapse justify-content-center" id="navbar-wd">
                                <ul class="navbar-nav">
                                    <li class="nav-item my-auto ms-10 ms-lg-0" style="padding-left: 90px; vertical-align: center;">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle btn-dropdown" onclick="dropdown();" role="button" data-toggle="dropdown" style="cursor: pointer;">

                                                <img src="data:image/*;base64,<?php echo base64_encode($dato['mifoto']); ?>" alt="foto_curso" style="width: 50px;height:45px;border-radius: 50%;">
                                            </a>
                                            <div class="dropdown-menu content_dropdown" id="menu_dropdown">
                                                <a class="dropdown-item" href="user-sidebar.php">Dashboard</a>
                                                <a class="dropdown-item" href="includes/login/logout.php">Cerrar Sesión</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        <?php
                        } else {
                        ?>

                            <div class="collapse navbar-collapse justify-content-end" id="navbar-wd">
                                <ul class="navbar-nav">
                                    <li>
                                        <a href="registros.php"><button type="button" class="roundedpill w165 mdl2 btn btn-lg btn-block btn-outline-primary">Registrar</button></a>
                                    </li>

                                    <li>
                                        <a href="iniciosesion.php"><button type="button" class="roundedpill  w165 mdl2 btn btn-lg btn-block btn-primary ">Login</button></a>
                                    </li>
                                </ul>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </nav>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</header>
