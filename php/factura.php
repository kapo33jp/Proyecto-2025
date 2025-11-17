<?php 

require('../libs/fpdf.php');

function to_iso88591($str) {
    return iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $str);
}

$pdf = new FPDF();
$pdf->AddPage();

// CABECERA
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(0,6,to_iso88591('Moca-HairStudio'),0,1,'C');
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(0,5,'RUT: 123456789',0,1,'C');
$pdf->Cell(0,5,to_iso88591('Gregorio Sanabria 939'),0,1,'C');
$pdf->Cell(0,5,to_iso88591('Maldonado, Uruguay'),0,1,'C');
$pdf->Cell(0,5,'Tel: 096 082 949',0,1,'C');
$pdf->Cell(0,5,'mogarbarbershop@gmail.com',0,1,'C');

// DATOS FACTURA
$pdf->Ln(5);
$pdf->Cell(0,5,to_iso88591('Factura Nº: F2025-000001'),0,1,'C');
$pdf->Cell(0,5,to_iso88591('Fecha: '.date('d/m/Y')),0,1,'C');
$pdf->Cell(0,5,to_iso88591('Método de pago: Tarjeta'),0,1,'C');

// COLUMNAS
$pdf->Ln(4);
$pdf->SetFont('Helvetica', 'B', 8);
$pdf->Cell(0,7,to_iso88591('Artículo     | Ud | Precio | Total'),0,1,'C');
$pdf->Cell(0,0,'','T',1);
$pdf->Ln(4);

// PRODUCTOS
$pdf->SetFont('Helvetica', '', 8);
$pdf->Cell(0,6,to_iso88591('Corte Clásico     1     350     350'),0,1,'C');

// TOTAL
$pdf->Ln(6);
$pdf->Cell(0,0,'','T',1);
$pdf->Ln(3);
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(0,8,'TOTAL: 350',0,1,'C');

// PIE
$pdf->Ln(8);
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(0,5,to_iso88591('Gracias por su compra'),0,1,'C');
$pdf->Cell(0,5,to_iso88591('Válido como comprobante'),0,1,'C');

$pdf->Output('factura.pdf','I');
?>
