<?php
ob_start();
@session_start();
if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
    require('fpdf184/fpdf.php');

    class PDF extends FPDF
    {
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('assets/img/logo_educalma.png',70,5,55);
        // Arial bold 15
        $this->SetFont('Times','B',35);
        // Movernos a la derecha
        //$this->Cell(80);
        // Salto de línea
        $this->Ln(20);
        //centrar
        $this->SetX(40);
        // Título
        $this->Cell(30,20,utf8_decode('Confirmación del Pedido'));
        //$this->Cell(ancho,largo,utf8_decode('contenido'),borde,salto);
        // Salto de línea
        $this->Ln(10);
        //
        $this->Cell(30,10,utf8_decode('______________________________'));
        
        // Salto de línea
        $this->Ln(80);
        //
        $this->Cell(30,10,utf8_decode('______________________________'));
        
        //
        $this->SetFont('Arial','B',12);
        $this->Ln(20);
        //centrar
        $this->SetX(20);
        // Título
        $this->Cell(30,20,utf8_decode('Comprador'));
        //centrar
        $this->SetX(120);
        // T
        $this->Cell(30,20,utf8_decode('Vendido por'));


        //
        $this->Ln(60);
        //centrar
        $this->SetX(20);
        // 
        $this->Cell(30,20,utf8_decode('Detalles de recibo'));
        //centrar
        $this->SetX(120);
        // Título
        $this->Cell(30,20,utf8_decode('¿Necesitas ayuda?'));


        $this->Ln(60);
        //
        $this->Cell(30,10,utf8_decode('_______________________________________________________________________________'));
        

    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    }

    // Creación del objeto de la clase heredada
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    /*for($i=1;$i<=10;$i++)
        $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);*/
    $pdf->Output();
}
else{
            header('Location:iniciosesion.php');
}
?>