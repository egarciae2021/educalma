<?php
require_once './database/databaseConection.php';
    if(isset($_GET['id'])){
        $id=25;
 
            $imga='http://20.226.29.168/assets/images/img2.png';
            $imagen =LOAD_FILE($imga);
          
 

            $pdo2 = Database::connect();  
            $veri2="UPDATE usuarios SET mifoto = '".$imagen."' WHERE id_user = '".$id."' ";
            $q2 = $pdo2->prepare($veri2);
            $q2->execute(); 

        Database::disconnect();
 

        
    
    }
 
?>