<?php

// Conexão e sessão
require_once('../../funcoes/php/conexao.php');
$conexao = estabelecerConexao('loja', false);

// Pega os ids dos setores

$setor = '';

if (isset($_POST['fastfood'])) $setor = '1,';

if (isset($_POST['alimentacao'])) $setor = $setor . '2,';

if (isset($_POST['farmacia'])) $setor = $setor . '3,';

if (isset($_POST['vestuario'])) $setor = $setor . '4,';

if (isset($_POST['perfumaria'])) $setor = $setor . '5,';

if (isset($_POST['petshop'])) $setor = $setor . '6,';

if (isset($_POST['moveis'])) $setor = $setor . '7,';

if (isset($_POST['eletrodomesticos'])) $setor = $setor . '8,';

if (isset($_POST['diversos'])) $setor = $setor . '9,';

// Pega as informaçoes do produto e cadastra

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$caracteristicas = $_POST['caracteristicas'];
$promocao = $_POST['promocao'];

$sql = $conexao->prepare (
	'INSERT INTO
		produto (
			nome_prod,
			descricao_prod,
			preco_prod,
			caracteristicas_prod,
			promocao_prod,
			id_seto,
			id_loja)
	VALUES (
		:nome,
		:descricao,
		:preco,
		:caracteristicas,
		:promocao,
		:setor,
		:loja)'
	);

$sql->bindParam(':nome', $nome);
$sql->bindParam(':descricao', $descricao);
$sql->bindParam(':preco', $preco);
$sql->bindParam(':caracteristicas', $caracteristicas);
$sql->bindParam(':promocao', $promocao);
$sql->bindParam(':setor', $setor);
$sql->bindParam(':loja', $_SESSION['id']);

$sql->execute();
$produto = $conexao->lastInsertId();

require_once('../../funcoes/php/imagem.php'); // Funções de manipulação de imagem
salvarImagem('produto', $produto, false);

$conexao = null;
$sql = null;

if ($produto > 0) {

	header("Location: ../produtos.php");
	exit;
}
else {

	header("Location: ../cadastro_produtos.php");
	exit;
}