<?php
require('../Proyecto-2025/php/libs/libs/'); // Asegurate de tener FPDF instalado

$pdf = new FPDF();
$pdf->AddPage();

// CABECERA
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(60,4,utf8_decode('Barbería Franklin'),0,1,'C');
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(60,4,'RUT: 123456789',0,1,'C');
$pdf->Cell(60,4,utf8_decode('Av. Principal 123'),0,1,'C');
$pdf->Cell(60,4,utf8_decode('Maldonado, Uruguay'),0,1,'C');
$pdf->Cell(60,4,'Tel: 099 123 456',0,1,'C');
$pdf->Cell(60,4,'contacto@barberia.com.uy',0,1,'C');

// DATOS FACTURA
$pdf->Ln(5);
$pdf->Cell(60,4,utf8_decode('Factura Nº: F2025-000001'),0,1,'');
$pdf->Cell(60,4,utf8_decode('Fecha: '.date('d/m/Y')),0,1,'');
$pdf->Cell(60,4,utf8_decode('Método de pago: Tarjeta'),0,1,'');

// COLUMNAS
$pdf->SetFont('Helvetica', 'B', 7);
$pdf->Cell(30, 10, utf8_decode('Artículo'), 0);
$pdf->Cell(5, 10, 'Ud',0,0,'R');
$pdf->Cell(10, 10, utf8_decode('Precio'),0,0,'R');
$pdf->Cell(15, 10, utf8_decode('Total'),0,0,'R');
$pdf->Ln(8);
$pdf->Cell(60,0,'','T');
$pdf->Ln(0);

// PRODUCTOS (simulados)
$pdf->SetFont('Helvetica', '', 7);
$pdf->MultiCell(30,4,utf8_decode('Corte Clásico'),0,'L'); 
$pdf->Cell(35, -5, '1',0,0,'R');
$pdf->Cell(10, -5, '350',0,0,'R');
$pdf->Cell(15, -5, '350',0,0,'R');
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
$pdf->Cell(60,0,utf8_decode('Gracias por su compra'),0,1,'C');
$pdf->Ln(3);
$pdf->Cell(60,0,utf8_decode('Válido como comprobante'),0,1,'C');

$pdf->Output('factura.pdf','I');
?>
