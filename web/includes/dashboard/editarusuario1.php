<div class="container-contformulario">
    <?php


    $pdo2 = Database::connect();
    $veri2 = "SELECT * FROM usuarios WHERE id_user = '$id' ";
    $q2 = $pdo2->prepare($veri2);
    $q2->execute(array());
    $dato2 = $q2->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    ?>
    <div class="contformulario" id="contformulario">
        <div class="row">
            <div class="image">
                <img src="./assets/images/perfilimg.png" alt="">
            </div>
            <form action="includes/usersidebar/actualizar_perfil.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                <div class="inputBox">
                    <h3>Nombre</h3>
                    <input type="text" id="Nombre" name="Nombre" value="<?php echo $dato2['nombres']; ?>">
                </div>
                <div class="inputBox">
                    <h3>Apellido Paterno</h3>
                    <input type="text" id="Apellidop" name="Apellido_Paterno" value="<?php echo $dato2['apellido_pat']; ?>">
                </div>
                <div class="inputBox">
                    <h3>Apellido Materno</h3>
                    <input type="text" id="Apellidom" name="Apellido_Materno" value="<?php echo $dato2['apellido_mat']; ?>">
                </div>
                <div class="inputBox">
                    <h3>Pa&iacute;s</h3>
                    <!-- <input type="text" id="Pais" name="pais" value="<?php # echo $dato2['pais']; ?>"> -->
                    <select id="cmbPais" name="pais" class="form-control">
                        <option value="">Seleccionar</option>
                        <?php
                        
                        $paises = array("Afganistán", "Albania", "Alemania", "Andorra", "Angola", "Antigua y Barbuda", "Arabia Saudita", "Argelia", "Argentina", "Armenia", "Australia", "Austria", "Azerbaiyán", "Bahamas", "Bangladés", "Barbados", "Baréin", "Bélgica", "Belice", "Benín", "Bielorrusia", "Birmania", "Bolivia", "Bosnia y Herzegovina", "Botsuana", "Brasil", "Brunéi", "Bulgaria", "Burkina Faso", "Burundi", "Bután", "Cabo Verde", "Camboya", "Camerún", "Canadá", "Catar", "Chad", "Chile", "China", "Chipre", "Ciudad del Vaticano", "Colombia", "Comoras", "Corea del Norte", "Corea del Sur", "Costa de Marfil", "Costa Rica", "Croacia", "Cuba", "Dinamarca", "Dominica", "Ecuador", "Egipto", "El Salvador", "Emiratos Árabes Unidos", "Eritrea", "Eslovaquia", "Eslovenia", "España", "Estados Unidos", "Estonia", "Etiopía", "Filipinas", "Finlandia", "Fiyi", "Francia", "Gabón", "Gambia", "Georgia", "Ghana", "Granada", "Grecia", "Guatemala", "Guyana", "Guinea", "Guinea ecuatorial", "Guinea-Bisáu", "Haití", "Honduras", "Hungría", "India", "Indonesia", "Irak", "Irán", "Irlanda", "Islandia", "Islas Marshall", "Islas Salomón", "Israel", "Italia", "Jamaica", "Japón", "Jordania", "Kazajistán", "Kenia", "Kirguistán", "Kiribati", "Kuwait", "Laos", "Lesoto", "Letonia", "Líbano", "Liberia", "Libia", "Liechtenstein", "Lituania", "Luxemburgo", "Madagascar", "Malasia", "Malaui", "Maldivas", "Malí", "Malta", "Marruecos", "Mauricio", "Mauritania", "México", "Micronesia", "Moldavia", "Mónaco", "Mongolia", "Montenegro", "Mozambique", "Namibia", "Nauru", "Nepal", "Nicaragua", "Níger", "Nigeria", "Noruega", "Nueva Zelanda", "Omán", "Países Bajos", "Pakistán", "Palaos", "Palestina", "Panamá", "Papúa Nueva Guinea", "Paraguay", "Perú", "Polonia", "Portugal", "Reino Unido", "República Centroafricana", "República Checa", "República de Macedonia", "República del Congo", "República Democrática del Congo", "República Dominicana", "República Sudafricana", "Ruanda", "Rumanía", "Rusia", "Samoa", "San Cristóbal y Nieves", "San Marino", "San Vicente y las Granadinas", "Santa Lucía", "Santo Tomé y Príncipe", "Senegal", "Serbia", "Seychelles", "Sierra Leona", "Singapur", "Siria", "Somalia", "Sri Lanka", "Suazilandia", "Sudán", "Sudán del Sur", "Suecia", "Suiza", "Surinam", "Tailandia", "Tanzania", "Tayikistán", "Timor Oriental", "Togo", "Tonga", "Trinidad y Tobago", "Túnez", "Turkmenistán", "Turquía", "Tuvalu", "Ucrania", "Uganda", "Uruguay", "Uzbekistán", "Vanuatu", "Venezuela", "Vietnam", "Yemen", "Yibuti", "Zambia", "Zimbabue");
                        foreach ($paises as $posicion => $pais) {
                        $posicion = $posicion + 1;?>
                        <option value="<?php echo $pais; ?>" <?php if($pais == $dato2['pais']){echo 'selected';};?>><?php echo $pais; ?></option>
                        
                        <?php };?>
                    </select>
                </div>
                <div class="inputBox">
                    <h3>Correo</h3>
                    <input type="email" id="Correo" name="Correo" value="<?php echo $dato2['email']; ?>">
                </div>
                <div class="inputBox">
                    <h3>Password</h3>
                    <input type="hidden" id="cuentaEmail1" value='<?php echo $dato2['email'] ?>' readonly>
                    <input type="Button" class="btn" style="margin-top: 0;" onclick="actualizarPass();" value="Cambiar">
                    <!-- <input type="password" id="Password" name="pass" value="<php echo $dato2['pass']; ?>"> -->
                </div>
                <div class="inputBox">
                    <h3>Tel&eacute;fono</h3>
                    <input type="number" id="Telefono" name="telefono" value="<?php echo $dato2['telefono']; ?>">
                </div>
                <div class="inputBox">
                    <h3>Tipo de documento</h3>
                    <select class="seleccionador" name="tipo_doc" id="Tipod">
                        <option value="1" <?php if(1 == $dato2['tipo_doc']){echo 'selected';};?>>DNI</option>
                        <option value="2" <?php if(2 == $dato2['tipo_doc']){echo 'selected';};?>>Pasaporte</option>
                        <option value="3" <?php if(3 == $dato2['tipo_doc']){echo 'selected';};?>>Carné extranjería</option>
                        <?php if ($_SESSION['privilegio']!=3) { ?>
                        <option value="4" <?php if(4 == $dato2['tipo_doc']){echo 'selected';};?>>RUC</option>
                        <?php } ?>
                    </select>
                    <!-- <input type="text"> -->
                </div>
                <div class="inputBox">
                    <h3>Numero de identidad</h3>
                    <input type="number" id="Numero" name="nume_documento" value="<?php echo $dato2['nro_doc']; ?>">
                </div>
                <div class="inputBox">
                    <h3>Tipo de sexo</h3>
                    <select class="seleccionador" name="sexo" id="Tipos">
                        <option value="1" <?php if(1 == $dato2['sexo']){echo 'selected';};?>>Mujer</option>
                        <option value="2" <?php if(2 == $dato2['sexo']){echo 'selected';};?>>Hombre</option>
                        <option value="3" <?php if(3 == $dato2['sexo']){echo 'selected';};?>>Otros... </option>
                    </select>
                    <!-- <input type="text"> -->
                </div>
                <div class="inputBox">
                    <h3>Fecha de Nacimiento</h3>
                    <input type="date" id="Fecha" name="fecha_naci" value="<?php echo $dato2['fecha_nacimiento']; ?>">
                </div>
                <div class="inputBox">
                    <h3>Inserta tu foto</h3>
                    <div class="column" style="margin:auto;">
                        <label for="inputGroupFile04" class="subir btn" style="margin-top: 0;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="input-icon" viewBox="0 0 640 512">
                                <path d="M144 480C64.47 480 0 415.5 0 336C0 273.2 40.17 219.8 96.2 200.1C96.07 197.4 96 194.7 96 192C96 103.6 167.6 32 256 32C315.3 32 367 64.25 394.7 112.2C409.9 101.1 428.3 96 448 96C501 96 544 138.1 544 192C544 204.2 541.7 215.8 537.6 226.6C596 238.4 640 290.1 640 352C640 422.7 582.7 480 512 480H144zM223 263C213.7 272.4 213.7 287.6 223 296.1C232.4 306.3 247.6 306.3 256.1 296.1L296 257.9V392C296 405.3 306.7 416 320 416C333.3 416 344 405.3 344 392V257.9L383 296.1C392.4 306.3 407.6 306.3 416.1 296.1C426.3 287.6 426.3 272.4 416.1 263L336.1 183C327.6 173.7 312.4 173.7 303 183L223 263z"/>
                            </svg>Inserta tu foto
                        </label>
                        <style>
                            .column label{
                                position: relative;
                                text-align: center;
                                color: black;
                                width: 60%;
                                height: 56%;
                                margin-top: 0;
                            }
                            .input-icon{
                                color: #191919;
                                position: absolute;
                                width: 17px;
                                height: 17px;
                                left: 30px;
                                top: 50%;
                                transform: translateY(-50%);
                            }
                        </style>
                        <input type="file" name="imagen" accept="image/*" id="inputGroupFile04" onchange="cambiarImg()" aria-describedby="inputGroupFileAddon04" style="display: none;" aria-label="Upload" ; multiple>

                    </div>
                    <div class="column" style="margin:auto;">
                        <div id="infoImg"></div>
                    </div>
                </div>
                <input type="submit" class="btn" value="Actualizar">
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="./assets/js/plugins/sweetalert2.all.min.js"></script>
<script src="./assets/js/Validator.js"></script>
<script src="./assets/js/sidebarEditar.js"></script>
<script src="./assets/js/validarRecuperacion.js"></script>