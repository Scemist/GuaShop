<?php
	
	// Conexão e sessão
	require_once('../../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('loja', false);

	$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

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

	$sql = $conexao -> prepare(
		"UPDATE produto
			SET
				nome_prod = '$nome',
				descricao_prod = '$descricao',
				preco_prod = '$preco',
				caracteristicas_prod = '$caracteristicas',
				promocao_prod = '$promocao',
				id_seto = '$setor',
				id_loja = '$_SESSION[id]'
			WHERE
				id_prod = '$id'
				");

	$sql -> bindParam(':loja', $_SESSION['id']);
	$sql -> execute();

	if (is_uploaded_file($_FILES['imagem']['tmp_name'])) {
 		$tabela = 'produto';

		$pasta = '../../imagens/';
		$tipo = substr($_FILES['imagem']['name'], -4);
		$imagem = $_POST['nome'] . date('dmYhmis') . $tipo;
		$nome_imagem = $pasta . $imagem;

		$tabela = 'produto';
		$referencia = $id;

		if(move_uploaded_file($_FILES['imagem']['tmp_name'], $nome_imagem)){
			$sql = $conexao -> prepare('SELECT id_imag FROM imagem WHERE referencia_refe = :referencia AND tabela_imag = "produto"');
			$sql -> bindParam(':referencia', $id);
			$sql -> execute();
			$quantidade = $sql -> rowCount();

			if ($quantidade > 0) {
				$sql = $conexao -> prepare (
					"UPDATE imagem
					SET
					arquivo_imag = '$imagem',
					tabela_imag = '$tabela',
					referencia_refe = '$referencia'
					WHERE
					referencia_refe = '$id'
					AND tabela_imag = 'produto'
					");
					$sql -> execute();
			}

			else if ($quantidade == 0) {
				$sql = $conexao -> prepare (
					'INSERT INTO imagem (
									arquivo_imag,
									tabela_imag,
									referencia_refe
									)
							VALUES (
									:imagem,
									"produto",
									:referencia
								)');
				$sql -> bindParam(':imagem', $imagem);
				$sql -> bindParam(':referencia', $id);
				$sql -> execute();
			}

		}
	}

	$conexao = null;
	$sql = null;

	if ($id > 0) {

		header("Location: ../index.php");
	}
	else{

		$_SESSION['msg'] = "<p>Erro ao salvar os dados</p>";
		header("Location: ../index.php");
	}

?>
