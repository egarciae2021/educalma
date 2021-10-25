<?php
require_once '../../database/databaseConection.php';
    if(isset($_GET['id'])){
        $id=$_GET['id'];

    $nombre=$_POST['Nombre'];
    $ape_pater=$_POST['Apellido_Paterno'];
    $ape_mater=$_POST['Apellido_Materno'];
    $correo=$_POST['Correo'];
    $pass=$_POST['pass'];
    $telefono=$_POST['telefono'];
    $tipo_docu=$_POST['tipo_doc'];
    $num_docume=$_POST['nume_documento'];
    $sexo=$_POST['sexo'];
    $fecha=$_POST['fecha_naci'];
    $pais=$_POST['pais'];


    $password = password_hash($pass, PASSWORD_BCRYPT);

        if($_FILES['imagen']['size']>0){
            $imga=$_FILES['imagen']['tmp_name'];
            $imagen = addslashes(file_get_contents($imga));

            $pdo2 = Database::connect();  
            $veri2="UPDATE usuarios SET nombres='$nombre', apellido_pat='$ape_pater', apellido_mat='$ape_mater', email='$correo', pass='$password', telefono='$telefono', tipo_doc='$tipo_docu',nro_doc='$num_docume',sexo='$sexo',fecha_nacimiento	='$fecha',pais ='$pais',mifoto = '$imagen' WHERE id_user = '$id' ";
            $q2 = $pdo2->prepare($veri2);
            $q2->execute(array(
                ':Nombre'=> $nombre,
                ':Apellido_Paterno'=> $ape_pater,
                ':Apellido_Materno'=> $ape_mater,
                ':Correo'=> $correo,
                ':pass'=> $password,
                ':telefono'=> $telefono,
                ':tipo_doc'=> $tipo_docu,
                ':nume_documento'=> $num_docume,
                ':sexo'=> $sexo,
                ':fecha_naci'=> $fecha,
                ':pais'=> $pais,
                ':imagen'=> $imagen,
            ));
        }else{
            $pdo2 = Database::connect();  
            $veri2="UPDATE usuarios SET nombres='$nombre', apellido_pat='$ape_pater', apellido_mat='$ape_mater', email='$correo', pass='$password', telefono='$telefono', tipo_doc='$tipo_docu',nro_doc='$num_docume',sexo='$sexo',fecha_nacimiento	='$fecha',pais ='$pais' WHERE id_user = '$id' ";
            $q2 = $pdo2->prepare($veri2);
            $q2->execute(array(
                ':Nombre'=> $nombre,
                ':Apellido_Paterno'=> $ape_pater,
                ':Apellido_Materno'=> $ape_mater,
                ':Correo'=> $correo,
                ':pass'=> $password,
                ':telefono'=> $telefono,
                ':tipo_doc'=> $tipo_docu,
                ':nume_documento'=> $num_docume,
                ':sexo'=> $sexo,
                ':fecha_naci'=> $fecha,
                ':pais'=> $pais,
            ));    

        }
     

        Database::disconnect();

        echo'
            <script>
                //alert ("editado perfectamente");
                window.location = "../../user-sidebar.php?iduser='.$id.'";
            </script>
        ';
    
    }else{
        
    }
    
 
?>