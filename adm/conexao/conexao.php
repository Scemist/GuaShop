<?php

	try {

		$conexao = new PDO('mysql:host=localhost;dbname=guashop;charset=utf8', 'root', '');
		$conexao -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	}
	catch (PDOException $ex) {

		echo "Erro: " . $e -> getMessage();
	}

?>
