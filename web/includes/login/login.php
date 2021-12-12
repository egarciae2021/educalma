<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicia Sesión</title>
  <!--<link rel="stylesheet" href="./assets/css/stylogin.css">-->
  <link rel="stylesheet" href="./assets/css/stylenewlogin.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
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
          <h1 class="font-weight-bold py-3" style="font-weight: 900;">Bienvenido de nuevo!</h1>
          <h4>¡Que bueno verte de nuevo por aquí!</h4>
          <form id="form_login" action="includes/login/checklogin.php" method="POST">
            <div class="form-row">
              <div class="col-lg-7">
                <span> Ingresa tu correo: </span>
                <input type="email" name="email_user_login" id="email-user-login" class="form-control my-3 p-2 cajita" placeholder="Correo" required />
              </div>
            </div>
            <div class="form-row">
              <div class="col-lg-7">
                <span> Ingresa tu contraseña: </span>
                <input type="password" name="pass_login" id="pass-login" class="form-control my-3 p-2 cajita" placeholder="Contraseña" required />
              </div>
            </div>
            <div class="form-row">
              <div class="col-lg-7">
                <button type="submit" class="btn1 mt-3 mb-5">Ingresar</button>
              </div>
            </div>
            <a href="recuperar.php">¿Olvidaste tu Contraseña?</a>
            <br>
            <p class="parr">¿Aún no tienes cuenta?</p><a href="registros.php" class="links">Registrarse</a>
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
  <script src="./assets/js/validarLogin.js"></script>
</body>