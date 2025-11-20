<?php 

require('../libs/fpdf.php');
include '../php/conexion.php';

// Validar que idventa venga por GET
if (!isset($_GET['idventa']) || empty($_GET['idventa'])) {
    die("ID de venta no proporcionado.");
}

$idventa = intval($_GET['idventa']);

// Consulta
$sql = $conn->query("SELECT * FROM ventas WHERE idventa = $idventa");

if (!$datos = $sql->fetch_object()) {
    die("Venta no encontrada.");
}

function to_iso88591($str) {
    return iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $str);
}

// tamaño ticket 80mm
$pdf = new FPDF('P', 'mm', array(80, 120));
$pdf->SetMargins(5, 5, 5);
$pdf->SetAutoPageBreak(true, 5);
$pdf->AddPage();

// CABECERA
$pdf->SetFont('Helvetica','',10);
$pdf->Cell(0,6,to_iso88591('Moca-HairStudio'),0,1,'C');
$pdf->SetFont('Helvetica','',7);
$pdf->Cell(0,5,'RUT: 107653482611',0,1,'C');
$pdf->Cell(0,5,to_iso88591('Gregorio Sanabria 939'),0,1,'C');
$pdf->Cell(0,5,to_iso88591('Maldonado, Uruguay'),0,1,'C');
$pdf->Cell(0,5,'Tel: 096 082 949',0,1,'C');
$pdf->Cell(0,5,'mogarbarbershop@gmail.com',0,1,'C');

// DATOS FACTURA
$pdf->Ln(4);
$pdf->Cell(0,5,to_iso88591('Factura Nº: F2025-000001'),0,1,'C');
$pdf->Cell(0,5,to_iso88591('Fecha: '.date('d/m/Y')),0,1,'C');
$pdf->Cell(0,5,to_iso88591('Método de pago: Contado'),0,1,'C');

// COLUMNAS
$pdf->Ln(3);
$pdf->SetFont('Helvetica', 'B', 7);
$pdf->Cell(0,6,to_iso88591('Artículo | Ud | Precio | Total'),0,1,'C');
$pdf->Cell(0,0,'','T',1);
$pdf->Ln(3);

// PIE
$pdf->Ln(6);
$pdf->SetFont('Helvetica','',7);
$pdf->Cell(0,5,to_iso88591('Gracias por su compra'),0,1,'C');
$pdf->Cell(0,5,to_iso88591('Válido como comprobante'),0,1,'C');

$pdf->Output('factura.pdf','I');
?>
