<?php
ob_start();
@session_start();
$keyPayme = "EmQipLueZd0PMrAv.jq3CL4p4j6OIQPOLFrnFFBPNGtbVyvFN75IsDb1fOh1Pg3uDB5tpc9VNlcuQpGnf";

$operation = "000041";//id de la transaccion, Auto Increment
$user_id = $_POST["txtid"];//id del usuario
$nombres = $_POST["txtNombre"];//nombres de la persona
$apellidos = $_POST["txtApellido"];//apellidos de la persona
$correo = $_POST["txtCorreo"];//correo de la persona
// $precio=$_POST["txtcost"];//precio de la compra
// $precio=strval($cos);
$pais = "PER";//pais de la tarjeta
$type_doc = "DNI";//tipo de documento
$doc = "455645446";//numero de documento
$numTarjeta = str_replace(' ', '', $_POST["txtNumTarget"]);//numero de tarjeta Prueba 4859 5100 0000 0051
$fechaVencimiento = str_replace('/', '', $_POST["txtFechaVencimiento"]);//fecha de vencimiento lasmonth
$codCVV = $_POST["txtCodigoSeguridad"];//codigo de seguridad año dias

$response = [];//array para guardar los datos de la transaccion

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
      "amount" => "100000",//aqui va el precio de la operacion 
      "meta" => [
        "internal_operation_number" => $operation,
        "additional_fields" => [
          "reserved1" => "Ejemplo valor reservado 1",//opcional, pero sirve como descripcion
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
          "subscriber" => "999999999"//numero de telefono
        ],
        "location" => [
          "line_1" => "Mi casa",//direccion pero si queremos solo con relleno para que no retorne error
          "line_2" => "Mi casa",
          "city" => "LIMA",
          "state" => "LIMA",
          "country" => "PE",
          "zip_code" => "18"//codigo postal
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
