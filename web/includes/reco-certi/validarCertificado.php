<?php 
    require_once '../../database/databaseConection.php';


    $cod = $_POST['codigo'];

    $pdoConsultaC = Database::connect();
    $sqlConsultaC = "SELECT COUNT(codCertificado) Cantidad FROM certificados WHERE codCertificado = '$cod'";
    $qiConsultaC = $pdoConsultaC->prepare($sqlConsultaC);
    $qiConsultaC->execute();
    $datoConsulta = $qiConsultaC -> fetch(PDO::FETCH_ASSOC);
    $CantidadCertificado = $datoConsulta['Cantidad'];
    Database::disconnect();

    if($CantidadCertificado > 0){
        $pdoConsultaC2 = Database::connect();
        $sqlConsultaC2 = "SELECT CE.codAlumno, CE.codCurso, U.nombres, U.apellido_pat, U.apellido_mat, C.nombreCurso FROM certificados CE
        INNER JOIN usuarios U ON U.codigo_alumno = CE.codAlumno
        INNER JOIN cursoinscrito CI ON CI.cod_curso = CE.codCurso AND CI.usuario_id = U.id_user
        INNER JOIN cursos C ON C.idCurso = CI.curso_id
        WHERE CE.codCertificado = '$cod'";
        $qiConsultaC2 = $pdoConsultaC2->prepare($sqlConsultaC2);
        $qiConsultaC2->execute();
        $datoConsulta2 = $qiConsultaC2 -> fetch(PDO::FETCH_ASSOC);
        $codA = $datoConsulta2['codAlumno'];
        $codC = $datoConsulta2['codCurso'];
        $nom = $datoConsulta2['nombres']." ".$datoConsulta2['apellido_pat']." ".$datoConsulta2['apellido_mat'];
        $nomCurso = $datoConsulta2['nombreCurso'];
        Database::disconnect();
        echo '<script>

        var formData = new FormData();
            
              formData.append("nombre_curso",'.$nomCurso.');
              formData.append("cod_alumno",'.$codA.');
              formData.append("cod_curso",'.$codC.');
              formData.append("nombre_estudiante",'.$nom.');

            var request = new XMLHttpRequest();
            request.onreadystatechange = dataLoaded;
            request.open("POST", Url);
            request.send(formData);

            function dataLoaded()
{
            if( this.status==200)
            {
               console.log("Respuesta del servidor"); 
               var Url2 = "http://test-apicalma.site/plugins/certificate/'.$codA.$codC.'pdf"
               setTimeout(function(){console.log("Se esta descargando el certificado");window.open(Url2, "_blank");}, 2000);
               
            }
            else
            {
                console.log("Aun no hay respuesta");
            }
}
        
        </script>';
    }else{
        echo '<script>
   
        alert ("Código Invalido");
        window.location = "../../certi.php";
        
        </script>';
    }

?>
