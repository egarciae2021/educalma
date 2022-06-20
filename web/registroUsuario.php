<!DOCTYPE html>
<html lang="es" class="h-100 w-100">

<head>
  <title>Registro | Educalma</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <link rel="stylesheet" href="assets/lib/bootstrap.min.css" />

<link rel="shortcut icon" href="assets/images/logo_edu.png">
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
    <!--<div class="col h-md-100 row row-cols-1 m-0 p-5" style="background: url('./assets/images/fondo1e_3.png'); background-size:100%; background-repeat: no-repeat;">-->
    <div class="col h-md-100 row row-cols-1 m-0 p-5" style="background: url('./assets/images/registrar_usuario.png'); background-size:cover; background-repeat: no-repeat;">
    <div class="col-12 mb-2">
          <center>
          <a href="./iniciosesion.php">
            <img style="max-width: 150px" src="assets/images/educalma-logo blanco.png" alt="Logo Educalma" />
          </a>
          </center>
        </div>
        <center>
      <div class="" style="padding:40px; border-radius:20px; padding-left:5px; padding-right:5px; max-width: 500px; background-color: white;">
      <div class="col h-auto mx-auto align-self-center" >
        
        <h4 class="col d-block" style="color: #683CFD;">¡Únete y comienza a potenciar tu carrera!</h4>
        <form autocomplete="off" id="form_data" >
          <div class="col-12 p-0" id="first-data">
            <div class="col my-3">
              <label for="txtEmail" id="lblEmail" style="color: #744DFA; float:left;">Valida tu correo electrónico</label>
              <input type="email" class="form-control" id="txtEmail" autocomplete="off" required />
              <div class="invalid-feedback">
                <span id="correoMessage"></span>
              </div>
            </div>
            <div class="col my-3 d-none" id="passBox">
              <label for="txtPass" style="float:left;">Crea tu contraseña</label>
              <div class="input-group">
                <input type="password" class="form-control" id="txtPass" required />
                <div class="input-group-append">
                  <span class="input-group-text" id="basic-addon2"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                </div>
                <div class="invalid-feedback">
                  <span>¡La contraseña debe tener al menos 8 carácteres, una mayúscula, una minúscula y un número!</span>
                </div>
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
              <label for="txtNombres" style="float:left;">Nombres</label>
              <input type="text" class="form-control" id="txtNombres" required />
              <div class="invalid-feedback">
                <span>¡Este es un campo requerido!</span>
              </div>
            </div>
            <!-- Apellidos -->
            <div class="col my-3">
              <label for="txtAPaterno" style="float:left;">Ap. paterno</label>
              <input type="text" class="form-control" id="txtAPaterno" required />
              <div class="invalid-feedback">
                <span>¡Este es un campo requerido!</span>
              </div>
            </div>
            <div class="col my-3">
              <label for="txtAMaterno" style="float:left;">Ap. materno</label>
              <input type="text" class="form-control" id="txtAMaterno" required />
              <div class="invalid-feedback">
                <span>¡Este es un campo requerido!</span>
              </div>
            </div>
            <!-- Tipo de documento -->
            <div class="col my-3">
              <label for="cmbTDocumento" style="float:left;">T. documento</label>
              <select id="cmbTDocumento" class="form-control">
                <option value="">Seleccionar</option>
                <option value="1">DNI</option>
                <option value="2">Pasaporte</option>
                <option value="3">Carnet Extranjería</option>
              </select>
              <div class="invalid-feedback">
                <span>¡Este es un campo requerido!</span>
              </div>
            </div>
            <!-- Documento -->
            <div class="col my-3">
              <label for="txtDocumento" style="float:left;">Documento</label>
              <input type="number" class="form-control" id="txtDocumento">
              <div class="invalid-feedback">
                <span>¡Este es un campo requerido!</span>
              </div>
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
              <label for="txtNacimiento" style="float:left;">F. nacimiento</label>
              <input type="date" class="form-control" id="txtNacimiento" required>
              <div class="invalid-feedback">
                <span>¡Debe ser mayor de 18 años!</span>
              </div>
            </div>

            <!-- Pais -->
            <div class="col my-3">
              <label for="cmbPais" style="float:left;">Pais</label>
              <select id="cmbPais" class="form-control">
                <option value="">Seleccionar</option>
                <?php
                
                $paises = array("Afganistán", "Albania", "Alemania", "Andorra", "Angola", "Antigua y Barbuda", "Arabia Saudita", "Argelia", "Argentina", "Armenia", "Australia", "Austria", "Azerbaiyán", "Bahamas", "Bangladés", "Barbados", "Baréin", "Bélgica", "Belice", "Benín", "Bielorrusia", "Birmania", "Bolivia", "Bosnia y Herzegovina", "Botsuana", "Brasil", "Brunéi", "Bulgaria", "Burkina Faso", "Burundi", "Bután", "Cabo Verde", "Camboya", "Camerún", "Canadá", "Catar", "Chad", "Chile", "China", "Chipre", "Ciudad del Vaticano", "Colombia", "Comoras", "Corea del Norte", "Corea del Sur", "Costa de Marfil", "Costa Rica", "Croacia", "Cuba", "Dinamarca", "Dominica", "Ecuador", "Egipto", "El Salvador", "Emiratos Árabes Unidos", "Eritrea", "Eslovaquia", "Eslovenia", "España", "Estados Unidos", "Estonia", "Etiopía", "Filipinas", "Finlandia", "Fiyi", "Francia", "Gabón", "Gambia", "Georgia", "Ghana", "Granada", "Grecia", "Guatemala", "Guyana", "Guinea", "Guinea ecuatorial", "Guinea-Bisáu", "Haití", "Honduras", "Hungría", "India", "Indonesia", "Irak", "Irán", "Irlanda", "Islandia", "Islas Marshall", "Islas Salomón", "Israel", "Italia", "Jamaica", "Japón", "Jordania", "Kazajistán", "Kenia", "Kirguistán", "Kiribati", "Kuwait", "Laos", "Lesoto", "Letonia", "Líbano", "Liberia", "Libia", "Liechtenstein", "Lituania", "Luxemburgo", "Madagascar", "Malasia", "Malaui", "Maldivas", "Malí", "Malta", "Marruecos", "Mauricio", "Mauritania", "México", "Micronesia", "Moldavia", "Mónaco", "Mongolia", "Montenegro", "Mozambique", "Namibia", "Nauru", "Nepal", "Nicaragua", "Níger", "Nigeria", "Noruega", "Nueva Zelanda", "Omán", "Países Bajos", "Pakistán", "Palaos", "Palestina", "Panamá", "Papúa Nueva Guinea", "Paraguay", "Perú", "Polonia", "Portugal", "Reino Unido", "República Centroafricana", "República Checa", "República de Macedonia", "República del Congo", "República Democrática del Congo", "República Dominicana", "República Sudafricana", "Ruanda", "Rumanía", "Rusia", "Samoa", "San Cristóbal y Nieves", "San Marino", "San Vicente y las Granadinas", "Santa Lucía", "Santo Tomé y Príncipe", "Senegal", "Serbia", "Seychelles", "Sierra Leona", "Singapur", "Siria", "Somalia", "Sri Lanka", "Suazilandia", "Sudán", "Sudán del Sur", "Suecia", "Suiza", "Surinam", "Tailandia", "Tanzania", "Tayikistán", "Timor Oriental", "Togo", "Tonga", "Trinidad y Tobago", "Túnez", "Turkmenistán", "Turquía", "Tuvalu", "Ucrania", "Uganda", "Uruguay", "Uzbekistán", "Vanuatu", "Venezuela", "Vietnam", "Yemen", "Yibuti", "Zambia", "Zimbabue");
                foreach ($paises as $posicion => $pais) {
                  $posicion = $posicion + 1;
                  echo '<option value="' . $pais . '">' . $pais . '</option>';
                }
                
                ?>
              </select>
              <div class="invalid-feedback">
                <span>¡Este es un campo requerido!</span>
              </div>
            </div>

            <!-- Celular -->
            <div class="col my-3">
              <label for="txtCelular" style="float:left;">Celular</label>
              <input type="number" class="form-control" id="txtCelular">
              <div class="invalid-feedback">
                <span>¡Este es un campo requerido!</span>
              </div>
            </div>
            
            <!-- Genero -->
            <div class="col my-3">
              <label for="cmbGenero" style="float:left;">Género</label>
              <select id="cmbGenero" class="form-control">
                <option value="">Seleccionar</option>
                <option value="1">Masculino</option>
                <option value="2">Femenino</option>
                <option value="3">No binario</option>
                <option value="4">Prefiero no decir</option>
              </select>
              <div class="invalid-feedback">
                <span>¡Este es un campo requerido!</span>
              </div>
            </div>
            
            <!-- Codigo Empresa -->
            <div class="col my-3" hidden multiple>
              <label for="txtcodigo" style="float:left;">Codigo Emp.</label>
              <input type="text" style="display: block; width: 100%; height:calc(1.5em + .75rem + 2px); padding: 0.375rem 0.75rem; font-size: 1rem; font-weight: 400; line-height: 1.5; background-clip: padding-box; border: 1px solid #ced4da; border-radius: 0.25rem; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out" id="txtcode" placeholder="Ingrese el codigo de su empresa" />
            </div>

          </div>

          <!-- Button -->
          <div class="col">
            <button class="col-12 btn btn-primary my-3" id="btnSubmit" style="background-color: #EBCB70;border: none;">CONTINUAR →</button>
          </div>
        </form>
      </div>
      <div class="col align-self-end pt-5 text-center">
        <div class="d-inline-block border p-3 rounded">
          <span style="color: #5FBBEF;">¿Ya tienes cuenta?</span>
          <a id="toLogin" href="./iniciosesion.php">Inicia sesión aquí</a>
        </div>
      </div>
    </div>
    </div>
    </center>
    <div class="col h-100 p-0 overflow-hidden" style="
          background: url('./assets/img/logo-inicio.png');
          background-size: 60%;
          background-repeat: no-repeat;
          background-position: 50%;
        "></div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="regSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¡Registro éxitoso!</h5>
        </div>
        <div class="modal-body">
          Inicie sesión, por favor.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="btnTogoLogin">Ir</button>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/js/Validator.js"></script>
  <script src="assets/js/registroUsuario.js"></script>
</body>

</html>
