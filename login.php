<?php
session_start();
if (isset($_SESSION['usuario_sessao'])) {
    header('Location: index.php');
    exit();
}
include_once("./util/config.php");

if (isset($_POST['usuario']) && isset($_POST['senha'])) {

$nomeaux=$_POST['usuario'];
$senhaaux=$_POST['senha'];
$nome="";
    $sql = "SELECT nome,senha FROM usuarios WHERE nome=:nome AND senha=:senha ";
    $query = $dbConn->prepare($sql);
    $query->bindparam(':nome', $nomeaux);
    $query->bindparam(':senha', $senhaaux);
    $query->execute();

    $row = $query->fetch();
    if ($row) { 
        $_SESSION['usuario_sessao'] = $_POST['usuario'];
        header('Location: index.php');
        exit();
    } else {
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
        <strong>Atenção </strong> Usuario inexistente!
    </div>';
    }
}

?>


<script>
    var alertList = document.querySelectorAll(".alert");
    alertList.forEach(function (alert) {
        new bootstrap.Alert(alert);
    });
</script>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso ao sistema</title>
    <script src="js/bootstrap.bundle.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="css/jquery-1.11.1.min.js"></script>
</head>

<body>

    <div class="container"> 
      <center>  
    <div class="card card-container" style="width: 350px;padding: 50px 50px;">
        <form action="login.php" method="post">

            <div class="mb-3">
                <label for="" class="form-label">usuário</label>
                <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="" />
                
            </div>
            <div class="mb-3">
                <label for="" class="form-label">senha</label>
                <input type="password" class="form-control" name="senha" id="" aria-describedby="helpId" placeholder="" />
             
            </div>
            <button type="submit" class="btn btn-primary" value="Logar">
                Logar
            </button>

        </form>
        </div>
        </center>
    </div>



</body>

</html>