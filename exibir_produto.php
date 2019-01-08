<?php 

	include_once "configuracao/conexao.php";

	$query = "SELECT * FROM produtos ORDER BY id_produto";

	$exec = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$exec->execute();
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	<style>

		h2 
		{
			text-align: center;
		}

		div
		{
			margin-top: 50px;
		}

		.btn
		{
			width: 50px;
			padding: 1px;
		}

	</style>

</head>


<body>
	<div class="container">
		<h2>.: PRODUTOS :.</h2>
		<form action="pesquisa.php" method="POST">
			<div class="form-group row">
				<input class="form-control col-sm-3" id="pesquisa" name="pesquisa">
				<input type="submit" class="btn btn-primary col-sm-1" name="pesquisar" value="Buscar">
			</div>
		</form>
		<table class="table table-bordered">
		    <thead>
		      <tr>
		        <th scope="col">#</th>
		        <th scope="col">Produto</th>
		        <th scope="col">Código</th>
		        <th scope="col">Categoria</th>
		        <th scope="col">Quantidade</th>
		        <th scope="col">Valor</th>
		        <th scope="col">Cadastrado em</th>
		        <th scope="col">Atualizado em</th>
		        <th scope="col">Ação</th>
		      </tr>
		    </thead>
			<?php 
				while ($row = $exec->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {

					$query_categoria = "SELECT categoria FROM categorias WHERE id_categoria = $row[4]";
					$categoria = $conn->prepare($query_categoria, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
					$categoria->execute();
					$row_categoria = $categoria->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);

					echo "<tr>";
					echo "<td>" . $row[0] . "</td>";
					echo "<td>" . $row[1] . "</td>";
					echo "<td>" . $row[2] . "</td>";
					echo "<td>" . $row_categoria[0] . "</td>";
					echo "<td>" . $row[5] . "</td>";
					echo "<td>" . "R$ " . $row[6] . "</td>";
					echo "<td>" . date('d/m/Y H:i:s',  strtotime($row[7])) . "</td>";
					echo "<td>" . date('d/m/Y H:i:s',  strtotime($row[8])) . "</td>";
				    echo "<td>
				    		<form action='alterar_produto.php' method='post'>
				    			<input type='text' class='form-control' id='id' name='id' value='$row[0]' hidden>
				    			<input type='submit' class='btn btn-outline-warning btn-sm' title='Editar' value='!'>
				    		</form>
				    		<form action='deleta.php' method='post'>
				    			<input type='text' class='form-control' id='id' name='id' value='$row[0]' hidden>
				    			<input type='submit' class='btn btn-outline-danger btn-sm' title='Excluir' value='X'>
				    		</form>
				    	  </td>";
				    echo "</tr>";				
				} 
			?>
		</table>
		<a href="cadastrar_produto.php">Cadastrar novo produto</a>
	</div>
</body>
</html>
