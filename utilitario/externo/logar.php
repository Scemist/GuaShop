<?php

// Conexão e sessão
require_once('../../funcoes/php/conexao.php');
$conexao = estabelecerConexao('utilitario', false);

$email = $_POST['email'];
$senha = md5($_POST['senha']);

$sql = $conexao->prepare('SELECT id_usua FROM usuario WHERE email_usua = :email AND senha_usua = :senha');
$sql->bindParam(':email', $email);
$sql->bindParam(':senha', $senha);
$sql->execute();
$usuario = $sql->fetch();

if (isset($usuario['id_usua'])):

	$_SESSION['logado'] = true;
	$_SESSION['email'] = $email;
	$_SESSION['id'] = $usuario['id_usua'];

	header('Location: ../index.php');
else:

	header('Location: ../login.php?msg=2');
endif;