<?php
require_once '../../database/databaseConection.php';
?>
<div class="container-fluid px-0" id="result">
    <?php
    function buscar()
    {
    ?>

        <div class="container-card-course">
            <div class="row pt-1 container d-flex justify-content-center" style="margin: 0 auto;">
                <?php
                $pdo2 = Database::connect();
                $busqueda = $_POST['buscar'];
                $sql = "SELECT * FROM cursos WHERE estado=1 AND permisoCurso=1 AND nombreCurso LIKE '%" . $busqueda . "%'";
                $q = $pdo2->query($sql);
                $q->execute(array());
                $contar = $q->rowCount();

                if ($contar == 0) {
                    echo '
                    <h5>No se encontraron coincidencias con "' . $busqueda . '" ➜ Resultados (' . $contar . ')</h5></div>';
                }

                if ($dato = $q->fetch(PDO::FETCH_ASSOC)) {

                    error_reporting(0);
                    $query3 = $pdo2->prepare($sql);
                    $query3->execute();
                    Database::disconnect();
                    while ($dato = $query3->fetch(PDO::FETCH_ASSOC)) {
                        if (isset($_SESSION['codUsuario'])) {
                            $cursoID = $dato['idCurso'];
                            $userID = $_SESSION['codUsuario'];
                            $sql4 = "SELECT * FROM cursoinscrito where curso_id='$cursoID' and usuario_id = '$userID' ";
                            $query4 = $pdo2->prepare($sql4);
                            $query4->execute(array());
                            $dato2 = $query4->fetch(PDO::FETCH_ASSOC);
                            if (empty($dato2)) {
                                $paginaRed = "detallecurso";
                            } else {
                                $paginaRed = "curso";
                            }
                        } else {
                            $paginaRed = "detallecurso";
                        }
                ?>
                
              
                      
                














                


                <?php
                    }
                }
                Database::disconnect();
                ?>
            </div>
        </div>
</div>
</div>
</div>
<?php
    }
    buscar();