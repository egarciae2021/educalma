<?php 
require_once '../../database/databaseConection.php';


$cod = $_POST['codigo'];
$pdo = Database::connect();  

$veri="SELECT * FROM certificados WHERE codigo = '$cod' ";
$q = $pdo->prepare($veri);
$q->execute(array());
$dato=$q->fetch(PDO::FETCH_ASSOC);

if($dato==null){
    echo '<script>
   
    alert ("Código Invalido");
    window.location = "../../certi.php";
    
    </script>';
    
}else{
    $id = $dato['idCurso_certif'];
    $idU = $dato['idUser_certif'];
    $_SESSION['codUsuario']=$idU;
    header('Location: ../../plugins/ejemplo.php?idCurso='.$id.'&idUsu='.$idU.''); 
}

?>
