<?php
require_once './database/databaseConection.php';

$correo = $_POST["email"];


$pdo = Database::connect();
$sql = "SELECT count(*) as cantidad from usuarios WHERE email = '$correo'";
$q = $pdo->prepare($sql);
$q->execute(array());
// $cuenta = $q->rowCount();
$result = $q->fetch(PDO::FETCH_ASSOC);
// echo var_dump($result);
Database::disconnect();
echo json_encode($result);
