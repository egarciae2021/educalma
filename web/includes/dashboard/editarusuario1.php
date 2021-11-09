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
                    <input type="text" id="Pais" name="pais" value="<?php echo $dato2['pais']; ?>">
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
                    <input type="tel" id="Telefono" name="telefono" value="<?php echo $dato2['telefono']; ?>">
                </div>
                <div class="inputBox">
                    <h3>Tipo de documento</h3>
                    <select class="seleccionador" name="tipo_doc" id="Tipod">
                        <option value="1">DNI</option>
                        <option value="2">Pasaporte</option>
                        <option value="3">Carné extranjería</option>
                        <option value="4">RUC</option>
                    </select>
                    <!-- <input type="text"> -->
                </div>
                <div class="inputBox">
                    <h3>Numero de identidad</h3>
                    <input type="text" id="Numero" name="nume_documento" value="<?php echo $dato2['nro_doc']; ?>">
                </div>
                <div class="inputBox">
                    <h3>Tipo de sexo</h3>
                    <select class="seleccionador" name="sexo" id="Tipos">
                        <option value="1">Mujer</option>
                        <option value="2">Hombre</option>
                        <option value="3">Otros... </option>
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