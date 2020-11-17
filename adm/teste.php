<?php

	$referencia = $_GET['r'];

	require_once('../../funcoes/php/imagem.php'); // Funções de manipulação de imagem
	salvarImagem('produto', $referencia, false);

?>