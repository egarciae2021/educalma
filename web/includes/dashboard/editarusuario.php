<div class="">
    <?php


    $pdo2 = Database::connect();
    $veri2 = "SELECT * FROM usuarios WHERE id_user = '$id' ";
    $q2 = $pdo2->prepare($veri2);
    $q2->execute(array());
    $dato2 = $q2->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    ?>
    <div class="container-backgorund">
        <div class="elements">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>


    <div class="container-formulario" id="configuracion">
        <h1>CUENTA</h1>
        <form action="includes/usersidebar/actualizar_perfil.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="column">
                    <label for="Nombre">Nombre</label>
                    <input type="text" id="Nombre" name="Nombre" value="<?php echo $dato2['nombres']; ?>">
                </div>
                <div class="column">
                    <label for="Apellidop">Apellido Paterno</label>
                    <input type="text" id="Apellidop" name="Apellido_Paterno" value="<?php echo $dato2['apellido_pat']; ?>">
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="Apellidom">Apellido Materno</label>
                    <input type="text" id="Apellidom" name="Apellido_Materno" value="<?php echo $dato2['apellido_mat']; ?>">
                </div>
                <div class="column">
                    <label for="Pais">Pais</label>
                    <input type="text" id="Pais" name="pais" value="<?php echo $dato2['pais']; ?>">
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="Correo">Correo</label>
                    <input type="email" id="Correo" name="Correo" value="<?php echo $dato2['email']; ?>">
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="Password">Password</label>
                    <input type="password" id="Password" name="pass" value="<?php echo $dato2['pass']; ?>">
                </div>
                <div class="column">
                    <label for="Telefono">Telefono</label>
                    <input type="tel" id="Telefono" name="telefono" value="<?php echo $dato2['telefono']; ?>">
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="Tipod">Tipo de Documento</label>
                    <select class="seleccionador" name="tipo_doc" id="Tipod">
                        <option value="1">DNI</option>
                        <option value="2">Pasaporte</option>
                        <option value="3">Carné extranjería</option>
                        <option value="4">RUC</option>
                    </select>
                </div>
                <div class="column">
                    <label for="Numero">Numero de Identidad</label>
                    <input type="text" id="Numero" name="nume_documento" value="<?php echo $dato2['nro_doc']; ?>">
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="Tipos">Tipo de Sexo</label>
                    <select class="seleccionador" name="sexo" id="Tipos">
                        <option value="1">Mujer</option>
                        <option value="2">Hombre</option>
                        <option value="3">Otros... </option>
                    </select>
                </div>
                <div class="column">
                    <label for="Fecha">Fecha Nacimiento</label>
                    <input type="date" id="Fecha" name="fecha_naci" value="<?php echo $dato2['fecha_nacimiento']; ?>">
                </div>
            </div>
            <div class="row" style="
                padding: 8px 10px;
                border-radius: 5px;
                border: 1px solid #6f6df4;">
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

            <button type="submit">Actualizar</button>
        </form>
    </div>
</div>

<script src="./assets/js/Validator.js"></script>
<script src="./assets/js/sidebarEditar.js"></script>