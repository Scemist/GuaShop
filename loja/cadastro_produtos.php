<?php

	session_name('loja');
	session_start();
	include_once('conexao/conexao.php');

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->
		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->

		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> <!-- CSS Bootstrap -->

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

		<title>Cadastro Produtos</title>
	</head>
	<body class="bg-light">
		<main class="container">
			<?php
				if (isset($_SESSION['msg'])) {
					echo $_SESSION ['msg'];
					unset($_SESSION['msg']);
				}
			?>
			<form action="externo/salvar_produto.php" method="POST" enctype="multipart/form-data">
				<h1 class="text-muted my-4">Cadastro de Produtos</h1>

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

		<script src="../bootstrap/jquery/jquery-3.3.1.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/popper/popper.min.js"></script> <!-- Popper.js -->
		<script src="../bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
	</body>
</html>
