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
        

            
            <a href="#" class="header__logo">
                <?php
                if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true) {
                    
                    ?>
                     
                    <!--Administrador-->
                    <?php if ($_SESSION['privilegio'] == 1) {?>

<<<<<<< HEAD
                        <img src="./assets/img/user-user.png" class="header__img" cellspacing="0" width="auto" alt="foto_curso">
=======
                        <img src="./assets/img/user-admi.jpg" class="header__img" cellspacing="0" width="auto" alt="foto_curso">
>>>>>>> 0f0c814ea2e92f9c9114d3dd896520cec5d6c9b0
               
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
