<?php

	function estabelecerConexao ($site, $checar) {

		try {
				
			$conexao = new PDO('mysql:host=localhost;dbname=guashop;charset=utf8', 'root', '');
			$conexao -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $ex) {

			echo "Erro: " . $e -> getMessage();
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
