<?php

    include_once ("configuracao/conexao.php");

    $id_produto      = $_POST['id_produto'];
    $produto		 = $_POST['produto'];
    $codigo_produto  = $_POST['cod_produto'];
    $descricao 		 = $_POST['descricao'];
    $categoria       = $_POST['categoria'];
    $quantidade      = $_POST['quantidade'];
    $valor		     = $_POST['valor'];
    $data_atualizado = date('Y-m-d H:i:s');

    $query_altera = "UPDATE produtos SET produto = :produto, codigo_produto = :codigo_produto, descricao = :descricao, 
                                  categoria = :categoria, quantidade = :quantidade, valor = :valor, data_atualizado = :data_atualizado 
                                  WHERE id_produto = :id_produto";


    $alterar = $conn->prepare($query_altera, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $alterar->execute(array(
        ':id_produto'       => $id_produto,
        ':produto'          => $produto,
        ':codigo_produto'   => $codigo_produto,
        ':descricao'        => $descricao,
        ':categoria'        => $categoria,
        ':quantidade'       => $quantidade,
        ':valor'            => $valor,
        ':data_atualizado'  => $data_atualizado
    ));

    if ($alterar) 
    {
        echo $_SESSION['msg'] = 'Alteração realizada com sucesso!!!';
        header('Location: exibir_produto.php');
    }
    else
    {
        echo $_SESSION['msg'] = 'Erro ao efetuar o cadastro: ',  $e->getMessage(), "\n";
        header('Location: exibir_produto.php');
    }

?>