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
    $cantidad_paginas=6;
    $page=$contar/$cantidad_paginas;
    $page=ceil($page);

    if(isset($_GET['pag'])){
        $pagina = $_GET['pag'];
    }else{
        $pagina = 1;
    }

    if ($contar>0) {
        if($pagina>$page||$pagina<1){
            header('Location:user-sidebar.php?pag=1');
        }
    }
    $inicio=($pagina-1)*$cantidad_paginas;


    if ($_SESSION['privilegio'] == 2) {
        $idProfe = $_SESSION['codUsuario'];
        $sql3 = "SELECT * FROM cursos WHERE id_userprofesor='$idProfe' order by idCurso DESC";
    } else {
        $idProfe = $_SESSION['codUsuario'];
        $sql3 = "SELECT * FROM cursos WHERE permisoCurso=1 order by idCurso DESC LIMIT $inicio,$cantidad_paginas";
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
    // $cantidad_paginas=6;
    $page1=$contar1/$cantidad_paginas;
    $page1=ceil($page1);

    if(isset($_GET['pagU'])){
        $PaginaUsu = $_GET['pagU'];
    }else{
        $PaginaUsu = 1;
    }

    if ($contar1>0) {
        if($PaginaUsu>$page1||$PaginaUsu<1){
            header('Location:user-sidebar.php?pag=1');
        }
    }
    $inicio1=($PaginaUsu-1)*$cantidad_paginas;

    $sql3 = "SELECT * FROM usuarios where estado=1 order by id_user DESC LIMIT $inicio1,$cantidad_paginas";
    
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
                
                <!-- Para buscar el curso -->
                <div style="text-align: right!important; margin: 15px 0px;">
                    <input type="text" class="input" id="buscarCur" name="buscarCur" placeholder="Busca un curso...">
                    <!-- <div class="btn btn_common">
                        <i class="fas fa-search"></i>
                    </div> -->
                </div>

                <div class="table-responsive">
                    <table id="listaCursosAd" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                        
                        <tbody  id="resultadoBusqueda">
                            
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


                <!--PAGINADOR-->       
                <nav aria-label="Page navigation calma" class="pdt50">
                    <ul class="pagination justify-content-end">
                        <li class="page-item <?php if($pagina<=1)echo 'disabled'?>">
                            <a class="page-link" href="user-sidebar.php?pag=<?php echo $pagina-1;?>&pagU=<?php echo $PaginaUsu;?>">
                            Anterior
                            </a>
                        </li>
                        <?php for($i=0;$i<$page;$i++):?>
                            <li class="page-item <?php echo $pagina==$i+1?'activate':''?>">
                                <a class="page-link" href="user-sidebar.php?pag=<?php echo $i+1;?>&pagU=<?php echo $PaginaUsu;?>"><?php echo $i+1;?></a>
                            </li>
                        <?php endfor?>
                            <li class="page-item <?php if($pagina>=$page) echo 'disabled'?>">
                                <a class="page-link" href="user-sidebar.php?pag=<?php echo $pagina+1;?>&pagU=<?php echo $PaginaUsu;?>">Siguiente</a>
                            </li>
                    </ul>
                </nav>
                <!--PAGINADOR FIN-->
                
               
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
                

                <!-- Para buscar el curso -->
                <div style="text-align: right!important; margin: 15px 0px;">
                    <input type="text" class="input" id="buscarUsuario" name="buscarUsuario" placeholder="Busca un usuario...">
                    <!-- <div class="btn btn_common">
                        <i class="fas fa-search"></i>
                    </div> -->
                </div>

                <div class="table-responsive">
                    <table id="listaCursosAd" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                        
                        <tbody  id="BusquedaUsuario">
                            
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

                <!--PAGINADOR-->       
                <nav aria-label="Page navigation calma" class="pdt50">
                    <ul class="pagination justify-content-end">
                        <li class="page-item <?php if($PaginaUsu<=1)echo 'disabled'?>">
                            <a class="page-link" href="user-sidebar.php?pag=<?php echo $pagina;?>&pagU=<?php echo $PaginaUsu-1;?>">
                            Anterior
                            </a>
                        </li>
                        <?php for($i=0;$i<$page1;$i++):?>
                            <li class="page-item <?php echo $PaginaUsu==$i+1?'activate':''?>">
                                <a class="page-link" href="user-sidebar.php?pag=<?php echo $pagina;?>&pagU=<?php echo $i+1;?>"><?php echo $i+1;?></a>
                            </li>
                        <?php endfor?>
                            <li class="page-item <?php if($PaginaUsu>=$page1) echo 'disabled'?>">
                                <a class="page-link" href="user-sidebar.php?pag=<?php echo $pagina;?>&pagU=<?php echo $PaginaUsu+1;?>">Siguiente</a>
                            </li>
                    </ul>
                </nav>
                <!--PAGINADOR FIN-->

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
