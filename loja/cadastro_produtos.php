<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('loja', true);

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/bootstrap-4.5.3.min.css"> <!-- CSS Bootstrap -->

		<title>Cadastro Produtos</title>

		<style>
			
		</style>
	</head>

	<body class="bg-light">
		<main class="container">

			<header class="row">
				<div class="col-10">
					<h1 class="mt-4 display-4 d-inline-block"><?= $_SESSION['loja'] ?></h1>
					<h4 class="ml-4 text-muted d-inline-block mt-4">Cadastro de produto</h4>
				</div>

				<div class="col-2 mt-5">
					<a class="btn btn-info w-100" href="index.php">Início</a>
				</div>
				
				<div class="col-12">
					<hr>
				</div>
			</header>

			<form action="externo/salvar_produto.php" method="POST" enctype="multipart/form-data">

				<div class="form-row">
					<div class="form-group col-12">
						<label class="col-form-label" for="nome">Nome do Produto:</label>
						<input type="text" class="form-control" placeholder="insira o nome do produto" id="nome" name="nome">
					</div>

					<div class="form-group col-6">
						<label class="col-form-label" for="descricao">Descrição:</label>
						<textarea name="descricao" id="descricao" class="form-control" placeholder="Dê uma descrição para o produto" cols="20" rows="6"></textarea>
					</div>

					<div class="form-group col-6">
						<label class="col-form-label" for="caracteristicas">Características:</label>
						<textarea name="caracteristicas" id="caracteristicas" class="form-control" placeholder="Quais são as características do produto" cols="20" rows="6"></textarea>
					</div>

					<div class="col-12">
						<hr>
					</div>

					<div class="col-6 mt-4">
						<label>Escolha o setor ou setores</label>
						<div class="row pl-4 form-group">
							<div class="col-4 form-check form-check-inline px-o mx-0">
								<input class="form-check-input" type="checkbox" id="fastfood" name="fastfood">
								<label class="form-check-label my-2" for="fastfood">Fast-food</label>
							</div>

							<div class="col-4 form-check form-check-inline px-o mx-0">
								<input class="form-check-input" type="checkbox" id="alimentacao" name="alimentacao">
								<label class="form-check-label my-2" for="alimentacao" >Alimentação</label>
							</div>

							<div class="col-4 form-check form-check-inline px-o mx-0">
								<input class="form-check-input" type="checkbox" id="farmacia" name="farmacia">
								<label class="form-check-label my-2" for="farmacia" >Farmácia</label>
							</div>

							<div class="col-4 form-check form-check-inline px-o mx-0">
								<input class="form-check-input" type="checkbox" id="vestuario" name="vestuario">
								<label class="form-check-label my-2" for="vestuario" >Vestuário</label>
							</div>

							<div class="col-4 form-check form-check-inline px-o mx-0">
								<input class="form-check-input" type="checkbox" id="perfumaria" name="perfumaria">
								<label class="form-check-label my-2" for="perfumaria">Perfumes</label>
							</div>

							<div class="col-4 form-check form-check-inline px-o mx-0">
								<input class="form-check-input" type="checkbox" id="petshop" name="petshop">
								<label class="form-check-label my-2" for="petshop">Petshop</label>
							</div>

							<div class="col-4 form-check form-check-inline px-o mx-0">
								<input class="form-check-input" type="checkbox" id="eletrodomesticos" name="eletrodomesticos">
								<label class="form-check-label my-2" for="eletrodomesticos">Eletrodoméstico</label>
							</div>

							<div class="col-4 form-check form-check-inline px-o mx-0">
								<input class="form-check-input" type="checkbox" id="moveis" name="moveis">
								<label class="form-check-label my-2" for="moveis">Móveis</label>
							</div>

							<div class="col-4 form-check form-check-inline px-o mx-0">
								<input class="form-check-input" type="checkbox" id="diversos" name="diversos">
								<label class="form-check-label my-2" for="diversos">Outros</label>
							</div>
						</div>
					</div>

					<div class="form-group col-3 mt-4">
						<label class="col-form-label" for="preco">Preço:</label>
						<input type="number" class="form-control" id="preco" placeholder="Qual será o valor" name="preco">
					</div>

					<div class="form-group col-md-3 mt-4">
						<label class="col-form-label" for="promocao">Promoção:</label>
						<input type="number" class="form-control" id="promocao" placeholder="Desconto. Opcional" name="promocao">
					</div>

					<div class="col-12">
						<hr>
					</div>

					<div class="form-group col-md-4 mt-4">
						<img style="width: 300px;" class="img-thumbnail img-fluid">
					</div>

					<div class="form-group col-md-4 mt-4">
						<label class="col-form-label">Insira uma imagem:</label>
						<input type="file" class="form-control-file" name="imagem" onchange="previewFile()">
					</div>

					<div class="form-group col-md-4 mt-4" style="margin-top: 5rem;">
						<input type="submit" name="SendCadImg" class="btn btn-primary mx-2 float-right btn-lg" value="Salvar">
						<a href="index.php" class="btn btn-outline-primary btn-lg float-right">Cancelar</a>
						<input type="hidden" name="id" value="<?php echo $id ?>">
					</div>
				</div>
			</form>
		</main>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
		<script>
			function previewFile() {
				let preview = document.querySelector('img')
				let file = document.querySelector('input[type=file]').files[0]
				let reader = new FileReader()

				reader.onloadend = function () {
					preview.src = reader.result
				}

				if (file) {
					reader.readAsDataURL(file)
				} else {
					preview.src = "";
				}
			}
		</script>
	</body>
</html>
