<?php
     
    $alumno= $_POST['nombre_estudiante'];
    $curso= $_POST['nombre_curso'];
    $codA=$_POST['cod_alumno'];
    $codC=$_POST['cod_curso'];
     
    //$font = "C:\Windows\Fonts\LSANSD.TTF"; 
	$font = "C:\Windows\Fonts\ARIAL.TTF"; 
    $fonti = "C:\Windows\Fonts\seguihis.ttf"; 
    $image= imagecreatefromjpeg("certificate.jpg");
    $color= imagecolorallocate($image,25,39,175);
    $color2= imagecolorallocate($image,25,39,175);;
    
    $nomAlumno = $alumno;
    $nomCurso = $curso;
    $codAlumno = $codA;
    $codCurso = $codC;

    //imagettftext($image,20,0,1530,190,$color,$fonti,$fechaActual);
    imagettftext($image,40,0,260,730,$color,$font,$nomCurso);//x=260,y=730
    //imagettftext($image,20,0,1600,1200,$color,$fonti,$ale);
    imagettftext($image,40,0,260,520,$color,$font,$nomAlumno);
    imagettftext($image,40,0,260,1340,$color2,$font,$codAlumno);
    imagettftext($image,40,0,470,1340,$color2,$font,$codCurso);

    imagejpeg($image,"certificate/".$nomAlumno.".jpg");
                
    require('fpdf2.php');
    $pdf = new FPDF('L','in',[11.7,8.27]);
    $pdf->Addpage();

    $pdf->Image("certificate/".$nomAlumno.".jpg",0,0,11.7,8.27);
    $pdf->Output("certificate/".$nomAlumno.".pdf","F");
    $pdf->Output("certificate/".$nomAlumno.".pdf","D");
    $pdf->Output();

    imagedestroy($image);
 ?>