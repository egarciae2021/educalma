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
                    <input type="password" id="Password" name="pass" value="<?php echo $dato2['pass']; ?>">
                </div>
                <div class="inputBox">
                    <h3>Tel&eacute;fono</h3>
                    <input type="tel" id="Telefono" name="telefono" value="<?php echo $dato2['telefono']; ?>" maxlength="10">
                </div>
                <div class="inputBox">
                    <h3>Tipo de documento</h3>
                    <select class="seleccionador" name="tipo_doc" id="Tipod">
                        <option value="1" <?php if(1 == $dato2['tipo_doc']){echo 'selected';};?>>DNI</option>
                        <option value="2" <?php if(2 == $dato2['tipo_doc']){echo 'selected';};?>>Pasaporte</option>
                        <option value="3" <?php if(3 == $dato2['tipo_doc']){echo 'selected';};?>>Carné extranjería</option>
                        <option value="4" <?php if(4 == $dato2['tipo_doc']){echo 'selected';};?>>RUC</option>
                    </select>
                    <!-- <input type="text"> -->
                </div>
                <div class="inputBox">
                    <h3>Numero de identidad</h3>
                    <input type="text" id="Numero" name="nume_documento" value="<?php echo $dato2['nro_doc']; ?>" <?php if(1 == $dato2['tipo_doc']){echo 'maxlength="8"';}else if(2 or 3 == $dato2['tipo_doc']){echo 'maxlength="12"';}else if(4 == $dato2['tipo_doc']){echo 'maxlength="11"';};?>>
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
                        <label for="inputGroupFile04" class="subir">
                            <i class="fas fa-cloud-upload-alt" aria-hidden="true"></i>
                            Inserta tu Foto
                        </label>
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
<script src="./assets/js/Validator.js"></script>
<script src="./assets/js/sidebarEditar.js"></script>