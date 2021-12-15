<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicia Sesión</title>
  <!--<link rel="stylesheet" href="./assets/css/stylogin.css">-->
  <link rel="stylesheet" href="./assets/css/stylenewlogin.css">
  <link rel="stylesheet" href="./assets/js/plugins/sweetalert2.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="container" style="height: 100vh;">
    <div class="row">
      <div class="col-lg-6">
        <img src="./assets/images/login.jpg" class="img-fluid" alt="">
      </div>
      <div class="col-lg-6 container-formulario">
        <a href="index.php">
          <img src="./assets/images/Logo.svg" class="logo-img" alt="image">
        </a>
        <h1 class="font-weight-bold py-3">Bienvenido de nuevo!</h1>
        <form id="form_login" action="includes/login/checklogin.php" method="POST">
          <div class="form-group">
            <label for="email">Ingresa tu correo: </label>
            <input type="email" name="email_user_login" id="email-user-login" class="form-control" placeholder="Correo" required />
          </div>
          <div class="form-group">
            <label for="password">Ingresa tu contraseña: </label>
            <input type="password" name="pass_login" id="pass-login" class="form-control" placeholder="Contraseña" required />
          </div>
          <div class="form-group my-5">
            <button type="submit" class="btn btn-primary w-100">INGRESAR</button>
          </div>
          <div class="form-group my-3" style="text-align: center;">
            <a href="recuperar.php">¿Olvidaste tu Contraseña?</a>
            <br>
            <p class="parr mr-2">¿Aún no tienes cuenta?</p><a href="registros.php" class="links">Registrarse</a>
          </div>


        </form>
      </div>
    </div>
  </div>


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
  <script src="assets/js/plugins/sweetalert2.all.min.js"></script>
</body>