<?php
include "config.php";
include "utils.php";
$dbConn =  connect($db);
/*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{

    $myObj->name = "John";
    $myObj->age = 30;
    $myObj->city = "New York";
    
    $myJSON = json_encode($myObj);
    
 

  //Mostrar un post
  $sql = $dbConn->prepare("SELECT * FROM `usuarios`");
 
  $sql->execute(); 

  $userData = array();

    while($row=$sql->fetch(PDO::FETCH_ASSOC)){
    
        // $userData['AllUsers'][] = $row;
        echo json_encode($row);
    
    }


//    header("HTTP/1.1 200 OK");
 
  exit();

}
 

//En caso de que ninguna de las opciones anteriores se haya ejecutado
// header("HTTP/1.1 400 Bad Request");
?>