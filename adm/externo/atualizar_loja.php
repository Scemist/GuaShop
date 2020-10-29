<?php

	// Conexão com o banco de dados

	require_once('../conexao/conexao.php');

	// Código PHP da página

	$id = $_POST['id'];

	if ($_POST['ativo'] == 0) { // Se está ativo
		$ativo = 0;
	}
	else {
		$ativo = 1;
	}

	$sobre = $_POST['sobre'];
	$estado = $_POST['uf'];
	$cidade = $_POST['cidade'];
	$cep = $_POST['cep'];
	$rua = $_POST['rua'];
	$numero = $_POST['numero'];
	$complemento = $_POST['complemento'];

	echo $id;

	$sql = $conexao -> prepare (
		"UPDATE
			loja
		SET
			sobre_loja = :sobre,
			estado_loja = :estado,
			cidade_loja = :cidade,
			cep_loja = :cep,
			rua_loja = :rua,
			numero_loja = :numero,
			complemento_loja = :complemento,
			ativo_loja = :ativo
		WHERE
			id_loja = :id
	");

	$sql -> bindParam(':sobre', $sobre);
	$sql -> bindParam(':estado', $estado);
	$sql -> bindParam(':cidade', $cidade);
	$sql -> bindParam(':cep', $cep);
	$sql -> bindParam(':rua', $rua);
	$sql -> bindParam(':numero', $numero);
	$sql -> bindParam(':complemento', $complemento);
	$sql -> bindParam(':ativo', $ativo);
	$sql -> bindParam(':id', $id);

	$sql -> execute();
	$loja = $conexao -> lastInsertId();

	// Salva imagem

	if (is_uploaded_file($_FILES['imagem']['tmp_name'])) { // Se existir uma imagem

		// Salva na pasta imagens

		$tabela = 'loja';
		$pasta_upload = '../../imagens/';
		$extensao = substr($_FILES['imagem']['name'], -4);
		$arquivo = "loja_" . date('Y_m_H_i_s') . $extensao;
		$imagem_final = $pasta_upload . $arquivo;


		if (move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem_final)) { // Se for salvo com sucesso

			// Salva o nome no banco de dados

			$sql = $conexao -> prepare
			('INSERT INTO
				imagem
				(
					arquivo_imag,
					tabela_imag,
					referencia_refe
				)
			VALUES
				(
					:arquivo,
					:tabela,
					:referencia
				)');

			$sql -> bindParam(':arquivo', $arquivo);
			$sql -> bindParam(':tabela', $tabela);
			$sql -> bindParam(':referencia', $loja);

			$sql -> execute();

			// Apaga a imagem antiga

			$arquivoImagem = $_POST['arquivoImagem'];

			if ($_POST['avisoSemImagem'] == 1) {
				unlink("../../imagens/$arquivoImagem");
			}

			$sql = $conexao -> prepare('DELETE FROM	imagem	WHERE arquivo_imag = :arquivo');
			$sql -> bindParam(':arquivo', $arquivoImagem);
			$sql -> execute();

		}
	}

	header('Location: ../loja.php?msg=1&id=' . $_POST['id']);

?>
