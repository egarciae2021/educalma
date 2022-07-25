
<?php
ob_start();
@session_start();
require_once 'database/databaseConection.php';
?>

<!--Inicio del header /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<header style="background: linear-gradient(to right, #7C83FD, #E0C7E5) !important; height: 90px;">
    <div style="position: relative; top: -20px; background: none;" class="container-header navbar-fixed-top">
        <input type="checkbox" name="" id="check">



        <!--Logo-->
        <div class="logo-container nav-link">
            
            <a href="index.php"><img style="width: 200px;" src="assets/images/educalma_logo_blanco.png" alt=""></a>
        
        </div>


        <!--Inicio de Nosotros, Cursos e Iniciar Sesión y Regístrate o Nombre (tipo de usuario)-->
        <div style="margin: 20px;margin-left: -3em;" class="nav-btn-header">



            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <div class="nav-links-header">


                <?php if (isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)) {?>

                    <ul style="margin-left: 25px;">

                        <!--Nosotros y Cursos-->
                        <li class="nav-link" style="--i: .6s">

                            <a href="nosotros.php">Nosotros</a>
                        </li>
                        
                        <li class="nav-link" style="--i: .6s">
                
                            <a href="ListaCursos.php?pag=1">Cursos</a>
                        </li>

                        <li class="nav-link" style="--i: .6s;">
                            <?php 
                            $nom_privilegio = "";
                            switch ($_SESSION['privilegio']) {
                                case 1:
                                    $nom_privilegio = "Administrador";
                                    break;
                                case 2:
                                    $nom_privilegio = "Profesor";
                                    break;
                                case 3:
                                    $nom_privilegio = "Usuario Normal";
                                    break;
                                case 4:
                                    $nom_privilegio = "Empresa";
                                    break;
                                case 5:
                                    $nom_privilegio = "Usuario Empresa";
                                    break;
                                case 6:
                                    $nom_privilegio = "Super Admin";
                                    break;
                            }
                            ?>
                    
                            <a class="link-cel pb-0" style="white-space: nowrap;text-overflow: ellipsis; overflow: hidden;">
                                <?php echo $_SESSION['nombres_nom']?>
                            </a>
                            <a class="link-cel pt-2">
                                <?php echo '('.$nom_privilegio.')'?>
                            </a>
                    
                        </li>

                        <li class="nav-link" style="--i: .6s;">
                    
                            <a class="link-cel" href="user-sidebar.php">Dashboard</a>
                    
                        </li>

                        <li class="nav-link" style="--i: .6s">
                    
                            <a class="link-cel" href="sidebarEditar.php">Ajustes</a>
                    
                        </li>

                        <li class="nav-link" style="--i: .6s">
                    
                            <a class="link-cel" href="includes/login/logout.php">Cerrar Sesión</a>
                    
                        </li>

                   

                        <!-- LOGUEADO - Nombre (Tipo de Usuario) -->


                                <!--El código está afuera de este div más abajo. (->) -->



                    </ul>
                <?php
                    }else{
                ?>
                    <ul style="margin-left: 25px;">
                    
                        <!--Nosotros y Cursos-->
                        <li class="nav-link" style="--i: .6s">

                            <a href="nosotros.php">Nosotros</a>
                        </li>

                        <li class="nav-link" style="--i: .6s">
                
                            <a href="cursosPublicados.php">Cursos</a> 
                        </li>

                        <!-- NO LOGUEADO - Iniciar Sesión y Regístrate -->
                        <div class="log-sign">

                            <a href="iniciosesion.php" class="btn transparent btnIni">Iniciar Sesión</a>
                      
                            <a href="registroUsuario.php" class="btn solid">Regístrate!</a>
                            
                        </div>
                    </ul>
                <?php
                    }
                ?>

                
            </div>
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////// -->














            <?php
            Database::disconnect();


            






































            // (->) //////////////////////////////////////////////////////////////////////////////////////////////////////////
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

            <!-- LOGUEADO - Nombre (Tipo de Usuario) -->
            <div class="log-sign" style="--i: 1.8s; margin-left: -12em;margin-right: -10em;">
                    <ul>
                        <li class="nav-link" style="--i: .85s">
                            
                            <a style="color: white;" href="#"><?php echo $nom ?>&nbsp;(Administrador)<i class="fas fa-caret-down"></i></a>

                            <!--Desplegable-->
                            <div class="dropdown">
                                <ul>
                                    <li class="dropdown-link">
                                        <a style="color: white;" href="user-sidebar.php">Dashboard</a>
                                    </li>

                                    <li class="dropdown-link">
                                        <a style="color: white;" href="sidebarEditar.php">Ajustes</a>
                                    </li>

                                    <li class="dropdown-link">
                                        <a style="color: white; border-top: 1px solid white;" href="includes/login/logout.php">Cerrar Sesión</a>
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

            <!-- LOGUEADO - Nombre (Tipo de Usuario) -->
            <div class="log-sign" style="--i: 1.8s; margin-left: -12em;margin-right: -10em;">
                    <ul>
                        <li class="nav-link" style="--i: .85s">
                            <a style="color: white;" href="#"><?php echo $nom ?>&nbsp;(Profesor)<i class="fas fa-caret-down"></i></a>
                            <div class="dropdown">
                                <ul>
                                    <li class="dropdown-link">
                                        <a style="color: white;" href="user-sidebar.php">Dashboard</a>
                                    </li>

                                    <li class="dropdown-link">
                                        <a style="color: white;"href="sidebarEditar.php">Ajustes</a>
                                    </li>
                    
                                    <li class="dropdown-link">
                                        <a style="color: white; border-top: 1px solid white;" href="includes/login/logout.php">Cerrar Sesión</a>
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

            <!-- LOGUEADO - Nombre (Tipo de Usuario) -->
            <div class="log-sign" style="--i: 1.8s; margin-left: -12em;margin-right: -10em;">
                    <ul>
                        <li class="nav-link" style="--i: .85s">
                           
                            <a style="color: white;" href="#"><?php echo $nom ?>&nbsp;(Estudiante)<i class="fas fa-caret-down"></i></a>
                             
                            
                            <div class="dropdown">
                                <ul>
                                    <li class="dropdown-link">
                                        <a style="color: white;" href="user-sidebar.php">Dashboard</a>
                                    </li>

                                    <li class="dropdown-link">
                                        <a style="color: white;" href="sidebarEditar.php">Ajustes</a>
                                    </li>

                                    <li class="dropdown-link">
                                        <a style="color: white; border-top: 1px solid white;" href="includes/login/logout.php">Cerrar Sesión</a>
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

            <!-- LOGUEADO - Nombre (Tipo de Usuario) -->
            <div class="log-sign" style="--i: 1.8s; margin-left: -12em;margin-right: -10em;">
                    <ul>
                        <li class="nav-link" style="--i: .85s">
                            <a style="color: white;" href="#"><?php echo $nom ?>&nbsp;(Empresa)<i class="fas fa-caret-down"></i></a>
                            <div class="dropdown">
                                <ul>
                                    <li class="dropdown-link">
                                        <a style="color: white;" href="user-sidebar.php">Dashboard</a>
                                    </li>

                                    <li class="dropdown-link">
                                        <a style="color: white;" href="sidebarEditar.php">Ajustes</a>
                                    </li>
                  
                                    <li class="dropdown-link">
                                        <a style="color: white; border-top: 1px solid white;" href="includes/login/logout.php">Cerrar Sesión</a>
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

            <!-- LOGUEADO - Nombre (Tipo de Usuario) -->
            <div class="log-sign" style="--i: 1.8s; margin-left: -12em;margin-right: -10em;">
                    <ul>
                        <li class="nav-link" style="--i: .85s">
                            <a style="color: white;" href="#"><?php echo $nom ?>&nbsp;(Usuario - Empresa)<i class="fas fa-caret-down"></i></a>
                            <div class="dropdown" style="left: 9em;">
                                <ul>
                                    <li class="dropdown-link">
                                        <a style="color: white;" href="user-sidebar.php">Dashboard</a>
                                    </li>

                                    <li class="dropdown-link">
                                        <a style="color: white;" href="sidebarEditar.php">Ajustes</a>
                                    </li>
                                    
                                    <li class="dropdown-link">
                                        <a style="color: white; border-top: 1px solid white;" href="includes/login/logout.php">Cerrar Sesión</a>
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

            <!-- LOGUEADO - Nombre (Tipo de Usuario) -->
            <div style="margin: auto; margin-left: -12em;margin-right: -10em;" class="log-sign" style="--i: 1.8s;">
                    <ul>
                        <li class="nav-link" style="--i: .85s">
                            <a style="color: white;" href="#"><?php echo $nom ?>&nbsp;(Super Administrador)<i class="fas fa-caret-down"></i></a>
                            <div class="dropdown" style="left: 13em;">
                                <ul>
                                    <li class="dropdown-link">
                                        <a style="color: white;" href="user-sidebar.php">Dashboard</a>
                                    </li>

                                    <li class="dropdown-link">
                                        <a style="color: white;" href="sidebarEditar.php">Ajustes</a>
                                    </li>

                                    <li class="dropdown-link">
                                        <a style="color: white; border-top: 1px solid white;" href="includes/login/logout.php">Cerrar Sesión</a>
                                    </li>
                                    <div class="arrow"></div>
                                </ul>
                            </div>
                        </li>
                    </ul>
            </div>

            <?php } 
            
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
            ?>



































        </div>
        <!--Fin de Nosotros, Cursos e Iniciar Sesión y Regístrate o Nombre (tipo de usuario)-->




        <!--Botón de tres líneas para la pantalla de celulares-->
        <div class="hamburger-menu-container">
            <div class="hamburger-menu">
                <div></div>
            </div>
        </div>


        
    </div>
</header>
<!--Fin del header /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->