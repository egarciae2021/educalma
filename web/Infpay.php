<?php

$servername = "20.226.29.168";
$username = "root";
$password = 'T3$t1ng.C4lm4';
$dbname = "educalma";
$topic ;
$id;
 
$conn = mysqli_connect($servername, $username, $password, $dbname); 
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
 
if (isset($_GET["topic"])) {
    $topic = $_GET["topic"]; 
}

if (isset($_GET["id"])) {
    $id = $_GET["id"]; 
    }


$sql = " insert into pagos(topic,id) values ('" +   $topic       +"','"+    $id       +"')";

echo $sql;

if (mysqli_query($conn, $sql)) {
    echo "Table MyGuests created successfully";
  } else {
    echo "Error creating table: " . mysqli_error($conn);
  }

  
 
mysqli_close($conn);   


?>
