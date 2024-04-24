<?php

session_start();
if (!isset($_SESSION['usuario_sessao'])) {
    header('Location: ../login.php');
    exit();
}

include_once("../util/config.php");


$result = $dbConn->query("SELECT * FROM emprestimos_log ORDER BY log_id DESC");
?>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <title>Manutenção Equipamentos</title>
</head>
<!DOCTYPE html>
<html lang="en">
<body>
 
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="rel_log.php">Operações do sistema</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                        <a class="nav-link" href="gera_pdf.php">Imprimir</a>
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
                    <th>id usuario antigo</th>
                    <th>id equipamento antigo</th>
                    <th>data antiga</th>
                    <th>id usuario novo</th>
                    <th>id equipamento novo</th>                   
                    <th>nova data do emprestimo</th>
                    <th>operação</th>
                    <th>usario</th>
                    <th>equipamento</th>
                    <th>setor</th>
                    <th>hora</th>
                   
                </tr>
            </thead>
            <tbody class="table-group-divider">

            <?php

             while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr class="table-primary">';
                echo "<td>" . $row['log_id'] . "</td>";
                echo "<td>" . $row['old_id_usuario'] . "</td>";
                echo "<td>" . $row['old_id_equipamento'] . "</td>";
                echo "<td>" . $row['old_data_emprestimo'] . "</td>";
                echo "<td>" . $row['new_id_usuario'] . "</td>";
                echo "<td>" . $row['new_id_equipamento'] . "</td>";              
                echo "<td>" . $row['new_data_emprestimo'] . "</td>";
                echo "<td>" . $row['operacao'] . "</td>";
                echo "<td>" . $row['usuario'] . "</td>";
                echo "<td>" . $row['equipamento'] . "</td>";
                echo "<td>" . $row['setor'] . "</td>";
                echo "<td>" . $row['hora'] . "</td>";
                echo "</tr>";
             }
?>
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>


</body>

</html>