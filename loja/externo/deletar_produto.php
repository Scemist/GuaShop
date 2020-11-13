<?php

	// Conexão e sessão
	require_once('../../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('loja', false);

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
