<?php
require_once '../../database/databaseConection.php';
if(isset($_POST["cod_user"])){
    $pdo2 = Database::connect();  
    $id=$_POST["cod_user"];
    $sql="SELECT * FROM usuarios as c inner join solicitud as a on a.id_usuario=c.id_user where c.id_user=$id AND a.id_usuario=$id";
    $busqueda=$pdo2->query($sql);
    $arrDatos=$busqueda->fetchAll(PDO::FETCH_ASSOC);
    foreach($arrDatos as $row){
        $arr=array(
            $row['id_solicitud'],
            $row['estado'],
            $row['nombres'],
            $row['nombre_empresa'],
            $row['correo_personal'],
            $row['correo_corporativo'],
            $row['telefono_movil'],
            $row['num_suscripcion'],
            // $row['pass'],
            $row['fecha_registro'],
            // $row['id_solicitud'],
            $row['id_user'],
        );
    }
    echo json_encode($arr);
    unset($arr);
    Database::disconnect();
}
else if(isset($_GET['id_eliminar'])){
    $pdo1 = Database::connect();  
    $id=$_GET['id_eliminar'];
    $ie=$_GET['id_delete'];
    $veri2="UPDATE usuarios SET estado=0 WHERE id_user = '$id'";
    $q2 = $pdo1->prepare($veri2);
    $q2->execute(array()); 

    $cambio=$pdo1->prepare("DELETE FROM `empresascursos` Where id_Empresa='$ie'");
    $cambio->execute(array());

    echo'
            <script>
                //alert ("eliminado perfectamente");
                window.location = "../../Enterprise.php";
            </script>
        ';

}else{
    
$pdo = Database::connect();  
$id=$_POST['id_user'];#
$id_sol=$_POST['id_sol'];
$nombreC=$_POST['nameC'];#
$nombreE=$_POST['nameE'];#
$EmailC=$_POST['E-C'];#
$EmailE=$_POST['E-E'];#
$TelfC=$_POST['T-C'];#
$subs=$_POST['N-S'];
// $curseIns=$_POST['C-i'];
$pass=$_POST['Pass'];
$password = password_hash($pass, PASSWORD_BCRYPT);
// $codeCurse=$_POST['Code'];#codigo
$status=$_POST['status'];

$veri2="UPDATE usuarios SET nombres='$nombreC', email='$EmailE',pass='$password',telefono=$TelfC,estado=1 WHERE id_user = $id ";
$q2 = $pdo->prepare($veri2);
$q2->execute();    

$veri3="UPDATE solicitud SET correo_corporativo='$EmailE', nombre_completo='$nombreC',correo_personal='$EmailC',nombre_empresa='$nombreE',telefono_movil='$TelfC',num_suscripcion=$subs WHERE id_solicitud = $id_sol ";
$q3 = $pdo->prepare($veri3);
$q3->execute();

// $veri=$pdo->prepare("SELECT codigo_curse FROM empresascursos where id_Empresa=$id_sol");
// $veri->execute();
// $verl=$veri->fetch(PDO::FETCH_ASSOC);


// if(empty($verl['codigo_curse'])){
//     $veri4=$pdo->prepare("INSERT INTO `empresascursos`(id_Empresa, id_Curso,codigo_curse)VALUES($id_sol,$curseIns,'$codeCurse')");
//     // $veri4->bindParam(":idEmp",$id_sol,PDO::PARAM_INT);
//     // $veri4->bindParam(":idCur",$curseIns,PDO::PARAM_INT);
//     // $veri4->bindParam(":idCode",$codeCurse,PDO::PARAM_STR);
//     $veri4->execute();    
// }else{
//     $code=$verl['codigo_curse'];
//     $veri4=$pdo->prepare("INSERT INTO `empresascursos`(id_Empresa, id_Curso,codigo_curse)VALUES($id_sol,$curseIns,'$code')");
//     // $veri4->bindParam(":idEmp",$id_sol,PDO::PARAM_INT);
//     // $veri4->bindParam(":idCur",$curseIns,PDO::PARAM_INT);
//     // $veri4->bindParam(":idCode",$codeCurse,PDO::PARAM_STR);
//     $veri4->execute();    
// }

// echo '<script>window.location="../../pageEnterprice.php?id='.base64_encode($curseIns).'&subs='.base64_encode($subs).'&us='.base64_encode($id).'";</script>'; 
echo '<script>window.location="../../Enterprise.php";</script>'; 

// $arr='Empresa Actualizada';
// echo json_encode($arr);
// unset($arr);


}
?>