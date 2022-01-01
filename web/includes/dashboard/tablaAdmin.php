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
                $sql = "SELECT * FROM cursos WHERE permisoCurso=1 AND nombreCurso LIKE '%" . $busqueda . "%'";
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
    buscar();
