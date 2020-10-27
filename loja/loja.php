<?php

	session_name('loja');
	session_start();
	include_once('conexao/conexao.php');

	$sql = $conexao -> prepare("SELECT
			*
		FROM
			imagem AS i
		JOIN
			loja AS l
			ON i.referencia_refe = :id
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
						<img src="../imagens/<?php if(isset($loja['arquivo_imag'])) echo $loja['arquivo_imag']; ?>" class="d-block img-thumbnail w-75 mt-4">
					</div>

					<div class="col-7">
						<label class="col-form-label" for="nome">Nome da Loja:</label>
						<input type="text" class="form-control" placeholder="insira o nome da loja" id="nome" name="nome" value="<?php if(isset($loja['nome_loja'])) echo $loja['nome_loja']; ?>" disabled>

						<label class="col-form-label mt-3" for="sobre">Sobre:</label>
						<textarea name="sobre" id="sobre" class="form-control" placeholder="Dê uma descrição para a sua loja" rows="5"><?php if(isset($loja['sobre_loja'])) echo $loja['sobre_loja']; ?></textarea>
					</div>
				</div>

				<hr class="my-4">

				<div class="row">
					<div class="col-4 form-row">
						<label class="col-form-label" for="estado">Estado:</label>
						<input type="text" class="form-control" id="estado" placeholder="O seu estado do País" name="estado" value="<?php if(isset($loja['estado_loja'])) echo $loja['estado_loja']; ?>">
					</div>
						
					<div class="col-4 form-row">
						<label class="col-form-label" for="cidade">Cidade:</label>
						<input type="text" class="form-control" id="cidade" placeholder="Diga-nos a sua localização" name="cidade" value="<?php if(isset($loja['cidade_loja'])) echo $loja['cidade_loja']; ?>">						
					</div>
					
					<div class="col-4 form-row">
						<label class="col-form-label" for="rua">Rua:</label>
						<input type="text" class="form-control" id="rua" placeholder="A rua ode se encontra a sua loja" name="rua" value="<?php if(isset($loja['rua_loja'])) echo $loja['rua_loja']; ?>">
					</div>

					<div class="col-2"></div>
					
					<div class="col-4 form-row">
						<label class="col-form-label" for="bairro">Bairro:</label>
						<input type="text" class="form-control" id="bairro" placeholder="O bairro ode se encontra a sua loja" name="bairro" value="<?php if(isset($loja['bairro_loja'])) echo $loja['bairro_loja']; ?>">
					</div>
					
					<div class="col-4 form-row">
						<label class="col-form-label" for="numero">Número:</label>
						<input type="text" class="form-control" id="numero" placeholder="O número da sua loja" name="numero" value="<?php if(isset($loja['numero_loja'])) echo $loja['numero_loja']; ?>">
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

		</script>
	</body>
</html>
