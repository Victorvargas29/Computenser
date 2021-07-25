<?php
require('../public/report/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../public/images/victor.jpg',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(40);
    // Título
    $this->Cell(30,10,'Factura',0,0,'C');
    // Salto de línea
    $this->Ln(20);
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
require_once("../modelos/ventas.php");


$venta = new Ventas();
//$venta = new Ventas();
///$venMax= $venta->Max();

$factura = $venta->venta();

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

for($i=0; $i<sizeof($factura);$i++){
    // $num++;
    $pdf->Cell(20,10,$factura[$i]['fecha'],1,0,'C',0);
  }

  $pdf->Output();


?>