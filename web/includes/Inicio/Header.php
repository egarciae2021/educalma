<?php
ob_start();
@session_start();
require_once 'database/databaseConection.php';
?>
<header>
    <div class="container-header navbar-fixed-top">
        <input type="checkbox" name="" id="check">
        <div class="logo-container">
            <a href="index.php"><img src="assets/images/Logo.svg" alt=""></a>
        </div>
        <div class="nav-btn-header">
            <div class="nav-links-header">
                <ul>
                    <li class="nav-link" style="--i: .6s">
                        <a href="nosotros.php">Nosotros</a>
                    </li>
                    <li class="nav-link" style="--i: .6s">
                        <a href="ListaCursos.php">Cursos</a>
                    </li>
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
                <!-- LOGUEADO -->
                <div class="log-sign" style="--i: 1.8s">
                    <ul>
                        <li class="nav-link" style="--i: .85s">
                            <a href="#">NOMBREUSER<i class="fas fa-caret-down"></i></a>
                            <div class="dropdown">
                                <ul>
                                    <li class="dropdown-link">
                                        <a href="user-sidebar.php">Dashboard</a>
                                    </li>
                                    <li class="dropdown-link">
                                        <a href="sidebarCursos.php">Ir a Cursos</a>
                                    </li>
                                    <li class="dropdown-link">
                                        <a href="InfoCurso.php?pag=1">Información Cursos</a>
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
            <?php
            } else {
            ?>
                <!-- REGISTRO Y LOGIN -->
                <div class="log-sign" style="--i: 1.8s">
                    <a href="iniciosesion.php" class="btn transparent">Iniciar Sesi&oacute;n</a>
                    <a href="registroUsuario.php" class="btn solid">Registrate!</a>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="hamburger-menu-container">
            <div class="hamburger-menu">
                <div></div>
            </div>
        </div>
    </div>
</header>