<head>
    <link rel="stylesheet" href="assets/css/agrecursos.css">
</head>
<div class="container-formulario" id="configuracion">

    <form name="formulario" id="newUserForm" method="POST" action="includes/Cursos_crud/Cursos_CRUD.php" target="dummyframe" onsubmit="return comprobarDatosFormulario()" enctype="multipart/form-data">
        <div class="row">
            <div class="column">
                <label for="names-agrecursos">NOMBRE DEL CURSO</label>
                <input type="text" name="nombres_agrecursos" id="names-agrecursos" aria-label="Nombrecurso" aria-describedby="names-addon">
            </div>
            <div class="column">
                <label for="categoria">CATEGORIA:</label>
                <select class="seleccionador" id="categoria" name="categoria">
                    <?php
                    require_once 'database/databaseConection.php';
                    $pdo4 = Database::connect();

                    $sql4 = "SELECT * FROM categorias";
                    $q4 = $pdo4->prepare($sql4);
                    $q4->execute(array());

                    while ($registro =  $q4->fetch(PDO::FETCH_ASSOC)) {

                    ?>
                        <option value="<?php echo $registro['idCategoria'] ?>"><?php echo $registro['nombreCategoria'] ?></option>

                    <?php

                    }

                    Database::disconnect();
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <label for="descripcio-curso">DESCRIPCIÓN DEL CURSO</label>
                <textarea id="descripcio-curso" name="descripcio_curso" placeholder="Ej. El curso pretende realizar una introducción a distintas técnicas que posibiliten el desarrollo." rows="3"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <label for="intro-curso">INTRODUCCIÓN DEL CURSO</label>
                <textarea id="intro-curso" name="intro_curso" placeholder="Ej. El curso pretende realizar una introducción a distintas técnicas que posibiliten el desarrollo." rows="3"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <label for="publico_dirigidoo">PÚBLICO DIRIGIDO</label>
                <input type="text" name="publico_dirigido" id="publico_dirigidoo" aria-label="Dirigido" aria-describedby="names-addon">
            </div>
        </div>
        <div class="row" style="
                padding: 8px 10px;
                border-radius: 5px;
                border: 1px solid #6f6df4;">
            <div class="column" style="margin:auto;">
                <label for="inputGroupFile04" class="subir">
                    <i class="fas fa-cloud-upload-alt" aria-hidden="true"></i>
                    Agregar Imagen Del Curso
                </label>
                <input type="file" id="file-upload" name="txtimagen" onchange='cambiar()' style='display: none;' accept="image/*" />

            </div>
            <div class="column" style="margin:auto;">
                <div id="infoImg"></div>
            </div>
        </div>

        <button type="submit" style="background:#9888DC;color:#FFFFFF;"><i class="fas fa-plus "></i> Agregar</button>
    </form>
</div>