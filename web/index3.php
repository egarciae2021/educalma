<?php
require_once "Mail.php";

$from = "notificaciones.mail.1S@gmail.com";
$to = 'garcia4014@gmail.com';

$host = "ssl://smtp.gmail.com";
$port = "465";
$username = 'notificaciones.mail.1S@gmail.com';
$password = 'amaterasu1';

$variable = "te quelo";

$subject = "test";
$body = "test .$variable. test";


$headers = array ('From' => $from, 'To' => $to,'Subject' => $subject);
$smtp = Mail::factory('smtp',
array ('host' => $host,
'port' => $port,
'auth' => true,
'username' => $username,
'password' => $password));

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
echo($mail->getMessage());
} else {
echo("Message successfully sent!\n");
}
?>
