<?php

// Conexão e sessão
require_once('../../funcoes/php/conexao.php');
$conexao = estabelecerConexao('adm', false);

$usuario = $_POST['usuario'];
$senha = md5($_POST['senha']);

$sql = $conexao->prepare('SELECT id_admi FROM administrador WHERE usuario_admi = :usuario AND senha_admi = :senha');
$sql->bindParam(':usuario', $usuario);
$sql->bindParam(':senha', $senha);
$sql->execute();

$administrador = $sql->fetch();

if (isset($administrador['id_admi'])) { // Se existir o administrador

	session_name('adm');
	session_start();
	$_SESSION['logado'] = true;
	$_SESSION['usuario'] = $usuario;

	header('Location: ../index.php');
	exit;
}
else { // Se não existir o administrador

	header('Location: ../login.php?men=1');
	exit;
}