<?php

// Conexão e sessão
require_once('../../funcoes/php/conexao.php');
$conexao = estabelecerConexao('loja', false);

$id = $_SESSION['id'];

$sobre = $_POST['sobre'];
$estado = $_POST['uf'];
$cidade = $_POST['cidade'];
$cep = $_POST['cep'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$complemento = $_POST['complemento'];

$sql = $conexao->prepare (
	'UPDATE
		loja
	SET
		sobre_loja = :sobre,
		estado_loja = :estado,
		cidade_loja = :cidade,
		cep_loja = :cep,
		rua_loja = :rua,
		numero_loja = :numero,
		complemento_loja = :complemento
	WHERE
		id_loja = :id
');

$sql->bindParam(':sobre', $sobre);
$sql->bindParam(':estado', $estado);
$sql->bindParam(':cidade', $cidade);
$sql->bindParam(':cep', $cep);
$sql->bindParam(':rua', $rua);
$sql->bindParam(':numero', $numero);
$sql->bindParam(':complemento', $complemento);
$sql->bindParam(':id', $id);

$sql->execute();

require_once('../../funcoes/php/imagem.php'); // Funções de manipulação de imagem
salvarImagem('loja', $id, true);

$conexao = null;
$sql = null;

header("Location: ../menu_de_conta.php");