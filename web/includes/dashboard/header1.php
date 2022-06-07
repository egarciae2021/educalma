<?php
ob_start();
@session_start();
?>


<header class="header" style="background-color:#737BF1;">

    <div class="header__container">
        <?php
        if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true) {
            require_once 'database/databaseConection.php';
            $pdo = Database::connect();
            $iduser = $_SESSION['codUsuario'];
            $sql = "SELECT * FROM usuarios WHERE id_user = '$iduser'";
            $q = $pdo->prepare($sql);
            $q->execute(array());
            $dato = $q->fetch(PDO::FETCH_ASSOC);
            Database::disconnect();
        ?>
        

        <?php    
            if($dato['mifoto']!=null){
        ?>
                <!--img src="data:image/*;base64,<?php echo base64_encode($dato['mifoto']); ?>" class=" header__img" alt="foto_curso"--> 
        <?php
            }else{
        ?>
                <!--img src="./assets/images/user.png" class=" header__img" alt="foto_curso"-->
        <?php
            }
        ?>
            
            <a href="#" class="header__logo">
                <?php
                if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true) {
                    
                    ?>
                     
                    <!--Administrador-->
                    <?php if ($_SESSION['privilegio'] == 1) {?>

                        <img src="./assets/img/user-admi.jpg" class="header__img" cellspacing="0" width="auto" alt="foto_curso">
               
                    <?php } ?>

                    <!--Profesor-->
                    <?php if ($_SESSION['privilegio'] == 2) {?>

                        <img src="./assets/img/user-prof.png" class="header__img" cellspacing="0" width="auto" alt="foto_curso">

                    <?php } ?>

                    <!--Usuario Normal-->
                    <?php if ($_SESSION['privilegio'] == 3) {?>

                        <img src="./assets/img/user-user.png" class="header__img" cellspacing="0" width="auto" alt="foto_curso">
                        
                    <?php } ?>

                    <!--Empresa-->
                    <?php if ($_SESSION['privilegio'] == 4) {?>

                        <img src="./assets/img/user-emp.png" class="header__img" cellspacing="0" width="auto" alt="foto_curso">

                    <?php } ?>

                    <!--Usuario - Empresa-->
                    <?php if ($_SESSION['privilegio'] == 5) {?>

                        <img src="./assets/img/user-emp.png" class="header__img" cellspacing="0" width="auto" alt="foto_curso">
                       
                    <?php } ?>

                    <!--Superadmin-->
                    <?php if ($_SESSION['privilegio'] == 6) {?>

                        <img src="./assets/img/user-sup-admin.png" class="header__img" cellspacing="0" width="auto" alt="foto_curso">

                    <?php } ?>




                    <?php   

                    
                } else {
                    echo '';
                }
                ?>
            </a>
        <?php
        }
        ?>
        <div class="header__toggle">
            <i class="fas fa-bars" id="header-toggle"></i>
        </div>
    </div>
</header>
