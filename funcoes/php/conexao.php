<?php

	function estabelecerConexao ($site, $checar) {

		try {
			$host = 'localhost';
			$dbname = 'guashop';
			$user = 'root';
			$password = '';

			$conexao = new PDO("mysql:host=${host};dbname=${dbname};charset=utf8", $user, $password);
			$conexao -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (Throwable $t) {

			echo "Erro: " . $t -> getMessage();
			die;
		}

		session_name($site);
		session_start();

		if (!isset($_SESSION['logado'])) {
				
			$_SESSION['logado'] = false;

			header('Location: ../' . $site . '/login.php');
			exit;
		}

		if ($checar == true) {

			checarSessao($site);
		}

		return $conexao;
	}
	
	function checarSessao ($site) {

		if ($_SESSION['logado'] == false) {

			header('Location: ../' . $site . '/login.php');
			exit;
		}
	}

?>
