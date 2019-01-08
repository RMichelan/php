<?php

include_once ("configuracao/conexao.php");

date_default_timezone_set('America/Sao_Paulo');

$id_produto = $_POST['id'];

$query_deleta = "DELETE FROM produtos WHERE id_produto = :id_produto";


$deletar = $conn->prepare($query_deleta, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
$deletar->execute(array(
    ':id_produto' => $id_produto
));

header('Location: exibir_produto.php');
?>