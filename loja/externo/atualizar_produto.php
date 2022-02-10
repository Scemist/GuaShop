<?php

// Conexão e sessão
require_once('../../funcoes/php/conexao.php');
$conexao = estabelecerConexao('loja', false);

$produto = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

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

$sql = $conexao->prepare(
	'UPDATE
		produto
	SET
		nome_prod = :nome,
		descricao_prod = :descricao,
		preco_prod = :preco,
		caracteristicas_prod = :caracteristicas,
		promocao_prod = :promocao,
		id_seto = :setor,
		id_loja = :loja
	WHERE
		id_prod = :produto'
);

$sql->bindParam(':nome', $nome);
$sql->bindParam(':descricao', $descricao);
$sql->bindParam(':preco', $preco);
$sql->bindParam(':caracteristicas', $caracteristicas);
$sql->bindParam(':promocao', $promocao);
$sql->bindParam(':setor', $setor);
$sql->bindParam(':loja', $_SESSION['id']);
$sql->bindParam(':produto', $produto);
$sql->execute();

// Funções de manipulação de imagem
require_once('../../funcoes/php/imagem.php'); 
salvarImagem('produto', $produto, true);

$conexao = null;
$sql = null;

header("Location: ../produto.php?id=$produto");