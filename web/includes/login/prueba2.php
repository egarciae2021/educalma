<?php

$enlace = new mysqli('20.226.29.168', 'root', 'T3$t1ng.C4lm4', 'educalma');

    $email_user = 'test';
    $querys=("Select * from usuarios where email ='".$email_user."'");
    $querys2= ("Update recover_password SET Estado = 0 where Estado = 1 and correo='".$email_user."'");
    $resultado=$enlace->query($querys2);
    $resultado = $enlace->query($querys); 
    $num_filas = mysqli_num_rows($resultado);


            $token = bin2hex(random_bytes(50)); 
            $querys= ("INSERT INTO recover_password (`token`,`correo`) VALUES ('".$token."','".$email_user."')");
            $enlace->query($querys); 
            enviar_correo($token,$email_user);
            echo 2;
 



?>