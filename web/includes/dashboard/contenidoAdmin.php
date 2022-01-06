<?php
ob_start();
@session_start();
 if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
    require_once 'database/databaseConection.php';
?>

<head>
    <link rel="stylesheet" href="includes/dist/css/adminlte.min.css">
</head>

<!-- para listar y la paginacion de cursos -->
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


<!-- para listar y la paginacion de usuarios -->
<?php
    $pdo4 = Database::connect();

    $sqlU = "SELECT * FROM usuarios where estado=1 order by id_user DESC ";
    $qu = $pdo4->prepare($sqlU);
    $qu->execute();

    $contar1=$qu->rowCount();
   
    $sql3 = "SELECT * FROM usuarios where estado=1 order by id_user DESC";
    
    $q3 = $pdo4->prepare($sql3);
    $q3->execute();
    $usuarios = $q3->fetchAll(PDO::FETCH_ASSOC);

?>


<main>
    <!--tabla de curso -->
    <div class="col-12 mt-5 text-center">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Listado de Cursos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                
                <div class="table-responsive">
                    <table id="tablaCursos" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                                <tr class="h-100 justify-content-center align-items-center">
                                    <td><?php echo $curso['nombreCurso']; ?></td>
                                    <td><?php echo $datoCate['nombreCategoria']; ?></td>
                                    <td><?php echo $curso['dirigido']; ?></td>
                                    <td><img style="height: 50px;" src="data:image/*;base64,<?php echo base64_encode($curso['imagenDestacadaCurso']) ?>"></td>
                                    <!-- <td>imagen</td> -->
                                    <td><?php echo substr($curso['descripcionCurso'],0,100)."..."; ?></td>
                                    <td><?php echo $curso['costoCurso'];?></td>
                                    <td>
                                        <!--para editar curso-->
                                        <a href="editarcurso.php?id=<?php echo $curso['idCurso']; ?>">
                                            <button  class=" boton_edit" type="button"><i class="far fa-edit"></i></button>
                                        </a>
                                        <!-- para quitar curso -->
                                        <a href="includes/Cursos_crud/Cursos_CRUD.php?id_eliminar=<?php echo $curso['idCurso']; ?>">
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
    
    <!--tabla de usuarios -->
    <div class="col-12 mt-5 text-center">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Listado de usuarios</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                
                <div class="table-responsive">
                    <table id="tableUsuarios" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Privilegio</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>Telefono</th>
                                <th>N° documento</th>
                                <th>Sexo</th>
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
                                $dotoPrivilegio= $q6->fetchAll();
                                // para el sexo
                                $idSexo = $usuarios['sexo'];
                                $sql7 = "SELECT * FROM sexo WHERE id_genero = '$idSexo'";
                                $q7 = $pdo4->prepare($sql7);
                                $q7->execute(array());
                                $datoSexo = $q7->fetch(PDO::FETCH_ASSOC);
                            ?>
                                <tr class="h-100 justify-content-center align-items-center">
                                    <td><?php echo $datoPrivi['nombre_privilegio']; ?></td>
                                    <td><?php echo $usuarios['nombres']; ?></td>
                                    <td><?php echo $usuarios['apellido_pat']." ".$usuarios['apellido_mat']; ?></td>
                                    <td><?php echo $usuarios['email']; ?></td>
                                    <td><?php echo $usuarios['telefono']; ?></td>
                                    <td><?php echo $usuarios['nro_doc']; ?></td>
                                    <td><?php echo $datoSexo['nombre_genero']; ?></td>
                                    <!-- <td><img style="height: 50px;" src="data:image/*;base64,<php echo base64_encode($usuarios['mifoto']) ?>"></td> -->
                                    
                                    <td>
                                        <!--para editar usuario-->
                                        <a href="#">
                                            <button  class=" boton_edit" type="button"><i class="far fa-edit"></i></button>
                                        </a>
                                        <!-- para quitar usuario -->
                                        <a href="#">
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

    <br>
    <br>
    <br>
    <br>
    <br>

</main>


<?php
    }
    else{
        header('Location: ../../iniciosesion.php');
    }
?>
