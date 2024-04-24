<?php

session_start();
if (!isset($_SESSION['usuario_sessao'])) {
    header('Location: index.php');
    exit();
}
include("../util/config.php");

if(isset($_POST['atualizar']))
{	
	$id = $_POST['id'];
	$nome=$_POST['nome'];
	$senha=$_POST['senha'];
	
	
	
	if(empty($nome) || empty($senha) ) {	
			
		if(empty($nome)) {
	
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
            <strong>Atenção </strong> Nome incorreto!
        </div>';
		}
		
		if(empty($senha)) {
			
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
            <strong>Atenção </strong> Nome incorreto!
        </div>';
		}
		
	} else {	
	
		$sql = "UPDATE usuarios SET nome=:nome, senha=:senha WHERE id=:id";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':id', $id);
		$query->bindparam(':nome', $nome);
		$query->bindparam(':senha', $senha);
		$query->execute();
		header("Location: index.php");
	}
}
?>
<?php
if (isset($_GET['id'])){

$id = $_GET['id'];

$sql = "SELECT * FROM usuarios WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
	$nome = $row['nome'];
	$senha = $row['senha'];
	
}

}
else{
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <title>Alteração de usuário</title>
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

                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Voltar</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
 
    <div class="container-sm">

    <form action="alterar.php" method="post" name="form1">
        <div class="mb-3">
            <label for="" class="form-label">Nome</label>
            <input type="text" class="form-control" name="nome" id="" placeholder="" value="<?php echo $nome;?>"/>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">senha</label>
            <input type="text" class="form-control" name="senha" id="" placeholder="" value="<?php echo $senha;?>" />

        </div>
        <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>


<div>

        <button type="submit" 
        name="atualizar" 
        value="" 
        class="btn btn-primary">
            Alterar 
        </button>
        </div>
    </form>
    </div>


</body>
</html>
