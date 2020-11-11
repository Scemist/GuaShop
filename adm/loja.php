<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('adm', true);

	$id = $_GET['id'];

	// Pega as informações da loja

	$sql = $conexao -> prepare ('SELECT * FROM loja WHERE id_loja = :id');
	$sql -> bindParam(':id', $id);
	$sql -> execute();
	$loja = $sql -> fetch();

	if (!isset($loja['id_loja'])) {

		header('Location: index.php?men=1');
		exit;
	}

	$checkDesativado = $checkAtivado = "";

	if ($loja['ativo_loja'] == 0) {

		$checkDesativado = "selected";
	}
	else {

		$checkAtivado = "selected";
	}

	// Pega as informações da imagem

	$tabela = 'loja';

	$sql = $conexao -> prepare ('SELECT id_imag, arquivo_imag FROM imagem WHERE referencia_refe = :id AND tabela_imag = :tabela');
	$sql -> bindParam(':id', $id);
	$sql -> bindParam(':tabela', $tabela);
	$sql -> execute();
	$imagem = $sql -> fetch();

	if (isset($imagem['id_imag'])) { // Tem imagem

		$exibir = "<img src='../imagens/" . $imagem['arquivo_imag'] . " ' width='250px' class='mx-auto d-block rounded img-thumbnail'>";
		$nomeImagem = $imagem['arquivo_imag'];
		$antigaImagem = true;
	}
	else { // Se não tem imagem

		$exibir = "<p>Sem imagem</p>";
		$antigaImagem = false;
	}

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="theme-color" content="#e2e6ea"> <!-- Cor do brownser -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/bootstrap-4.5.3.min.css"> <!-- CSS Bootstrap -->
	
		<title><?= $loja['nome_loja'] ?> - GuaShop Adm</title>
	</head>

	<body class="bg-light">
		<nav class="container-fluid">
			<div class="row">
				<div class="col-12">
					<h2 class="text-light bg-dark py-2 px-5 mt-1 mb-0 text-right font-weight-light rounded"><spam class="h5 font-weight-light mr-4">Informações da loja </spam> <?= $loja['nome_loja'] ?></h2>
				</div>

				<div class="col-12">
					<a href="index.php">
						<button class="btn btn-info btn-sm mt-1 mb-0">
							Voltar ao início
						</button>
					</a>
					<hr class="mt-4 mb-0">
				</div>
			</div>
		</nav>

		<main class="container">
			<form action="externo/atualizar_loja.php" method="POST" enctype="multipart/form-data">
				<div class="row">

				<div class="col-0 col-xl-1"></div>

					<div class="col-12 col-md-6 col-xl-5 my-3">
				
						<?= $exibir ?>

						<div class="custom-file my-2">
							<input type="file" class="custom-file-input" id="imagem" name="imagem">
							<label class="custom-file-label">Clique para escolher</label>
							<input type="hidden" name="antigaImagemNome" value="<?= $nomeImagem ?>">
							<input type="hidden" name="antigaImagem" value="<?= $antigaImagem ?>">
						</div>

						<div class="text-center">
							<small class="text-muted">Alterar ou adicionar imagem da loja</small>
						</div>
					</div>

					<div class="col-12 col-sm-12 col-md-6 col-xl-5">
						<div class="row">
							<div class="col-12 form-group">
								<label for="nome">Nome</label>
								<input class="form-control" id="nome" type="textarea" name="nome" placeholder="<?= $loja['nome_loja'] ?>" value="<?= $loja['nome_loja'] ?>">
							</div>

							<div class="col-12 form-group">
								<label for="sobre">Sobre</label>
								<textarea class="form-control" id="nome" type="textarea" name="sobre" rows="4" placeholder="<?= $loja['sobre_loja'] ?>"><?= $loja['sobre_loja'] ?></textarea>
							</div>
						</div>
					</div>
				</div>

				<hr>

				<div class="form-row">
					<div class="col-0 col-xl-1"></div>

					<div class="col-12 col-md-5 col-xl-4">
						<label for="estado">CEP</label>
						<div class="input-group mb-3">
							<input id="cep" type="input" class="form-control w-75" name="cep" placeholder="<?= $loja['cep_loja'] ?>" value="<?= $loja['cep_loja'] ?>">
							<div class="input-group-append w-25">
								<button id="adicionar" class="btn btn-outline-info w-100" type="button">Buscar</button>
							</div>
						</div>

						<label for="estado">Cidade e UF</label>	
						<div class="input-group mb-3">
							<input type="text" class="form-control w-75" id="localidade" type="text" name="cidade" placeholder="<?= $loja['cidade_loja'] ?>" value="<?= $loja['cidade_loja'] ?>" readonly="readonly">
							<input type="text" class="form-control w-25" id="uf" type="text" name="uf" placeholder="<?= $loja['estado_loja'] ?>" value="<?= $loja['estado_loja'] ?>" readonly="readonly">
						</div>
					</div>

					<div class="col-12 col-md-7 col-xl-6">
						<div class="form-row">
							<div class="col-12 form-group">
								<label for="rua">Rua</label>
								<input class="form-control" id="rua" type="text" name="rua" placeholder="<?= $loja['rua_loja'] ?>" value="<?= $loja['rua_loja'] ?>">
							</div>

							<div class="col-6 form-group">
								<label for="numero">Número</label>
								<input class="form-control" id="numero" type="number" name="numero" placeholder="<?= $loja['numero_loja'] ?>" value="<?= $loja['numero_loja'] ?>">
							</div>
				
							<div class="col-6 form-group">
								<label for="numero">Complemento</label>
								<input class="form-control" id="complemento" type="text" name="complemento" placeholder="<?= $loja['complemento_loja'] ?>" value="<?= $loja['complemento_loja'] ?>">
							</div>
						</div>
					</div>
				</div>

				<hr>

				<div class="row">
					<div class="col-0 col-xl-1"></div>

					<div class="col-12 col-sm-12 col-lg-3 form-group">
						<label for="exampleFormControlSelect1">Status atual da loja</label>
						<select class="form-control" id="exampleFormControlSelect1" name="ativo">
							<option <?= $checkAtivado ?> value="1">Ativado</option>
							<option  <?= $checkDesativado ?> value="0">Desativado</option>
						</select>
					</div>
					
					<div class="col-12 col-sm-12 col-lg-5 col-xl-3"></div>

					<div class="col-12 col-sm-6 col-lg-2">
						<a class="btn btn-danger d-inline-block mb-3 w-100" href="externo/apagar_loja.php?id=<?= $id ?>">Apagar</a>
					</div>

					<div class="col-12 col-sm-6 col-lg-2">
						<input type="hidden" name="id" value="<?= $id ?>">
						<input class="btn btn-info w-100 mb-3 w-100" type="submit" value="Atualizar">
					</div>
				</div>

			</form>
		</main>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
		<script src="../funcoes/js/cep.js"></script> <!-- Funções de CEP -->
		<!-- <script src="../funcoes/js/imagem.js"></script> Funções de imagens -->
	</body>
</html>
