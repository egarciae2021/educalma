<!DOCTYPE html>
<html lang="es" class="h-100 w-100">

<head>
  <title>Registro | Educalma</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="assets/lib/bootstrap.min.css" />
  <script src="assets/lib/jquery.min.js"></script>
  <script src="assets/lib/popper.min.js"></script>
  <script src="assets/lib/bootstrap.min.js"></script>
  <link rel="stylesheet" href="assets/lib/fontawesome/css/all.css" />

  <style>
    @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap");

    * {
      font-family: 'Roboto', sans-serif;
    }

    #basic-addon2 {
      cursor: pointer;
    }
  </style>
</head>

<body class="h-100 w-100">
  <div class="row row-cols-1 row-cols-md-2 h-100 w-100 m-0">
    <div class="col h-md-100 bg-light row row-cols-1 m-0 p-5">
      <div class="col"></div>
      <div class="col mx-auto align-self-center" style="max-width: 400px">
        <div class="col-12 mb-5">
          <img style="max-width: 150px" src="assets/img/logo_educalma.svg" alt="Logo Educalma" />
        </div>
        <h5 class="col d-block">¡Únete y comienza a potenciar tu carrera!</h5>
        <form autocomplete="off" id="form_data">
          <div class="col-12 p-0" id="first-data">
            <div class="col my-3">
              <label for="txtEmail" id="lblEmail">Valida tu correo electrónico</label>
              <input type="email" class="form-control" id="txtEmail" required />
              <div class="invalid-feedback">
                <span id="correoMessage"></span>
              </div>
            </div>
            <div class="col my-3 d-none" id="passBox">
              <label for="txtPass">Crea tu contraseña</label>
              <div class="input-group">
                <input type="password" class="form-control" id="txtPass" required />
                <div class="input-group-append">
                  <span class="input-group-text" id="basic-addon2"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                </div>
              </div>
              <div class="invalid-feedback">
                <span>¡La contraseña debe tener al menos 8 carácteres!</span>
              </div>
            </div>
          </div>

          <!-- 1 de 1 -->
          <div class="col-12 p-0 d-none" id="second-data">
            <div class="col my-3">
              <h5 class="d-inline">Completa tus datos</h5>
              <span class="badge badge-secondary float-right p-2">1 de 2</span>
            </div>
            <!-- Nombres -->
            <div class="col my-3">
              <label for="txtNombres">Nombres</label>
              <input type="text" class="form-control" id="txtNombres" required />
            </div>
            <!-- Apellidos -->
            <div class="col my-3">
              <label for="txtAPaterno">Ap. paterno</label>
              <input type="text" class="form-control" id="txtAPaterno" required />
            </div>
            <div class="col my-3">
              <label for="txtAMaterno">Ap. materno</label>
              <input type="text" class="form-control" id="txtAMaterno" required />
            </div>
            <!-- Tipo de documento -->
            <div class="col my-3">
              <label for="cmbTDocumento">T. documento</label>
              <select id="cmbTDocumento" class="form-control">
                <option>Seleccionar</option>
                <option value="1">DNI</option>
                <option value="2">Pasaporte</option>
                <option value="3">Carnet Extranjería</option>
              </select>
            </div>
            <!-- Documento -->
            <div class="col my-3">
              <label for="txtDocumento">Documento</label>
              <input type="text" class="form-control" id="txtDocumento">
            </div>
          </div>

          <!-- 2 de 2 -->
          <div class="col-12 p-0 d-none" id="three-data">
            <div class="col my-3">
              <h5 class="d-inline">Completa tus datos</h5>
              <span class="badge badge-secondary float-right p-2">2 de 2</span>
            </div>
            <!-- F. Nacimiento -->
            <div class="col my-3">
              <label for="txtNacimiento">F. nacimiento</label>
              <input type="date" class="form-control" id="txtNacimiento" required>
            </div>
            <!-- Celular -->
            <div class="col my-3">
              <label for="txtCelular">Celular</label>
              <input type="tel" class="form-control" id="txtCelular" required>
            </div>
            <!-- Pais -->
            <div class="col my-3">
              <label for="cmbPais">Pais</label>
              <select id="cmbPais" class="form-control">
                <option>Seleccionar</option>
                <option value="1">Perú</option>
                <option value="2">Argentina</option>
              </select>
            </div>
            <!-- Genero -->
            <div class="col my-3">
              <label for="cmbGenero">Género</label>
              <select id="cmbGenero" class="form-control">
                <option>Seleccionar</option>
                <option value="1">Masculino</option>
                <option value="2">Femenino</option>
                <option value="3">No binario</option>
                <option value="4">Prefiero no decir</option>
              </select>
            </div>
          </div>

          <!-- Button -->
          <div class="col">
            <button class="col-12 btn btn-primary my-3" id="btnSubmit">CONTINUAR →</button>
          </div>
        </form>
      </div>
      <div class="col align-self-end p-5 text-center">
        <div class="d-inline-block border p-3 rounded">
          <span>¿Ya tienes cuenta?</span>
          <a id="toLogin" href="./iniciosesion.php">Inicia sesión aquí</a>
        </div>
      </div>
    </div>
    <div class="col h-100 p-0 overflow-hidden" style="
          background: url('./assets/img/image01.png');
          background-size: cover;
          background-position: 50%;
        "></div>
  </div>

  <script src="assets/js/registroUsuario.js"></script>
</body>

</html>