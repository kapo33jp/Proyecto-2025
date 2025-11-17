<?php 

require('../libs/fpdf.php');

function to_iso88591($str) {
    return iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $str);
}

$pdf = new FPDF();
$pdf->AddPage();

// CABECERA
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(175,4,to_iso88591('Moca-HairStudio'),0,1,'C');
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(175,4,'RUT: 123456789',0,1,'C');
$pdf->Cell(175,4,to_iso88591('Gregorio Sanabria 939'),0,1,'C');
$pdf->Cell(175,4,to_iso88591('Maldonado, Uruguay'),0,1,'C');
$pdf->Cell(175,4,'Tel: 096 082 949',0,1,'C');
$pdf->Cell(175,4,'mogarbarbershop@gmail.com',0,1,'C');

// DATOS FACTURA
$pdf->Ln(5);
$pdf->Cell(175,4,to_iso88591('Factura Nº: F2025-000001'),0,1,'C');
$pdf->Cell(175,4,to_iso88591('Fecha: '.date('d/m/Y')),0,1,'C');
$pdf->Cell(175,4,to_iso88591('Método de pago: Tarjeta'),0,1,'C');

// COLUMNAS
$pdf->SetFont('Helvetica', 'B', 7);
$pdf->Cell(60, 10, to_iso88591('Artículo'), 0, 0,'C');
$pdf->Cell(25, 10, 'Ud',0,0,'C');
$pdf->Cell(25, 10, to_iso88591('Precio'),0,0,'C');
$pdf->Cell(10, 10, to_iso88591('Total'),0,0,'R');
$pdf->Ln(8);
$pdf->Cell(60,0,'','T');
$pdf->Ln(0);

// PRODUCTOS (simulados)
$pdf->SetFont('Helvetica', '', 7);
$pdf->MultiCell(30,4,to_iso88591('Corte Clásico'),0,'L'); 
$pdf->Cell(74, -5, '1',0,0,'R');
$pdf->Cell(26, -5, '350',0,0,'R');
$pdf->Cell(20, -5, '350',0,0,'R');
$pdf->Ln(3);

// TOTAL
$pdf->Ln(6);
$pdf->Cell(60,0,'','T');
$pdf->Ln(2);    
$pdf->Cell(25, 10, 'TOTAL', 0);    
$pdf->Cell(20, 10, '', 0);
$pdf->Cell(15, 10, '350',0,0,'R');

// PIE
$pdf->Ln(10);
$pdf->Cell(60,0,to_iso88591('Gracias por su compra'),0,1,'C');
$pdf->Ln(3);
$pdf->Cell(60,0,to_iso88591('Válido como comprobante'),0,1,'C');

$pdf->Output('factura.pdf','I');
?>