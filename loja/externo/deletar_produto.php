<?php

// Conexão e sessão
require_once('../../funcoes/php/conexao.php');
$conexao = estabelecerConexao('loja', false);

$produto = $_GET['id'];

// Funções de manipulação de imagem
require_once('../../funcoes/php/imagem.php');
apagarImagem('produto', $produto, false);

$sql = $conexao->prepare('DELETE FROM produto WHERE id_prod = :produto');
$sql->bindParam(':produto', $produto);
$sql->execute();

header('Location: ../produtos.php');