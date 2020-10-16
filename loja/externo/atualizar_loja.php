<?php

	session_name('loja');
	session_start();
	include_once('../conexao/conexao.php');

	$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

	$sobre = $_POST['sobre'];
	$estado = $_POST['estado'];
	$cidade = $_POST['cidade'];
	$bairro = $_POST['bairro'];
	$rua = $_POST['rua'];
	$numero = $_POST['numero'];

	$sql = $conexao -> prepare ("
		UPDATE
			loja
		SET
			sobre_loja = '$sobre',
			estado_loja = '$estado',
			cidade_loja = '$cidade',
			bairro_loja = '$bairro',
			rua_loja = '$rua',
			numero_loja = '$numero'
		WHERE
			id_loja = '$id'
	");

	$sql -> execute();
	$loja = $conexao -> lastInsertId();

  if (is_uploaded_file($_FILES['imagem']['tmp_name'])) { 

    $titulo = $_POST['titulo'];
    $tabela = 'loja';
	$referencia = $id;

    $pasta = '../../imagens/';
    $tipo = substr($_FILES['imagem']['name'], -4);
    $imagem = $titulo . date('dmYhmis') . $tipo;
    $nome_imagem = $pasta . $imagem;

		if(move_uploaded_file($_FILES['imagem']['tmp_name'], $nome_imagem)){
			$sql = $conexao -> prepare (
				"UPDATE imagem
					SET
						titulo_imag = '$titulo',
						arquivo_imag = '$imagem',
						tabela_imag = '$tabela',
						referencia_refe = '$referencia'
					WHERE
						referencia_refe = '$id'
						");

			$sql -> execute();
		}
	}

	$conexao = null;
	$sql = null;

	if ($id > 0) {

		header("Location: ../index.php");
	}
	else{

		$_SESSION['msg'] = "<p>Erro ao salvar os dados</p>";
		header("Location: ../menu_de_conta.php");
	}

?>