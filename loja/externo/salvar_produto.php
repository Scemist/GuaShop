<?php

	session_start();
	include_once('../conexao/conexao.php');

	// Pega os ids dos setores

	$setor = '';

	if (isset($_POST['fastfood'])) {
		$setor = '1,';}

	if (isset($_POST['alimentacao'])) {
		$setor = $setor . '2,';}

	if (isset($_POST['farmacia'])) {
		$setor = $setor . '3,';}

	if (isset($_POST['vestuario'])) {
		$setor = $setor . '4,';}

	if (isset($_POST['perfumaria'])) {
		$setor = $setor . '5,';}

	if (isset($_POST['petshop'])) {
		$setor = $setor . '6,';}

	if (isset($_POST['moveis'])) {
		$setor = $setor . '7,';}

	if (isset($_POST['eletrodomesticos'])) {
		$setor = $setor . '8,';}

	if (isset($_POST['diversos'])) {
		$setor = $setor . '9,';}

	// Pega as informaçoes do produto e cadastra

	$nome = $_POST['nome'];
	$descricao = $_POST['descricao'];
	$preco = $_POST['preco'];
	$caracteristicas = $_POST['caracteristicas'];
	$promocao = $_POST['promocao'];

	$sql = $conexao -> prepare (
		"INSERT INTO produto (
						nome_prod,
						descricao_prod,
						preco_prod,
						caracteristicas_prod,
						promocao_prod,
						id_seto,
						id_loja
						)
				VALUES (
						:nome,
						:descricao,
						:preco,
						:caracteristicas,
						:promocao,
						:setor,
						:loja
					)");

	$sql -> bindParam(':nome', $nome);
	$sql -> bindParam(':descricao', $descricao);
	$sql -> bindParam(':preco', $preco);
	$sql -> bindParam(':caracteristicas', $caracteristicas);
	$sql -> bindParam(':promocao', $promocao);
	$sql -> bindParam(':setor', $setor);
	$sql -> bindParam(':loja', $_SESSION['id']);

	$sql -> execute();
	$prod = $conexao -> lastInsertId();

	// Cadastra a imagem

	if (is_uploaded_file($_FILES['imagem']['tmp_name'])) {
 		$tabela = 'produto';

		$pasta = '../../imagens/';
		$tipo = substr($_FILES['imagem']['name'], -4);
		$imagem = $_POST['nome'] . date('dmYhmis') . $tipo;
		$nome_imagem = $pasta . $imagem;

		$tabela = 'produto';

		if(move_uploaded_file($_FILES['imagem']['tmp_name'], $nome_imagem)){
			$sql = $conexao -> prepare (
				"INSERT INTO imagem (
								arquivo_imag,
								tabela_imag,
								referencia_refe
								)
						VALUES (
								:imagem,
								:tabela,
								:referencia
								)");

			$sql -> bindParam(':imagem', $imagem);
			$sql -> bindParam(':tabela', $tabela);
			$sql -> bindParam(':referencia', $prod);
			$sql -> execute();
		}
	}

	// Limpa a conexao e volta para a página

	$conexao = null;
	$sql = null;

	if ($prod > 0) {

		$_SESSION['msg'] = "<p>Sucesso ao salvar os dados</p>";
		header("Location: ../index.php");
	}
	else{

		$_SESSION['msg'] = "<p>Erro ao salvar os dados</p>";
		header("Location: ../cadastro_produtos.php");
	}
?>
