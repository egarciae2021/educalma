<?php 


require_once '../../database/databaseConection.php';

function buscar(){ 
    $busqueda=$_POST['buscar'];
    $pdo2 = Database::connect();  
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
           
            //ALGORITMO CURSO INSCRITO Y NO INSCRITO
            if (isset($_SESSION['codUsuario'])) {
                $cursoID = $dato['idCurso'];
                $userID = $_SESSION['codUsuario'];
                $sql4 = "SELECT * FROM cursoinscrito where curso_id='$cursoID' and usuario_id = '$userID'";
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
            <div class="contenedor">
                <img src="data:image/*;base64,<?php echo base64_encode($dato['imagenDestacadaCurso']); ?>" alt="">
                    <div class="box-datos">
                        <a href= "<?php echo $paginaRed ?>.php?id=<?php echo $dato['idCurso']; ?>" style="font-size:18px; color: #4F52D6"> <center><strong><?php echo $dato['nombreCurso']; ?></strong> </center></a>
                        <div class="redes">
                        <span class="date">Dirigido: <?php echo $dato['dirigido']; ?></span>
                        </div>    
                    <p><?php echo $dato['descripcionCurso']; ?>'</p>
                    </div>
            </div>
             
        <?php 
        }  
    } Database::disconnect();      
                  
}
buscar();

