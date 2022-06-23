<?php
include "config.php";
include "utils.php";


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Allow: GET, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Origin, Access-Control-Allow-Headers, Authorization, X-Requested-With, X-Api-Key, Accept");

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
  $sql = $dbConn->prepare("SELECT * FROM `temp` ");
 
  $sql->execute(); 

  $userData = array();
  $userData2 = array();
    while($row=$sql->fetch(PDO::FETCH_ASSOC)){ 

          //  $temp = mb_convert_encoding($row, 'UTF8', 'Windows-1252');
        array_push($userData,$row);
    }
  

    http_response_code(200);

    $userData2 = array("data"=>$userData);
    
    echo json_encode($userData2,JSON_FORCE_OBJECT); 
   
  exit();

}
?>