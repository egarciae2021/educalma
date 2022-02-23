<?php
/* CONSULTA DE TRANSACCION
    Metodo para consultar el estado de la transaccion
*/

$keyPayme = "EmQipLueZd0PMrAv.jq3CL4p4j6OIQPOLFrnFFBPNGtbVyvFN75IsDb1fOh1Pg3uDB5tpc9VNlcuQpGnf";

$url = "https://api.dev.alignet.io/";
$action = "charges";
$method = "GET";

// Codigo de la transaccion
$id = "000029";

$opts = array(
  'http' =>
  array(
    'method' => $method,
    'header' => "Authorization: " . $keyPayme . "\r\n"
  )
);
$context = stream_context_create($opts);
$result = file_get_contents($url . $action . "/" . $id, false, $context);

header('Content-Type: application/json; charset=utf-8');
echo $result;
