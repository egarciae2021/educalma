<?php 
require_once '../../database/databaseConection.php';


$cod = $_POST['codigo'];
$pdo = Database::connect();  

$veri="SELECT * FROM certificados WHERE codigo = '$cod' ";
$q = $pdo->prepare($veri);
$q->execute(array());
$dato=$q->fetch(PDO::FETCH_ASSOC);

$id = $dato['idCurso_certif'];

if($dato==null){
    echo '<script>
   
    alert ("Código Invalido");
    window.location = "../../certi.php";
    
    </script>';
    
}else{
    header('Location: ../../plugins/ejemplo.php?idCurso='.$id.''); 
}

?>
