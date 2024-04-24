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
	$descricao=$_POST['descricao'];
	$setor=$_POST['setor'];
	
	
	
	if(empty($descricao) || empty($setor) ) {	
			
		if(empty($descricao)) {
	
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
            <strong>Atenção </strong> descricao incorreta!
        </div>';
		}
		
		if(empty($setor)) {
			
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
	
		$sql = "UPDATE equipamentos SET descricao=:descricao, setor=:setor WHERE id=:id";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':id', $id);
		$query->bindparam(':descricao', $descricao);
		$query->bindparam(':setor', $setor);
		$query->execute();
		header("Location: index.php");
	}
}
?>
<?php
if (isset($_GET['id'])){

$id = $_GET['id'];

$sql = "SELECT * FROM equipamentos WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
	$descricao = $row['descricao'];
	$setor = $row['setor'];
	
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
<div class="container-sm">
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">Equipamentos</a>
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
 


    <form action="alterar.php" method="post" name="form1">
        <div class="mb-3">
            <label for="" class="form-label">Descrição</label>
            <input type="text" class="form-control" name="descricao" id="" placeholder="" value="<?php echo $descricao;?>"/>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Setor</label>
            <input type="text" class="form-control" name="setor" id="" placeholder="" value="<?php echo $setor;?>" />

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
