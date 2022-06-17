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

    // while($row=$sql->fetch(PDO::FETCH_ASSOC)){ 
    //     echo json_encode($row); 
    // }

    $test = "[{'avalible':true,'name':'{\'Barranco\'}','picture':'{\'https://viajes.nationalgeographic.com.es/medio/2019/11/06/barranco1_efb2c25b_800x800.jpg\'}','price':'{\'s/20.00\'}'},{'avalible':true,'name':'{\'Lima\'}','picture':'{https://elviajerolibre.com/wp-content/uploads/2020/04/Lima-que-ver.jpg}','price':'{\'s/25.00\'}'},{'avalible':true,'name':'{\'Chorrillos}','picture':'{https://st.depositphotos.com/1010142/3084/i/450/depositphotos_30847313-stock-photo-coast-of-lima-peru.jpg}','price':'{\'15.00\'}'},{'avalible':true,'name':'{\'Parque de las leyendas}','picture':'{https://leyendas.gob.pe/wp-content/uploads/2022/01/PARQUE-DE-LAS-LEYENDAS-002-scaled.jpg}','price':'{\'s/50.00\'}'}]";
    echo ($test); 
//    header("HTTP/1.1 200 OK");
 
  exit();

}
 

//En caso de que ninguna de las opciones anteriores se haya ejecutado
// header("HTTP/1.1 400 Bad Request");
?>