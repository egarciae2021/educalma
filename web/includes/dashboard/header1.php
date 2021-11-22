<?php
ob_start();
@session_start();
?>


<header class="header">
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
            <img src="data:image/*;base64,<?php echo base64_encode($dato['mifoto']); ?>" class=" header__img" alt="foto_curso">
            <a href="#" class="header__logo">
                <?php
                if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true) {
                    echo $_SESSION['nombres'];
                    if ($_SESSION['privilegio'] == 1) {
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
                    echo "<center>" . $privilegioNombre;
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
