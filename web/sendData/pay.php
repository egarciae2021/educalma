<?php
ob_start();
@session_start();
require_once './../database/databaseConection.php';
$pdo = Database::connect();
$keyPayme = "EmQipLueZd0PMrAv.jq3CL4p4j6OIQPOLFrnFFBPNGtbVyvFN75IsDb1fOh1Pg3uDB5tpc9VNlcuQpGnf";
$idCurso = $_SESSION['cursoVisa'];
// $operation = "000103";
$SQL3 = "SELECT MAX(id) as IDT FROM transacciones_payme";
$q3 = $pdo->prepare($SQL3);
$q3 -> execute(array());
$dato3 = $q3->fetch(PDO::FETCH_ASSOC);
$IDT = $dato3["IDT"];

if($IDT==NULL){
  $operation = "000001";
}else{
  $LEN = 6;
  $SQL4 = "SELECT * FROM transacciones_payme WHERE ID = $IDT";
  $q4 = $pdo->prepare($SQL4);
  $q4 -> execute(array());
  $dato4 = $q4->fetch(PDO::FETCH_ASSOC);
  $IDT2 = strval((int)$dato4["idTransac"]+1);
  $operation = str_pad($IDT2, $LEN, "0", STR_PAD_LEFT);
}
// $sql2="SELECT idTransac FROM `transacciones_payme` ORDER BY id DESC LIMIT 1";
// $q2 = $pdo->prepare($sql2);
// $q2->execute();
// $data2 = $q2->fetch(PDO::FETCH_ASSOC);
// $uno="00000";$dos="0000";$tres="000";$cuatro="00";$cinco="0";
// //$idTransac = $data2['idTransac'];
// if(empty($data2['idTransac'])){
//   $operation = "000001";
// }
// $nu=intval($data2['idTransac']);
// $nu+1;
// $number=strval($nu);
// if($nu<=9){
//   $operation = $uno.$number;
// }
// if($nu>9 && $nu<=99){
//   $operation = $dos.$number;
// }
// if($nu>99 && $nu<=999){
//   $operation = $tres.$number;
// }
// if($nu>999 && $nu<=9999){
//   $operation = $cuatro.$number;
// }
// if($nu>9999 && $nu<=99999){
//   $operation = $cinco.$number;
// }
// $operation = "000001"; //id de la transaccion, Auto Increment
$user_id = $_POST["txtid"]; //id del usuario
$nombres = $_POST["txtNombre"]; //nombres de la persona
$apellidos = $_POST["txtApellido"]; //apellidos de la persona
$correo = $_POST["txtCorreo"]; //correo de la persona
$precio=$_SESSION['costoPay'];//precio de la compra
$costo=$_SESSION['prec'];
// $precio=strval($cos);
$pais = "PER"; //pais de la tarjeta
$type_doc = "DNI"; //tipo de documento
$doc = "455645446"; //numero de documento
$numTarjeta = str_replace(' ', '', $_POST["txtNumTarget"]); //numero de tarjeta Prueba 4859 5100 0000 0051
$fechaVencimiento = str_replace('/', '', $_POST["txtFechaVencimiento"]); //fecha de vencimiento lasmonth
$codCVV = $_POST["txtCodigoSeguridad"]; //codigo de seguridad año dias

$response = []; //array para guardar los datos de la transaccion

