<?php
require_once '../../database/databaseConection.php';
if(isset($_GET['deli'])&&isset($_GET['delc'])){
    $pdo3= Database::connect();
    $id_c=$_GET['deli'];
    $id=$_GET['delc'];
    $veri3=$pdo3->prepare("DELETE FROM `temp` WHERE cod_empre=$id AND cod_curse=$id_c");
    $veri3->execute();
    echo '<script>window.location="../../curseEmp.php?sol='.$id.'"</script>';
}
elseif(isset($_GET['emp'])){
    $pdo1= Database::connect();
    $id=$_GET['emp'];
    $veri1=$pdo1->prepare("DELETE FROM `temp` WHERE cod_empre=$id");
    $veri1->execute();
    echo '<script>window.location="../../curseEmp.php"</script>';
}
elseif(isset($_GET['ent'])){
    function genera_codigo ($longitud) {
        $caracteres = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
        $codigo = '';
    
        for ($i = 1; $i <= $longitud; $i++) {
            $codigo .= $caracteres[numero_aleatorio(0, 35)];
        }
        return $codigo;
    }
    function numero_aleatorio ($ninicial, $nfinal) {
        $numero = rand($ninicial, $nfinal);
    
        return $numero;
    }
    // echo genera_codigo(5);
    

    $pdo2= Database::connect();
    $id=$_GET['ent'];

    $sql2 = "SELECT id_solicitud,num_suscripcion FROM solicitud WHERE id_usuario=$id";
    $q2 = $pdo2->prepare($sql2);
    $prueba=$q2->execute();
    $dato1 = $q2->fetch(PDO::FETCH_ASSOC);
    $id_sol=$dato1['id_solicitud'];
    $subs=$dato1['num_suscripcion'];

    // $sql = "SELECT SUM(cod_curse) FROM temp WHERE cod_empre=$id";
    // $q8 = $pdo2->prepare($sql);
    // $cuento=$q8->execute();
    // $suma=$q8->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT COUNT(cod_curse) FROM temp WHERE cod_empre=$id";
    $q8 = $pdo2->prepare($sql);
    $cuento=$q8->execute();
    $suma=$q8->fetchColumn();

    $sql1 = "SELECT cod_curse FROM temp WHERE cod_empre=$id";
    $q1 = $pdo2->prepare($sql1);
    $cuento1=$q1->execute();
    $dato3 = $q1->fetchAll(PDO::FETCH_ASSOC);
    $ram=genera_codigo(5);
    $prube=0;
    for ($i=0; $i <$suma ; ++$i) { 
        $Curso=$dato3[$i]['cod_curse'];
        $sql3=$pdo2->prepare("SELECT costoCurso FROM cursos WHERE idCurso=$Curso");
        $sql3->execute();
        $dato4 = $sql3->fetch(PDO::FETCH_ASSOC);
        $costo=$dato4['costoCurso'];
        $prube+=$costo;
        $veri=$pdo2->prepare("INSERT INTO `empresascursos`(id_Empresa, id_Curso, codigo_curse) VALUES ($id_sol,$Curso,'$ram')");
        // $veri->bindParam(":curso",$Curso,PDO::PARAM_INT);
        // $veri->bindParam(":id",$idCurso,PDO::PARAM_INT);
        $veri->execute();
    }
    // echo 'pageEnterprice.php?id='.base64_encode($id_sol).'val='.base64_encode($prube).'&subs='.base64_encode($subs).''; 
    //echo '<script>window.location="../../pageEnterprice.php?id='.base64_encode($id).'&sol='.base64_encode($id_sol).'&val='.base64_encode($prube).'&subs='.base64_encode($subs).'"</script>';
    // $veri2=$pdo2->prepare("DELETE FROM `temp` WHERE cod_empre=$id");
    // $veri2->execute();
    // echo '<script>window.location="../../curseEmp.php?if='.base64_encode($id).'&ent='.base64_encode($id_sol).'&pag='.base64_encode($prube).'&cnt='.base64_encode($subs).'"</script>';
    echo '<script>window.location="../../curseEmp.php"</script>';
    // echo $prube;
}
else{
      
    if (isset($_POST['curso']) && isset($_POST['usuario'])) {
        $curso = $_POST ['curso'];
        $usuario=$_POST['usuario'];
        $pdo = Database::connect();    
        # code...
        $veri4 = $pdo->prepare("INSERT INTO `temp`(cod_empre,cod_curse)VALUES($usuario,$curso)");
            //$veri4->bindParam(":idEmp",$id_sol,PDO::PARAM_INT);
            //$veri4->bindParam(":idCur",$curseIns,PDO::PARAM_INT);
            //$veri4->bindParam(":idCode",$codeCurse,PDO::PARAM_STR);
            $veri4->execute();
        echo '<script>window.location="../../curseEmp.php?sol='.$usuario.'"</script>';
    }else{
        echo '<script>window.location="../../curseEmp.php?error=Es un error"</script>';
    }
}
?>