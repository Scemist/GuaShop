<?php

	session_start();
	include_once('../conexao/conexao.php');

	$id = $_GET['id'];

	$sql = $conexao -> prepare( 
		"DELETE FROM
					imagem
				WHERE
					referencia_refe = :id
					AND tabela_imag = 'produto';
		DELETE FROM
					setor 
				WHERE 
					id_prod = :id;
		DELETE FROM
					produto
				WHERE
					id_prod = :id
				");

	$sql -> bindParam(':id', $id);

	$sql -> execute();

	header('Location: ../index.php');
?>
