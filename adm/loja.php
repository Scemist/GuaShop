<?php

	require_once('conexao/conexao.php'); // Conexão com banco de dados

	require_once('externo/verificar.php'); // Confere a sessão

	$id = $_GET['id'];

	// Pega as informações da loja

	$sql = $conexao -> prepare ('SELECT id_loja, nome_loja, sobre_loja, estado_loja, cidade_loja, bairro_loja, rua_loja, numero_loja, ativo_loja FROM loja WHERE id_loja = :id');
	$sql -> bindParam(':id', $id);
	$sql -> execute();
	$loja = $sql -> fetch();

	$checkDesativado = $checkAtivado = "";

	if ($loja['ativo_loja'] == 0) {

		$checkDesativado = "checked";
	}
	else {

		$checkAtivado = "checked";
	}

	// Pega as informações da imagem

	$tabela = 'loja';

	$sql = $conexao -> prepare ('SELECT id_imag, titulo_imag, arquivo_imag FROM imagem WHERE referencia_refe = :id AND tabela_imag = :tabela');
	$sql -> bindParam(':id', $id);
	$sql -> bindParam(':tabela', $tabela);
	$sql -> execute();
	$imagem = $sql -> fetch();

	if (isset($imagem['id_imag'])) { // Tem imagem

		$exibir = "<img src='../imagens/" . $imagem['arquivo_imag'] . " ' width='250px'><br>";
	}
	else { // Se não tem imagem

		$exibir = "<p>Sem imagem</p>";
	}

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> <!-- CSS Bootstrap -->

		<title>GuaShop ADM - Loja</title>
	</head>

	<body class="bg-light">

		<main class="container">

			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <a href="index.php">
            <button class="btn btn-primary m-3">
              Início
            </button>
          </a>
					<hr>
				</div>
			</div>

			<form action="externo/atualizar_loja.php" method="POST" enctype="multipart/form-data">
				<div class="form-row">

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 mb-3">
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 input-group mb-3">
								<div class="img mx-auto">
									<?= $exibir ?>
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 input-group px-5 mb-3">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="titulo_imagem" aria-describedby="inputGroupFileAddon01" name="imagem">
									<label class="custom-file-label" for="inputGroupFile01">Alterar ou adicionar logo ou imagem para a loja</label>
								</div>
							</div>
						</div>
					</div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
								<label for="nome">Nome</label>
								<input class="form-control" id="nome" type="textarea" name="nome" placeholder="<?= $loja['nome_loja'] ?>" value="<?= $loja['nome_loja'] ?>">
							</div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
								<label for="sobre">Sobre</label>
								<textarea class="form-control" id="nome" type="textarea" name="sobre" placeholder="<?= $loja['sobre_loja'] ?>"><?= $loja['sobre_loja'] ?></textarea>
							</div>
						</div>
					</div>
				</div>

				<hr>

				<h3 class="text-muted mb-4">Endereço</h3>
				<div class="form-row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1"></div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 form-group">
						<label for="estado">Estado</label>
						<input class="form-control" id="estado" type="text" name="estado" placeholder="<?= $loja['estado_loja'] ?>" value="<?= $loja['estado_loja'] ?>">
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 form-group">
						<label for="cidade">Cidade</label>
						<input class="form-control" id="cidade" type="text" name="cidade" placeholder="<?= $loja['cidade_loja'] ?>" value="<?= $loja['cidade_loja'] ?>">
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 form-group">
						<label for="bairro">Bairro</label>
						<input class="form-control" id="bairro" type="text" name="bairro" placeholder="Medeiros" value="<?= $loja['bairro_loja'] ?>">
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 form-group">
						<label for="rua">Rua</label>
						<input class="form-control" id="rua" type="text" name="rua" value="<?= $loja['rua_loja'] ?>">
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 form-group">
						<label for="numero">Número</label>
						<input class="form-control" id="numero" type="number" name="numero" value="<?= $loja['numero_loja'] ?>">
					</div>
				</div>

				<hr>

				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 form-group">
						<label for="exampleFormControlSelect1">Status atual da loja</label>
						<select class="form-control" id="exampleFormControlSelect1" name="ativo">
							<option <?= $checkAtivado ?> value="1">Ativado</option>
							<option  <?= $checkDesativado ?> value="0">Desativado</option>
						</select>
					</div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2">
						<a class="btn btn-danger m-3 w-100" href="externo/apagar_loja.php?id=<?= $id ?>">Apagar</a>
					</div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-5"></div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2">
						<input type="hidden" name="id" value="<?= $id ?>">
						<input class="btn btn-primary w-100 float-right m-3" type="submit" value="Atualizar">
					</div>
				</div>

			</form>



		</main>

		<script src="../bootstrap/jquery/jquery-3.3.1.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/popper/popper.min.js"></script> <!-- Popper.js -->
		<script src="../bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
	</body>
</html>
