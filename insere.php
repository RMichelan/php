<?php

    include_once ("configuracao/conexao.php");

    $produto		= $_POST['produto'];
    $codigo_produto = $_POST['cod_produto'];
    $descricao 		= $_POST['descricao'];
    $categoria      = $_POST['categoria'];
    $quantidade     = $_POST['quantidade'];
    $valor		    = $_POST['valor'];
    $data_cadastro 	= date('Y-m-d H:i:s');

    $query = "INSERT INTO produtos (produto, codigo_produto, descricao, categoria, quantidade, valor, data_cadastro, data_atualizado) 
                VALUES(:produto, :codigo_produto, :descricao, :categoria, :quantidade, :valor, :data_cadastro, :data_atualizado)";

    try 
    {	
        $stmt = $conn->prepare($query);
        $stmt->execute(array(
            ':produto' 			=> $produto,
            ':codigo_produto'	=> $codigo_produto,
            ':descricao'		=> $descricao,
            ':categoria'        => $categoria,
            ':quantidade'       => $quantidade,
            ':valor'     		=> $valor,
            ':data_cadastro' 	=> $data_cadastro,
            ':data_atualizado'  => $data_cadastro
        ));

        if ($stmt) {
            header('Location: exibir_produto.php');
        }
    }

    catch (Exception $e)
    {
        header('Location: cadastrar_produto.php');
    }

?>