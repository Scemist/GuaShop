<?php

	// Conexão com o banco de dados
	require_once('../conexao/conexao.php');

	// Confere a Senha
	if ($_POST['senha'] !== $_POST['confirmacaosenha']) {

		header('Location: ../cadastro_loja.php?msg=1');
		exit;
	}

	// Salva a loja no banco de dados

	$nome = $_POST['nome'];
	$sobre = $_POST['sobre'];
	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
	$uf = $_POST['uf'];
	$cidade = $_POST['cidade'];
	$cep = $_POST['cep'];
	$rua = $_POST['rua'];
	$numero = $_POST['numero'];
	$complemento = $_POST['complemento'];

	$ativo = $_POST['ativo'];

	if ($ativo == 'ativado') {

		$ativo = 1;
	}
	else if ($ativo == 'desativado') {

		$ativo = 0;
	}

	$sql = $conexao -> prepare (
		'INSERT INTO loja (
			nome_loja,
			sobre_loja,
			usuario_loja,
			senha_loja,
			estado_loja,
			cidade_loja,
			cep_loja,
			rua_loja,
			numero_loja,
			complemento_loja,
			ativo_loja)
		VALUES (
			:nome,
			:sobre,
			:usuario,
			:senha,
			:estado,
			:cidade,
			:cep,
			:rua,
			:numero,
			:complemento,
			:ativo)'
	);

	$sql -> bindParam(':nome', $nome);
	$sql -> bindParam(':sobre', $sobre);
	$sql -> bindParam(':usuario', $usuario);
	$sql -> bindParam(':senha', $senha);
	$sql -> bindParam(':estado', $uf);
	$sql -> bindParam(':cidade', $cidade);
	$sql -> bindParam(':cep', $cep);
	$sql -> bindParam(':rua', $rua);
	$sql -> bindParam(':numero', $numero);
	$sql -> bindParam(':complemento', $complemento);
	$sql -> bindParam(':ativo', $ativo);

	$sql -> execute();
	$loja = $conexao -> lastInsertId();

	// Salva imagem
	if (is_uploaded_file($_FILES['imagem']['tmp_name'])) { // Se existir uma imagem

		// Salva na pasta imagens
		$tabela = 'loja';
		$pasta_upload = '../../imagens/';
		$extensao = substr($_FILES['imagem']['name'], -4);
		$arquivo = "loja_" . date('dmYhmis') . $extensao;
		$imagem_final = $pasta_upload . $arquivo;

		if (move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem_final)) { // Se for salvo com sucesso

			// Salva o nome no banco de dados
			$sql = $conexao -> prepare (
				'INSERT INTO
					imagem (
					arquivo_imag,
					tabela_imag,
					referencia_refe)
				VALUES (
					:arquivo,
					:tabela,
					:referencia)
			');
			$sql -> bindParam(':arquivo', $arquivo);
			$sql -> bindParam(':tabela', $tabela);
			$sql -> bindParam(':referencia', $loja);

			$sql -> execute();
		}
	}

	$conexao = null;
	$sql = null;

	if ($loja > 0) {

	  header("Location: ../loja.php?id=$loja");
	  exit;
	}
	else {

	  header('Location: ../cadastro_loja.php?msg=2');
	  exit;
	}

?>
