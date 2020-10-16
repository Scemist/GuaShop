<?php

	session_name('loja');
	session_start();
	include_once('../conexao/conexao.php');

	$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
	$csenha = $_POST['csenha'];

	$loja = 'loja';

	if (empty($usuario) || empty($senha)) {
    	echo "Informe email e senha";
            return true;
	}
	if ($senha != $csenha) {
            echo "As senhas devem ser iguais!";
            return true;
    }  

	$sql =  $conexao -> prepare("
		UPDATE
			loja
		SET
			usuario_loja = '$usuario',
			senha_loja = '$senha'
		WHERE
			id_loja = '$id'
	");

	$sql -> execute();

	$conexao = null;
	$sql = null;

	if ($id > 0) {

		header("Location: ../menu_de_conta.php");
	}
	else {

		$_SESSION['msg'] = "<p>Erro ao salvar os dados</p>";
		header("Location: ../mudar_login.php");
	}

?>
