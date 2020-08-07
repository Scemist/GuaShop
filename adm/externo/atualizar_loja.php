<?php

	// Conexão com o banco de dados

	require_once('../conexao/conexao.php');

	// Código PHP da página

	$loja = $_POST['id'];

	if ($_POST['ativo'] == 0) { // Se está ativo
		$ativo = 0;
	}
	else {
		$ativo = 1;
	}

	$sql = $conexao -> prepare ('
		UPDATE
			loja
		SET
			nome_loja = :nome,
			sobre_loja = :sobre,
			estado_loja = :estado,
			cidade_loja = :cidade,
			bairro_loja = :bairro,
			rua_loja = :rua,
			numero_loja = :numero,
			ativo_loja = :ativo
		WHERE
			id_loja = :id
	');

	$sql -> bindParam(':nome', $_POST['nome']);
	$sql -> bindParam(':sobre', $_POST['sobre']);
	$sql -> bindParam(':estado', $_POST['estado']);
	$sql -> bindParam(':cidade', $_POST['cidade']);
	$sql -> bindParam(':bairro', $_POST['bairro']);
	$sql -> bindParam(':rua', $_POST['rua']);
	$sql -> bindParam(':numero', $_POST['numero']);
	$sql -> bindParam(':ativo', $ativo);
	$sql -> bindParam(':id', $loja);

	$sql -> execute();

	// Salva imagem

  if (is_uploaded_file($_FILES['imagem']['tmp_name'])) { // Se existir uma imagem

    // Salva na pasta imagens

    $titulo = $_POST['titulo'];
    $tabela = 'loja';

    $pasta_upload = '../../imagens/';
    $extensao = substr($_FILES['imagem']['name'], -4);
    $arquivo = $titulo . date('dmYhmis') . $extensao;
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

    }
  }

	header('Location: ../loja.php?msg=1&id=' . $_POST['id']);

?>
