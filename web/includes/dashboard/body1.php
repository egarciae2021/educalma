<?php
// Este codigo hace validacion para que no se pueda acceder a cualquier pagina sin estar logueado__Pablo Loyola

 if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
     
?>
 <!--========== NAV ==========-->
 <div class="nav-dashboard" id="navbar">
     <nav class="nav__container-dashboard">
         <div>
             <a href="index.php" class="nav__link-dashboard nav__logo-dashboard">
                 <img src="./assets/images/imagen_2021-10-28_233347.png" alt="" class="header__img__logo">
                 <span class="nav__logo-name-dashboard"> Educalma</span>
                 <i style="margin-left: 9rem; display: none;" class='bx bx-menu' id="header-toggle"></i>
             </a>
             <div class="nav__list-dashboard">
                 <div class="nav__items-dashboard">
                     <h3 class="nav__subtitle__img-dashboard">
                         
                     <!-- <img src="./assets/images/imagen_2021-10-29_000020.png" alt="" class="header__img__side"></h3> -->
                     <img src="data:image/*;base64,<?php echo base64_encode($dato['mifoto']); ?>" alt="foto_curso" class="header__img__side-dashboard"></h3>

                     <h4 class="nav__subtitle-dashboard">
                         <?php
                            if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true) {
                                echo $_SESSION['nombres'];
                            } else {
                                echo '';
                            }
                            ?>
                     </h4>
                     <div class="nav__dropdown-dashboard">
                         <a href="#" class="nav__link-dashboard">
                             <i class="far fa-user-circle nav__icon-dashboard"></i>
                             <!-- <i class="far fa-bookmark nav__icon"></i> -->
                             <span class="nav__name-dashboard">Perfil</span>
                             <!-- <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i> -->
                             <i class="fas fa-caret-down nav__icon-dashboard nav__dropdown-icon-dashboard"></i>
                         </a>

                         <div class="nav__dropdown-collapse-dashboard">
                             <div class="nav__dropdown-content-dashboard">
                                 <a href="user-sidebar.php" class="nav__dropdown-item-dashboard nav__link-dashboard">Dashboard</a>
                             </div>
                         </div>
                     </div>


                     <div class="nav__dropdown-dashboard">
                         <a href="sidebarCursos.php" class="nav__link-dashboard">
                             <i class="far fa-folder nav__icon-dashboard"></i>
                             <!-- <i class="far fa-bookmark nav__icon"></i> -->
                             <span class="nav__name-dashboard">Cursos</span>
                             <!-- <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i> -->
                             <i class="fas fa-caret-down nav__icon-dashboard nav__dropdown-icon-dashboard"></i>
                         </a>

                         <div class="nav__dropdown-collapse-dashboard">
                             <div class="nav__dropdown-content-dashboard">
                                 <a href="sidebarCursos.php" class="nav__dropdown-item-dashboard nav__link-dashboard">Mis Cursos</a>
                                 <a href="ListaCursos.php?pag=1" class="nav__dropdown-item-dashboard nav__link-dashboard">Ver todos los Cursos</a>
                                 <?php
                                    if($_SESSION['privilegio']==1 ||$_SESSION['privilegio']==6 ){
                                ?>
                                 <a href="agregarcurso.php" class="nav__dropdown-item-dashboard nav__link-dashboard">Donar Curso</a>
                                 <a href="publicarcursos.php?pag=1" class="nav__dropdown-item-dashboard nav__link-dashboard">Publicar cursos</a>
                                 <?php
                                  }
                                ?>
                             </div>
                         </div>
                     </div>

                    <?php
                        if($_SESSION['privilegio']==1 ||$_SESSION['privilegio']==6 ){
                    ?>
                        <div class="nav__dropdown-dashboard">
                            <a href="agregarCategorias.php" class="nav__link-dashboard">
                                <i class="far fa-check-circle nav__icon-dashboard"></i>
                                <span class="nav__name-dashboard">Categoria</span>
                                <!-- <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i> -->
                                <i class="fas fa-caret-down nav__icon-dashboard nav__dropdown-icon-dashboard"></i>
                            </a>

                            <div class="nav__dropdown-collapse-dashboard">
                                <div class="nav__dropdown-content-dashboard">
                                    
                                    <a href="agregarCategorias.php" class="nav__dropdown-item-dashboard nav__link-dashboard">Nueva Categoria</a>
                                    <a href="aagregarCategorias.php" class="nav__dropdown-item-dashboard nav__link-dashboard">Nueva Categoria impl</a>
                                    
                                </div>
                            </div>
                            
                        </div>
                        <div class="nav__dropdown-dashboard">
                            <a alt="Empresas" class="nav__link-dashboard" style="cursor:pointer;">
                                <i class="fas fa-building" style="color:0x272735;"> </i>
                                <span class="nav__name-dashboard">&nbsp;&nbsp; Empresas</span>
                                <!-- <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i> -->
                                <i class="fas fa-caret-down nav__icon-dashboard nav__dropdown-icon-dashboard"></i>
                            </a>
                            <div class="nav__dropdown-collapse-dashboard">
                                <div class="nav__dropdown-content-dashboard">
                                    
                                    <a href="Enterprise.php" class="nav__dropdown-item-dashboard nav__link-dashboard">Control de Empresas</a>
                                    <!-- <a href="#" class="nav__dropdown-item-dashboard nav__link-dashboard">Control de Empleados</a> -->
                                    
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    <?php
                        if($_SESSION['privilegio']==4){
                    ?>
                    <div class="nav__dropdown-dashboard">
                            <a alt="Empresas" class="nav__link-dashboard" style="cursor:pointer;">
                                <i class="fas fa-building" style="color:0x272735;"> </i>
                                <span class="nav__name-dashboard">&nbsp;&nbsp; Empresa</span>
                                <!-- <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i> -->
                                <i class="fas fa-caret-down nav__icon-dashboard nav__dropdown-icon-dashboard"></i>
                            </a>
                            <div class="nav__dropdown-collapse-dashboard">
                                <div class="nav__dropdown-content-dashboard">
                                    
                                    <a href="empleados.php" class="nav__dropdown-item-dashboard nav__link-dashboard">Control de Empresas</a>
                                    <!-- <a href="#" class="nav__dropdown-item-dashboard nav__link-dashboard">Control de Empleados</a> -->
                                    
                                </div>
                            </div>
                        </div>
                     <?php
                        }
                    ?>
                     <a href="index.php" class="nav__link-dashboard">
                         <!-- <i class='bx bx-home nav__icon'></i> -->
                         <i class="fas fa-home nav__icon-dashboard"></i>
                         <span class="nav__name-dashboard">Educalma</span>
                     </a>

                     <a href="sidebarEditar.php" class="nav__link-dashboard">
                         <i class="fas fa-cog nav__icon-dashboard"></i>
                         <span class="nav__name-dashboard">Ajustes</span>
                     </a>
                     <!-- <a href="#" class="nav__link">
                         <i class="fas fa-question-circle nav__icon"></i>
                         <span class="nav__name">Ayuda</span>
                     </a> -->

                     <a href="includes/login/logout.php" class="nav__link-dashboard nav__logout-dashboard">
                         <!-- <i class='bx bx-log-out nav__icon'></i> -->
                         <i class="fas fa-sign-out-alt nav__icon-dashboard"></i>
                         <span class="nav__name-dashboard">Salir</span>
                     </a>

                 </div>
             </div>
         </div>


     </nav>
 </div>

 <!--========== CONTENTS ==========-->
 <?php
    }
    else{
        header('Location: ../../iniciosesion.php');
    }
?>
