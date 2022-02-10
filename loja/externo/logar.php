<?php

// Conexão e sessão
require_once('../../funcoes/php/conexao.php');
$conexao = estabelecerConexao('loja', false);

$usuario = $_POST['usuario'];
$senha = md5($_POST['senha']);

$sql = $conexao->prepare("SELECT id_loja FROM loja WHERE usuario_loja = :usuario AND senha_loja = :senha");
$sql->bindParam(':usuario', $usuario);
$sql->bindParam(':senha', $senha);
$sql->execute();
$loja = $sql->fetch();

if (isset($loja['id_loja'])) {

	$_SESSION['logado'] = true;
	$_SESSION['id'] = $loja['id_loja'];

	header('Location: ../index.php');
	exit;
}
else {

	header('Location: ../login.php?men=1');
	exit;
}