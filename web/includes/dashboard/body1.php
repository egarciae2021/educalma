<?php
// Este codigo hace validacion para que no se pueda acceder a cualquier pagina sin estar logueado__Pablo Loyola

if (isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)) {

?>
    <!--========== NAV ==========-->
    <div class="nav-dashboard" id="navbar">
        <nav class="nav__container-dashboard">
            <div>
                <a href="index.php" class="nav__link-dashboard nav__logo-dashboard">
                    
                    <!-- <img src="./assets/images/imagen_2021-10-28_233347.png" alt="" class="header__img__logo"> -->

                    <!-- <span class="nav__logo-name-dashboard"> Educalma</span> -->

                    <img style="width: 40px; height: 35px;" src="./assets/images/logo_edu.png" alt="" class="header__img__logo">
                    <img style="position: relative; left: 3px; width: 140px; height: 30px;" src="./assets/images/logo_edu_2.png" alt="" class="header__img__logo">
                    <i style="margin-left: 9rem; display: none;" class='bx bx-menu' id="header-toggle"></i>
                </a>
                <div class="nav__list-dashboard">
                    <div class="nav__items-dashboard">
                        <h3 class="nav__subtitle__img-dashboard">

                            <!-- <img src="./assets/images/imagen_2021-10-29_000020.png" alt="" class="header__img__side"></h3> -->
                            
                            <?php    
                                if($dato['mifoto']!=null){
                            ?>
                                    <img src="data:image/*;base64,<?php echo base64_encode($dato['mifoto']); ?>" alt="foto_curso" class="header__img__side-dashboard">
                            <?php
                                }else{
                            ?>

                                <?php  if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $dato['sexo'] === 1) { // 1 -> Masculino?>

                                    <img src="./assets/images/avatar_hombre.png" alt="foto_curso" class="header__img__side-dashboard">
                            
                                <?php } else if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $dato['sexo'] === 2) { // 2 -> Femenino?>

                                    <img src="./assets/images/avatar_mujer.png" alt="foto_curso" class="header__img__side-dashboard">

                                <?php } else if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $dato['sexo'] === 3) { // 3 -> No binario?>

                                    
                                <?php } else if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $dato['sexo'] === 2) { // 2 -> Prefiero no decir?>


                                <?php } ?>
                            <?php
                                }
                            ?>
                        </h3>

                        <h4 style="position: relative; left: 20px; top: -15px;" class="nav__subtitle-dashboard">
                            <?php
                            if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true) {
                                echo $_SESSION['nombres'];
                            } else {
                                echo '';
                            }
                            ?>
                        </h4>

                        <a style="position: relative; left: 8px;" href="index.php" class="nav__link-dashboard">
                            <!-- <i class='bx bx-home nav__icon'></i> -->
                            <i class="fas fa-home nav__icon-dashboard" style="color:#92D161;"></i>
                            <span style="position: relative; left: -3px;" class="nav__name-dashboard">Inicio</span>
                        </a>
                        
                        <div style="position: relative; left: 8px;" class="nav__dropdown-dashboard">
                            <a href="user-sidebar.php" class="nav__link-dashboard">
                                <i class="fa fa-chart-line nav__icon-dashboard" style="color:#5499C7;"></i>
                                <!-- <i class="far fa-bookmark nav__icon"></i> -->
                                <span class="nav__name-dashboard">Dashboard</span>
                                <!-- <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i> -->
                                
                            </a>

                        </div>


                        <div style="position: relative; left: 8px;" class="nav__dropdown-dashboard">
                            <a href="sidebarCursos.php" class="nav__link-dashboard">
                                <i class="far fa-folder-open nav__icon-dashboard" style="color:#F1C40F;"></i>
                                <!-- <i class="far fa-bookmark nav__icon"></i> -->
                                <span style="position: relative; left: -3px;" class="nav__name-dashboard">Cursos</span>
                                <!-- <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i> -->
                                <i class="fas fa-caret-down nav__icon-dashboard nav__dropdown-icon-dashboard"></i>
                            </a>

                            <div class="nav__dropdown-collapse-dashboard">
                                <div class="nav__dropdown-content-dashboard">


                                    <?php
                                    if ($_SESSION['privilegio'] != 1 && $_SESSION['privilegio'] != 6) {
                                    ?>

                                    <a href="sidebarCursos.php" class="nav__dropdown-item-dashboard nav__link-dashboard">Cursos Comprados</a>

                                    <?php
                                    }
                                    ?>
                                    
                                    <a href="ListaCursos.php?pag=1" class="nav__dropdown-item-dashboard nav__link-dashboard">Cursos Publicados</a>

                                    <?php
                                    if ($_SESSION['privilegio'] == 1 || $_SESSION['privilegio'] == 6) {
                                    ?>
                                        <a href="publicarcursos.php?pag=1" class="nav__dropdown-item-dashboard nav__link-dashboard">Cursos No Publicados</a>

                                        <a href="agregarcurso.php" class="nav__dropdown-item-dashboard nav__link-dashboard">Agregar Un Nuevo Curso</a>

                                        <!--<a href="aprobadosCurso.php" class="nav__dropdown-item-dashboard nav__link-dashboard">Aprobados</a>-->
                                    <?php
                                    }
                                    ?>

    



                                    
                                </div>
                            </div>
                        </div>










                        <?php
                        if ($_SESSION['privilegio'] == 1 || $_SESSION['privilegio'] == 6) {
                        ?>
                            <!-- <div class="nav__dropdown-dashboard">
                                <a href="agregarCategorias.php" class="nav__link-dashboard">
                                    <i class="far fa-check-circle nav__icon-dashboard"></i>
                                    <span class="nav__name-dashboard">Categoria</span> -->
                                    <!-- <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i> -->
                                    <!-- <i class="fas fa-caret-down nav__icon-dashboard nav__dropdown-icon-dashboard"></i>
                                </a>

                                <div class="nav__dropdown-collapse-dashboard">
                                    <div class="nav__dropdown-content-dashboard">

                                        <a href="agregarCategorias.php" class="nav__dropdown-item-dashboard nav__link-dashboard">Nueva Categoria</a>
                                        <a href="aagregarCategorias.php" class="nav__dropdown-item-dashboard nav__link-dashboard">Nueva Categoria impl</a>

                                    </div>
                                </div>

                            </div> -->
                            <div style="position: relative; left: 8px;" class="nav__dropdown-dashboard">
                                <a alt="Empresas" class="nav__link-dashboard" style="cursor:pointer;">
                                    <i class="fas fa-city" style="color:#6495ED;"> </i>
                                    <span style="position: relative; left: -8px;" class="nav__name-dashboard">&nbsp;&nbsp; Empresas</span>
                                    <!-- <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i> -->
                                    <i class="fas fa-caret-down nav__icon-dashboard nav__dropdown-icon-dashboard"></i>
                                </a>
                                <div class="nav__dropdown-collapse-dashboard">
                                    <!-- <div class="nav__dropdown-content-dashboard">

                                        <a href="Enterprise.php" class="nav__dropdown-item-dashboard nav__link-dashboard">Control de Empresas</a>
                                        <a href="#" class="nav__dropdown-item-dashboard nav__link-dashboard">Control de Empleados</a>

                                    </div> -->
                                    <div class="nav__dropdown-content-dashboard">

                                        <a href="curseEmp.php" class="nav__dropdown-item-dashboard nav__link-dashboard">Cursos para Empresas</a>
                                        <!-- <a href="#" class="nav__dropdown-item-dashboard nav__link-dashboard">Control de Empleados</a> -->

                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <?/*php
                        if ($_SESSION['privilegio'] == 4) {
                        */?>
                            <!-- <div class="nav__dropdown-dashboard">
                                <a alt="Empresas" class="nav__link-dashboard" style="cursor:pointer;">
                                    <i class="fas fa-building" style="color:0x272735;"> </i>
                                    <span class="nav__name-dashboard">&nbsp;&nbsp; Empresa</span> -->
                                    <!-- <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i> -->
                                    <!-- <i class="fas fa-caret-down nav__icon-dashboard nav__dropdown-icon-dashboard"></i>
                                </a>
                                <div class="nav__dropdown-collapse-dashboard">
                                    <div class="nav__dropdown-content-dashboard">

                                        <a href="empleados.php" class="nav__dropdown-item-dashboard nav__link-dashboard">Control de Empresas</a> -->
                                        <!-- <a href="#" class="nav__dropdown-item-dashboard nav__link-dashboard">Control de Empleados</a> -->

                                    <!-- </div>
                                </div>
                            </div> -->
                        <?/*php
                        }
                        */
                        ?>
                        <a style="position: relative; left: 12px;" href="reporteUsuario.php" class="nav__link-dashboard">
                            <i class="fas fa-clipboard nav__icon-dashboard" style="color:#E6B0AA;"></i>
                            <span class="nav__name-dashboard">Reporte</span>
                        </a>

                        <a style="position: relative; left: 8px;" href="sidebarEditar.php" class="nav__link-dashboard">
                            <i class="fas fa-cog nav__icon-dashboard" style="color:#AAB7B8;"></i>
                            <span class="nav__name-dashboard">Ajustes</span>
                        </a>
                        <!-- <a href="#" class="nav__link">
                         <i class="fas fa-question-circle nav__icon"></i>
                         <span class="nav__name">Ayuda</span>
                     </a> -->

                        <a style="position: relative; left: 8px;" href="includes/login/logout.php" class="nav__link-dashboard nav__logout-dashboard">
                            <!-- <i class='bx bx-log-out nav__icon'></i> -->
                            <i class="fas fa-sign-out-alt nav__icon-dashboard" style="color:red;"></i>
                            <span class="nav__name-dashboard">Salir</span>
                        </a>

                    </div>
                </div>
            </div>


        </nav>
    </div>

    <!--========== CONTENTS ==========-->
<?php
} else {
    header('Location: ../../iniciosesion.php');
}
?>