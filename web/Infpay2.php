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

$topic = $_GET["topic"];

echo str_contains($topic, "payment");
 
if (str_contains( $topic, 'payment')) 
{

echo str_contains( $topic,'payment');
echo "llego";
    // Aqui recibimos la notificación de pago , capturamos la api de consulta para usarlo en el GET mas adeltante
    $json = file_get_contents('php://input');
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
    
    $id =  $info_pago['collection']['id'];
    $site_id =  $info_pago['collection']['site_id'];
    $date_created =  $info_pago['collection']['date_created'];
    $money_release_date =  $info_pago['collection']['money_release_date'];
    $last_modified =  $info_pago['collection']['last_modified'];
    $payerid =  $info_pago['collection']['payer']['id'];
    $payerfirst_name =  $info_pago['collection']['payer']['first_name'];
    $payerlast_name =  $info_pago['collection']['payer']['last_name'];
    $payerphonearea_code = $info_pago['collection']['payer']['phone']['area_code'];
    $payerphonenumber = $info_pago['collection']['payer']['phone']['number'];
    $payerphoneextension = $info_pago['collection']['payer']['phone']['extension'];
    $payeridentificationtype = $info_pago['collection']['payer']['identification']['type']; 
    $payeridentificationnumber = $info_pago['collection']['payer']['identification']['number']; 
    $payeremail =  $info_pago['collection']['payer']['email'];
    $payerenickname =  $info_pago['collection']['payer']['nickname'];
    $order_id =  $info_pago['collection']['order_id'];
    $external_reference =  $info_pago['collection']['external_reference'];
    $merchant_order_id =  $info_pago['collection']['merchant_order_id'];
    $reason =  $info_pago['collection']['reason'];
    $currency_id =  $info_pago['collection']['currency_id'];
    $transaction_amount =  $info_pago['collection']['transaction_amount'];
    $net_received_amount =  $info_pago['collection']['net_received_amount'];
    $total_paid_amount =  $info_pago['collection']['total_paid_amount'];
    $shipping_cost =  $info_pago['collection']['shipping_cost'];
    $coupon_amount =  $info_pago['collection']['coupon_amount'];
    $coupon_fee =  $info_pago['collection']['coupon_fee'];
    $finance_fee =  $info_pago['collection']['finance_fee'];
    $discount_fee =  $info_pago['collection']['discount_fee'];
    $coupon_id =  $info_pago['collection']['coupon_id'];
    $status =  $info_pago['collection']['status'];
    $status_detail =  $info_pago['collection']['status_detail'];
    $installments =  $info_pago['collection']['installments'];
    $issuer_id =  $info_pago['collection']['issuer_id'];
    $installment_amount =  $info_pago['collection']['installment_amount'];
    $deferred_period =  $info_pago['collection']['deferred_period'];
    $payment_type =  $info_pago['collection']['payment_type'];
    $payment_method_id =  $info_pago['collection']['payment_method_id'];
    $marketplace =  $info_pago['collection']['marketplace'];
    $operation_type =  $info_pago['collection']['operation_type'];
    $transaction_order_id =  $info_pago['collection']['transaction_order_id'];
    $statement_descriptor =  $info_pago['collection']['statement_descriptor'];
    $cardholdername =  $info_pago['collection']['cardholder']['name']; 
    $cardholderidentificationtype =  $info_pago['collection']['cardholder']['identification']['type'];
    $cardholderidentificationnumber=  $info_pago['collection']['cardholder']['identification']['number']; 
    $authorization_code =  $info_pago['collection']['authorization_code'];
    $marketplace_fee =  $info_pago['collection']['marketplace_fee'];
    $last_four_digits =  $info_pago['collection']['last_four_digits']; 
    $deduction_schema =  $info_pago['collection']['deduction_schema'];
    $refunds =  $info_pago['collection']['refunds']; 
    $amount_refunded =  $info_pago['collection']['amount_refunded']; 
    $last_modified_by_admin =  $info_pago['collection']['last_modified_by_admin']; 
    $api_version =  $info_pago['collection']['api_version']; 
    $concept_id =  $info_pago['collection']['concept_id']; 
    $concept_amount =  $info_pago['collection']['concept_amount']; 
    $collectorid =  $info_pago['collection']['collector']['id']; 
    $collectorfirst_name =  $info_pago['collection']['collector']['first_name']; 
    $collectorlast_name =  $info_pago['collection']['collector']['last_name'];  
    $collectorphonearea_code =  $info_pago['collection']['collector']['phone']['area_code'];  
    $collectorphonenumber =  $info_pago['collection']['collector']['phone']['number']; 
    $collectorphoneextension =  $info_pago['collection']['collector']['phone']['extension'];   
    $collectoridentificationtype =  $info_pago['collection']['collector']['identification']['type'];  
    $collectoridentificationnumber =  $info_pago['collection']['collector']['identification']['number'];  
    $collectoremail =  $info_pago['collection']['collector']['email'];  
    $collectornickname =  $info_pago['collection']['collector']['nickname']; 
 
    $sql = "INSERT INTO payments(`id`, `site_id`, `date_created`, `date_approved`, `money_release_date`, `last_modified`, `payerid`, `payerfirst_name`, `payerlast_name`, `payerphonearea_code`, `payerphonenumber`, `payerphoneextension`, `payeridentificationtype`, `payeridentificationnumber`, `payeremail`, `payernickname`, `order_id`, `external_reference`, `merchant_order_id`, `reason`, `currency_id`, `transaction_amount`, `net_received_amount`, `total_paid_amount`, `shipping_cost`, `coupon_amount`, `coupon_fee`, `finance_fee`, `discount_fee`, `coupon_id`, `status`, `status_detail`, `installments`, `issuer_id`, `installment_amount`, `deferred_period`, `payment_type`, `payment_method_id`, `marketplace`, `operation_type`, `transaction_order_id`, `statement_descriptor`, `cardholdername`, `cardholderidentificationtype`, `cardholderidentificationnumber`, `authorization_code`, `marketplace_fee`, `last_four_digits`, `deduction_schema`, `refunds`, `amount_refunded`, `last_modified_by_admin`, `api_version`, `concept_id`, `concept_amount`, `collectorid`, `collectorfirst_name`, `collectorlast_name`, `collectorphonearea_code`, `collectorphonenumber`, `collectorphoneextension`, `collectoridentificationtype`, `collectoridentificationnumber`, `collectoremail`, `collectornickname`) 
    values  ('$id','$site_id','$date_created','$date_approved','$money_release_date','$last_modified','$payerid','$payerfirst_name','$payerlast_name','$payerphonearea_code','$payerphonenumber','$payerphoneextension','$payeridentificationtype','$payeridentificationnumber','$payeremail','$payernickname','$order_id','$external_reference','$merchant_order_id','$reason','$currency_id','$transaction_amount','$net_received_amount','$total_paid_amount','$shipping_cost','$coupon_amount','$coupon_fee','$finance_fee','$discount_fee','$coupon_id','$status','$status_detail','$installments','$issuer_id','$installment_amount','$deferred_period','$payment_type','$payment_method_id','$marketplace','$operation_type','$transaction_order_id','$statement_descriptor','$cardholdername','$cardholderidentificationtype','$cardholderidentificationnumber','$authorization_code','$marketplace_fee','$last_four_digits','$deduction_schema','$refunds','$amount_refunded','$last_modified_by_admin','$api_version','$concept_id','$concept_amount','$collectorid','$collectorfirst_name','$collectorlast_name','$collectorphonearea_code','$collectorphonenumber','$collectorphoneextension','$collectoridentificationtype','$collectoridentificationnumber','$collectoremail','$collectornickname')" ;
   
   if (mysqli_query($conn, $sql)) {
        echo  "successfully";
      } else {
        echo "Error creating table: " . mysqli_error($conn);
      } 
    mysqli_close($conn);   
      


}

?>
