<?php

session_start();
if (!isset($_SESSION['usuario_sessao'])) {
    header('Location: ../login.php');
    exit();
}
require('../fpdf/fpdf.php');
include_once("../util/config.php");
$result = $dbConn->query("SELECT * FROM equipamentos_log ORDER BY log_id DESC");

$pdf = new FPDF('L');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Listagem log de equipamentos');
$cont =60;
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $pdf->ln();
    
    $texto= $row['log_id'] ." - ". $row['old_id'] ." - ". $row['old_descricao'] ." - ". $row['old_setor'] ." - ". $row['new_id'] ." - ". $row['new_descricao'] ." - ". $row['new_setor'] ." - ". $row['operacao'] ." - ". $row['hora'];
    $pdf->Cell(40,10,$texto);
  
 }



$pdf->Output();
?>