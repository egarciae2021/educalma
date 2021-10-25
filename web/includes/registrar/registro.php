<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>registrar</title>
  <link rel="stylesheet" href="./assets/css/styregistro2.css">
  <link rel="stylesheet" href="./assets/js/plugins/sweetalert2.min.css">
  <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
</head>

<body>
<section>
  <div class="contenedor">
    <div class="contenedor-contenido">
      <div class="contenedor-formulario">
        <h1>¡Bienvenido a EduCalma!</h1>
        <h3>¡Estamos encantados de verte!</h3>

        <form id="form_registro" role="form"  method="POST" enctype="multipart/form-data">
          <div class="input">
            <div class="image-view" id="searchImage">
              <img id="imgView">
              <span>Arrastra foto aquí</span>
            </div>
            <!-- Foto -->
            <input type="file" name="imagen" accept="image/*">
            <span class="message"></span>
          </div>
          <!-- Nombres -->
          <div class="input">
            <span>Nombres</span>
            <input type="text" name="nombres_registrar" placeholder="Nombres" required>
          </div>
          <div class="two-row-input">
            <!-- A. paterno -->
            <div class="input">
              <span> Ap. paterno</span>
              <input type="text" name="apellidoPat_registrar" placeholder="Apellido paterno" required>
            </div>
            <!-- A. materno -->
            <div class="input">
              <span> Ap. materno</span>
              <input type="text" name="apellidoMat_registrar" placeholder="Apellido materno" required>
            </div>
          </div>
          <!-- Correo -->
          <div class="input">
            <span>Correo</span>
            <input type="email" name="email_user_registrar" placeholder="Ejemplo: example@dominio.com" required>
            <span class="message">El correo no es válido</span>
          </div>
          <div class="two-row-input">
            <!-- T. documento -->
            <div class="input">
              <span>T. documento</span>
              <select name="tipo_documento">
                <option value="0">Seleccionar</option>
                <option value="1">DNI</option>
                <option value="2">Pasaporte</option>
                <option value="3">Carnet Extranjería</option>
              </select>
              <span class="message">Seleccione un elemento</span>
            </div>
            <!-- Documento -->
            <div class="input">
              <span>Documento</span>
              <input type="text" name="num_docu_registrar" placeholder="Nro documento" required>
            </div>
          </div>
          <div class="three-row-input">
            <!-- F. nacimiento -->
            <div class="input">
              <span>F. nacimiento</span>
              <input type="date" name="fecha_registrar" placeholder="dd/mm/yyyy" required>
            </div>
            <!-- Pais -->
            <div class="input">
              <span>País</span>
              <select name="pais_registrar">
                <option value="0">Seleccionar</option>
                <option value="1">Perú</option>
                <option value="2">Argentina</option>
              </select>
              <span class="message">Seleccione un elemento</span>
            </div>
            <!-- Género -->
            <div class="input">
              <span> Género </span>
              <select name="sexo">
                <option value="0">Seleccionar</option>
                <option value="1">Masculino</option>
                <option value="2">Femenino</option>
                <option value="3">No binario</option>
                <option value="4">Prefiero no decir</option>
              </select>
              <span class="message">Seleccione un elemento</span>
            </div>
          </div>
          <!-- Celular -->
          <div class="input">
            <span>Celular</span>
            <input type="tel" name="telef_registrar" placeholder="Nro celular" required>
          </div>
          <!-- Nueva contraseña -->
          <div class="input">
            <span>Nueva contraseña</span>
            <input type="password" name="pass_registrar" id="txtPass" placeholder="Introducir contraseña" required>
            <div class="nivel">
              <ul>
                <li class="min8">Mínimo 8 carácteres</li>
                <li class="men-may">Al menos una mayúscula</li>
                <li class="men-min">Al menos una minúscula</li>
                <li class="men-num">Al menos un número</li>
                <li class="men-car">Al menos un carácter especial ( ! # $ * + : ; <> )</li>
              </ul>
            </div>
          </div>
          <!-- Repetir contraseña -->
          <div class="input">
            <span>Repetir contraseña</span>
            <input type="password" id="txtRepPass" placeholder="Repetir contraseña" required>
            <span class="message">La contraseña no coincide</span>
          </div>
          <!-- Button Registrarse -->
          <div class="button-center">
            <button type="submit">Registrarse</button>
          </div>

          <span class="text-center">
            ¿Ya estás registrado?
          </span>
          <div class="links">
            <div class="link-internal">
              <!-- Enlace a Login -->
              <a href="iniciosesion.php">Iniciar Sesión</a>
            </div>
          </div>
        </form>
      </div>
    </div></div>
  </div>
</section>
<script src="./assets/js/registro.js"></script>
<script src="./assets/js/validarRegistro.js"></script>
<script src="./assets/js/plugins/sweetalert2.all.min.js"> </script>
</body>