if ($nombres !== "" && $correo !== "" && $numTarjeta !== "" && $fechaVencimiento !== "" && $codCVV !== "") {
  /* 
  **** ISO 4217 ****
  Tipo de moneda
  Referencia: https://es.wikipedia.org/wiki/ISO_4217
  604 = SOL
  840 = USD
*/
  $money_iso = "604";
  /*
  **** FORMATO DE MONEDA ****
  5 ultimos digitos son decimales
  Asi que 1 SOL es igual a 1,00000
  Y 50 centimos seria 50000
*/
  $money = "50000";

  // URL del servidor
  $url = "https://api.dev.alignet.io/";
  // Accion [Token - pagar]
  $action = "charges";

  // Data
  $postdata = array(
    'action' => 'authorize',
    'channel' => '1',
    'payment_method' => [
      'card' => [[
        'pan' => $numTarjeta,
        "expiry_date" => $fechaVencimiento,
        "security_code" => $codCVV
      ]],
    ],
    "transaction" => [
      "currency" => $money_iso,
      "amount" => $costo, //aqui va el precio de la operacion 
      "meta" => [
        "internal_operation_number" => $operation,
        "additional_fields" => [
          "reserved1" => "Ejemplo valor reservado 1", //opcional, pero sirve como descripcion
          "2" => "Ejemplo valor reservado 2",
          "plan" => "00",
          "cuota" => "000",
          "user_id" => $user_id
        ]
      ]
    ],
    "address" => [
      "billing" => [
        "first_name" => $nombres,
        "last_name" => $apellidos,
        "email" => $correo,
        "phone" => [
          "country_code" => "51",
          "subscriber" => "999999999" //numero de telefono
        ],
        "location" => [
          "line_1" => "Mi casa", //direccion pero si queremos solo con relleno para que no retorne error
          "line_2" => "Mi casa",
          "city" => "LIMA",
          "state" => "LIMA",
          "country" => "PE",
          "zip_code" => "18" //codigo postal
        ]
      ]
    ],
    "card_holder" => [[
      "first_name" => $nombres,
      "last_name" => $apellidos,
      "email_address" => $correo,
      "identity_document_country" => $pais,
      "identity_document_type" => $type_doc,
      "identity_document_identifier" => $doc
    ]]
  );

  $opts = array(
    'http' =>
    array(
      'method' => 'POST',
      'header' => "Authorization: " . $keyPayme . "\r\n" .
        "Content-type: application/json",
      'content' => json_encode($postdata)
    )
  );
  $context = stream_context_create($opts);
  $result = file_get_contents($url . $action, false, $context);

  // echo $result;

  // Forzar a ser de tipo array
  // porque sino van a ser de tipo stdClass
  // por lo tanto no se va a poder acceder a sus llaves
  // Ejemplo: $decJSON["id"]
  $decJSON = (array)json_decode($result);
  $decJSON["transaction"] = (array)$decJSON["transaction"];
  $decJSON["transaction"]["meta"] = (array)$decJSON["transaction"]["meta"];
  $decJSON["transaction"]["meta"]["processor"] = (array)$decJSON["transaction"]["meta"]["processor"];
  $decJSON["transaction"]["meta"]["processor"]["authorization"] = (array)$decJSON["transaction"]["meta"]["processor"]["authorization"];
  $decJSON["transaction"]["meta"]["additional_fields"] = (array)$decJSON["transaction"]["meta"]["additional_fields"];
  $decJSON["transaction"]["meta"]["status"] = (array)$decJSON["transaction"]["meta"]["status"];
  $decJSON["transaction"]["meta"]["status"]["message_ilgn"] = (array)$decJSON["transaction"]["meta"]["status"]["message_ilgn"];
  $decJSON["transaction"]["meta"]["status"]["message_ilgn"][0] = (array)$decJSON["transaction"]["meta"]["status"]["message_ilgn"][0];

  // Rellenar el mensaje a retornar en caso no haya resapuesta de Payme
  $response = [
    "success" => "false",
    "data" => [],
    "message" => [
      "title" => "¡Error!",
      "cuerpo" => $decJSON["transaction"]["meta"]["status"]["message_ilgn"][0]["value"],
      "icon" => "error"
    ]
  ];

  if ($decJSON["success"] === "true") {
    $status="COMPLETED";
    $sql = "INSERT INTO `cursoinscrito` (`curso_id`, `usuario_id`, cod_curso, curso_obt, cantidad_respuestas) VALUES (:idCurso, :idUser, '', 1, 0)";
    $q = $pdo->prepare($sql);
    $q->bindParam(":idCurso", $idCurso, PDO::PARAM_INT);
    $q->bindParam(":idUser", $user_id, PDO::PARAM_INT);
    $q->execute();

    $sql1 = "INSERT INTO `transacciones_payme` (`idTransac`,`idUsuario`,`idCurso`,`monto`,`status`,`fecha`,`correo`) 
                    VALUES (:id_trans,:idUser,:idCurso,:monto,:status,now(),:correo)";
    $q1 = $pdo->prepare($sql1);
    $q1->bindParam(":id_trans", $operation, PDO::PARAM_STR);
    $q1->bindParam(":idUser", $user_id, PDO::PARAM_INT);
    $q1->bindParam(":idCurso", $idCurso, PDO::PARAM_INT);
    $q1->bindParam(":monto", $precio, PDO::PARAM_INT);
    $q1->bindParam(":status", $status, PDO::PARAM_STR);
    $q1->bindParam(":correo", $correo, PDO::PARAM_STR);
    $q1->execute();

    $response = [
      "success" => true,
      "data" => [
        "num_operation" => $decJSON["id"],
        "card_number" => $decJSON["transaction"]["meta"]["processor"]["authorization"]["masked_pan"]
      ],
      "message" => [
        "title" => "¡Pago realizado!",
        "cuerpo" => "La operación se realizó con éxito.",
        "icon" => "success"
      ]
    ];
  }
} else {
  // Rellenar el mensaje a retornar en caso no haya resapuesta de Payme
  $response = [
    "success" => "false",
    "data" => [],
    "message" => [
      "title" => "¡Datos faltantes!",
      "cuerpo" => "Por favor, rellene todos los campos obligatorios.",
      "icon" => "warning"
    ]
  ];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
