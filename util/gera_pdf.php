<?php

session_start();
if (!isset($_SESSION['usuario_sessao'])) {
    header('Location: ../login.php');
    exit();
}
require('../fpdf/fpdf.php');
include_once("../util/config.php");
$result = $dbConn->query("SELECT * FROM emprestimos_log ORDER BY log_id DESC");

$pdf = new FPDF('L');

$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Listagem de log do sistema');
$cont =60;
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $pdf->ln();
    $texto=$row['log_id']." - ". $row['old_id_usuario']." - ". $row['old_id_equipamento']." - ". $row['old_data_emprestimo']." - ". $row['new_id_usuario']." - ". $row['new_id_equipamento']." - ". $row['new_data_emprestimo']." - ". $row['operacao']." - ". $row['usuario']." - ". $row['equipamento']." - ". $row['setor']." - ". $row['hora'];
    $pdf->Cell(40,10,$texto);
   
 }



$pdf->Output();
?>