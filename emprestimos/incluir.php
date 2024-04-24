<?php

session_start();
if (!isset($_SESSION['usuario_sessao'])) {
    header('Location: index.php');
    exit();
}

include_once("../util/config.php");


if (isset($_POST['submit'])) {
    $usuario = $_POST['usuario'];
    $equipamento = $_POST['equipamento'];
    $data = $_POST['data'];

    if (empty($usuario) || empty($equipamento)|| empty($data)) {

        if (empty($usuario)) {
           
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

        if (empty($equipamento)) {
            
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
            <strong>Atenção </strong> equipamento incorreto!
        </div>';
        }
        if (empty($data)) {
            
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
            <strong>Atenção </strong> data incorreto!
        </div>';
        }

    } else {

        $sql = "INSERT INTO emprestimos(usuario, equipamento,data) VALUES(:usuario, :equipamento,:data)";
        $query = $dbConn->prepare($sql);

        $query->bindparam(':usuario', $usuario);
        $query->bindparam(':equipamento', $equipamento);
        $query->bindparam(':data', $data);
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
    <script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>


    <title>Empréstimos de equipamentos</title>
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
           
<?php
$result = $dbConn->query("SELECT * FROM usuarios");
echo '<div class="mb-3">
    <label for="" class="form-label">Usuario</label>
    <select
        class="form-select form-select-lg"
        name="usuario"
        id=""
    >
    <option value="">Selecione um usuário</option>';

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value=".$row['id'].">".$row['nome']."</option>";
    }
    echo '</select>';


    

?>
</div>

        <div class="mb-3">
          
            <?php
$result2 = $dbConn->query("SELECT * FROM equipamentos");
echo '<div class="mb-3">
    <label for="" class="form-label">Equipamentos</label>
    <select
        class="form-select form-select-lg"
        name="equipamento"
        id=""
    >
    <option value="">Selecione um equipamento</option>';

    while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value=".$row['id'].">".$row['descricao']."</option>";
    }
    echo '</select>';
?>
        </div>

<div class="mb-3">
    <label for="" class="form-label">Data</label>
    <input
        type="date"
        class="form-control"
        name="data"
        id=""
        placeholder=""
    />

</div>


        <div>
        <button type="submit" name="submit"  class="btn btn-primary">
            Incluir
        </button>
        </div>
    </form>
</div>
</body>

</html>


