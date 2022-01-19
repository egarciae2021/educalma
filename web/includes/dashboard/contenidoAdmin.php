<?php
ob_start();
@session_start();
 if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
    require_once 'database/databaseConection.php';
?>

<head>
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css" />
    <link rel="stylesheet" href="includes/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="assets/css/styledash.css">
</head>

<!-- para lista de cursos -->
<?php
    $pdo3 = Database::connect();

    $sqlz = "SELECT * FROM cursos where permisoCurso=1 order by idCurso DESC ";
    $qz = $pdo3->prepare($sqlz);
    $qz->execute();

    $contar=$qz->rowCount();

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

<!-- para lista de usuarios -->
<?php
    $pdo4 = Database::connect();
    $sql3 = "SELECT * FROM usuarios where estado=1 order by id_user DESC";
    $q3 = $pdo4->prepare($sql3);
    $q3->execute();
    $usuarios = $q3->fetchAll(PDO::FETCH_ASSOC);
?>


<!-- CODIGO NUEVO -->
<main>
        <!--tabla de curso -->
        <div class="container-fluid">
            <!-- sin container -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="title">Administrar</div>
                    <div id="accordion">
                        <div class="row">
                            <div class="col-12">
                                <nav class="navbar navbar-expand">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                por cursos
                                            </a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link " href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                por usuarios
                                            </a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link " href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                por empresas
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <?php
                        $pdo3 = Database::connect();

                        $sqlCur = "SELECT COUNT(*) AS cantidad FROM cursos WHERE permisoCurso = 1;";
                        $qCur = $pdo3->prepare($sqlCur);
                        $qCur->execute(array());
                        $resultCurs = $qCur->fetch(PDO::FETCH_ASSOC);
                        ?>

                        <div class="col-12" id="headingOne">
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card mt-2">
                                    <div class="card-header">
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <h3 class="card-title">Cantidad de cursos
                                                    <span style="color:#C1E1EE;">(<?php echo $resultCurs['cantidad']; ?>))</span>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-7"></div>
                                            <div class="col-12 col-md-5">
                                                <div id="tablaCursos_filter" class="dataTables_filter">

                                                    <!-- <input type="search " class="form-control form-control-sm " placeholder=" " aria-controls="tablaCursos "> -->

                                                    <div class="input-group mb-3">
                                                        <input type="search" class="form-control buscador" placeholder="Buscar" aria-controls="tablaCursos" aria-describedby="basic-addon2">
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn btn-outline-dark border-left-0" style="border-color: #ced4da;border-radius: 0 50px 50px 0;">
                                                                <i class="fas fa-search"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body"><div class=" ">
                                        <div class="table-responsive">
                                            <table id="tablaCursos" class="table table-borderless dt-responsive text-left" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th style="border-radius: 10px 0 0 10px;">
                                                            Imagen
                                                        </th>
                                                        <th scope="col">Nombre</th>
                                                        <th>Descripción</th>
                                                        <th>Categoría</th>
                                                        <th>Dirigido</th>
                                                        <th>Costo</th>
                                                        <th>Publicado</th>
                                                        <th style="border-radius: 0 10px 10px 0;">
                                                            Acción
                                                        </th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    <?php
                                                    foreach ($curso as $curso) {
                                                        $pdo4 = Database::connect();
                                                        $idCate = $curso['categoriaCurso'];
                                                        $sql4 = "SELECT * FROM categorias WHERE idCategoria = '$idCate'";
                                                        $q4 = $pdo4->prepare($sql4);
                                                        $q4->execute(array());
                                                        $datoCate = $q4->fetch(PDO::FETCH_ASSOC);
                                                        $dotocoto= $q4->fetchAll();
                                                    ?>

                                                    <tr>
                                                        <td>
                                                            <img style="height: 40px;" class="rounded-circle" src="data:image/*;base64,<?php echo base64_encode($curso['imagenDestacadaCurso']) ?>">
                                                        </td>
                                                        <td>
                                                            <?php echo $curso['nombreCurso'];?>
                                                        </td>
                                                        <td>
                                                            <?php echo substr($curso['descripcionCurso'],0,100)."..."; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $datoCate['nombreCategoria'];?>-
                                                        </td>
                                                        <td>
                                                            <?php echo $curso['dirigido'];?>
                                                        </td>
                                                        <td>
                                                            <?php echo $curso['costoCurso'];?>
                                                        </td>
                                                        <td>
                                                            <?php echo $curso['fechaPulicacion'];?>
                                                        </td>
                                                        <td>
                                                            <!--para editar curso-->
                                                            <div class="btn-group" role="group">
                                                                <a href="editarcurso.php?id=<?php echo $curso['idCurso'];?>">
                                                                    <button type="button" class="btn btn-edit">
                                                                        <i class="far fa-edit"></i>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                            <!-- para quitar curso -->
                                                            <div class="btn-group" role="group">
                                                                <a href="includes/Cursos_crud/Cursos_CRUD.php?id_eliminar=<?php echo $curso['idCurso'];?>">
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
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- fin tabla cursos -->

                                <!-- paginador de cursos-->
                                <div class="col-12">
                                    <div class="row pag">
                                        <nav>
                                            <ul class="pagination mt-3">
                                                <li class="page-item"><a class="page-link text-info" href="#">Anterior</a></li>
                                                <li class="page-item"><a class="page-link text-info num" href="#">1</a></li>
                                                <li class="page-item"><a class="page-link text-info" href="#">Siguiente</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <!--fin paginador -->
                                    <?php
                                    $pdo3 = Database::connect();

                                    $sql3 = "SELECT COUNT(*) AS cantidad FROM categorias";
                                    $q3 = $pdo3->prepare($sql3);
                                    $q3->execute(array());
                                    $resultCa = $q3->fetch(PDO::FETCH_ASSOC);

                                    ?>

                                    <!-- tablas (2) categorias  -->
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 class="card-title mb-3">Cantidad de categorías
                                                <span style="color:#C1E1EE;">(<?php echo $resultCa['cantidad']; ?>)</span>
                                            </h3>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <!-- tabla añadir categorias -->
                                        <div class="col-12 col-md-6">
                                            <div class="card t-categ">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <form id="formRegis" action="includes/categorias/checkAgrCateg.php" target="dummyframe" method="POST" onsubmit="return comprobarCategoria()" style="padding:0;"> 
                                                            <table id="" class="table table-borderless text-center dt-responsive text-center" cellspacing="0 " width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="border-radius:10px;">
                                                                            nombre de categoría
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <input class="form-control" type="text" id="categoria_agregar" name="categoria_agregar"   aria-describedby="temaAgr-addon" placeholder="Ingrese nombre de categoría" required>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <button type="submit" id="categoria_agregar" class="btn btn-block btn-categ"> Agregar</button>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <input class="btn btn-block btn-categ" type="reset" value="limpiar">
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>
                                        <!-- tabla fin añadir categorias -->

                                        <!-- tabla accion categorias -->
                                        <div class="col-12 col-md-6">
                                            <div class="card pt-0">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="" class="table table-borderless text-center dt-responsive text-center" cellspacing="0" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th style="border-radius: 10px 0 0 10px;">
                                                                        nombre de categoría
                                                                    </th>
                                                                    <th style="border-radius:0 10px 10px 0;">
                                                                        acción
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $pdo3 = Database::connect();

                                                                $sql3 = "SELECT * FROM categorias ";
                                                                $q3 = $pdo3->prepare($sql3);
                                                                $q3->execute();
                                                                while ($dato3 = $q3->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                                    <tr>
                                                                        <td>
                                                                            <input type="text" value="<?php echo $dato3['nombreCategoria'] ?>" aria-label="Recipient's username with two button addons" style="text-align:center;border:0;background:none;" disabled>
                                                                        </td>
                                                                        <td>
                                                                            <!--para editar categoría-->
                                                                            <div class="btn-group" role="group">
                                                                                <a>
                                                                                    <button class="btn btn-edit" nombre="categoria_editar" type="button" data-toggle="modal" data-target="#ModalCategoria<?php echo $dato3['idCategoria']; ?>">
                                                                                    <i class='fas fa-edit'></i></button>
                                                                                </a>  
                                                                            </div>
                                                                            <!-- para quitar categoría -->
                                                                            <div class="btn-group" role="group">
                                                                                <a id="eliminar_categoria" href="#" data-id="<?php echo $dato3['idCategoria'] ?>">
                                                                                    <button class="btn btn-quitar" type="button">
                                                                                    <i class="fas fa-trash-alt"></i></button>
                                                                                </a>
                                                                            </div>

                                                                            <!--/----------------------------------------MODAL EDITAR ---------------------------------------------------->
                                                                            <div class="modal fade" id="ModalCategoria<?php echo $dato3['idCategoria']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h4>Editar Categoria</h4>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div>
                                                                                            <form id="formCatEditar" method="post" action="includes/categorias/checkEditCateg.php">
                                                                                                
                                                                                                    <div class="modal-body ">
                                                                                                        
                                                                                                        <input type="text" id="idCategoria" name="idCategoria" class="form-control" value="<?php echo $dato3['idCategoria']; ?>" style="display: none;" />
                                                                                                        <div class="form-group" style="padding: 0px;">
                                                                                                            <label class="col-form-label">CATEGORIA</label>
                                                                                                            <input type="text" placeholder="Categoria" id="nombreCategoria" name="nombreCategoria" class="form-control" value="<?php echo $dato3['nombreCategoria']; ?>" required />
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="modal-footer">
                                                                                                        <button type="submit"  class="btn btn-primary">Guardar</button>
                                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                                                    </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                Database::disconnect();
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>
                                        <!-- tabla fin accion categorias -->

                                    </div>
                                    <!-- paginador de categorías-->
                                    <div class="col-12">
                                        <div class="row pag">
                                            <nav>
                                                <ul class="pagination mt-3">
                                                    <li class="page-item"><a class="page-link text-info" href="#">Anterior</a></li>
                                                    <li class="page-item"><a class="page-link text-info num" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link text-info" href="#">Siguiente</a></li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                    <!--fin paginador -->
                                </div>
                            </div>
                            <!-- fin tablas categorias -->

                            <?php
                            $pdo3 = Database::connect();

                            $sqlUsu = "SELECT COUNT(*) AS cantidad FROM usuarios WHERE estado = 1";
                            $qUsua = $pdo3->prepare($sqlUsu);
                            $qUsua->execute(array());
                            $resultUsu = $qUsua->fetch(PDO::FETCH_ASSOC);

                            ?>

                            <!-- TABLA DE USUARIOS  -->
                            <div id="headingTwo">
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row mb-2">
                                                <div class="col-12">
                                                    <h3 class="card-title">Cantidad de usuarios
                                                        <span style="color:#C1E1EE;">(<?php echo $resultUsu['cantidad']; ?>)</span>
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-7"></div>
                                                <div class="col-12 col-md-5">
                                                    <div id="" class="">
                                                        <div class="input-group mb-3">
                                                            <input type="search" class="form-control buscador" placeholder="Buscar" aria-controls="" aria-describedby="basic-addon2">
                                                            <div class="input-group-append">
                                                                <button type="button" class="btn btn-outline-dark border-left-0" style="border-color: #ced4da;border-radius: 0 50px 50px 0;">
                                                                    <i class="fas fa-search"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="tableUsuarios" class="table table-borderless dt-responsive nowrap text-center" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th style="border-radius: 10px 0 0 10px;">
                                                                Privilegio
                                                            </th>
                                                            <th>Nombres</th>
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
                                                            $dotoPrivilegio= $q6->fetchAll();
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
                                                            <td><?php echo $usuarios['apellido_pat']." ".$usuarios['apellido_mat']; ?></td>
                                                            <td><?php echo $usuarios['email']; ?></td>
                                                            <td ><?php echo $usuarios['telefono']; ?></td>
                                                            <td><?php echo $usuarios['nro_doc']; ?></td>
                                                            <td><?php echo $datoSexo['nombre_genero']; ?></td>
                                                            <!-- <td><img style="height: 50px;" src="data:image/*;base64,<php echo base64_encode($usuarios[ 'mifoto']) ?>"></td> -->
                                                            <td>
                                                                <?php $idUsu = $usuarios['id_user']?>
                                                                <!--para editar usuario-->
                                                                <div class="btn-group" role="group">
                                                                    <a href="#" data-toggle="modal" data-target="#modalAdmin" <?php echo "onclick='masInfoUser( $idUsu )'"?>>
                                                                        <button type="button" class="btn btn-edit">
                                                                            <i class="far fa-edit"></i>
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                                <!-- para quitar usuario -->
                                                                <div class="btn-group" role="group">
                                                                    <a href="includes/usersidebar/actualizar_perfil.php?id_eliminar=<?php echo $usuarios['id_user'];?>">
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
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- paginador de usuarios-->
                                    <div class="col-12">
                                        <div class="row pag">
                                            <nav>
                                                <ul class="pagination mt-3">
                                                    <li class="page-item"><a class="page-link text-info" href="#">Anterior</a></li>
                                                    <li class="page-item"><a class="page-link text-info num" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link text-info" href="#">Siguiente</a></li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                    <!--fin paginador -->
                                </div>
                            </div>
                            <!-- FIN NUEVA TABLA USUARIO -->

                            <!-- Tabla empresas -->
                            <div id="headingThree">
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row mb-2">
                                                <div class="col-12">
                                                    <h3 class="card-title">Cantidad de empresas
                                                        <span style="color:#C1E1EE;">(20)</span>
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-7"></div>
                                                <div class="col-12 col-md-5">
                                                    <div id="" class="">
                                                        <div class="input-group mb-3">
                                                            <input type="search" class="form-control buscador" placeholder="Buscar" aria-controls="" aria-describedby="basic-addon2">
                                                            <div class="input-group-append">
                                                                <button type="button" class="btn btn-outline-dark border-left-0" style="border-color: #ced4da;border-radius: 0 50px 50px 0;">
                                                                    <i class="fas fa-search"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="" class="table table-borderless dt-responsive text-center" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th style="border-radius: 10px 0 0 10px;">
                                                                lorem
                                                            </th>
                                                            <th>lorem</th>
                                                            <th>lorem</th>
                                                            <th>lorem</th>
                                                            <th>lorem</th>
                                                            <th>lorem</th>
                                                            <th style="border-radius: 0 10px 10px 0;">
                                                                lorem
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>lorem ipsum</td>
                                                            <td>lorem ipsum</td>
                                                            <td>lorem ipsum</td>
                                                            <td>lorem ipsum</td>
                                                            <td>lorem ipsum</td>
                                                            <td>lorem ipsum</td>
                                                            <td>
                                                                <!--para editar empresa-->
                                                                <div class="btn-group" role="group">
                                                                    <a href="#">
                                                                        <button type="button" class="btn btn-edit">
                                                                            <i class="far fa-edit"></i>
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                                <!-- para quitar empresa -->
                                                                <div class="btn-group" role="group">
                                                                    <a href="#">
                                                                        <button type="button" class="btn btn-quitar">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- paginador de empresas-->
                                    <div class="col-12">
                                        <div class="row pag">
                                            <nav>
                                                <ul class="pagination mt-3">
                                                    <li class="page-item"><a class="page-link text-info" href="#">Anterior</a></li>
                                                    <li class="page-item"><a class="page-link text-info num" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link text-info" href="#">Siguiente</a></li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                    <!--fin paginador -->
                                </div>
                                <!-- fin tabla empresas -->
                            </div>
                        </div>
                    </div>
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
                    <input type="hidden" id = "id_userV" name="id_userV"/>
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
                            <input class="form-control input-md" type="text" id="Apellidop" name="Apellido_Paterno" >
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
                        <button type="submit" class="btn btn-blue" onclick="actualizarUser();"
                            style="color: #FFFFFF; background: #0093E9; background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);">
                            Editar <i class="far fa-edit"></i>
                        </button>
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- fin modal -->

            <br>
            <br>
            <br>

    </main>
<!-- FIN CODIGO NUEVO -->

<!-- <script src="./assets/js/Validator.js"></script>
<script src="./assets/js/sidebarEditar.js"></script> -->

<script>
    function cambiarImg() {
        var pdrs = document.getElementById('inputGroupFile04').files[0].name;
        document.getElementById('infoImg').innerHTML = pdrs;
    }

    function masInfoUser(x){
        document.getElementById("Nombre").value="";
        document.getElementById("Apellidop").value="";
        document.getElementById("Apellidom").value="";
        document.getElementById("Pais").value="";
        document.getElementById("Correo").value="";
        document.getElementById("Telefono").value="";
        document.getElementById("Tipod").value="";
        document.getElementById("Numero").value="";
        document.getElementById("Tipos").value="";
        document.getElementById("Fecha").value="";
        
        //mensaje de espera

        $.ajax({
            url: "includes/usersidebar/actualizar_perfil.php",
            type: "POST",
            data: "cod_user=" + x,
            dataType: 'json',
            cache: false,
            success: function(arr){

                document.getElementById("Nombre").value=arr[0];
                document.getElementById("Apellidop").value=arr[1];
                document.getElementById("Apellidom").value=arr[2];
                document.getElementById("Pais").value=arr[3];
                document.getElementById("Correo").value=arr[4];
                document.getElementById("Telefono").value=arr[5];
                document.getElementById("Tipod").value=arr[6];
                document.getElementById("Numero").value=arr[7];
                document.getElementById("Tipos").value=arr[8];
                document.getElementById("Fecha").value=arr[9];
                document.getElementById("id_userV").value=arr[10];
            },
            
        });
    }

    function actualizarUser(){
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
        }).then(function () {
            $.ajax({
                url: "includes/usersidebar/actualizar_perfil.php",
                type: "POST",
                dataType:'json',
                data:{
                    id_usuario:cod_user,
                    tipo_docUser:tipo_doc_user,
                    numdoc_user:num_docUser,
                    nombre_user:nombre_user,
                    apellido_p_user:userPaterno,
                    apellido_m_user:userMaterno,
                    correo_user: correoUser,
                    fecha_nac_user:nacimientoUser,
                    sexo_user:sexoUser,
                    telefono_user:telefUser,
                    pais_user:userPais
                },
                cache: false
            }).done( function() {
                Swal.fire({
                    title: 'Usuario Actualizado',
                    text: 'Se han actualizado los datos satisfactoriamente.',
                    icon: 'success',
                }).then(function(){ 
                    location.reload();
                });
                
            }).fail( function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Ocurrio un problama al actualizar el usuario',
                    icon: 'error',
                }).then(function(){ 
                    location.reload();
                });
            })
        }, function (dismiss) {
            if (dismiss === 'cancel') {
            }
        }
        )
    }


</script>

<?php
    }
    else{
        header('Location: ../../iniciosesion.php');
    }
?>
