<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reestablecer</title>
  <!--<link rel="stylesheet" href="./assets/css/stylogin.css">-->
  <link rel="stylesheet" href="./assets/css/stylenewlogin.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="./assets/js/plugins/sweetalert2.min.css">
</head>


<?php

    require_once './database/databaseConection.php';
  
    if(empty($_GET['id'])){ 
        header('Location: index.php');
    }
    if(empty($_GET['token'])){
        header('Location: index.php');
    }

    $token = $_GET['token'];
    $id_user = $_GET['id'];

    $pdo = Database::connect();
    $sql = "SELECT estado FROM usuarios WHERE id_user = $id_user ;
    //$sql = "SELECT estado FROM usuarios WHERE id_user = $id_user AND token_password = '$token' AND password_request = 1 LIMIT 1";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $dato=$q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    if(is_array($dato)){
        if($dato['estado'] == 0){
            //echo $dato['actividad'];
            echo "<script>alert('No se pudo verificar los datos')</script>";
            header('Location: index.php');
        }        
    }else{
        echo "<script>alert('No se pudo verificar los datos')</script>";
        header('Location: index.php');
        exit;
    }


?>


<body>
  <br><br>
  <section class="Form my-4 mx-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
        <img src="./assets/images/—Pngtree—gradient fingerprint unlock login computer_5044947.png" class="img-fluid" alt="">
        </div>
        <div class="col-lg-6 px-5 pt-5">
          <a href="index.php">
            <img src="./assets/images/Logo.svg" class="logo-img" alt="image">
          </a>
          <h1 class="font-weight-bold py-3" style="font-weight: 900;">Cambiar contraseña!</h1>
          <!-- <h4>¡Que bueno verte de nuevo por aquí!</h4> -->
          <form id="cambiarpass" action="includes/login/checkcambiar.php" method="POST">

          <input type="hidden" id="user_id" name="user_id" value ="<?php echo $id_user; ?>" />							
          <input type="hidden" id="token" name="token" value ="<?php echo $token; ?>" />

          <div class="form-row">
              <div class="col-lg-7">
                <span> Ingresa tu contraseña: </span>
                <input type="password" name="pass_registrar" id="pass-registro" class="form-control my-3 p-2 cajita" placeholder="Contraseña" required />
              </div>
            </div>

            <div class="form-row">
              <div class="col-lg-7">
                <span> Repite tu contraseña: </span>
                <input type="password" name="pass-confirm_registrar" id="pass-confirm-registro" class="form-control my-3 p-2 cajita" placeholder="Repite la contraseña" required />
              </div>
            </div>

            <div class="form-row">
              <div class="col-lg-7">
                <button type="submit" class="btn1 mt-3 mb-5">Cambiar</button>
              </div>
            </div>
            <a href="iniciosesion.php">Iniciar sesion</a>
          </form>
        </div>
      </div>
    </div>
  </section>



  <?php
  if (isset($_SESSION['usuario'])) {
    echo "<script>
              document.getElementById('email-user-login').value='" . $_SESSION['usuario'] . "';
              document.getElementById('pass-login').focus();
            </script>";
  }
  ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
  <script src="./assets/js/plugins/sweetalert2.all.min.js"></script>
  <script src="./assets/js/validarLogin.js"></script>
  <script src="./assets/js/validarRecuperacion.js"></script>
</body>
