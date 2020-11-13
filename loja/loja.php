<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('loja', true);

	$sql = $conexao -> prepare(
		"SELECT
			*
		FROM
			imagem i
			JOIN loja l ON (i.referencia_refe = :id)
		WHERE
			i.tabela_imag = 'loja'
			AND id_loja = referencia_refe");

	$sql -> bindParam(':id', $_SESSION['id']);
	$sql -> execute();
	$loja = $sql -> fetch();

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->
		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->

		<link rel="stylesheet" href="../bootstrap/bootstrap-4.5.3.min.css"> <!-- CSS Bootstrap -->

		<title>Conta</title>
	</head>

	<body class="bg-light">
		<main class="container">

			<header class="row">
				<div class="col-10">
					<h1 class="mt-4 display-4 d-inline-block"><?= $_SESSION['loja'] ?></h1>
					<h4 class="ml-4 text-muted d-inline-block mt-4">Informaçoes da loja</h4>
				</div>

				<div class="col-2 mt-5">
					<a class="btn btn-info w-100" href="index.php">Início</a>
				</div>
				
				<div class="col-12">
					<hr>
				</div>
			</header>

			<form action="externo/atualizar_loja.php" method="POST" enctype="multipart/form-data">

				<div class="row">
					<div class="col-5">
						<label class="col-form-label">Insira uma Logo:</label>
						<input type="file" class="form-control-file" name="imagem" onchange="previewFile()">
						<img src="../imagens/<?= $loja['arquivo_imag'] ?>" class="d-block img-thumbnail w-75 mt-4">
					</div>

					<div class="col-7">
						<label class="col-form-label" for="nome">Nome da Loja:</label>
						<input type="text" class="form-control" value="<?= $loja['nome_loja']?>" disabled>

						<label class="col-form-label mt-3" for="sobre">Sobre:</label>
						<textarea name="sobre" id="sobre" class="form-control" placeholder="<?= $loja['sobre_loja'] ?>" rows="5"><?= $loja['sobre_loja'] ?></textarea>
					</div>
				</div>

				<hr class="my-4">

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

				<hr class="my-4">

				<div class="row mb-5">
					<div class="col-6"></div>

					<div class="col-3">
						<a href="menu_de_conta.php" class="btn btn-outline-warning w-100">Cancelar</a>
					</div>

					<div class="col-3">
						<input type="submit" name="Send" class="btn btn-info w-100" value="Salvar">
						<input type="hidden" name="id" value="<?= $id ?>">
					</div>
				</div>
			</form>
		</main>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
		<script>

			function previewFile() {

				var preview = document.querySelector('img');
				var file = document.querySelector('input[type=file]').files[0];
				var reader = new FileReader();

				reader.onloadend = function () {

					preview.src = reader.result;
				}

				if (file) {

					reader.readAsDataURL(file);
				} else {

					preview.src = "";
				}
			}

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
