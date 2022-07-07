<?php
require_once '../../database/databaseConection.php';
function guidv4($data = null) {
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
} 


    if(isset($_GET['id'])){
        $id=$_GET['id'];

    $nombre=$_POST['Nombre'];
    $ape_pater=$_POST['Apellido_Paterno'];
    $ape_mater=$_POST['Apellido_Materno'];
    $correo=$_POST['Correo'];
    // $pass=$_POST['pass'];
    $telefono=$_POST['telefono'];
    $tipo_docu=$_POST['tipo_doc'];
    $num_docume=$_POST['nume_documento'];
    $sexo=$_POST['sexo'];
    $fecha=$_POST['fecha_naci'];
    $pais=$_POST['pais'];


    // $password = password_hash($pass, PASSWORD_BCRYPT);

        if($_FILES['imagen']['size']>0){
            //
            //$imga=$_FILES['imagen']['tmp_name'];
            //$imagen = addslashes(file_get_contents($imga));
            
    $archivo = $_FILES['imagen']['name'];
   //Si el archivo contiene algo y es diferente de vacio
   if (isset($archivo) && $archivo != "") {
      //Obtenemos algunos datos necesarios sobre el archivo
      $tipo = $_FILES['imagen']['type'];
      $tamano = $_FILES['imagen']['size'];
      $temp = $_FILES['imagen']['tmp_name'];
      $UUID = guidv4();
      $ruta = null;
      $rutaAbsoluta = $_SERVER["DOCUMENT_ROOT"]."/test-educalma/web/imagenes/";
      //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
     if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
        echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
        - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
     }
     else {
        //Si la imagen es correcta en tamaño y tipo
        //Se intenta subir al servidor
        opendir($rutaAbsoluta);
        if (move_uploaded_file($temp, $rutaAbsoluta.$UUID.'.png')) {
            $ruta = '/imagenes/'.$UUID.'.png';
            $pdo2 = Database::connect();  
            $veri2="UPDATE usuarios SET nombres='$nombre', apellido_pat='$ape_pater', apellido_mat='$ape_mater', email='$correo', telefono='$telefono', tipo_doc='$tipo_docu',nro_doc='$num_docume',sexo='$sexo',fecha_nacimiento	='$fecha',pais ='$pais',mifoto = '$ruta' WHERE id_user = '$id' ";
            $q2 = $pdo2->prepare($veri2);
            $q2->execute(array());
        }
      }
   }
        }else{
            $pdo2 = Database::connect();  
            $veri2="UPDATE usuarios SET nombres='$nombre', apellido_pat='$ape_pater', apellido_mat='$ape_mater', email='$correo', telefono='$telefono', tipo_doc='$tipo_docu',nro_doc='$num_docume',sexo='$sexo',fecha_nacimiento	='$fecha',pais ='$pais' WHERE id_user = '$id' ";
            $q2 = $pdo2->prepare($veri2);
            $q2->execute(array());    

        }
     

        Database::disconnect();

        echo'
            <script>
                //alert ("editado perfectamente");
                window.location = "../../user-sidebar.php?iduser='.$id.'";
            </script>
        ';
    
    }else if(isset($_GET['id_eliminar'])){
        $id=$_GET['id_eliminar'];

        $pdo2 = Database::connect();  
        $veri2="UPDATE usuarios SET estado=0  WHERE id_user = '$id' ";
        $q2 = $pdo2->prepare($veri2);
        $q2->execute(array());

        echo'
            <script>
                //alert ("editado perfectamente");
                window.location = "../../user-sidebar.php";
            </script>
        ';
    }

    if(isset($_POST["cod_user"])){


		$pdo = Database::connect();
		$sql = "SELECT u.id_user, u.privilegio, u.sexo, u.tipo_doc, u.padreEmpresa, u.hijoEmpresa, u.nombres, u.apellido_pat, u.apellido_mat, u.email, u.pass, u.telefono, 
                    d.nombre_tipoDoc, u.nro_doc, s.nombre_genero, u.fecha_nacimiento, u.pais, u.cod_tipoDonador, u.estado, u.fecha_registro 
                    FROM usuarios u
                    INNER JOIN sexo s ON s.	id_genero = u.sexo
                    INNER JOIN tipodocumentoidentidad d ON d.id_tipoDoc = u.tipo_doc WHERE u.id_user='".$_POST['cod_user']."'";

	    $busqueda=$pdo->query($sql);
	    $arrDatos=$busqueda->fetchAll(PDO::FETCH_ASSOC);
		foreach ($arrDatos as $row) {
			$arr = array(
                $row['nombres'], //0
                $row['apellido_pat'], //1
                $row['apellido_mat'], //2
                $row['pais'], //3
                $row['email'], //4
                $row['telefono'], //5
                $row['tipo_doc'], //6
                $row['nro_doc'], //7
                $row['sexo'], //8
                $row['fecha_nacimiento'], //9
                $row['id_user'], //10
            );
		}

		echo json_encode($arr);
		unset($arr);
        Database::disconnect();
	}else if(isset($_POST['id_usuario'])){
        $id=$_POST['id_usuario'];

        $nombre=$_POST['nombre_user'];
        $ape_pater=$_POST['apellido_p_user'];
        $ape_mater=$_POST['apellido_m_user'];
        $correo=$_POST['correo_user'];
        // $pass=$_POST['pass_user'];
        $telefono=$_POST['telefono_user'];
        $tipo_docu=$_POST['tipo_docUser'];
        $num_docume=$_POST['numdoc_user'];
        $sexo=$_POST['sexo_user'];
        $fecha=$_POST['fecha_nac_user'];
        $pais=$_POST['pais_user'];

        // if($_FILES['imagen_user']['size']>0){
        //     $imga=$_FILES['imagen_user']['tmp_name'];
        //     $imagen = addslashes(file_get_contents($imga));

        //     $pdo2 = Database::connect();  
        //     $veri2="UPDATE usuarios SET nombres='$nombre', apellido_pat='$ape_pater', apellido_mat='$ape_mater', email='$correo', telefono='$telefono', tipo_doc='$tipo_docu',nro_doc='$num_docume',sexo='$sexo',fecha_nacimiento	='$fecha',pais ='$pais',mifoto = '$imagen' WHERE id_user = '$id' ";
        //     $q2 = $pdo2->prepare($veri2);
        //     $q2->execute(array());
        // }else{
            $pdo2 = Database::connect();  
            $veri2="UPDATE usuarios SET nombres='$nombre', apellido_pat='$ape_pater', apellido_mat='$ape_mater', email='$correo', telefono='$telefono', tipo_doc='$tipo_docu',nro_doc='$num_docume',sexo='$sexo',fecha_nacimiento	='$fecha',pais ='$pais' WHERE id_user = '$id' ";
            $q2 = $pdo2->prepare($veri2);
            $q2->execute(array());    

        // }

        $arr='Usuario_actualizado';

		echo json_encode($arr);
		unset($arr);
    

        Database::disconnect();
    }
 
?>
