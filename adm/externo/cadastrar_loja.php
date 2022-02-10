<?php

// Conexão e sessão
require_once('../../funcoes/php/conexao.php');
$conexao = estabelecerConexao('adm', true);

// Confere a Senha
if ($_POST['senha'] !== $_POST['confirmacaosenha']) {

	header('Location: ../cadastro_loja.php?msg=1');
	exit;
}

// Salva a loja no banco de dados
$nome = $_POST['nome'];
$sobre = $_POST['sobre'];
$usuario = $_POST['usuario'];
$senha = md5($_POST['senha']);
$uf = $_POST['uf'];
$cidade = $_POST['cidade'];
$cep = $_POST['cep'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$complemento = $_POST['complemento'];

$ativo = $_POST['ativo'];

if ($ativo == 'ativado') {

	$ativo = 1;
}
else if ($ativo == 'desativado') {

	$ativo = 0;
}

$sql = $conexao -> prepare (
	'INSERT INTO loja (
		nome_loja,
		sobre_loja,
		usuario_loja,
		senha_loja,
		estado_loja,
		cidade_loja,
		cep_loja,
		rua_loja,
		numero_loja,
		complemento_loja,
		ativo_loja)
	VALUES (
		:nome,
		:sobre,
		:usuario,
		:senha,
		:estado,
		:cidade,
		:cep,
		:rua,
		:numero,
		:complemento,
		:ativo)'
);

$sql -> bindParam(':nome', $nome);
$sql -> bindParam(':sobre', $sobre);
$sql -> bindParam(':usuario', $usuario);
$sql -> bindParam(':senha', $senha);
$sql -> bindParam(':estado', $uf);
$sql -> bindParam(':cidade', $cidade);
$sql -> bindParam(':cep', $cep);
$sql -> bindParam(':rua', $rua);
$sql -> bindParam(':numero', $numero);
$sql -> bindParam(':complemento', $complemento);
$sql -> bindParam(':ativo', $ativo);

$sql -> execute();
$loja = $conexao -> lastInsertId();

require_once('../../funcoes/php/imagem.php'); // Funções de manipulação de imagem
salvarImagem('loja', $loja, false);

$conexao = null;
$sql = null;

if ($loja > 0) {

	header("Location: ../loja.php?id=$loja");
	exit;
}
else {

	header('Location: ../cadastro_loja.php?msg=2');
	exit;
}