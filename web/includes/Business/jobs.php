<?php
ob_start();
@session_start();
if (isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)) {
    require_once 'database/databaseConection.php';
?>

    <head>
        <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css" />
        <link rel="stylesheet" href="includes/dist/css/adminlte.min.css">
    </head>

    <!-- para listar y la paginacion de cursos -->
    <?php
    $pdo3 = Database::connect();

    $sqlz = "SELECT * FROM cursos where permisoCurso=1 order by idCurso DESC ";
    $qz = $pdo3->prepare($sqlz);
    $qz->execute();

    $contar = $qz->rowCount();

    if ($_SESSION['privilegio'] == 2) {
        $idProfe = $_SESSION['codUsuario'];
        $sql3 = "SELECT * FROM cursos WHERE id_userprofesor='$idProfe' order by idCurso DESC";
    } else {
        $idProfe = $_SESSION['codUsuario'];
        $sql3 = "SELECT * FROM cursos WHERE permisoCurso=1 order by idCurso DESC ";
    }

    $q3 = $pdo3->prepare($sql3);
    $q3->execute();
    $curso = $q3->fetchAll(PDO::FETCH_ASSOC);

    ?>


    <!-- para listar y la paginacion de usuarios -->
    <?php
    $idad = $_SESSION['codUsuario'];
    $pdo4 = Database::connect();
    $sql1 = "SELECT id_solicitud FROM solicitud where id_usuario=$idad";
    $q1 = $pdo4->prepare($sql1);
    $q1->execute();
    $datos = $q1->fetch(PDO::FETCH_ASSOC);
    echo $idd = $datos['id_solicitud'];

    $sql2 = "SELECT codigo_curse FROM empresascursos where id_Empresa='$idd' LIMIT 1";
    $q2 = $pdo4->prepare($sql2);
    $q2->execute();
    $datos = $q2->fetch(PDO::FETCH_ASSOC);
    echo $iddad = $datos['codigo_curse'];


    $sql3 = "SELECT * FROM usuarios where cod_Emp='$iddad' AND estado=1 order by id_user DESC";
    $q3 = $pdo4->prepare($sql3);
    $q3->execute();
    $usuarios = $q3->fetchAll(PDO::FETCH_ASSOC);

    ?>


    <main>
        <!--tabla de curso -->
        <!-- <div class="col-12 mt-5 text-center">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Listado de Cursos</h3>
            </div>
             /.card-header 
            <div class="card-body">
                
                <div class="table-responsive">
                    <table id="tablaCursos" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Público dirigido</th>
                                <th>Imagen</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        
                        <tbody> -->

        <?php
        // foreach ($curso as $curso) {
        //     $pdo4 = Database::connect();
        //     $idCate = $curso['categoriaCurso'];
        //     $sql4 = "SELECT * FROM categorias WHERE idCategoria = '$idCate'";
        //     $q4 = $pdo4->prepare($sql4);
        //     $q4->execute(array());
        //     $datoCate = $q4->fetch(PDO::FETCH_ASSOC);
        //     $dotocoto= $q4->fetchAll();
        ?>
        <!-- <tr>
                                    <td><?php //echo $curso['nombreCurso']; 
                                        ?></td>
                                    <td><?php //echo $datoCate['nombreCategoria']; 
                                        ?></td>
                                    <td><?php //echo $curso['dirigido']; 
                                        ?></td>
                                    <td><img style="height: 50px;" src="data:image/*;base64,<?php //echo base64_encode($curso['imagenDestacadaCurso']) 
                                                                                            ?>"></td>
                                    <td>imagen</td> 
                                    <td><?php //echo substr($curso['descripcionCurso'],0,100)."..."; 
                                        ?></td>
                                    <td><?php //echo $curso['costoCurso'];
                                        ?></td>
                                    <td>
                                        para editar curso
                                        <a href="editarcurso.php?id=<?php //echo $curso['idCurso']; 
                                                                    ?>">
                                            <button  class=" boton_edit" type="button"><i class="far fa-edit"></i></button>
                                        </a>
                                        para quitar curso 
                                        <a href="includes/Cursos_crud/Cursos_CRUD.php?id_eliminar=<?php //echo $curso['idCurso']; 
                                                                                                    ?>">
                                            <button type="button"><i class="fas fa-trash-alt"></i></button>
                                        </a>
                                    </td> -->
        </tr>
        <?php //}
        // Database::disconnect();
        ?>
        <!-- </tbody>
                    </table>
                </div>

            </div>
             /.card-body 
        </div>
    </div> -->

        <!--tabla de usuarios -->
        <div class="col-12 mt-5 text-center">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Listado de usuarios registrados</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="tablaEmpleadosSS" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Privilegio</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Email</th>
                                    <th>Telefono</th>
                                    <th>N° documento</th>
                                    <th>Sexo</th>
                                    <th>Certificado</th>
                                    <th>Acciones</th>
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
                                        <td><?php echo $datoPrivi['nombre_privilegio']; ?></td>
                                        <td><?php echo $usuarios['nombres']; ?></td>
                                        <td><?php echo $usuarios['apellido_pat'] . " " . $usuarios['apellido_mat']; ?></td>
                                        <td><?php echo $usuarios['email']; ?></td>
                                        <td><?php echo $usuarios['telefono']; ?></td>
                                        <td><?php echo $usuarios['nro_doc']; ?></td>
                                        <td><?php echo $datoSexo['nombre_genero']; ?></td>
                                        <!-- <td><img style="height: 50px;" src="data:image/*;base64,<php echo base64_encode($usuarios['mifoto']) ?>"></td> -->
                                        <td>
                                          <label style="color: #C71C64;">  NO COMPLETADO</label>
                                        </td>
                                        <td>
                                            <?php $idUsu = $usuarios['id_user'] ?>
                                            <?php //echo $_SESSION['passSinHash'];
                                            ?>
                                            <!--para editar curso-->
                                            <!-- <a href="#" data-toggle="modal" data-target="#modalAdmin" <?php echo "onclick='masInfoUser( $idUsu )'" ?>>
                                            <button  class=" boton_edit" type="button"><i class="far fa-edit"></i></button>
                                        </a> -->
                                            <!-- para quitar curso -->
                                            <a href="includes/usersidebar/actualizar_perfil.php?id_eliminar=<?php echo $usuarios['id_user']; ?>">
                                                <button type="button"><i class="fas fa-trash-alt"></i></button>
                                            </a>
                                        </td>
                                        
                                    </tr>
                                <?php }
                                Database::disconnect();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

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
    </main>
    <?php
    $pdo1 = Database::connect();
    if (isset($_GET['sol'])) {
        $sql1 = "SELECT * FROM temp where cod_empre=$ent";
        $q1 = $pdo1->prepare($sql1);
        $q1->execute();
        $users = $q1->fetchAll(PDO::FETCH_ASSOC);
    }
    ?>
    <main>
        <!--tabla de cursos de empresa-->
        <div class="col-12 text-center">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="tabla" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="col-lg-6">Estado de Cuenta - Pagos</th>
                                    <th class="col-lg-1">Estado</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr>
                                    <?php
                                    $pdo2 = Database::connect();
                                    $sql = "SELECT COUNT(cod_curse) FROM temp WHERE cod_empre=$idad";
                                    $q8 = $pdo2->prepare($sql);
                                    $cuento = $q8->execute();
                                    $suma = $q8->fetchColumn();

                                    if($suma==0){
                                        echo '<td colspan="2" class="text-center">No hay pagos pendientes</td>';
                                    }else{
                                    ?>
                                    <td><?php

                                        // $sql2 = "SELECT * FROM temp where cod_empre=$id";
                                        // $q2 = $pdo->prepare($sql2);
                                        // $q2->execute();
                                        // $users = $q2->fetchAll(PDO::FETCH_ASSOC);
                                        // foreach ($users as $user) {
                                        //     $sql3 = "SELECT * FROM cursos where idCurso=" . $user['cod_curse'];
                                        //     $q1 = $pdo->prepare($sql3);
                                        //     $q1->execute();
                                        //     $nombre = $q1->fetch(PDO::FETCH_ASSOC);

                                        ?><?php echo "PAQUETE DE CURSOS"//echo $nombre['nombreCurso'] . "<br>"; ?>
                                    <?php //} ?></td>
                                    <td>
                                        <center>
                                            <!-- para pagar curso -->
                                            <!-- <a href="includes\Business\addcurso.php?deli=<?php //echo $nombre['idCurso']; 
                                                                                                ?>&delc=<?php //echo $Empresa['id_usuario']; 
                                                                                                        ?>">
                                                <button type="button"></button>
                                            </a> -->
                                            <?php
                                            $sql2 = "SELECT id_solicitud,num_suscripcion FROM solicitud WHERE id_usuario=$idad";
                                            $q2 = $pdo2->prepare($sql2);
                                            $prueba = $q2->execute();
                                            $dato1 = $q2->fetch(PDO::FETCH_ASSOC);
                                            $id_sol = $dato1['id_solicitud'];
                                            $subs = $dato1['num_suscripcion'];

                                            // $sql = "SELECT COUNT(cod_curse) FROM temp WHERE cod_empre=$idad";
                                            // $q8 = $pdo2->prepare($sql);
                                            // $cuento = $q8->execute();
                                            // $suma = $q8->fetchColumn();

                                            $prube = 0;
                                            $sql1 = "SELECT cod_curse FROM temp WHERE cod_empre=$idad";
                                            $q1 = $pdo2->prepare($sql1);
                                            $cuento1 = $q1->execute();
                                            $dato3 = $q1->fetchAll(PDO::FETCH_ASSOC);
                                            for ($i = 0; $i < $suma; ++$i) {
                                                $Curso = $dato3[$i]['cod_curse'];
                                                $sql3 = $pdo2->prepare("SELECT costoCurso FROM cursos WHERE idCurso=$Curso");
                                                $sql3->execute();
                                                $dato4 = $sql3->fetch(PDO::FETCH_ASSOC);
                                                $costo = $dato4['costoCurso'];
                                                $prube += $costo;
                                            }
                                            ?>
                                            <a href="pageEnterprice.php?id=<?php echo base64_encode($idad) ?>&sol=<?php echo base64_encode($id_sol)?>&val=<?php echo base64_encode($prube) ?>&subs=<?php echo base64_encode($subs); ?>" style="height: 100%; width:80%;" class="btn btn-primary m-0 ">PAGAR</a>
                                        </center>
                                    </td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- <script src="./assets/js/Validator.js"></script>
<script src="./assets/js/sidebarEditar.js"></script> -->

    <script>
        // function cambiarImg() {
        //     var pdrs = document.getElementById('inputGroupFile04').files[0].name;
        //     document.getElementById('infoImg').innerHTML = pdrs;
        // }

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

<?php
} else {
    header('Location: ../../iniciosesion.php');
}
?>