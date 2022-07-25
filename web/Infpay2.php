<?php

$servername = "20.226.29.168";
$username = "root";
$password = 'T3$t1ng.C4lm4';
$dbname = "educalma";
$topic = "" ;
$id = "" ;
 
$conn = mysqli_connect($servername, $username, $password, $dbname); 
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

 
 $topic="esto";
 $id="es una prueba";
    
    $json = file_get_contents('php://input');
    $recibe = json_encode($json); 
    echo $recibe;
    
    $sql = "INSERT INTO pagos(topic,id,resultado) VALUES ('$topic' ,'$id','$recibe')";
    if (mysqli_query($conn, $sql)) {
        echo  "successfully";
      } else {
        echo "Error creating table: " . mysqli_error($conn);
      }
    mysqli_close($conn);   
     
 





?>
