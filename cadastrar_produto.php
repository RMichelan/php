<?php 

include_once "configuracao/conexao.php";

 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>.: CADASTRO :.</title>

	<link rel="stylesheet" href="estilos/estilo_cadastrar.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
	<div class="container">
		<div class="form-cadastro">

			<h2>.: CADASTRAR PRODUTO :.</h2>

			<form action="inserir_produto.php" method="POST">

				<div class="form-group">
					<label>Produto:</label>
					<input type="text" class="form-control" id="produto" name="produto" required>
				</div>

				<div class="form-group">
					<label>Descrição:</label>
					<textarea class="form-control" maxlength="512" id="descricao" name="descricao" required></textarea>
				</div>

				<div class="form-group">
					<label>Categoria:</label>
					<select class="form-control" id="categoria" name="categoria" required>
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
					<input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="Ex.: 20" required>
				</div>

				<div class="form-group">
					<label>Código do Produto:</label>
					<input type="text" class="form-control" id="cod_produto" name="cod_produto" placeholder="Ex.: XYZ1234BR" required>
				</div>

				<div class="form-group">
					<label>Valor (R$):</label>
					<input type="text" class="form-control" id="valor" name="valor" placeholder="Ex.: 50,00" required>
				</div>

				<div class="form-line">
					<input type="submit" class="col-sm-3 btn btn-primary" value="CADASTRAR PRODUTO">
					<a href="exibir_produto.php" class="col-sm-3">Ver Produtos</a>
				</div>
			</form>
		</div>	
	</div>	
</body>
</html>