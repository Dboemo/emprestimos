<?php
// Inicia uma sessão
session_start();

// Remove a variável de sessão
unset($_SESSION['usuario_sessao']);

// Redireciona para a página de login
header('Location: index.php');
exit();
?>
