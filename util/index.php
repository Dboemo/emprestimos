<?php
session_start();
if (!isset($_SESSION['usuario_sessao'])) {
    header('Location: ../login.php');
    exit();
}else{
    header('Location: ../index.php');
    exit();
}
?>