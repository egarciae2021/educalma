<?php  
 
require __DIR__ .  '/vendor/autoload.php';
// Agrega credenciales
MercadoPago\SDK::setAccessToken('APP_USR-1923618636570539-071014-5632864634d560a172adbfd37f3d8c8e-1157900136');
 
// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->title = 'Mi producto';
$item->quantity = 1;
$item->unit_price = 75.56;
$item->currency_id="PEN";
$item-> auto_return = "approved" ;
$preference->items = array($item);

$payer = new MercadoPago\Payer();
$payer->name =  $_SESSION['nombres_nom']  ;
$payer->surname =  $_SESSION['nombres_pat'] + ' ' +  $_SESSION['nombres_mat']   ;
$payer->email=  $_SESSION['username']  ;
$payer->identification = array(
  'type' => $_SESSION['tipoDocIdentidad'],
  'number' => $_SESSION['nroDocIdentidad']
);

$preference->payer=array($payer);


$preference->back_urls = array(
    "success" => "https://apiflutter.azurewebsites.net/mercadopago/lectura.php",
    "failure" => "https://youtube.com", 
    "pending" => "https://Facebook.com"
);
$preference->auto_return = "approved"; 



$preference->save();

$response = array(
    'id' => $preference->id,
); 
echo json_encode($response);

?> 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba mercadopago</title> 
    <script src="https://sdk.mercadopago.com/js/v2"></script>
</head>
<body>

<h3>Hola</h3>
 
 <div class="checkout-btn"> </div>
 <a href="<?php echo $preference->init_point; ?>">Pay with Mercado Pago</a>


<script>
  // Agrega credenciales de SDK
  const mp = new MercadoPago("APP_USR-151e9e9b-62d0-439d-8f66-e4d1239f2c9e", {
    locale: "es-PE",
  });

  // Inicializa el checkout
  mp.checkout({
    preference: {
      id: '<?php echo $preference->id;?>'
    },
    // autoOpen: true,
    render: {
      container: ".checkout-btn", // Indica el nombre de la clase donde se mostrará el botón de pago
      label: "Pagar", // Cambia el texto del botón de pago (opcional)
    },
  });
</script>



</body>
</html>





 