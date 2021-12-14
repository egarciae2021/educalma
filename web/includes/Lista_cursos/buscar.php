<?php 
require_once '../../database/databaseConection.php';
?>
<div class="container-fluid px-0" id="result">

<div class="row"><!-- <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4"> -->
            <div class="col-12">
                <div class="row">
                    <div class="section-title-course">
                        Cursos
                        <hr>
                    </div>
                </div>
            </div>
        </div>
<?php
function buscar(){ 
    ?>

    <div class="container-card-course " > 
    <div class="row pt-4 container" style="margin: 0 auto;" >
    <?php
    $pdo2 = Database::connect();  
    $busqueda=$_POST['buscar'];
    $sql="SELECT * FROM cursos WHERE permisoCurso=1 AND nombreCurso LIKE '%".$busqueda."%'"; 
    $q = $pdo2->query($sql);
    $q->execute(array());
    $contar=$q->rowCount();
    
    if ($contar==0){
        echo '<center><h4>No se encontraron coincidencias con "'.$busqueda.'" ➜ Resultados ('.$contar.')</h4></div></center>';
    }
    if($dato=$q->fetch(PDO::FETCH_ASSOC)){
        error_reporting(0);
        $query3=$pdo2->prepare($sql);
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
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
            <div class="card">
            <div class="container-card-image">
                <img heigth="10px"; src="data:image/*;base64,<?php echo base64_encode($dato['imagenDestacadaCurso']); ?>" alt="">
                </div>
                <div class="container-card-title">
                    <a style="font-size:18px; color: black"> <center><strong><?php echo $dato['nombreCurso']; ?></strong> </center></a>
                </div>
                <div class="container-card-description">
                            
                         <p><?php echo $dato['descripcionCurso']; ?>'</p>
                         </div> 
                         <div class="container-card-link">
                         <a href= "<?php echo $paginaRed ?>.php?id=<?php echo $dato['idCurso']; ?>"> <center><strong>Ver Informaci&oacute;n > </strong> </center></a>
                        </div>
                </div>
            </div>
            
        <?php
        }  
    } Database::disconnect();      
    ?>    
    </div>   
    </div>
    </div>
</div>
</div>
    <?php
}
buscar();