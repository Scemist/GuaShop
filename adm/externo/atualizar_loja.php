<?php

// Conexão e sessão
require_once('../../funcoes/php/conexao.php');
$conexao = estabelecerConexao('adm', true);

// Código PHP da página

$loja = $_POST['id'];

if ($_POST['ativo'] == 0) { // Se está ativo

	$ativo = 0;
}
else {

	$ativo = 1;
}

$nome = $_POST['nome'];
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
		nome_loja = :nome,
		sobre_loja = :sobre,
		estado_loja = :estado,
		cidade_loja = :cidade,
		cep_loja = :cep,
		rua_loja = :rua,
		numero_loja = :numero,
		complemento_loja = :complemento,
		ativo_loja = :ativo
	WHERE
		id_loja = :id'
);

$sql->bindParam(':nome', $nome);
$sql->bindParam(':sobre', $sobre);
$sql->bindParam(':estado', $estado);
$sql->bindParam(':cidade', $cidade);
$sql->bindParam(':cep', $cep);
$sql->bindParam(':rua', $rua);
$sql->bindParam(':numero', $numero);
$sql->bindParam(':complemento', $complemento);
$sql->bindParam(':ativo', $ativo);
$sql->bindParam(':id', $loja);

$sql->execute();

require_once('../../funcoes/php/imagem.php'); // Funções de manipulação de imagem
salvarImagem('loja', $loja, true);

header('Location: ../loja.php?men=1&id=' . $_POST['id']);
exit;