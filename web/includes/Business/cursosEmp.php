<?php
ob_start();
@session_start();
if (isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)) {
    require_once 'database/databaseConection.php';
}
?>

<head>
    <script src="assets/js/plugins/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css" />
    <link rel="stylesheet" href="includes/dist/css/adminlte.min.css">
    <script src="assets/js/clipboard.min.js"></script>
    <script src="assets/js/funciones.js"></script>
</head>
<br>
<br>
<br>
<?php
// $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//https://educalma.fundacioncalma.org/
// echo $envio=substr($url, strrpos($url, 'h') - 1);
?>
<form action="includes/Business/addcurso.php" method="POST">
    <div class="container">
        <div class="row">
            <?php
            if (!isset($_GET['sol'])) {
            ?>
                <div class="col-12 col-md-4 col-lg-4 pb-3">
                <?php
            } else {
                ?>
                    <div class="col-12 col-md-4 col-lg-3 pb-3">
                    <?php
                }
                    ?>
                    <select class="form-control seleccionador" id="curso" name="curso">
                        <option value="" selected disabled>Seleccionar Curso</option>
                        <?php
                        $pdo5 = Database::connect();
                        $sql5 = 'SELECT * FROM cursos where permisoCurso=1';
                        $q5 = $pdo5->prepare($sql5);
                        $q5->execute(array());
                        while ($registro = $q5->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <option value="<?php echo $registro['idCurso']; ?>"><?php echo $registro['nombreCurso']; ?></option>
                        <?php
                        }
                        Database::disconnect();
                        ?>
                    </select>
                    </div>
                    <?php
                    if (!isset($_GET['sol'])) {
                    ?>
                        <div class="col-12 col-md-4 col-lg-4 pb-3">
                        <?php
                    } else {
                        ?>
                            <div class="col-12 col-md-4 col-lg-3 pb-3">
                            <?php
                        }
                            ?>
                            <?php
                            if (!isset($_GET['sol'])) {
                            ?>
                                <select class="form-control seleccionador" id="usuario" name="usuario">
                                    <option value="" selected disabled>Seleccionar Empresa</option>
                                    <?php
                                    $pdo5 = Database::connect();
                                    $sql5 = 'SELECT * FROM solicitud';
                                    $q5 = $pdo5->prepare($sql5);
                                    $q5->execute(array());
                                    while ($registro = $q5->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <option value="<?php echo $registro['id_usuario']; ?>"><?php echo $registro['correo_corporativo']; ?></option>
                                    <?php
                                    }
                                    Database::disconnect();
                                    ?>
                                </select>
                            <?php
                            } else {
                            ?>
                                <select class="form-control seleccionador" id="usuario" aria-label="Disabled select example" name="usuario">
                                    <!-- <option value="" selected disabled>Seleccionar Empresa</option> -->
                                    <?php
                                    $pdo5 = Database::connect();
                                    $emp = $_GET['sol'];
                                    $sql5 = "SELECT * FROM solicitud where id_usuario=$emp";
                                    $q5 = $pdo5->prepare($sql5);
                                    $q5->execute(array());
                                    while ($registro = $q5->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <option value="<?php echo $registro['id_usuario']; ?>"><?php echo $registro['correo_corporativo']; ?></option>
                                    <?php
                                    }
                                    Database::disconnect();
                                    ?>
                                </select>
                            <?php
                            }
                            ?>
                            </div>
                            <?php
                            if (isset($_GET['sol'])) {
                            ?>
                                <div class="col-12 col-md-4 col-lg-3 pb-3">
                                <?php
                            } else {
                                ?>
                                    <div class="col-12 col-md-4 col-lg-4 pb-3">
                                    <?php
                                }
                                    ?>
                                    <button type="submit" id="addtbl" class="btn btn-primary m-0 ">AGREGAR</button>
                                    </div>
                                    <?php
                                    if (isset($_GET['sol'])) {
                                        $ent = $_GET['sol'];
                                    ?>
                                        <div class="col-12 col-md-4 col-lg-3 pb-3">
                                            <a href="includes/Business/addcurso.php?emp=<?php echo $ent; ?>" type="button" class="btn btn-danger m-0 ">LIMPIAR</a>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                        </div>
</form>
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
                        <thead style="background-color:#AED6F1;">
                            <tr>
                                <th>Nombre-Empresa</th>
                                <th class="col-lg-6">Curso(s)</th>
                                <th class="col-lg-1">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (isset($_GET['sol'])) {
                                foreach ($users as $user) {
                                    $sql4 = "SELECT * FROM cursos where idCurso=" . $user['cod_curse'];
                                    $q3 = $pdo1->prepare($sql4);
                                    $q3->execute();
                                    $nombre = $q3->fetch(PDO::FETCH_ASSOC);

                                    $sql6 = "SELECT * FROM solicitud where id_usuario=" . $user['cod_empre'];
                                    $q6 = $pdo1->prepare($sql6);
                                    $q6->execute();
                                    $Empresa = $q6->fetch(PDO::FETCH_ASSOC);

                            ?>
                                    <tr><?php

                                        ?>
                                        <td><?php echo $Empresa['nombre_empresa']; ?></td>
                                        <td><?php echo $nombre['nombreCurso']; ?></td>
                                        <td>
                                            <center>
                                                <!-- para quitar curso -->
                                                <a href="includes\Business\addcurso.php?deli=<?php echo $nombre['idCurso']; ?>&delc=<?php echo $Empresa['id_usuario']; ?>">
                                                    <button type="button"><i class="fas fa-trash-alt"></i></button>
                                                </a>
                                            </center>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else { ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<main>
    <div class="col-12 text-center">

        <div class="card">
            <div class="card-header" style="background-color:#5499C7 ; color:white;">
                <h3 class="card-title"><strong>CONTROL DE PAGO</strong></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-4 pb-3 ">
                        <div class="card">
                            <div class="card-header" style="background-color:#5c5dc4; color:white;">
                                <h5 style="font-size: 14px;" class="card-title"><strong>CANTIDAD DE CURSOS</strong></h5>
                            </div>
                            <?php
                            if (isset($_GET['sol'])) {
                            ?>
                                <div class="card-body" style="background-color:#FDEDEC;">
                                    <?php

                                    $sql2 = $pdo1->query("SELECT COUNT(*) FROM temp where cod_empre=$ent");
                                    $name = $sql2->fetchColumn();
                                    echo $name . " curso(s)";
                                    ?>
                                </div>
                            <?php

                            }
                            ?>
                        </div>
                        <div class="card">
                            <div class="card-header" style="background-color:#5c5dc4; color:white;">
                                <h5 style="font-size: 14px;" class="card-title"><strong>CANTIDAD DE SUSCRIPCIONES</strong></h5>
                            </div>
                            <?php
                            if (isset($_GET['sol'])) {
                            ?>
                                <div class="card-body" style="background-color:#FDEDEC;">
                                    <?php
                                    $sql2 = "SELECT num_suscripcion FROM solicitud where id_usuario=" . $_GET['sol'];
                                    $q2 = $pdo1->prepare($sql2);
                                    $q2->execute();
                                    $cur = $q2->fetch(PDO::FETCH_ASSOC);
                                    echo $cur['num_suscripcion'] . " SUSCRIPCIONES";
                                    ?>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-5 pb-3 ">
                        <?php
                        if (isset($_GET['sol'])) {
                        ?>
                            <!-- <div class="card-body"> -->
                            <?php
                            $sql2 = "SELECT num_suscripcion FROM solicitud where id_usuario=" . $_GET['sol'];
                            $q2 = $pdo1->prepare($sql2);
                            $q2->execute();
                            $cur = $q2->fetch(PDO::FETCH_ASSOC);
                            echo "EL N°" . $cur['num_suscripcion'] . " ES EL NÚMERO DE SUSCRIPCIONES TOTALES";
                            ?>
                            <!-- </div> -->
                        <?php
                        }
                        ?>
                        <hr>
                        <?php
                        if (isset($_GET['sol'])) {
                        ?>
                            <!-- <div class="card-body"> -->
                            <?php
                            $sql3 = $pdo1->query("SELECT COUNT(*) FROM temp where cod_empre=$ent");
                            $q4 = $sql3->fetchColumn();
                            // $q2 = $pdo1->prepare($sql2);
                            // $q2->execute();
                            // $cur = $q2->fetch(PDO::FETCH_ASSOC);
                            echo "ESTA PROXIMO A COMPRAR " . $q4 . " CURSO(S)";
                            ?>
                            <!-- </div> -->
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3 pb-3 " style="display: flex; align-items: center; justify-content: center;">
                        <a  href="includes/Business/addcurso.php?ent= <?php echo $ent;?>" <?php
                                                                                            if (!isset($_GET['sol'])) {
                                                                                                echo 'style="width:100%;cursor: not-allowed;pointer-events: none;"';
                                                                                            } else {
                                                                                                echo 'style="width:100%;"';
                                                                                            }
                                                                                            ?> class="btn btn-primary m-0 ">GENERAR PAGO</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- <main>
    <div class="col-12 text-center">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>LINK DE PAGO</strong></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-8 pb-3 ">
                        <input style="border-radius: 6px; width: 100%;" id="foo" <?php
                                                                                    //echo '<script>window.location="../../pageEnterprice.php?id='.base64_encode($id).'&sol='.base64_encode($id_sol).'&val='.base64_encode($prube).'&subs='.base64_encode($subs).'"</script>';

                                                                                    //window.location="../../curseEmp.php?if='.base64_encode($id).'&ent='.base64_encode($id_sol).'&pag='.base64_encode($prube).'&cnt='.base64_encode($subs).'"</script>'
                                                                                    //if(isset($_GET['if']) && isset($_GET['ent']) && isset($_GET['pag']) && isset($_GET['cnt'])){
                                                                                    //$ide=base64_decode($_GET['if']);
                                                                                    //$ente=base64_decode($_GET['ent']);
                                                                                    //$pag=base64_decode($_GET['pag']);
                                                                                    //$cnt=base64_decode($_GET['cnt']);

                                                                                    //https://educalma.fundacioncalma.org/ se pone esta url en produccion
                                                                                    ?>
                        
                        value="http://localhost/EDUCALM/test-educalma/web/pageEnterprice.php?id=<?php //echo base64_encode($ide); 
                                                                                                ?>&sol=<?php //echo base64_encode($ente); 
                                                                                                        ?>&val=<?php //echo base64_encode($pag); 
                                                                                                                                                    ?>&subs=<?php //echo base64_encode($cnt);
                                                                                                                                                                                            ?>"
                        <?php
                        //}
                        ?> type="text">
                    </div>
                    <div class="col-12 col-md-4 col-lg-4 text-right pb-3 ">
                        <button type="button" style="height: 100%; width:80%;" data-clipboard-target="#foo" class="btn btn-primary m-0 portapapeles">COPIAR LINK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main> -->
<!-- <script type="text/javascript">
    $(document).ready(function(){
        $('#tabla').load('cursosEmp.php');
        // $('#tabla').this.load();
    })
</script> -->
<!-- <script type="text/javascript">
    $(document).ready(function(){
        $('#addtbl').click(function(){
            curso = $('#curso').val();
            usuario = $('#usuario').val();
            agregarDatos(curso,usuario);
        })
    })
</script> -->