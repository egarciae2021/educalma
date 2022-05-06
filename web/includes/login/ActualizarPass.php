 
<?php 
$data = file_get_contents('php://input');
$data = json_decode($data, true);  
$cel= $data['celular'];  
$pass=$data['nueva_clave'];
$pass = password_hash($pass, PASSWORD_BCRYPT);
$mysqli = new mysqli("localhost", "root", "", "educalma"); 
$sql ="select * from usuarios where telefono = '".$cel."'";  

$result = $mysqli->query($sql);  

if (mysqli_num_rows($result) == 0){
    echo "Usuario no encontrado";
}
else{ 
    $sql ="UPDATE `usuarios` SET pass='".$pass."'   where telefono='".$cel."'  ";
    $mysqli->query($sql); 
    echo "Se actualizo el acceso";

} 

return;

?>