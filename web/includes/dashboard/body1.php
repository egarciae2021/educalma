 <?php
// Este codigo hace validacion para que no se pueda acceder a cualquier pagina sin estar logueado__Pablo Loyola

if (isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)) {

?>

    <!--========== NAV ==========-->
    <div class="nav-dashboard" id="navbar">

        <nav class="nav__container-dashboard">
            
            <div>
         
                <a href="index.php" class="nav__link-dashboard nav__logo-dashboard">

                    <img style="width: 40px; height: 35px;" src="./assets/images/logo_edu.png" alt="" class="header__img__logo">
                    <img style="position: relative; left: 3px; width: 140px; height: 30px;" src="./assets/images/logo_edu_2.png" alt="" class="header__img__logo">
                    <i style="margin-left: 9rem; display: none;" class='bx bx-menu' id="header-toggle"></i>
                
                </a>

                <div style="margin-bottom: 100px;" class="nav__list-dashboard">
                    <div class="nav__items-dashboard">
                        <h3 class="nav__subtitle__img-dashboard">

                            <?php    
                            
                                if($dato['mifoto']!=null){
                            ?>
                                
                               <img id="miFoto"  src="data:image/*;base64,<?php echo base64_encode($dato['mifoto']); ?>" alt="foto_curso" class="header__img__side-dashboard" >  
                               <!-- <style>
                                   #miFoto{
                                    border-radius: 50%;
                                    border-left: 5px solid #8184f6;
                                    border-right: 5px solid #e1c6e0;
                                    
                                    -webkit-box-sizing: border-box;
                                    -moz-box-sizing: border-box;
                                    box-sizing: border-box;
                                    background-position: 0 0, 0 100% ;
                                    background-repeat: no-repeat;
                                    -webkit-background-size: 100% 5px;
                                    -moz-background-size: 100% 5px;
                                    background-size: 100% 5px;
                                    background-image: -webkit-linear-gradient(left, #3acfd5 0%, #3a4ed5 100%), -webkit-linear-gradient(left, #3acfd5 0%, #3a4ed5 100%);
                                    background-image: -moz-linear-gradient(left, #3acfd5 0%, #3a4ed5 100%), -moz-linear-gradient(left, #3acfd5 0%, #3a4ed5 100%);
                                    background-image: -o-linear-gradient(left, #3acfd5 0%, #3a4ed5 100%), -o-linear-gradient(left, #3acfd5 0%, #3a4ed5 100%);
                                    background-image: linear-gradient(to right, #3acfd5 0%, #3a4ed5 100%), linear-gradient(to right, #3acfd5 0%, #3a4ed5 100%);
                                    }
                               </style> -->
                          
                          <?php
                                }else{
                            ?>

                                <?php  if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $dato['sexo'] == 1) { ?>

                                    <img src="./assets/images/avatar_hombre.png" alt="foto_curso" class="header__img__side-dashboard"> 
                                  
                                <?php } else if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true && $dato['sexo'] == 2) { ?>

                                    <img src="./assets/images/avatar_mujer.png" alt="foto_curso" class="header__img__side-dashboard">
                               
                                <?php  } ?>
                            <?php
                                }
                            ?>
                        </h3>


                        <?php
                        $pdo = Database::connect();
                        $idUsuario = $_SESSION['codUsuario'];
                        $sql = "SELECT * FROM usuarios WHERE id_user = '$idUsuario'";
                        $q = $pdo->prepare($sql);
                        $q->execute(array());
                        $dato = $q->fetch(PDO::FETCH_ASSOC);
                        Database::disconnect();
                        $nom=$dato['nombres'];
                        $apepat=$dato['apellido_pat'];
                        $apemat=$dato['apellido_mat'];
                        ?>



                        <h4 style="position: relative; left: 20px; top: -15px;" class="nav__subtitle-dashboard">
                            <?php
                            if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true) {
                                echo $nom." ".$apepat." ".$apemat;
                            } else {
                                echo '';
                            }
                            ?>
                        </h4>

                        <a style="position: relative; left: 8px;" href="index.php" class="nav__link-dashboard">
                            <!-- <i class='bx bx-home nav__icon'></i> -->
                            <i class="fas fa-home nav__icon-dashboard" style="color:#7d83fc;"></i>
                            <span style="position: relative; left: -3px;" class="nav__name-dashboard">Inicio</span>
                        </a>
                        
                        <div style="position: relative; left: 8px;" class="nav__dropdown-dashboard">
                            <a href="user-sidebar.php" class="nav__link-dashboard">
                                <i class="fa fa-chart-line nav__icon-dashboard" style="color:#7d83fc;"></i>
                                <!-- <i class="far fa-bookmark nav__icon"></i> -->
                                <span class="nav__name-dashboard">Dashboard</span>
                                <!-- <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i> -->
                                
                            </a>

                        </div>


                        <div style="position: relative; left: 8px;" class="nav__dropdown-dashboard">

                            <a class="nav__link-dashboard">
                                <img class="nav__icon-dashboard" src="./assets/images/cur.png" width="25" heigth="25">
                                <!-- <i class="far fa-bookmark nav__icon"></i> -->
                                <span style="position: relative; left: -3px;" class="nav__name-dashboard">Cursos</span>
                                <!-- <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i> -->
                                <i class="fas fa-caret-down nav__icon-dashboard nav__dropdown-icon-dashboard"></i>
                            </a>

                            <div class="nav__dropdown-collapse-dashboard" style="background-color: #e0c7e5;">
                                <div class="nav__dropdown-content-dashboard">


                                    <!-- 1 -> Administrador     -->
                                    <!-- 2 -> Profesor          -->
                                    <!-- 3 -> Usuario Normal    -->
                                    <!-- 4 -> Empresa           -->
                                    <!-- 5 -> Usuario (Empresa) -->
                                    <!-- 6 -> Super Admin       -->


                                    
                                    <?php
                                    if ($_SESSION['privilegio'] != 1 && $_SESSION['privilegio'] != 2 && $_SESSION['privilegio'] != 6) {
                                    ?>

                                        <!--//-->
                                        <a href="sidebarCursos.php" class="nav__dropdown-item-dashboard nav__link-dashboard"><i class="fa fa-angle-right" aria-hidden="true"></i>Mis Cursos</a>

                                        <!--//-->
                                        <a href="comprarCursoCodEmpresa.php" class="nav__dropdown-item-dashboard nav__link-dashboard"><i class="fa fa-angle-right" aria-hidden="true"></i>Comprar Curso por Código de Empresa</a>

                                    <?php
                                    }
                                    ?>
                                    
                                    <!--//-->
                                    <a href="ListaCursos.php?pag=1" class="nav__dropdown-item-dashboard nav__link-dashboard"><i class="fa fa-angle-right" aria-hidden="true"></i>Cursos Publicados</a>


                                    
                                    <?php
                                    if ($_SESSION['privilegio'] != 1 && $_SESSION['privilegio'] != 2 && $_SESSION['privilegio'] != 6) {
                                    ?>

                                        

                                        


                                    <?php
                                    }else{
                                    ?>

                                        <!--//-->
                                        <a href="agregarcurso.php" class="nav__dropdown-item-dashboard nav__link-dashboard"><i class="fa fa-angle-right" aria-hidden="true"></i>Agregar Un Nuevo Curso</a>

                                        <!--//-->
                                        <a href="publicarcursos.php?pag=1" class="nav__dropdown-item-dashboard nav__link-dashboard"><i class="fa fa-angle-right" aria-hidden="true"></i>Cursos No Publicados</a>

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
                                <a alt="Empresas" class="nav__link-dashboard">
                                    <i class="fas fa-city" style="color:#7d83fc;"> </i>
                                    <span style="position: relative; left: -8px;" class="nav__name-dashboard">&nbsp;&nbsp; Empresas</span>
                                    <!-- <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i> -->
                                    <i class="fas fa-caret-down nav__icon-dashboard nav__dropdown-icon-dashboard"></i>
                                </a>
                                <div class="nav__dropdown-collapse-dashboard" style="background-color: #e0c7e5;">
                                    <!-- <div class="nav__dropdown-content-dashboard">

                                        <a href="Enterprise.php" class="nav__dropdown-item-dashboard nav__link-dashboard">Control de Empresas</a>
                                        <a href="#" class="nav__dropdown-item-dashboard nav__link-dashboard">Control de Empleados</a>

                                    </div> -->
                                    <div class="nav__dropdown-content-dashboard">

                                        <a href="curseEmp.php" class="nav__dropdown-item-dashboard nav__link-dashboard"><i class="fa fa-angle-right" aria-hidden="true"></i>Cursos para Empresas</a>
                                        <!-- <a href="#" class="nav__dropdown-item-dashboard nav__link-dashboard">Control de Empleados</a> -->

                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <?php
                            if ($_SESSION['privilegio'] == 1 || $_SESSION['privilegio'] == 2 || $_SESSION['privilegio'] == 6) {
                        ?>

                            <a style="position: relative; left: 12px;" href="reporteUsuario.php" class="nav__link-dashboard">
                                <i class="fas fa-clipboard nav__icon-dashboard" style="color:#7d83fc;"></i>
                                <span class="nav__name-dashboard">Reporte</span>
                            </a>

                        <?php
                            }else{
                        ?>

                        <?php
                            }
                        ?>

                        <a style="position: relative; left: 8px;" href="sidebarEditar.php" class="nav__link-dashboard">
                            <i class="fas fa-cog nav__icon-dashboard" style="color:#7d83fc;"></i>
                            <span class="nav__name-dashboard">Ajustes</span>
                        </a>

                        <a style="position: relative; left: 8px; margin-top: 10px;border-color: #7d83fc;" href="includes/login/logout.php" class="nav__link-dashboard nav__logout-dashboard">
                            <button style="background-color:#7d83fc; color:azure; height: 45px; width:80px; ">
                                <i class="fa fa-arrow-right nav__icon-dashboard" style="float: left;"></i><span class="nav__name-dashboard" style="float:left;">Salir </span>  
                            </button>
                        </a>

                        <img style="position: relative; top: 20px;" src="./assets/images/ilu_niño.png">

                    </div>
                </div>
            </div>

        </nav>
    </div>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"></script>-->
    <!--========== CONTENTS ==========-->
<?php
}else {
    header('Location: ../../iniciosesion.php');
}
?>