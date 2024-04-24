<?php

session_start();
if (!isset($_SESSION['usuario_sessao'])) {
    header('Location: ../login.php');
    exit();
}

include_once("../util/config.php");


$result = $dbConn->query("SELECT equip.id ,equip.descricao,equip.setor,usr.id,usr.nome,emp.id as \"idemp\",emp.usuario,emp.equipamento,emp.data 
FROM equipamentos AS equip
	, usuarios AS usr, emprestimos AS emp 
    where emp.usuario=usr.id and emp.equipamento=equip.id ORDER BY emp.id DESC");

/*
SELECT `equip`.*, `usr`.*, `emp`.*
FROM `equipamentos` AS `equip`
	, `usuarios` AS `usr`, `emprestimos` AS `emp` 
    where emp.usuario=usr.id and emp.equipamento=equip.id;
*/


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <title>Lançamento de emprestimos</title>
</head>

<body>
 
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">Empréstimos</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                        <a class="nav-link" href="incluir.php">lançar emprestimo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Voltar</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
    <br /><br />




    <div class="table-responsive" >
        <table class="table table-striped table-hover table-borderless table-primary align-middle" width='80%' border=0>
            <thead class="table-light">

                <tr bgcolor='#CCCCCC'>
                    <th>Código</th>
                    <th>Usuário</th>
                    <th>Equipamento</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

            <?php

             while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr class="table-primary">';
                echo "<td>" . $row['idemp'] . "</td>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . $row['descricao'] . "</td>";
                $dataaux = $row['data'];
                $dataaux= substr($dataaux,0,10);
                echo "<td>" . $dataaux. "</td>";
                echo "<td><a href=\"alterar.php?id=$row[idemp]\">Editar</a> | <a href=\"excluir.php?id=$row[idemp]\" onClick=\"return confirm('Você deseja excluir?')\">Excluir</a></td></tr>";
             }
?>
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>


</body>

</html>