<?php

session_start();
if (!isset($_SESSION['usuario_sessao'])) {
    header('Location: index.php');
    exit();
}
include("../util/config.php");

$id = $_GET['id'];

try{
$sql = "DELETE FROM equipamentos WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));
}catch(PDOException $e){

}
header("Location:index.php");
?>