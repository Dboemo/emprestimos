<?php
session_start();
if (!isset($_SESSION['usuario_sessao'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/bootstrap.bundle.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Sistema de emprestimos</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">Principal</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cadastros</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="./usuarios/index.php">Usuários</a>
                            <a class="dropdown-item" href="./equipamentos/index.php">Equipamentos</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./emprestimos/index.php">Empréstimos</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Relatórios</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="./usuarios/rel_usuarios.php">Usuários</a>
                            <a class="dropdown-item" href="./equipamentos/rel_equipamentos.php">Equipamentos</a>
                            <a class="dropdown-item" href="./util/rel_log.php">log do sistema</a>
                            <a class="dropdown-item" href="./util/rel_log.php">log de usuários</a>
                            <a class="dropdown-item" href="./equipamentos/rel_log.php">log de equipamentos</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sair.php">Sair</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
   
<center>

</center>
    

</body>

</html>