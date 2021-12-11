<?php
// Este codigo hace validacion para que no se pueda acceder a cualquier pagina sin estar logueado__Pablo Loyola

 if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
     
?>
 <!--========== NAV ==========-->
 <div class="nav" id="navbar">
     <nav class="nav__container">
         <div>
             <a href="#" class="nav__link nav__logo">
                 <img src="./assets/images/imagen_2021-10-28_233347.png" alt="" class="header__img__logo">
                 <span class="nav__logo-name"> EduCalma</span>
                 <!-- <i style="margin-left: 9rem; display: none;" class='bx bx-menu' id="header-toggle"></i> -->
             </a>
             <div class="nav__list">
                 <div class="nav__items">
                     <h3 class="nav__subtitle__img">
                         
                     <!-- <img src="./assets/images/imagen_2021-10-29_000020.png" alt="" class="header__img__side"></h3> -->
                     <img src="data:image/*;base64,<?php echo base64_encode($dato['mifoto']); ?>" alt="foto_curso" class="header__img__side"></h3>

                     <h4 class="nav__subtitle">
                         <?php
                            if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true) {
                                echo $_SESSION['nombres'];
                            } else {
                                echo '';
                            }
                            ?>
                     </h4>
                     <div class="nav__dropdown">
                         <a href="#" class="nav__link">
                             <i class="far fa-user-circle nav__icon"></i>
                             <!-- <i class="far fa-bookmark nav__icon"></i> -->
                             <span class="nav__name">Perfil</span>
                             <!-- <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i> -->
                             <i class="fas fa-caret-down nav__icon nav__dropdown-icon"></i>
                         </a>

                         <div class="nav__dropdown-collapse">
                             <div class="nav__dropdown-content">
                                 <a href="user-sidebar.php" class="nav__dropdown-item nav__link">Dashboard</a>
                             </div>
                         </div>
                     </div>


                     <div class="nav__dropdown">
                         <a href="sidebarCursos.php" class="nav__link">
                             <i class="far fa-folder nav__icon"></i>
                             <!-- <i class="far fa-bookmark nav__icon"></i> -->
                             <span class="nav__name">Cursos</span>
                             <!-- <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i> -->
                             <i class="fas fa-caret-down nav__icon nav__dropdown-icon"></i>
                         </a>

                         <div class="nav__dropdown-collapse">
                             <div class="nav__dropdown-content">
                                 <a href="sidebarCursos.php" class="nav__dropdown-item nav__link">Mis Cursos</a>
                                 <a href="ListaCursos.php?pag=1" class="nav__dropdown-item nav__link">Ver todos los Cursos</a>
                                 <a href="agregarcurso.php" class="nav__dropdown-item nav__link">Donar Curso</a>
                                <?php
                                    if($_SESSION['privilegio']==1 ||$_SESSION['privilegio']==6 ){
                                ?>
                                 <a href="publicarcursos.php?pag=1" class="nav__dropdown-item nav__link">Publicar cursos</a>
                                 <?php
                                  }
                                ?>
                             </div>
                         </div>
                     </div>

                    <?php
                        if($_SESSION['privilegio']==1 ||$_SESSION['privilegio']==6 ){
                    ?>
                        <div class="nav__dropdown">
                            <a href="agregarCategorias.php" class="nav__link">
                                <i class="far fa-check-circle nav__icon"></i>
                                <span class="nav__name">Categoria</span>
                                <!-- <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i> -->
                                <i class="fas fa-caret-down nav__icon nav__dropdown-icon"></i>
                            </a>

                            <div class="nav__dropdown-collapse">
                                <div class="nav__dropdown-content">
                                    
                                    <a href="agregarCategorias.php" class="nav__dropdown-item nav__link">Nueva Categoria</a>
                                    
                                </div>
                            </div>
                        </div>

                    <?php
                        }
                    ?>

                     <a href="index.php" class="nav__link">
                         <!-- <i class='bx bx-home nav__icon'></i> -->
                         <i class="fas fa-home nav__icon"></i>
                         <span class="nav__name">Educalma</span>
                     </a>

                     <a href="sidebarEditar.php" class="nav__link">
                         <i class="fas fa-cog nav__icon"></i>
                         <span class="nav__name">Ajustes</span>
                     </a>
                     <a href="#" class="nav__link">
                         <i class="fas fa-question-circle nav__icon"></i>
                         <span class="nav__name">Ayuda</span>
                     </a>

                     <a href="includes/login/logout.php" class="nav__link nav__logout">
                         <!-- <i class='bx bx-log-out nav__icon'></i> -->
                         <i class="fas fa-sign-out-alt nav__icon"></i>
                         <span class="nav__name">Salir</span>
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
