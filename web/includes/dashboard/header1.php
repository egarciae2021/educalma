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
            
            <a href="#" class="header__logo" style="color:white; padding-left:500px;">
                <?php
                if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true) {
                    echo $_SESSION['nombres'];
                    ?>
                    &nbsp; <img src="./assets/img/user-admi.jpg" class=" header__img" alt="foto_curso">


                    <!--if ($_SESSION['privilegio'] == 1) {
                        $privilegioNombre = 'Administrador';
                    } else if ($_SESSION['privilegio'] == 2) {
                        $privilegioNombre = 'Profesor';
                    } else if ($_SESSION['privilegio'] == 3) {
                        $privilegioNombre = 'normal';
                    } else if ($_SESSION['privilegio'] == 4) {
                        $privilegioNombre = 'empresa';
                    } else if ($_SESSION['privilegio'] == 5) {
                        $privilegioNombre = 'user';
                    } else if ($_SESSION['privilegio'] == 6) {
                        $privilegioNombre = 'superadmin';
                    }
                    echo "<center>" . $privilegioNombre;-->

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
