<?php 

include_once "configuracao/conexao.php";

$id_produto = $_POST['id'];

$busca_produto = "SELECT * FROM produtos WHERE id_produto = $id_produto";
$exec = $conn->prepare($busca_produto, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
$exec->execute();

$produto = $exec->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>.: ATUALIZAR :.</title>

	<link rel="stylesheet" href="estilos/estilo_cadastrar.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
	<div class="container">
		<div class="form-cadastro">

			<h2>.: ALTERAR PRODUTO :.</h2>

			<h4> #<?php echo $id_produto; ?> </h4>

			<form action="altera.php" method="POST">

				<input type="text" class="form-control" id="id_produto" name="id_produto" value="<?php echo $id_produto; ?>" hidden>

				<div class="form-group">
					<label>Produto:</label>
					<input type="text" class="form-control" id="produto" name="produto" value="<?php echo $produto[1]; ?>">
				</div>

				<div class="form-group">
					<label>Descrição:</label>
					<textarea class="form-control" maxlength="512" id="descricao" name="descricao"><?php echo $produto[3]; ?></textarea>
				</div>

				<div class="form-group">
					<label>Categoria:</label>
					<select class="form-control" id="categoria" name="categoria">
						<?php
							$categorias = "SELECT id_categoria, categoria FROM categorias";
	
							$exec_categoria = $conn->prepare($categorias, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
							$exec_categoria->execute();

							while ($row = $exec_categoria->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) 
							{
								echo "<option value=" . $row[0] . ">" . $row[1] . "</option>";
							} 
						 ?>
					</select>
				</div>

				<div class="form-group">
					<label>Quantidade:</label>
					<input type="number" class="form-control" id="quantidade" name="quantidade" value="<?php echo $produto[5]; ?>">
				</div>

				<div class="form-group">
					<label>Código do Produto:</label>
					<input type="text" class="form-control" id="cod_produto" name="cod_produto" value="<?php echo $produto[2]; ?>">
				</div>

				<div class="form-group">
					<label>Valor (R$):</label>
					<input type="text" class="form-control" id="valor" name="valor" value="<?php echo $produto[6]; ?>">
				</div>

				<div class="form-line">
					<input type="submit" class="col-sm-3 btn btn-success" value="ALTERAR PRODUTO">
					<a href="exibir_produto.php" class="col-sm-3">Ver Produtos</a>
				</div>
			</form>
		</div>	
	</div>	
</body>
</html>