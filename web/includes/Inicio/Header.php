<?php
ob_start();
@session_start();
require_once 'database/databaseConection.php';
?>
<header>
    <div class="container-header navbar-fixed-top">
        <input type="checkbox" name="" id="check">
        <div class="logo-container">
            <a href="index.php"><img style="width: 200px;" src="assets/images/logo_educalma.png" alt=""></a>
        </div>
































        <!--////////////////////-->
        <div style="margin: 20px;" class="nav-btn-header">

            <div class="nav-links-header">


                <?php if (isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)) {?>
                    <ul style="margin-left: 25px;">

                        <li class="nav-link" style="--i: .6s">

                            <a href="nosotros.php">Nosotros</a>
                        </li>
                        
                        <li class="nav-link" style="--i: .6s">
                
                            <a href="ListaCursos.php?pag=1">Cursos</a>
                
                        </li>
                    </ul>
                <?php
                    }else{
                ?>
                    <ul style="margin-left: 25px;">
                    
                        <li class="nav-link" style="--i: .6s">
                            <a href="nosotros.php">Nosotros</a>
                        </li>

                        <li class="nav-link" style="--i: .6s">
                
                            <a href="ListaCursos.php?pag=1">Cursos</a>
                        
                        </li>

                        <div class="log-sign" style="--i: 1.8s">
                            <a href="iniciosesion.php" class="btn transparent">Iniciar Sesión</a>
                            <a href="registroUsuario.php" class="btn solid">Regístrate!</a>
                        </div>

                    </ul>
                <?php
                    }
                ?>

                
            </div>

            <?php
            Database::disconnect();




























          
            if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $_SESSION['privilegio'] == 1) {




                $pdo = Database::connect();
                $idUsuario = $_SESSION['codUsuario'];
                $sql = "SELECT * FROM usuarios WHERE id_user = '$idUsuario'";
                $q = $pdo->prepare($sql);
                $q->execute(array());
                $dato = $q->fetch(PDO::FETCH_ASSOC);
                Database::disconnect();
                $nom=$dato['nombres'];
            ?>

            <!-- LOGUEADO -->
            <div class="log-sign" style="--i: 1.8s; position: relative; top: -100px;">
                    <ul>
                        <li class="nav-link" style="--i: .85s">
                            
                            <a href="#"><?php echo $nom ?>&nbsp;(Administrador)<i class="fas fa-caret-down"></i></a>
                            
                            <div class="dropdown">
                                <ul>
                                    <li class="dropdown-link">
                                        <a href="user-sidebar.php">Dashboard</a>
                                    </li>

                                    <li class="dropdown-link">
                                        <a href="ListaCursos.php?pag=1">Cursos Publicados</a>
                                    </li>

                                    <li class="dropdown-link">
                                        <a href="includes/login/logout.php">Cerrar Sesión</a>
                                    </li>
                                    <div class="arrow"></div>
                                </ul>
                            </div>
                        </li>
                    </ul>
            </div>

            <?php } ?>


            <?php

            if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $_SESSION['privilegio'] == 2) {




                $pdo = Database::connect();
                $idUsuario = $_SESSION['codUsuario'];
                $sql = "SELECT * FROM usuarios WHERE id_user = '$idUsuario'";
                $q = $pdo->prepare($sql);
                $q->execute(array());
                $dato = $q->fetch(PDO::FETCH_ASSOC);
                Database::disconnect();
                $nom=$dato['nombres'];
            ?>

            <!-- LOGUEADO -->
            <div class="log-sign" style="--i: 1.8s">
                    <ul style="margin-left: 25px;">
                        <li class="nav-link" style="--i: .85s">
                            <a href="#"><?php echo $nom ?>&nbsp;(Profesor)<i class="fas fa-caret-down"></i></a>
                            <div class="dropdown">
                                <ul>
                                    <li class="dropdown-link">
                                        <a href="user-sidebar.php">Dashboard</a>
                                    </li>

                                    <li class="dropdown-link">
                                        <a href="ListaCursos.php?pag=1">Cursos Publicados</a>
                                    </li>
                    
                                    <li class="dropdown-link">
                                        <a href="includes/login/logout.php">Cerrar Sesión</a>
                                    </li>
                                    <div class="arrow"></div>
                                </ul>
                            </div>
                        </li>
                    </ul>
            </div>

            <?php } ?>

            <?php

            if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $_SESSION['privilegio'] == 3) {




                $pdo = Database::connect();
                $idUsuario = $_SESSION['codUsuario'];
                $sql = "SELECT * FROM usuarios WHERE id_user = '$idUsuario'";
                $q = $pdo->prepare($sql);
                $q->execute(array());
                $dato = $q->fetch(PDO::FETCH_ASSOC);
                Database::disconnect();
                $nom=$dato['nombres'];
            ?>

            <!-- LOGUEADO -->
            <div class="log-sign" style="--i: 1.8s">
                    <ul style="margin-left: 25px;">
                        <li class="nav-link" style="--i: .85s">
                            <a href="#"><?php echo $nom ?>&nbsp;(Estudiante)<i class="fas fa-caret-down"></i></a>
                            <div class="dropdown">
                                <ul>
                                    <li class="dropdown-link">
                                        <a href="user-sidebar.php">Dashboard</a>
                                    </li>

                                    <li class="dropdown-link">
                                        <a href="ListaCursos.php?pag=1">Cursos Publicados</a>
                                    </li>

                                    <li class="dropdown-link">
                                        <a href="includes/login/logout.php">Cerrar Sesión</a>
                                    </li>
                                    <div class="arrow"></div>
                                </ul>
                            </div>
                        </li>
                    </ul>
            </div>

            <?php } ?>

            <?php

            if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $_SESSION['privilegio'] == 4) {




                $pdo = Database::connect();
                $idUsuario = $_SESSION['codUsuario'];
                $sql = "SELECT * FROM usuarios WHERE id_user = '$idUsuario'";
                $q = $pdo->prepare($sql);
                $q->execute(array());
                $dato = $q->fetch(PDO::FETCH_ASSOC);
                Database::disconnect();
                $nom=$dato['nombres'];
            ?>

            <!-- LOGUEADO -->
            <div class="log-sign" style="--i: 1.8s">
                    <ul style="margin-left: 25px;">
                        <li class="nav-link" style="--i: .85s">
                            <a href="#"><?php echo $nom ?>&nbsp;(Empresa)<i class="fas fa-caret-down"></i></a>
                            <div class="dropdown">
                                <ul>
                                    <li class="dropdown-link">
                                        <a href="user-sidebar.php">Dashboard</a>
                                    </li>

                                    <li class="dropdown-link">
                                        <a href="ListaCursos.php?pag=1">Cursos Publicados</a>
                                    </li>
                  
                                    <li class="dropdown-link">
                                        <a href="includes/login/logout.php">Cerrar Sesión</a>
                                    </li>
                                    <div class="arrow"></div>
                                </ul>
                            </div>
                        </li>
                    </ul>
            </div>

            <?php } ?>

            <?php

            if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $_SESSION['privilegio'] == 5) {




                $pdo = Database::connect();
                $idUsuario = $_SESSION['codUsuario'];
                $sql = "SELECT * FROM usuarios WHERE id_user = '$idUsuario'";
                $q = $pdo->prepare($sql);
                $q->execute(array());
                $dato = $q->fetch(PDO::FETCH_ASSOC);
                Database::disconnect();
                $nom=$dato['nombres'];
            ?>

            <!-- LOGUEADO -->
            <div class="log-sign" style="--i: 1.8s">
                    <ul style="margin-left: 25px;">
                        <li class="nav-link" style="--i: .85s">
                            <a href="#"><?php echo $nom ?>&nbsp;(Usuario - Empresa)<i class="fas fa-caret-down"></i></a>
                            <div class="dropdown">
                                <ul>
                                    <li class="dropdown-link">
                                        <a href="user-sidebar.php">Dashboard</a>
                                    </li>

                                    <li class="dropdown-link">
                                        <a href="ListaCursos.php?pag=1">Cursos Publicados</a>
                                    </li>
                                    
                                    <li class="dropdown-link">
                                        <a href="includes/login/logout.php">Cerrar Sesión</a>
                                    </li>
                                    <div class="arrow"></div>
                                </ul>
                            </div>
                        </li>
                    </ul>
            </div>

            <?php } ?>

            <?php

            if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $_SESSION['privilegio'] == 6) {




                $pdo = Database::connect();
                $idUsuario = $_SESSION['codUsuario'];
                $sql = "SELECT * FROM usuarios WHERE id_user = '$idUsuario'";
                $q = $pdo->prepare($sql);
                $q->execute(array());
                $dato = $q->fetch(PDO::FETCH_ASSOC);
                Database::disconnect();
                $nom=$dato['nombres'];
            ?>

            <!-- LOGUEADO -->
            <div style="margin: auto;" class="log-sign" style="--i: 1.8s">
                    <ul>
                        <li class="nav-link" style="--i: .85s">
                            <a href="#"><?php echo $nom ?>&nbsp;(Super Administrador)<i class="fas fa-caret-down"></i></a>
                            <div class="dropdown">
                                <ul>
                                    <li class="dropdown-link">
                                        <a href="user-sidebar.php">Dashboard</a>
                                    </li>

                                    <li class="dropdown-link">
                                        <a href="ListaCursos.php?pag=1">Cursos Publicados</a>
                                    </li>

                                    <li class="dropdown-link">
                                        <a href="includes/login/logout.php">Cerrar Sesión</a>
                                    </li>
                                    <div class="arrow"></div>
                                </ul>
                            </div>
                        </li>
                    </ul>
            </div>

            <?php } ?>


 
















        </div>
        <div class="hamburger-menu-container">
            <div class="hamburger-menu">
                <div></div>
            </div>
        </div>
    </div>
</header>