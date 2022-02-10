<?php

// Conexão e sessão
require_once('../../funcoes/php/conexao.php');
$conexao = estabelecerConexao('loja', false);

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$confirmacaoSenha = $_POST['csenha'];

$loja = 'loja';

if ($senha != $confirmacaoSenha) {

	echo "As senhas devem ser iguais!";	
}  

$senha = md5($senha);

$sql =  $conexao->prepare(
	'UPDATE
		loja
	SET
		usuario_loja = :usuario,
		senha_loja = :senha
	WHERE
		id_loja = :id'
);

$sql->bindParam(':usuario', $usuario);
$sql->bindParam(':senha', $senha);
$sql->bindParam(':id', $id);
$sql->execute();

$conexao = null;
$sql = null;

if ($id > 0) {

	header("Location: ../menu_de_conta.php");
}
else {

	$_SESSION['msg'] = "<p>Erro ao salvar os dados</p>";
	header("Location: ../mudar_login.php");
}