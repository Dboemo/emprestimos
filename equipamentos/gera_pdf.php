<?php

session_start();
if (!isset($_SESSION['usuario_sessao'])) {
    header('Location: ../login.php');
    exit();
}
require('../fpdf/fpdf.php');
include_once("../util/config.php");
$result = $dbConn->query("SELECT * FROM equipamentos ORDER BY id DESC");

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Listagem de equipamentos');
$cont =60;
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $pdf->ln();
    $texto= $row['id'] ." - ". $row['descricao'] ." - ".$row['setor']." ";
    $pdf->Cell(40,10,$texto);
  
 }



$pdf->Output();
?>