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
	$usuario=$_POST['usuario'];
	$equipamento=$_POST['equipamento'];
	$data=$_POST['data'];
	
	
	if(empty($usuario) || empty($equipamento) || empty($data) ) {	
			
		if(empty($usuario)) {
	
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
            <strong>Atenção </strong> usuario incorreto!
        </div>';
		}
		
		if(empty($equipamento)) {
			
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

        if(empty($data)) {
			
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
            <strong>Atenção </strong> data incorreta!
        </div>';
		}
		
	} else {	
	
		$sql = "UPDATE emprestimos SET usuario=:usuario, equipamento=:equipamento, data=:data WHERE id=:id";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':id', $id);
		$query->bindparam(':usuario', $usuario);
		$query->bindparam(':equipamento', $equipamento);
        $query->bindparam(':data', $data);
		$query->execute();
		header("Location: index.php");
	}
}
?>
<?php

 function procUsuario($id,$dbConn){
 $nome = "";
    $sql ="SELECT * FROM usuarios where id=:id";
    $query = $dbConn->prepare($sql);
    $query->execute(array(':id' => $id));

    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
       $nome = $row['nome'];
    }

    return $nome;
}
function procEquipo($id,$dbConn){
    $descricao = "";
       $sql ="SELECT * FROM equipamentos where id=:id";
       $query = $dbConn->prepare($sql);
       $query->execute(array(':id' => $id));
   
       while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $descricao = $row['descricao'];
       }
   
       return $descricao;
   }

if (isset($_GET['id'])){

$id = $_GET['id'];

$sql = "SELECT * FROM emprestimos WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
	$usuario = $row['usuario'];
    $nomeusuario=procUsuario($usuario,$dbConn);
	$equipamento = $row['equipamento'];
    $descequipo = procEquipo($equipamento,$dbConn);
	$data = $row['data'];
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
    <title>Alteração de empréstimo</title>
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
 
    <div class="container-sm">

    <form action="alterar.php" method="post" name="form1">
        <!--Usuário -->
          <div class="mb-3">
           
           <?php
           $result = $dbConn->query("SELECT * FROM usuarios");
           echo '<div class="mb-3">
               <label for="" class="form-label">Usuário</label>
               <select
                   class="form-select form-select-lg"
                   name="usuario"
                   id=""
               >
               <option value="'.$usuario.'">'.$nomeusuario.'</option>';
           
               while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                   echo "<option value=".$row['id'].">".$row['nome']."</option>";
               }
               echo '</select>';      
           ?>
           </div>

      

<!--Usuário -->
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
  <option value="'.$equipamento.'">'.$descequipo.'</option>';

  while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
      echo "<option value=".$row['id'].">".$row['descricao']."</option>";
  }
  echo '</select>';
?>
      </div>

            

        <div class="mb-3">
            <label for="" class="form-label">Data do empréstimo</label>
            <?php
            $dataaux= substr($data,0,10);
            ?>
            <input type="date" class="form-control" name="data" id="" placeholder="" value="<?php echo $dataaux;?>" />

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
