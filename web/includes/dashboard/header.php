<?php
ob_start();
@session_start();
?>

<header>


  <div class="btn-toggle" id="btnToggle">
    <a href="#">
      <i class="fas fa-bars"></i>
    </a>
  </div>
  <div class="group-items">
    <a href="#">
      <img src="./assets/images/logo.educalma.svg" alt="Logo Educalma" />
    </a>
    <?php
    if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true) {
      require_once 'database/databaseConection.php';
      $pdo = Database::connect();
      $sql = "SELECT * FROM usuarios WHERE id_user = '$_SESSION[codUsuario]'";
      $q = $pdo->prepare($sql);
      $q->execute(array());
      $dato = $q->fetch(PDO::FETCH_ASSOC);
      Database::disconnect();
    ?>
      <div class="group-tools">
        <div class="group-icons">

          <div class="dropdown">
            <!-- Nombre usuario 1/2 -->
            <div class="info-user" id="infoUser">
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
            </div>
            <div class="icon" id="iconUser"><i class="fas fa-user"></i></div>
            <div class="main-data" id="mainData">
              <ul>
                <!-- Nombre usuario 2/2-->
                <div class="info-user">
                  <span>Lorenzo G.</span>
                  <span class="type">Administrador</span>
                </div>
                <div class="separator"></div>
                <li><i class="fas fa-cog"></i>Ajustes</li>
                <li><i class="fas fa-question-circle"></i>Ayuda</li>
                <div class="separator"></div>
                <a align="center" style="text-decoration: none;" href="includes/login/logout.php">
                  <li>Salir</li>
                </a>
              </ul>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
</header>
<div class="main-context" id="mainContex">
  <ul>
    <li>
      <a href="">
        <i class="fas fa-chart-pie"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li>
      <a href="sidebarCursos.php">
        <i class="fas fa-swatchbook"></i>
        <span>Mis cursos</span>
      </a>
    </li>
    <li>
      <a href="agregarcurso.php">
        <i class="fas fa-hand-holding-heart"></i>
        <span>Donar cursos</span>
      </a>
    </li>
    <li>
      <a href="agregarCategorias.php">
        <i class="fas fa-plus-circle"></i>
        <span>Nueva categoria</span>
      </a>
    </li>
    <li>
      <a href="sidebarEditar.php">
        <i class="fas fa-user"></i>
        <span>Cuenta</span>
      </a>
    </li>
    <li>
      <a href="includes/login/logout.php">
        <i class="fas fa-sign-out-alt"></i>
        <span>Log out</span>
      </a>
    </li>
    <li>
      <a href="index.php">
        <i class="fas fa-arrow-left"></i>
        <span>Inicio</span>
      </a>
    </li>
  </ul>
</div>