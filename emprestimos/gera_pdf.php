<?php
session_start();
if (!isset($_SESSION['usuario_sessao'])) {
    header('Location: ../login.php');
    exit();
}
require('../fpdf/fpdf.php');
include_once("../util/config.php");
//$result = $dbConn->query("SELECT * FROM emprestimos ORDER BY id DESC");
$result = $dbConn ->query("SELECT equip.id ,equip.descricao,equip.setor,usr.id,usr.nome,emp.id as \"idemp\",emp.usuario,emp.equipamento,emp.data 
FROM equipamentos AS equip
	, usuarios AS usr, emprestimos AS emp 
    where emp.usuario=usr.id and emp.equipamento=equip.id ORDER BY emp.id DESC");


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Listagem de emprestimos');
$cont =60;
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $pdf->ln();
    $texto= $row['idemp'] ." - ". $row['nome'] ." - ".$row['descricao']." - ";
    $dataaux = $row['data'];
    $dataaux= substr($dataaux,0,10);
    $texto.=$dataaux;
    $pdf->Cell(40,10,$texto);
    
 }



$pdf->Output();
?>