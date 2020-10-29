<?php

	require_once('conexao/conexao.php'); // Conexão com banco de dados

	require_once('externo/verificar.php'); // Confere a sessão

	$id = $_GET['id'];

	// Pega as informações da loja

	$sql = $conexao -> prepare ('SELECT id_loja, nome_loja, sobre_loja, estado_loja, cidade_loja, bairro_loja, rua_loja, numero_loja, ativo_loja FROM loja WHERE id_loja = :id');
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

		$exibir = "<img src='../imagens/" . $imagem['arquivo_imag'] . " ' width='250px' class='rounded'><br>";
		$arquivoImagem = $imagem['arquivo_imag'];
		$avisoSemImagem = 1;
	}
	else { // Se não tem imagem

		$exibir = "<p>Sem imagem</p>";
		$avisoSemImagem = 0;
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

		<nav class="container">
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
									<input type="hidden" name="arquivoImagem" value="<?= $arquivoImagem ?>">
									<input type="hidden" name="avisoSemImagem" value="<?= $avisoSemImagem ?>">
								</div>
							</div>
						</div>
					</div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 form-group">
								<label for="nome">Nome</label>
								<input class="form-control" id="nome" type="textarea" name="nome" placeholder="<?= $loja['nome_loja'] ?>" value="<?= $loja['nome_loja'] ?>">
							</div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 form-group">
								<label for="sobre">Sobre</label>
								<textarea class="form-control" id="nome" type="textarea" name="sobre" placeholder="<?= $loja['sobre_loja'] ?>"><?= $loja['sobre_loja'] ?></textarea>
							</div>
						</div>
					</div>
				</div>

				<hr>

				<div class="form-row">
					<div class="col-1"></div>

					<div class="col-4">
						<label for="estado">CEP</label>
						<div class="input-group mb-3">
							<input id="cep" type="number" class="form-control" name="cep" placeholder="<?= $loja['cep_loja'] ?>" value="<?= $loja['cep_loja'] ?>">
							<div class="input-group-append">
								<button id="adicionar" class="btn btn-outline-info" type="button">Adicionar</button>
							</div>
						</div>

						<label for="estado">Cidade e UF</label>	
						<div class="input-group mb-3">
							<input type="text" class="form-control w-75" id="localidade" type="text" name="cidade" placeholder="<?= $loja['cidade_loja'] ?>" value="<?= $loja['cidade_loja'] ?>" readonly="readonly">
							<input type="text" class="form-control w-25" id="uf" type="text" name="uf" placeholder="<?= $loja['estado_loja'] ?>" value="<?= $loja['estado_loja'] ?>" readonly="readonly">
						</div>
					</div>

					<div class="col-6">
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
						<input class="btn btn-info w-100 float-right m-3" type="submit" value="Atualizar">
					</div>
				</div>

			</form>

		</main>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
		<script>
			function cep() {
				
				const adicionar = window.document.querySelector('#adicionar')
				
				function pegarCep(){
					
					var resposta
					var cep = window.document.querySelector('#cep').value
					const localidade = window.document.querySelector('#localidade')
					const uf = window.document.querySelector('#uf')
					const xhr = new XMLHttpRequest()

					xhr.responseType = 'json'
					xhr.onreadystatechange = function (){

						if (xhr.readyState == 4 && xhr.status == 200) {

							resposta  = xhr.response
							localidade.value = resposta['localidade']
							uf.value = resposta['uf']
						}
					}
					xhr.open('GET', 'https://viacep.com.br/ws/' + cep + '/json/')
					xhr.send()
				}
				
				adicionar.addEventListener('click', pegarCep)
			}
			
			cep()
			
		</script>
	</body>
</html>
