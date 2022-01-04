<?php
require_once '../../database/databaseConection.php';
?>

    <?php
    function buscar()
    {
    ?>
                <?php
                $pdo2 = Database::connect();
                $busqueda = $_POST['buscar'];
                $sql = "SELECT * FROM cursos WHERE permisoCurso=1 AND nombreCurso LIKE '%" . $busqueda . "%' ORDER BY idCurso DESC LIMIT 6 ";
                $q = $pdo2->query($sql);
                $q->execute(array());

                if ($dato = $q->fetch(PDO::FETCH_ASSOC)) {
                    error_reporting(0);
                    $query3 = $pdo2->prepare($sql);
                    $query3->execute();
                    Database::disconnect();
                    while ($dato = $query3->fetch(PDO::FETCH_ASSOC)) {
                        $pdo4 = Database::connect();
                        $idCate = $dato['categoriaCurso'];
                        $sql4 = "SELECT * FROM categorias WHERE idCategoria = '$idCate'";
                        $q4 = $pdo4->prepare($sql4);
                        $q4->execute(array());
                        $datoCate = $q4->fetch(PDO::FETCH_ASSOC)
                ?>
                <tr>
                        <td><?php echo $dato['nombreCurso']; ?></td>
                        <td><?php echo $datoCate['nombreCategoria']; ?></td>
                        <td><?php echo $dato['dirigido']; ?></td>
                        <td><img style="height: 50px;" src="data:image/*;base64,<?php echo base64_encode($dato['imagenDestacadaCurso']) ?>"></td>
                        <!-- <td>imagen</td> -->
                        <td><?php echo substr($dato['descripcionCurso'],0,100)."..."; ?></td>
                        <td><?php echo $dato['costoCurso'];?></td>
                        <td>
                            <!--para editar curso-->
                            <a href="editarcurso.php?id_curso=<?php echo $dato['idCurso']; ?>">
                                <button  class=" boton_edit" type="button"><i class="far fa-edit"></i></button>
                            </a>
                            <!-- para quitar curso -->
                            <a href="includes/Cursos_crud/Cursos_CRUD.php?id_eliminar=<?php echo $dato['idCurso']; ?>">
                                <button type="button"><i class="fas fa-trash-alt"></i></button>
                            </a>
                        </td>
                </tr>
                <?php
                    }
                }
                Database::disconnect();
                ?>
<?php
    }

    function buscarUsuario()
    {
    ?>
                <?php
                $pdo2 = Database::connect();
                $busqueda1 = $_POST['buscarUsua'];
                $sql = "SELECT * FROM usuarios WHERE estado=1 AND nombres LIKE '%" . $busqueda1 . "%' ORDER BY id_user DESC LIMIT 6 ";
                $q = $pdo2->query($sql);
                $q->execute(array());

                if ($dato = $q->fetch(PDO::FETCH_ASSOC)) {
                    error_reporting(0);
                    $query3 = $pdo2->prepare($sql);
                    $query3->execute();
                    Database::disconnect();
                    while ($usuarios = $query3->fetch(PDO::FETCH_ASSOC)) {
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
                <?php
                    }
                }
                Database::disconnect();
                ?>
<?php
    }

    if (isset($_POST['buscar'])){
        buscar();
    }
    
    if (isset($_POST['buscarUsua'])){
        buscarUsuario();
    }
