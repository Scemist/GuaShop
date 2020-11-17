<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('loja', true);

	$id = $_GET['id'];

	$res = "SELECT
				*
			FROM
				produto p
			WHERE
				p.id_prod = '$id'";
	$result = $conexao -> query($res);
	$produto = $result -> fetch();

	$res = "SELECT
			*
		FROM
			imagem i
		WHERE
			i.tabela_imag = 'produto'
			AND i.referencia_refe = $id";

	$result = $conexao -> query($res);
	$imagem = $result -> fetch();

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/bootstrap-4.5.3.min.css"> <!-- CSS Bootstrap -->

		<title>Produto - GuaShop</title>
	</head>

	<body class="bg-light">
		<main class="container">
			  
			<header class="row">
				<div class="col-10">
					<h1 class="mt-4 display-4 d-inline-block"><?= $_SESSION['loja'] ?></h1>
					<h4 class="ml-4 text-muted d-inline-block mt-4">Informaçoes do produto</h4>
				</div>

				<div class="col-2 mt-5">
					<a class="btn btn-info w-100" href="index.php">Início</a>
				</div>
				
				<div class="col-12">
					<hr>
				</div>
			</header>

			<form action="externo/atualizar_produto.php" method="POST" enctype="multipart/form-data">
				<div>
					<div>
						<input type="hidden" name="id"
							value="<?php if(isset($produto['id_prod'])) echo $produto['id_prod']; ?>">
					</div>

					<div class="form-group">
						<label class="col-form-label" for="nome">Nome do Produto:</label>
						<input type="text" class="form-control" placeholder="insira o nome do produto" id="nome" name="nome" value="<?php if(isset($produto['nome_prod'])) echo $produto['nome_prod']; ?>">
					</div>

					<div class="form-row">

						<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 form-group">
							<label class="col-form-label" for="descricao">Descrição:</label>
							<textarea name="descricao" id="descricao" class="form-control" placeholder="Dê uma descrição para o produto" cols="20" rows="6"><?php if(isset($produto['descricao_prod'])) echo $produto['descricao_prod']; ?></textarea>
						</div>

						<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 form-group">
							<h4>Defina os setores</h4>
							<div class="row">

								<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 form-group">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="fastfood" value="fastfood" name="fastfood" <?php if(strpos((',' . $produto['id_seto']), '1')){	echo "checked"; } ?>>
										<label class="form-check-label" for="fastfood">Fast-food</label>
									</div>

									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="alimentacao" value="alimentacao" name="alimentacao" <?php if(strpos((',' . $produto['id_seto']), '2')){	echo "checked"; } ?>>
										<label class="form-check-label" for="alimentacao" >Alimentação</label>
									</div>

									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="farmacia" value="farmacia" name="farmacia" <?php if(strpos((',' . $produto['id_seto']), '3')){	echo "checked"; } ?>>
										<label class="form-check-label" for="farmacia" >Farmácia</label>
									</div>
								</div>

								<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 form-group">
									<div class="form-check">
									  <input class="form-check-input" type="checkbox" id="vestuario" value="vestuario" name="vestuario" <?php if(strpos((',' . $produto['id_seto']), '4')){	echo "checked"; } ?>>
										<label class="form-check-label" for="vestuario" >Vestuário</label>
									</div>

									<div class="form-check">
									  <input class="form-check-input" type="checkbox" id="perfumaria" value="perfumaria" name="perfumaria" <?php if(strpos((',' . $produto['id_seto']), '5')){	echo "checked"; } ?>>
										<label class="form-check-label" for="perfumaria">Perfumes</label>
									</div>

									<div class="form-check">
									  <input class="form-check-input" type="checkbox" id="petshop" value="petshop" name="petshop" <?php if(strpos((',' . $produto['id_seto']), '6')){	echo "checked"; } ?>>
										<label class="form-check-label" for="petshop">Petshop</label>
									</div>
								</div>

								<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 form-group">

									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="moveis" value="moveis" name="moveis" <?php if(strpos((',' . $produto['id_seto']), '7')){	echo "checked"; } ?>>
										<label class="form-check-label" for="moveis">Móveis</label>
									</div>

									<div class="form-check">
									  <input class="form-check-input" type="checkbox" id="eletrodomesticos" value="eletrodomesticos" name="eletrodomesticos" <?php if(strpos((',' . $produto['id_seto']), '8')){	echo "checked"; } ?>>
										<label class="form-check-label" for="eletrodomesticos">Eletrodoméstico</label>
									</div>

									<div class="form-check">
									  <input class="form-check-input" type="checkbox" id="diversos" value="diversos" name="diversos" <?php if(strpos((',' . $produto['id_seto']), '9')){	echo "checked"; } ?>>
										<label class="form-check-label" for="diversos">Outros</label>
									</div>
								</div>
							</div>
						</div>
					</div>


					<div class="form-row">
						<div class="form-group col-md-4">
							<label class="col-form-label" for="preco">Preço:</label>
							<input type="number" class="form-control" id="preco" placeholder="Qual será o valor" name="preco" value="<?php if(isset($produto['preco_prod'])) echo $produto['preco_prod']; ?>">
						</div>

						<div class="form-group col-md-4">
							<label class="col-form-label" for="promocao">Promoção:</label>
							<input type="number" class="form-control" id="promocao" placeholder="Desconto. Opcional" name="promocao" value="<?php if(isset($produto['promocao_prod'])) echo $produto['promocao_prod']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label class="col-form-label" for="caracteristicas">Características:</label>
						<textarea name="caracteristicas" id="caracteristicas" class="form-control" placeholder="Quais são as características do produto" cols="20" rows="6"><?php if(isset($produto['caracteristicas_prod'])) echo $produto['caracteristicas_prod']; ?>
						</textarea>
					</div>

					<div class="form-row">
					<div class="form-group col-md-6">
						<label class="col-form-label">Insira uma imagem:</label>
						<input type="file" class="form-control-file" name="imagem" onchange="previewFile()">
					</div>

					<div class="form-row">
						<div class="form-group col-md-6">
							<img src="../imagens/<?php if(isset($imagem['arquivo_imag'])) echo $imagem['arquivo_imag']; ?>" style="width: 400px;" class="img-thumbnail img-fluid">
						</div>

						<div class="form-group col-md-6" style="margin-top: 5rem;">
							<input type="hidden" name="id" value="<?= $id ?>">

							<a href="externo/deletar_produto.php?id=<?= $id ?>" class="btn btn-danger">Deletar</a>
							<a href="index.php" class="btn btn-outline-warning">Cancelar</a>
							<input type="submit" name="SendCadEdit" class="btn btn-outline-info" value="Salvar">
						</div>
					</div>
				</div>
			</form>
		</main>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
		<script>
			function previewFile() {
			 	var preview = document.querySelector('img');
			  	var file    = document.querySelector('input[type=file]').files[0];
			  	var reader  = new FileReader();

			  	reader.onloadend = function () {
			    	preview.src = reader.result;
			  	}

			  	if (file) {
			    	reader.readAsDataURL(file);
			  	}
			  	else {
			    	preview.src = "";
			  	}
			}
		</script>
	</body>
</html>
