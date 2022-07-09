<?php
header('Content-Type: text/html; charset=UTF-8');
require('fpdf/fpdf.php');

date_default_timezone_set('America/Tijuana');


//==============================================================================
$fecha  = date('d-m-Y H:i:s');
$SendaGRAFS = "images/";

$pdf=new FPDF('L','cm','Letter');

$pdf->AliasNbPages();

$pdf->AddPage();

$pdf->SetFont('Arial','','8');
$pdf->SetTextColor(0,0,0); // Color de texto

$pdf->SetDrawColor(150,150,150); // Color de borde

$pdf->SetTextColor(0,0,0);


$pdf->SetFillColor(0,51,161); // Color de fondo
$pdf->Rect(0, 0, 28, 22, 'F');

$pdf->SetFillColor(256,256,256); // Color de fondo
$pdf->Rect(0, 1.5, 28, 18.7, 'F');

$pdf->SetFillColor(183,196,200); // Color de fondo
$pdf->Rect(0, 1.50, 28, 0.8, 'F');

$pdf->image($SendaGRAFS."LogoBio.jpg", 1, 2.4+0.6, 4, 4);
$pdf->image($SendaGRAFS."LogoCertBlue.png", 22.4, 2.4+0.6, 5, 4);

$pdf->image($SendaGRAFS."LogoCertBlue.png", 22.4, 2.4+0.6, 5, 4);


$pdf->SetFont('arial','B',48);
$pdf->SetTextColor(0,82,131);
$pdf->SetXY(13.2,3.9);
$pdf->Cell(1, 0.25, "CERTIFICADO", 0, 1,'C', 0);

$pdf->SetFont('arial','',20);
$pdf->SetTextColor(102,102,102);
$pdf->SetXY(13,5.5);
$pdf->Cell(1, 0.25, utf8_decode('Curso de:'), 0, 1,'C', 0);

$pdf->SetFont('arial','B',20);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(13.2,6.7);
$pdf->Cell(1, 0.25, utf8_decode('"Actualización en el Virus de la Hepatitis C"'), 0, 1,'C', 0);

$pdf->SetFont('arial','',16);
$pdf->SetTextColor(102,102,102);
$pdf->SetXY(13,8);
$pdf->Cell(1, 0.25, utf8_decode('Certificamos que'), 0, 1,'C', 0);

$pdf->SetFont('arial','IB',22);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(13,9.3);
$pdf->Cell(1, 0.25, utf8_decode('ALEXIS ALEJANDRO CARDENAS MARTINEZ'), 0, 1,'C', 0);


$pdf->SetFont('arial','',16);
$pdf->SetTextColor(102,102,102);
$pdf->SetXY(13,10.5);
$pdf->Cell(1, 0.25, utf8_decode('Ha concluido este curso con una duración de 20 horas.'), 0, 1,'C', 0);

$pdf->SetFont('arial','IB',18);
$pdf->SetTextColor(102,102,102);
$pdf->SetXY(13,11.8);
$pdf->Cell(1, 0.25, utf8_decode('12 de Enero de 2020.'), 0, 1,'C', 0);


$pdf->line(9.5, 14.5-0.8, 17.5, 14.5-0.8);

$pdf->SetFont('arial','',16);
$pdf->SetTextColor(102,102,102);
$pdf->SetXY(13,14-0.8);
$pdf->Cell(1, 0.25, utf8_decode('NOMBRE DEL INSTRUCTOR'), 0, 1,'C', 0);

$pdf->SetFont('arial','',16);
$pdf->SetTextColor(102,102,102);
$pdf->SetXY(13,14.8-0.8);
$pdf->Cell(1, 0.25, utf8_decode('Instructor'), 0, 1,'C', 0);

$pdf->Output();

### FIN DEL SCRIPT ###
