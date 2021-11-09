<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicia Sesión</title>
  <link rel="stylesheet" href="./assets/css/stylogin.css">
</head>

<body>
  <section>
    <div class="contenedor">
      <div class="contenedor-contenido">
        <div class="contenedor-formulario">
          <h1>Bienvenido de nuevo!</h1>
          <h3>¡Qué bueno verte de nuevo por aquí!</h3>
          <form id="form_login" role="form" action="includes/login/checklogin.php" onsubmit="cargando()" method="POST">
            <div class="input">
              <span> Ingresa tu correo </span>
              <input type="email" name="email_user_login" id="email-user-login" class="correo" placeholder="Correo" required />
            </div>
            <div class="input">
              <span> Ingresa tu contraseña </span>
              <input type="password" name="pass_login" id="pass-login" class="contraseña" placeholder="Contraseña" required />
            </div>
            <div class="button-left">
              <button type="submit">Ingresar</button>
            </div>

            <div class="links">
              <div class="link-internal">
                <a href="#">¿Olvidaste tu Contraseña?</a>
              </div>
              <span class="text-center">
                ¿Aún no tienes cuenta?
              </span>
              <div class="link-internal">
                <a href="registros.php">Registrarse</a>
              </div>

            </div>

          </form>
        </div>
      </div>
      <div class="contenedor-img">
        <img src="./assets/images/1fa3.jpg" alt="">
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
</body>
