<?php 

require('../libs/fpdf.php');
include '../php/conexion.php';

// Validar parámetro
if (!isset($_GET['idventa']) || empty($_GET['idventa'])) {
    die("ID de venta no proporcionado.");
}

$idventa = intval($_GET['idventa']);

// Traer datos de la venta
$sql = $conn->query("SELECT * FROM ventas WHERE idventa = $idventa");

if (!$datos = $sql->fetch_object()) {
    die("Venta no encontrada.");
}

// Obtener nombre del producto
$productoSQL = $conn->query("SELECT nombreproducto FROM producto WHERE idproducto = $datos->idproducto");
$prod = $productoSQL->fetch_object();
$nombreProd = $prod ? $prod->nombreproducto : 'Producto';

// Conversión de caracteres
function to_iso88591($str) {
    return iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $str);
}

// Crear PDF tipo ticket (80mm)
$pdf = new FPDF('P', 'mm', array(80, 100));
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
$pdf->SetFont('Helvetica','',8);

$pdf->Cell(0,5,to_iso88591('Factura Nº: F2025-' . str_pad($datos->idventa, 6, '0', STR_PAD_LEFT)),0,1,'C');

$fecha = date('d/m/Y H:i', strtotime($datos->fecha_venta));
$pdf->Cell(0,5,to_iso88591('Fecha: ' . $fecha),0,1,'C');

// SEPARADOR
$pdf->Ln(3);
$pdf->Cell(0,0,'','T',1);
$pdf->Ln(3);

// COLUMNAS
$pdf->SetFont('Helvetica', 'B', 7);
$pdf->Cell(30,5,to_iso88591('Artículo'),0,0,'L');
$pdf->Cell(10,5,'Ud',0,0,'C');
$pdf->Cell(15,5,'Precio',0,0,'C');
$pdf->Cell(15,5,'Total',0,1,'C');

$pdf->SetFont('Helvetica','',7);
$pdf->Cell(30,5,to_iso88591($nombreProd),0,0,'L');
$pdf->Cell(10,5,$datos->cantidad,0,0,'C');
$pdf->Cell(15,5,'$'.number_format($datos->precio,2),0,0,'C');
$pdf->Cell(15,5,'$'.number_format($datos->total,2),0,1,'C');

// SEPARADOR
$pdf->Ln(3);
$pdf->Cell(0,0,'','T',1);
$pdf->Ln(4);

// PIE
$pdf->SetFont('Helvetica','',7);
$pdf->Cell(0,5,to_iso88591('Gracias por su compra'),0,1,'C');
$pdf->Cell(0,5,to_iso88591('Válido como comprobante'),0,1,'C');

// Salida
$pdf->Output('factura.pdf','I');

?>
