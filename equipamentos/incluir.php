<?php

session_start();
if (!isset($_SESSION['usuario_sessao'])) {
    header('Location: index.php');
    exit();
}

include_once("../util/config.php");


if (isset($_POST['submit'])) {
    $descricao = $_POST['descricao'];
    $setor = $_POST['setor'];
  
    if (empty($descricao) || empty($setor)) {

        if (empty($descricao)) {
           
            echo '<div
            class="alert alert-primary alert-dismissible fade show"
            role="alert"
        >
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
            ></button>
            <strong>Atenção </strong> descrição incorreta!
        </div>';


        }

        if (empty($setor)) {
            
            echo '<div
            class="alert alert-primary alert-dismissible fade show"
            role="alert"
        >
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
            ></button>
            <strong>Atenção </strong> setor incorreto!
        </div>';
        }

    } else {

        $sql = "INSERT INTO equipamentos(descricao, setor) VALUES(:descricao, :setor)";
        $query = $dbConn->prepare($sql);

        $query->bindparam(':descricao', $descricao);
        $query->bindparam(':setor', $setor);
        $query->execute();
        header("Location: index.php");

    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <title>inclusão de equipamentos</title>
</head>

<body>

    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">Equipamento</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Voltar</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
    <br /><br />

    <div class="container-sm">   
    <form action="incluir.php" method="post" name="form1">
        <div class="mb-3">
            <label for="" class="form-label">descricao</label>
            <input type="text" class="form-control" name="descricao" id="" placeholder="" />
        </div>
        <div class="mb-3">
            <label for="" class="form-label">setor</label>
            <input type="text" class="form-control" name="setor" id="" placeholder="" />

        </div>
        <div>
        <button type="submit" name="submit"  class="btn btn-primary">
            Incluir
        </button>
        </div>
    </form>
</body>

</html>

</div>
</body>

</html>