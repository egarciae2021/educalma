<?php  

    require_once '../database/databaseConection.php';
    

    session_start();     
    //USUARIO VALIDADO SESIÓN   
    if(isset($_SESSION['codUsuario'])){

        $cursoid= $_GET['idCurso'];
        $id= $_SESSION['codUsuario'];
        $pdo3 = Database::connect();
        $sql3 = "SELECT * FROM cursoinscrito c inner join usuarios u on 
        u.id_user=c.usuario_id inner join cursos s on
        s.idCurso=c.curso_id where id_user= '$id' and c.curso_id = '$cursoid' ";
        $q3 = $pdo3->prepare($sql3);
        $q3->execute(array());

       
        while( $dato = $q3->fetch(PDO::FETCH_ASSOC)){
            $fecha1 = date('Y');
            $fecha2 = date('m');
            if($fecha2 == '01'){
                $fecha2 = 'Enero';
            }elseif($fecha2 == '02'){
                $fecha2 = 'Febrero';
            }elseif($fecha2 == '03'){
                $fecha2 = 'Marzo';
            }elseif($fecha2 == '04'){
                $fecha2 = 'Abril';
            }elseif($fecha2 == '05'){
                $fecha2 = 'Mayo';
            }elseif($fecha2 == '06'){
                $fecha2 = 'Junio';
            }elseif($fecha2 == '07'){
                $fecha2 = 'Julio';
            }elseif($fecha2 == '08'){
                $fecha2 = 'Agosto';
            }elseif($fecha2 == '09'){
                $fecha2 = 'Septiembre';
            }elseif($fecha2 == '10'){
                $fecha2 = 'Octubre';
            }elseif($fecha2 == '11'){
                $fecha2 = 'Noviembre';
            }elseif($fecha2 == '12'){
                $fecha2 = 'Diciembre';
            }
            $fecha3 = date('d');
            $fechaActual = $fecha3.' de '.$fecha2.' del '.$fecha1;
            
            //*
             /*CONDICIONAL PARA QUE DESCARGUE EL MISMO (Aún no lo hago)
             /*@Autor: Jean
             */

            //*
             /*GENERAR CODIGO ALEATORIO
             /*@Autor: Jean
             */
            function cod_aleatorio($letra,$longitud){
                for($i=1;$i<=$longitud;$i++){
                    $numero=rand(0,9);
                    $letra.=$numero;
                }
                return $letra;
            }
            /*FIN*/

            //*
             /*METODO PARA GUARDAR EL CERTIFICADO EN SU TABLA
             /*@Autor: Jean
             */
            $ale= cod_aleatorio('C',8);
            
            $userid= $dato['id_user'];
            $pdo4 = Database::connect();
            
                $sql4 = "INSERT INTO certificados (idCurso_certif, idUser_certif, fechaCurso_terminado,codigo)
                values ('$cursoid','$userid','$fechaActual','$ale')";
                // WHERE NOT EXISTS (SELECT 1 FROM certificados WHERE codigo<>'$ale')";
                $q4 = $pdo4->prepare($sql4);
                $q4->execute(array());

            /*FIN*/

            /*
            *METODO PARA CREAR CERTIFICADO
            *@AUTOR: GONZALO
            */
            $font = "C:\Windows\Fonts\GOTHIC.TTF"; 
            $image= imagecreatefromjpeg("certificate.jpg");
            $color= imagecolorallocate($image,19,21,22);
        

            $nomalumno = $dato['nombres'].' '.$dato['apellido_pat'].' '.$dato['apellido_mat'];
            $nomcurso= $dato['nombreCurso'];  

            
            imagettftext($image,30,0,1300,190,$color,$font,$fechaActual);
            imagettftext($image,40,0,260,730,$color,$font,$nomcurso);
            imagettftext($image,40,0,260,920,$color,$font,$ale);
            imagettftext($image,40,0,260,520,$color,$font,$nomalumno);
            
            
            imagejpeg($image,"certificate/".$nomalumno.".jpg");
                
            require('fpdf.php');
            $pdf = new FPDF('L','in',[11.7,8.27]);
            $pdf->Addpage();

           $pdf->Image("certificate/".$nomalumno.".jpg",0,0,11.7,8.27);
           $pdf->Output("certificate/".$nomalumno.".pdf","F");
           $pdf->Output("certificate/".$nomalumno.".pdf","D");
           $pdf->Output();

            imagedestroy($image);
            /*FIN*/



            //echo "certificate created"."<br>";
            /*

                include('smtp/PHPMailerAutoload.php');
                $mail=new PHPMailer();
                $mail->isSMTP();
                $mail->Host='smtp.gmail.com';
                $mail->Port=587;
                $mail->SMTPSecure="tls";
                $mail->SMTPAuth=true;
                $mail->Username="gonferjc@gmail.com";
                $mail->Password="a1s2d3g6";
                $mail->setFrom("gonferjc@gmail.com");
                $mail->addAddress($dato['email']);
                $mail->isHTML(true);
                $mail->Subjet="Certificate Generated";
                $mail->Body="Certificate Generated";
                $mail->addAttachment("certificate/".$nomalumno.".pdf");
                $mail->SMTPOptions=array("ssl"=>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                    "allow_self_signed"=>false,
                ));
                if($mail->send()){
                    echo'
                    <script>
                        alert (" Certificado enviado, revisa tu correo");
                        window.location = "../curso.php";
                    </script>
                    ';
                }else{
                    echo $mail->ErrorInfo;
                }
                */
            

  
        }
    }
?>

        
        
