<?php


    require('fpdf2.php');
     
    $alumno= $_POST['nombre_estudiante'];
    $curso= $_POST['nombre_curso'];
    $codA=$_POST['cod_alumno'];
    $codC=$_POST['cod_curso'];
     
    //$font = "C:\Windows\Fonts\LSANSD.TTF"; 
	$font = "/opt/lampp/htdocs/git_clone/test-educalma/web/assets/fonts/Montserrat/Montserrat-Bold.ttf";
    $fonti = "/opt/lampp/htdocs/git_clone/test-educalma/web/assets/css/fonts/Flaticon.ttf";
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
    imagettftext($image,40,0,260,1840,$color2,$font,$codAlumno);
    imagettftext($image,40,0,820,1340,$color2,$font,$codCurso);

    imagejpeg($image, "/opt/lampp/htdocs/git_clone/test-educalma/web/plugins/certificate/".$codAlumno.$codCurso.".jpg");
                

    $pdf = new FPDF('L','in',[11.7,8.27]);
    $pdf->Addpage();

    $pdf->Image("/opt/lampp/htdocs/git_clone/test-educalma/web/plugins/certificate/".$codAlumno.$codCurso.".jpg",0,0,11.7,8.27);
    $pdf->Output("/opt/lampp/htdocs/git_clone/test-educalma/web/plugins/certificate/".$codAlumno.$codCurso.".pdf","F");
    $pdf->Output("/opt/lampp/htdocs/git_clone/test-educalma/web/plugins/certificate/".$codAlumno.$codCurso.".pdf","D");
    $pdf->Output(); 
 
    imagedestroy($image);
 ?>