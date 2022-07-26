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
    
    // Aqui recibimos la notificación de pago , capturamos la api de consulta para usarlo en el GET mas adeltante
    $json = file_get_contents('php://input');
    // $recibe = json_encode($json);  
    $recibe_json = json_decode($json,true); 

    // Iniciamos la petición GET a mercadopago para traer la info de pago
    $ch = curl_init();

    // curl_setopt($ch, CURLOPT_URL,"https://api.mercadolibre.com/collections/notifications/24286617922"); 
    curl_setopt($ch, CURLOPT_URL,$recibe_json['resource']); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    $headers = [
        'Authorization: Bearer APP_USR-1923618636570539-071014-5632864634d560a172adbfd37f3d8c8e-1157900136'
    ]; 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
    $server_output = curl_exec ($ch); 
    curl_close ($ch); 
    $info_pago=json_decode($server_output,true);
    $info_pago=$info_pago['collection'];
    echo $server_output;
    echo "1";

    
    // $sql = "INSERT INTO pagos(topic,id,resultado) VALUES ('$topic' ,'$id','$recibe')";
    // $sql = "INSERT INTO pagos(`id`, `site_id`, `date_created`, `date_approved`, `money_release_date`, `last_modified`, `payerid`, `payerfirst_name`, `payerlast_name`, `payerphonearea_code`, `payerphonenumber`, `payerphoneextension`, `payeridentificationtype`, `payeridentificationnumber`, `payeremail`, `payernickname`, `order_id`, `external_reference`, `merchant_order_id`, `reason`, `currency_id`, `transaction_amount`, `net_received_amount`, `total_paid_amount`, `shipping_cost`, `coupon_amount`, `coupon_fee`, `finance_fee`, `discount_fee`, `coupon_id`, `status`, `status_detail`, `installments`, `issuer_id`, `installment_amount`, `deferred_period`, `payment_type`, `payment_method_id`, `marketplace`, `operation_type`, `transaction_order_id`, `statement_descriptor`, `cardholdername`, `cardholderidentificationtype`, `cardholderidentificationnumber`, `authorization_code`, `marketplace_fee`, `last_four_digits`, `deduction_schema`, `refunds`, `amount_refunded`, `last_modified_by_admin`, `api_version`, `concept_id`, `concept_amount`, `collectorid`, `collectorfirst_name`, `collectorlast_name`, `collectorphonearea_code`, `collectorphonenumber`, `collectorphoneextension`, `collectoridentificationtype`, `collectoridentificationnumber`, `collectoremail`, `collectornickname`) 
    // values  ('$topic' ,'$id','$recibe')   ";
 
    // if (mysqli_query($conn, $sql)) {
    //     echo  "successfully";
    //   } else {
    //     echo "Error creating table: " . mysqli_error($conn);
    //   }
    // mysqli_close($conn);   
     
  

?>
