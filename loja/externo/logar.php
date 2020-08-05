<?php
	require('../conexao/conexao.php');

	$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
	$senha = isset($_POST['senha']) ? $_POST['senha'] : '';

	if (empty($usuario) || empty($senha)) {
    	echo "Informe email e senha";
    	exit;
	}

	// cria o hash da senha
	$hash_senha = make_hash($senha);

	$sql = $conexao -> prepare("SELECT id_loja FROM loja WHERE usuario_loja = :usuario AND senha_loja = :senha");
	$sql -> bindParam(':usuario', $usuario);
 	$sql -> bindParam(':senha', $senha);
 	$sql -> execute();
 	$users = $sql -> fetchAll(PDO::FETCH_ASSOC);

 	if (count($users) <= 0) {
		header('Location: ../login.php?msg=1');
    	exit;
	}

	// pega o primeiro usuário
	$loja = $users[0];

	session_start();
	$_SESSION['logged_in'] = true;
	$_SESSION['id'] = $loja['id_loja'];

	header('Location: ../index.php');
?>
