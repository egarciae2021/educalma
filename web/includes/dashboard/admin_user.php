<head>
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css" />
    <link rel="stylesheet" href="includes/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="assets/css/styledash.css">


    <style>
.dataTables_filter{

/*Centrando el buscador de "Por Usuarios".*/
position: relative;  
text-align: center;
max-width: 275px;
/**/

border-radius: 5px ; 
border: 1px solid #57B3F7;
background-repeat: no-repeat;
background-image: url("./assets/img/buscar.png");
background-position: 8px 5px;
background-size: 25px 25px;

}

/*Palabra "Buscar"*/ 
.dataTables_filter label {

  position: relative;
    top: 5px;
    
    left: 38px;
    /*font-weight: bold;*/
    width: 280px;

    font-size: 15.4px;

}

/*Caja de texto del buscador*/ 
.dataTables_filter label .form-control {

  border: 0;
    height: 25px;
    position: relative;
    left: -9px;
    padding: 0;
}


    </style>
</head>

<!-- para lista de usuarios -->
<?php
$pdo4 = Database::connect();
$sql3 = "SELECT * FROM usuarios where estado=1 order by id_user DESC";
$q3 = $pdo4->prepare($sql3);
$q3->execute();
$usuarios = $q3->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
    <!-- Por usuarios -->
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-12">
                <div class="title" style="color:#737BF1;">Administrar</div>
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="user-sidebar.php">
                                        por cursos
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link active" href="userdash.php">
                                        por usuarios
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="empredash.php">
                                        por empresas
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="aprobdash.php">
                                        por aprobados
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <?php
                $pdo3 = Database::connect();
                $sqlUsu = "SELECT COUNT(*) AS cantidad FROM usuarios WHERE estado = 1";
                $qUsua = $pdo3->prepare($sqlUsu);
                $qUsua->execute(array());
                $resultUsu = $qUsua->fetch(PDO::FETCH_ASSOC);
                ?>

                <!-- TABLA DE USUARIOS  -->
                <div class="card mt-2">

                
                    <div class="card-header">
                        <div class="row mb-2">
                            <div class="col-12">
                                <h3 class="card-title" style="color:#737BF1;">Cantidad de usuarios
                                    <span style="color:#BEC1F3;">(<?php echo $resultUsu['cantidad']; ?>)</span>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tableUsuarios" class="table table-borderless dt-responsive text-left" cellspacing="0" width="100%">
                                <thead>
                                    <tr style="background-color:#737BF1;">
                                        <th style="border-radius: 10px 0 0 10px;">
                                            Privilegio
                                        </th>
                                        <th scope="col">Nombres</th>
                                        <th>Apellidos</th>
                                        <th>email</th>
                                        <th>teléfono</th>
                                        <th>n° documento</th>
                                        <th>sexo</th>
                                        <th style="border-radius: 0 10px 10px 0;">
                                            Acción
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($usuarios as $usuarios) {
                                        $pdo4 = Database::connect();
                                        // para el privilegio
                                        $idPri = $usuarios['privilegio'];
                                        $sql6 = "SELECT * FROM privilegio WHERE id_privilegio = '$idPri'";
                                        $q6 = $pdo4->prepare($sql6);
                                        $q6->execute(array());
                                        $datoPrivi = $q6->fetch(PDO::FETCH_ASSOC);
                                        $dotoPrivilegio = $q6->fetchAll();
                                        // para el sexo
                                        $idSexo = $usuarios['sexo'];
                                        $sql7 = "SELECT * FROM sexo WHERE id_genero = '$idSexo'";
                                        $q7 = $pdo4->prepare($sql7);
                                        $q7->execute(array());
                                        $datoSexo = $q7->fetch(PDO::FETCH_ASSOC);
                                    ?>

                                        <tr>
                                            <td>
                                                <?php echo $datoPrivi['nombre_privilegio']; ?>
                                            </td>
                                            <td>
                                                <?php echo $usuarios['nombres']; ?>
                                            </td>
                                            <td>
                                                <?php echo $usuarios['apellido_pat'] . " " . $usuarios['apellido_mat']; ?>
                                            </td>
                                            <td>
                                                <?php echo $usuarios['email']; ?>
                                            </td>
                                            <td>
                                                <?php echo $usuarios['telefono']; ?>
                                            </td>
                                            <td>
                                                <?php echo $usuarios['nro_doc']; ?>
                                            </td>
                                            <td>
                                                <?php if(!empty($datoSexo['nombre_genero'])){
                                                    echo $datoSexo['nombre_genero']; 
                                                    }else{
                                                    echo "Empresa";
                                                    }?>
                                            </td>
                                            <!-- <td><img style="height: 50px;" src="data:image/*;base64,<php echo base64_encode($usuarios[ 'mifoto']) ?>"></td> -->
                                            <td>
                                                <?php $idUsu = $usuarios['id_user'] ?>
                                                <!--para editar usuario-->
                                                <div class="btn-group" role="group">
                                                    <a href="#" data-toggle="modal" data-target="#modalAdmin"
                                     <?php echo "onclick='masInfoUser( $idUsu )'" 
                                        ?>>
                                      <button type="button" class="btn btn-edit">
                                        <i class="far fa-edit"></i>
                                      </button>
                                    </a>
                                                    <!-- <a href="">
                                                                        <button type="button" class="btn btn-edit">
                                                                          <i class="far fa-edit"></i>
                                                                        </button>
                                                                    </a> -->
                                                </div>
                                                <!-- para quitar usuario -->
                                                <div class="btn-group" role="group">
                                                    <a href="includes/usersidebar/actualizar_perfil.php?id_eliminar=<?php echo $usuarios['id_user']; ?>">
                                                        <button type="button" class="btn btn-quitar">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                    <?php }
                                    Database::disconnect();
                                    ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- FIN DE TABLA DE USUARIO -->

                <?php
                $pdo10 = Database::connect();

                $sqlw = "SELECT * from usuarios as c INNER JOIN cursoinscrito as a ON a.usuario_id=c.id_user WHERE c.privilegio=4";
                $qw = $pdo10->prepare($sqlw);
                $qw->execute();

                $contar = $qw->rowCount();

                $idProfesor = $_SESSION['codUsuario'];
                $sql10 = "SELECT * from usuarios as c INNER JOIN cursoinscrito as a ON a.usuario_id=c.id_user WHERE c.privilegio=4";
                $q10 = $pdo10->prepare($sql10);
                $q10->execute();
                $curso = $q10->fetchAll(PDO::FETCH_ASSOC);

                ?>

                <!-- para listar y la paginacion de usuarios -->
                <?php
                $pdo11 = Database::connect();
                $sql10 = "SELECT * from usuarios as c INNER JOIN cursoinscrito as a ON a.usuario_id=c.id_user WHERE c.privilegio=4 order by id_user DESC";
                $q10 = $pdo11->prepare($sql10);
                $q10->execute();
                $usuarios = $q10->fetchAll(PDO::FETCH_ASSOC);
                ?>

            </div>
        </div>
    </div>

    <!-- MODAL USER -->
    <div class="modal fade" id="modalAdminEmp" style="overflow:hidden;">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Información de Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- contenido modal -->
                <div class="modal-body">
                    <form action="includes/Business/business.php" method="POST">
                        <div class="row form-group">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                            <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Nombre-Contacto:</label>
                            <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                                <!-- <input class="form-control input-md" type="text" value="<?php //echo $usuarios['nombres']; 
                                                                                                ?>" id="nameC" name="nameC"> -->
                                <input class="form-control input-md" type="text" id="nameC" name="nameC">
                            </div>
                        </div>
                        <input type="hidden" id="id_user" name="id_user" />
                        <input type="hidden" id="id_sol" name="id_sol" />
                        <input type="hidden" id="status" name="status" />
                        <div class="row form-group">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                            <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Nombre de la Empresa:</label>
                            <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                                <!-- <input class="form-control input-md" type="text" value="<?php //echo $usuarios['nombre_empresa']; 
                                                                                                ?>" id="nameE" name="nameE"> -->
                                <input class="form-control input-md" type="text" id="nameE" name="nameE">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                            <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Email-Contacto:</label>
                            <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                                <!-- <input class="form-control input-md" type="email" value="<?php //echo $usuarios['correo_personal']; 
                                                                                                ?>" id="E-C" name="Apellido_Materno"> -->
                                <input class="form-control input-md" type="email" id="E-C" name="E-C">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                            <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Email-Empresa</label>
                            <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                                <!-- <input class="form-control input-md" type="email" value="<?php //echo $usuarios['correo_corporativo']; 
                                                                                                ?>" id="E-E" name="E-E"> -->
                                <input class="form-control input-md" type="email" id="E-E" name="E-E">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                            <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Telefono-Contacto:</label>
                            <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                                <!-- <input class="form-control input-md" type="tel" value="<?php //echo $usuarios['telefono_movil']; 
                                                                                            ?>" id="T-C" name="Correo"> -->
                                <input class="form-control input-md" type="tel" id="T-C" name="T-C">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                            <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Número de subscripciones:</label>
                            <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                                <!-- <input class="form-control input-md" type="number" value="<?php //echo $usuarios['num_suscripcion']; 
                                                                                                ?>" id="N-S" name="N-S"> -->
                                <input class="form-control input-md" type="number" id="N-S" name="N-S">
                            </div>
                        </div>

                </div>

                <div class="row form-group">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-0"></div>
                    <label class="col-lg-2 col-md-3 col-sm-3 col-4 control-label">Fecha de solicitud:</label>
                    <div class="col-lg-7 col-md-5 col-sm-5 col-6">
                        <!-- <input class="form-control input-md" type="text" id="F-S" value="<?php //echo $usuarios['fecha_registro']; 
                                                                                                ?>" readonly name="nume_documento"> -->
                        <input class="form-control input-md" type="text" id="F-S" readonly name="F-S">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                    <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Contraseña:</label>
                    <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                        <input class="form-control input-md" type="text" id="Pass" name="Pass">
                    </div>
                </div>

                <?php
                // }
                ?>
                <!-- fin contenido modal -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-blue" style="color: #FFFFFF; background: #0093E9; background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);">
                        Guardar <i class="fas fa-save"></i>
                    </button>
                    <!-- <button type="button" class="btn btn-secondary" onclick="actu();" data-dismiss="modal">Cerrar</button> -->
                </div>
                </form>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>

    <!-- --MODAL USER -->
    <div class="modal fade" id="modalAdmin" style="overflow:hidden;">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Información de Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- contenido modal -->
                <div class="modal-body">
                    <!-- <form action="includes/usersidebar/actualizar_perfil.php?id=<php echo $id; ?>" method="POST" enctype="multipart/form-data"> -->
                    <input type="hidden" id="id_userV" name="id_userV" />
                    <div class="row form-group">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                        <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Nombre:</label>
                        <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                            <input class="form-control input-md" type="text" id="Nombre" name="Nombre">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                        <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Apellido Paterno:</label>
                        <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                            <input class="form-control input-md" type="text" id="Apellidop" name="Apellido_Paterno">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                        <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Apellido Materno:</label>
                        <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                            <input class="form-control input-md" type="text" id="Apellidom" name="Apellido_Materno">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                        <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">País:</label>
                        <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                            <input class="form-control input-md" type="text" id="Pais" name="pais">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                        <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Correo:</label>
                        <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                            <input class="form-control input-md" type="email" id="Correo" name="Correo">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                        <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Teléfono:</label>
                        <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                            <input class="form-control input-md" type="tel" id="Telefono" name="telefono">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-0"></div>
                        <label class="col-lg-2 col-md-3 col-sm-3 col-4 control-label">Tipo de Documento:</label>
                        <div class="col-lg-7 col-md-5 col-sm-5 col-6">
                            <select class="form-control seleccionador" name="tipo_doc" id="Tipod">
                                <option value="1">DNI</option>
                                <option value="2">PASAPORTE</option>
                                <option value="3">CARNÉ EXTRANJERIA</option>
                                <option value="4">RUC</option>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-0"></div>
                        <label class="col-lg-2 col-md-3 col-sm-3 col-4 control-label">Nro Documento:</label>
                        <div class="col-lg-7 col-md-5 col-sm-5 col-6">
                            <input class="form-control input-md" type="text" id="Numero" name="nume_documento">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                        <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Sexo:</label>
                        <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                            <select class="form-control" class="seleccionador" name="sexo" id="Tipos">
                                <option value="1">Masculino</option>
                                <option value="2">Femenino</option>
                                <option value="3">No Binario</option>
                                <option value="4">Prefiero No Decir</option>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                        <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Fecha Nacimiento:</label>
                        <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                            <input class="form-control input-md" type="date" id="Fecha" name="fecha_naci">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                        <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Inserta tu foto:</label>
                        <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                            <div class="column" style="margin:auto;">
                                <label for="inputGroupFile04" class="subir">
                                    <i class="fas fa-cloud-upload-alt" aria-hidden="true"></i>
                                    Selecciona la foto
                                </label>
                                <input type="file" name="imagen" accept="image/*" id="inputGroupFile04" onchange="cambiarImg()" aria-describedby="inputGroupFileAddon04" style="display: none;" aria-label="Upload" ; multiple>

                            </div>
                            <div class="column" style="margin:auto;">
                                <div id="infoImg"></div>
                            </div>
                        </div>
                    </div>

                    <!-- </form> -->
                </div>
                <!-- fin contenido modal -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-blue" onclick="actualizarUser();" style="color: #FFFFFF; background: #0093E9; background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);">
                        Editar <i class="far fa-edit"></i>
                    </button>
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- fin modal -->

    <script>
        function cambiarImg() {
            var pdrs = document.getElementById('inputGroupFile04').files[0].name;
            document.getElementById('infoImg').innerHTML = pdrs;
        }

        function masInfoUser(x) {
            document.getElementById("Nombre").value = "";
            document.getElementById("Apellidop").value = "";
            document.getElementById("Apellidom").value = "";
            document.getElementById("Pais").value = "";
            document.getElementById("Correo").value = "";
            document.getElementById("Telefono").value = "";
            document.getElementById("Tipod").value = "";
            document.getElementById("Numero").value = "";
            document.getElementById("Tipos").value = "";
            document.getElementById("Fecha").value = "";

            //mensaje de espera

            $.ajax({
                url: "includes/usersidebar/actualizar_perfil.php",
                type: "POST",
                data: "cod_user=" + x,
                dataType: 'json',
                cache: false,
                success: function(arr) {

                    document.getElementById("Nombre").value = arr[0];
                    document.getElementById("Apellidop").value = arr[1];
                    document.getElementById("Apellidom").value = arr[2];
                    document.getElementById("Pais").value = arr[3];
                    document.getElementById("Correo").value = arr[4];
                    document.getElementById("Telefono").value = arr[5];
                    document.getElementById("Tipod").value = arr[6];
                    document.getElementById("Numero").value = arr[7];
                    document.getElementById("Tipos").value = arr[8];
                    document.getElementById("Fecha").value = arr[9];
                    document.getElementById("id_userV").value = arr[10];
                },

            });
        }

        function actualizarUser() {
            var cod_user = document.getElementById('id_userV').value;
            var nombre_user = document.getElementById('Nombre').value;
            var userPaterno = document.getElementById('Apellidop').value;
            var userMaterno = document.getElementById('Apellidom').value;
            var userPais = document.getElementById('Pais').value;
            var correoUser = document.getElementById('Correo').value;
            var telefUser = document.getElementById('Telefono').value;
            var tipo_doc_user = document.getElementById("Tipod").value;
            var num_docUser = document.getElementById("Numero").value;
            var sexoUser = document.getElementById('Tipos').value;
            var nacimientoUser = document.getElementById('Fecha').value;
            // var imagenUser = document.getElementById('inputGroupFile04').value;
            // var fileToUpload = $('#inputGroupFile04').prop('files')[0];
            // var fileToUpload = document.getElementById('inputGroupFile04').prop('files')[0];


            Swal.fire({
                title: '¿SEGURO QUE DESEA ACTUALIZAR ESTE REGISTRO?',
                text: "Se actualizarán los datos de este Usuario",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Actualizar',
                cancelButtonText: 'Cancelar !'
            }).then(function() {
                $.ajax({
                    url: "includes/usersidebar/actualizar_perfil.php",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        id_usuario: cod_user,
                        tipo_docUser: tipo_doc_user,
                        numdoc_user: num_docUser,
                        nombre_user: nombre_user,
                        apellido_p_user: userPaterno,
                        apellido_m_user: userMaterno,
                        correo_user: correoUser,
                        fecha_nac_user: nacimientoUser,
                        sexo_user: sexoUser,
                        telefono_user: telefUser,
                        pais_user: userPais
                    },
                    cache: false
                }).done(function() {
                    Swal.fire({
                        title: 'Usuario Actualizado',
                        text: 'Se han actualizado los datos satisfactoriamente.',
                        icon: 'success',
                    }).then(function() {
                        location.reload();
                    });

                }).fail(function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Ocurrio un problama al actualizar el usuario',
                        icon: 'error',
                    }).then(function() {
                        location.reload();
                    });
                })
            }, function(dismiss) {
                if (dismiss === 'cancel') {}
            })
        }
    </script>

    <!-- <script>
        function masInfoUser(x) {
            document.getElementById("id_sol").value = "";
            document.getElementById("status").value = "";
            document.getElementById("nameC").value = "";
            document.getElementById("nameE").value = "";
            document.getElementById("E-C").value = "";
            document.getElementById("E-E").value = "";
            document.getElementById("T-C").value = "";
            document.getElementById("N-S").value = "";
            // document.getElementById("Pass").value = "";
            document.getElementById("F-S").value = "";
            // document.getElementById("Code").value = "";


            //mensaje de espera

            $.ajax({
                url: "includes/Business/business.php",
                type: "POST",
                data: "cod_user=" + x,
                dataType: 'json',
                cache: false,
                success: function(arr) {

                    document.getElementById("id_sol").value = arr[0];
                    document.getElementById("status").value = arr[1];
                    document.getElementById("nameC").value = arr[2];
                    document.getElementById("nameE").value = arr[3];
                    document.getElementById("E-C").value = arr[4];
                    document.getElementById("E-E").value = arr[5];
                    document.getElementById("T-C").value = arr[6];
                    document.getElementById("N-S").value = arr[7];
                    // document.getElementById("Pass").value = arr[8];
                    document.getElementById("F-S").value = arr[8];
                    // document.getElementById("Code").value = arr[10];
                    document.getElementById("id_user").value = arr[9];
                },

            });
        }

        function actu() {

            var cod_user = document.getElementById('id_user').value;
            var nameC = document.getElementById('nameC').value;
            var nameE = document.getElementById('nameE').value;
            var EmailC = document.getElementById('E-C').value;
            var EmailE = document.getElementById('E-E').value;
            var TelfC = document.getElementById('T-C').value;
            var subs = document.getElementById('N-S').value;
            var curseIns = document.getElementById('C-i').value;
            // var  = document.getElementById('F-S').value;
            var Pass = document.getElementById('Pass').value;
            var id_sol = document.getElementById('id_sol').value;
            // var PassC = document.getElementById('PassC').value;
            var codeCurse = document.getElementById('Code').value;
            var status = document.getElementById('status').value;

            // alert(cod_user+" "+nameC+" "+nameE+" "+EmailC+" "+EmailE+" "+TelfC+" "+subs+" "+curseIns+" "+Pass+" "+id_sol+" "+codeCurse+" "+status+" ");
            Swal.fire({
                    title: '¿SEGURO QUE DESEA ACTUALIZAR ESTE REGISTRO DE EMPRESA?',
                    text: "Se actualizarán los datos de esta empresa",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Actualizar',
                    cancelButtonText: 'Cancelar !'
                })
                .then(function() {
                    $.ajax({
                        url: "includes\Business\business.php",
                        method: "POST",
                        dataType: 'json',
                        data: {
                            id_usuario: cod_user,
                            id_sol: id_sol,
                            nameC: nameC,
                            nameE: nameE,
                            EmailC: EmailC,
                            EmailE: EmailE,
                            TelfC: TelfC,
                            subs: subs,
                            curseIns: curseIns,
                            Pass: Pass,
                            status: status,
                            codeCurse: codeCurse
                        },
                        cache: false
                    }).done(function() {
                        Swal.fire({
                            title: 'Usuario Actualizado',
                            text: 'Se han actualizado los datos satisfactoriamente.',
                            icon: 'success',
                        }).then(function() {
                            location.reload();
                        });

                    }).fail(function() {
                        Swal.fire({
                            title: 'Error',
                            text: 'Ocurrio un problema al actualizar el usuario',
                            icon: 'error',
                        }).then(function() {
                            location.reload();
                        });
                    })
                }, function(dismiss) {
                    if (dismiss === 'cancel') {}
                })
        }
    </script> -->

</main>