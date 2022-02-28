<?php
ob_start();
@session_start();
if (isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)) {
    require_once 'database/databaseConection.php';
}
?>

    <head>
        <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css" />
        <link rel="stylesheet" href="includes/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="assets/css/styledash.css">
    </head>

    <!-- para listar y la paginacion de tablas -->
    <?php
    $pdo3 = Database::connect();
    $sqlz = "SELECT  *
from usuarios as us 
INNER JOIN solicitud as sl 
on us.id_user = sl.id_usuario
WHERE us.privilegio=4;";
    $qz = $pdo3->prepare($sqlz);
    $qz->execute();

    $contar = $qz->rowCount();

    $idProfe = $_SESSION['codUsuario'];
    $sql3 = "SELECT *
from usuarios as us 
INNER JOIN solicitud as sl 
on us.id_user = sl.id_usuario
WHERE us.privilegio=4 ;";


    $q3 = $pdo3->prepare($sql3);
    $q3->execute();
    $curso = $q3->fetchAll(PDO::FETCH_ASSOC);
    ?>

        <!-- para listar y la paginacion de usuarios -->
        <?php
        $pdo4 = Database::connect();
        $sql3 = "SELECT  *
from usuarios as us  
INNER JOIN solicitud as sl 
on us.id_user = sl.id_usuario
WHERE us.privilegio=4 order by id_user DESC;";
        $q3 = $pdo4->prepare($sql3);
        $q3->execute();
        $usuarios = $q3->fetchAll(PDO::FETCH_ASSOC);
        ?>

            <main>
                <!-- Por empresas -->
                <div class="container-fluid">
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="title">Administrar</div>
                            <div class="row">
                                <div class="col-12">
                                    <nav class="navbar navbar-expand">
                                        <ul class="navbar-nav">
                                            <li class="nav-item">
                                                <!-- <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> -->
                                                <a class="nav-link" href="user-sidebar.php">
                                                por cursos
                                            </a>
                                            </li>
                                            <li class="nav-item ">
                                                <!-- <a class="nav-link " href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> -->
                                                <a class="nav-link" href="userdash.php">
                                                por usuarios
                                            </a>
                                            </li>
                                            <li class="nav-item ">
                                                <!-- <a class="nav-link " href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> -->
                                                <a class="nav-link active" href="empredash.php">
                                              por empresas
                                            </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>

                            <!--tabla de empresas -->
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <h3 class="card-title">Cantidad de empresas
                                                    <span style="color:#C1E1EE;"><?php echo " ( ".$contar." )"?></span>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="tableUsuarios" class="table table-borderless dt-responsive nowrap" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th style="border-radius: 10px 0 0 10px;">
                                                            Privilegio
                                                        </th>
                                                        <th>Nombres-Contacto</th>
                                                        <th>Nombre-Empresa</th>
                                                        <th>Email-Contacto</th>
                                                        <th>Email-Empresa</th>
                                                        <th>Telef-Contacto</th>
                                                        <th>Nro° Subs</th>
                                                        <th>Estado: </th>
                                                        <th>Fecha de Solicitud: </th>
                                                        <!-- <th>Link de Pago</th> -->
                                                        <th>Contraseña:</th>
                                                        <th>CODIGO: </th>
                                                        <th style="border-radius: 0 10px 10px 0;">
                                                            Acciones
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
                                                                <?php echo $usuarios['privilegio']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $usuarios['nombres']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $usuarios['nombre_empresa']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $usuarios['correo_personal']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $usuarios['correo_corporativo']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $usuarios['telefono_movil']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $usuarios['num_suscripcion']; ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($usuarios['estado'] == 0) {
                                                                    echo "Pendiente";
                                                                } else {
                                                                    echo "Aprobado";
                                                                } ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $usuarios['fecha_registro']; ?>
                                                            </td>
                                                            <td>
                                                                <?php $userr = "123";

                                                                if (password_verify($userr, $usuarios['pass']) === true) {
                                                                    echo "Vacio";
                                                                } else {
                                                                    echo $usuarios['pass'];
                                                                } ?>
                                                            </td>
                                                            <!-- <td><img style="height: 50px;" src="data:image/*;base64,<php echo base64_encode($usuarios['mifoto']) ?>"></td> -->
                                                            <td>
                                                                <?php 
                                                                    $idemp = $usuarios['id_solicitud'];
                                                                    $pdo6 = Database::connect();
                                                                    $id_usa = $pdo6->prepare("SELECT * FROM `empresascursos` WHERE id_Empresa = '$idemp' LIMIT 1");
                                                                    $id_usa->execute();
                                                                    $id_usa = $id_usa->fetch(PDO::FETCH_ASSOC);
                                                                    // $id_use = $id_usa['id_Empresa'];
                                                                    
                                                                    if (empty($id_usa)) {
                                                                        echo "No tiene";
                                                                    } else {
                                                                        echo $id_usa['codigo_curse'];
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php $idUsu = $usuarios['id_user'] ?>
                                                                <!--para editar empresa-->
                                                                <div class="btn-group" role="group">
                                                                    <a href="#" data-toggle="modal" data-target="#modalAdminEmp" <?php echo "onclick='masInfoUser($idUsu)'" ?>>
                                                                            <button class="btn btn-edit" type="button"><i class="far fa-edit"></i></button>
                                                                    </a>
                                                                </div>
                                                                <!-- para quitar empresa -->
                                                                <div class="btn-group" role="group">
                                                                    <a href="includes\Business\business.php?id_eliminar=<?php echo $usuarios['id_user']; ?>&id_delete=<?php echo $usuarios['id_solicitud']; ?>">
                                                                        <button class="btn btn-quitar" type="button"><i class="fas fa-trash-alt"></i></button>
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
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>

                            <!-- --MODAL User Empresa -->
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
                                        <!-- <input type="text" id="id_user" value="<?php //echo $usuarios['id_user']; ?>" name="id_user" />
                                        <input type="hidden" id="id_sol" value="<?php //echo $usuarios['id_solicitud']; ?>" />
                                        <input type="hidden" id="status" value="<?php //echo $usuarios['estado']; ?>"  /> -->
                                        <div class="modal-body">
                                            <form action="includes/Business/business.php" method="POST">
                                                <div class="row form-group">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                                                    <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Nombre-Contacto:</label>
                                                    <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                                                        <!-- <input class="form-control input-md" type="text" value="<?php //echo $usuarios['nombres']; ?>" id="nameC" name="nameC"> -->
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
                                                        <!-- <input class="form-control input-md" type="text" value="<?php //echo $usuarios['nombre_empresa']; ?>" id="nameE" name="nameE"> -->
                                                        <input class="form-control input-md" type="text" id="nameE" name="nameE">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                                                    <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Email-Contacto:</label>
                                                    <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                                                        <!-- <input class="form-control input-md" type="email" value="<?php //echo $usuarios['correo_personal']; ?>" id="E-C" name="Apellido_Materno"> -->
                                                        <input class="form-control input-md" type="email" id="E-C" name="E-C">
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                                                    <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Email-Empresa</label>
                                                    <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                                                        <!-- <input class="form-control input-md" type="email" value="<?php //echo $usuarios['correo_corporativo']; ?>" id="E-E" name="E-E"> -->
                                                        <input class="form-control input-md" type="email" id="E-E" name="E-E">
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                                                    <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Telefono-Contacto:</label>
                                                    <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                                                        <!-- <input class="form-control input-md" type="tel" value="<?php //echo $usuarios['telefono_movil']; ?>" id="T-C" name="Correo"> -->
                                                        <input class="form-control input-md" type="tel" id="T-C" name="T-C">
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                                                    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Número de subscripciones:</label>
                                                    <div class="col-lg-6 col-md-5 col-sm-5 col-xs-6">
                                                        <!-- <input class="form-control input-md" type="number" value="<?php //echo $usuarios['num_suscripcion']; ?>" id="N-S" name="N-S"> -->
                                                        <input class="form-control input-md" type="number" id="N-S" name="N-S">
                                                    </div>
                                                </div>

                                                <!-- <div class="row form-group">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-0"></div>
                        <label class="col-lg-2 col-md-3 col-sm-3 col-4 control-label">Cursos a inscribir:</label>
                        <div class="col-lg-7 col-md-5 col-sm-5 col-6">
                            <select class="form-control seleccionador" id="C-i" name="C-i">
                                <option value="" selected disabled>Seleccionar</option>
                                <?php
                                //$pdo5 = Database::connect();
                                // $sql5 = 'SELECT * FROM cursos where permisoCurso=1';
                                // $q5 = $pdo5->prepare($sql5);
                                // $q5->execute(array());
                                // while ($registro = $q5->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <option value="<?php //echo $registro['idCurso']; ?>"><?php //echo $registro['nombreCurso']; ?></option>
                                <?php
                                // }
                                // Database::disconnect();
                                ?>
                            </select>
                        </div> -->
                                                <!-- <button onclick="agregar()" style="background-color: #FFFFFF;">
                            <i class="fas fa-plus-circle"></i>
                        </button> -->
                                        </div>

                                        <div class="row form-group">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                                            <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Fecha de solicitud:</label>
                                            <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                                                <!-- <input class="form-control input-md" type="text" id="F-S" value="<?php //echo $usuarios['fecha_registro']; ?>" readonly name="nume_documento"> -->
                                                <input class="form-control input-md" type="text" id="F-S" readonly name="F-S">
                                            </div>
                                        </div>

                                        <!-- <div class="row form-group">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                            <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Crear codigo:</label>
                            <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                                <input class="form-control input-md" id="Code" name="Code" type="text">
                            </div>
                        </div> -->

                                        <div class="row form-group">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                                            <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Contraseña:</label>
                                            <div class="col-lg-7 col-md-5 col-sm-5 col-xs-6">
                                                <input class="form-control input-md" type="text" id="Pass" name="Pass">
                                            </div>
                                        </div>
                                        <?php
                                        // $idemp = $usuarios['id_solicitud'];
                                        // $pdo6 = Database::connect();
                                        // $id_usa = $pdo6->prepare("SELECT * FROM `empresascursos` WHERE id_Empresa = '$idemp' LIMIT 1");
                                        // $id_usa->execute();
                                        // $id_usa = $id_usa->fetch(PDO::FETCH_ASSOC);
                                        // // $id_usa = $id_usa['id_Empresa'];
                                        // if (empty($id_usa)) {
                                        ?>

                                            <?php
                                        // }?>
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
                        </div>
                    </div>
                </div>

                <br>
                <br>
                <br>

            </main>

            <script>
                // function cambiarImg() {
                //     var pdrs = document.getElementById('inputGroupFile04').files[0].name;
                //     document.getElementById('infoImg').innerHTML = pdrs;
                // }

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
                //     const CheckValid = (e) => {
                //     if ($(e.target).attr("id") === "pass-confirm-registro") {
                //       // Validacion de pass-confirm-registro
                //         CheckPassRepeat($("#pass-registro"), $("#pass-confirm-registro"));
                //     } else if ($(e.target).attr("id") === "pass-registro") {
                //         ChangeValid(e.target, 1);
                //         CheckPassRepeat($("#pass-registro"), $("#pass-confirm-registro"));
                //     } else {
                //         if ($(e.target).prop("tagName") === "SELECT") CheckSelect(e.target);
                //         else ChangeValid(e.target, 1);
                //     }
                //   };

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
            </script>
