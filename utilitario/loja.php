<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('utilitario', false);

	$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

	$sql = 
		"SELECT
			*
		FROM
			imagem i
			JOIN loja l	ON (i.referencia_refe = '$id')
		WHERE
			i.tabela_imag = 'loja'
			AND id_loja = '$id'";

	$result = $conexao -> query($sql);
	$loja = $result -> fetch();

	$sql_2 =
		"SELECT
			*
		FROM
			imagem i
			JOIN produto p ON (i.referencia_refe = p.id_prod)
			JOIN loja l ON (l.id_loja = p.id_loja)
		WHERE
			p.id_loja = '$id'
			AND i.tabela_imag = 'produto'
		ORDER BY
			p.preco_prod ASC LIMIT 4";

	$result = $conexao -> query($sql_2);
	$produtos = $result -> fetchAll();

	$sql_3 =
		"SELECT
			*
		FROM
			imagem AS i
		JOIN
			produto p ON (i.referencia_refe = p.id_prod)
			JOIN loja l ON (l.id_loja = p.id_loja)
		WHERE
			p.id_loja = '$id'
			AND i.tabela_imag = 'produto'
			AND p.promocao_prod > 0
		ORDER BY
			p.promocao_prod DESC LIMIT 4";

	$result = $conexao->query($sql_3);
	$promocao = $result->fetchAll();

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<title>GuaShop - Loja</title>
		<meta charset="utf-8">
		<meta name="theme-color" content="#6b2278"> <!-- Cor do brownser -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/bootstrap-4.5.3.min.css"> <!-- CSS Bootstrap -->
		<link rel="stylesheet" type="text/css" href="css/navbar.css"> <!-- CSS NavBar -->
		<link rel="stylesheet" type="text/css" href="css/geral.css"> <!-- CSS Personalizado -->
	</head>

	<body class="bg-light">

		<?php include_once('externo/navbar.php'); ?>

		<main class="container">
			<div class="row">
				<div class="col-12 col-md-5">
					<img src="../imagens/<?= $loja['arquivo_imag'] ?>" class="w-100 img-thumbnail shadow-sm rounded mt-md-5">
				</div>

				<div class="col-12 col-md-7">
					<div class="row pt-3">
						<div class="col-8">
							<h1 class="display-4"><?= $loja['nome_loja'] ?></h1>
						</div>
						<div class="col-4">
							<a href="estoque.php?id=<?= $loja['id_loja']?>" class="btn btn-outline-info mt-4 float-right">Ver Estoque</a>
						</div>
					</div>

					<p class="px-3 pt-2 text-muted mx-auto"><?= $loja['sobre_loja'] ?></p>

					<hr class="my-3">

					<div class="col-12">
						<p class="text-dark lead"><strong class="font-weight-bold">Localidade: </strong><?= $loja['cidade_loja']?>, <?= $loja['estado_loja']?></p>
					
						<p class="text-dark lead"><strong class="font-weight-bold">CEP: </strong><?= $loja['cep_loja']?></p>
					
						<p class="text-dark lead"><strong class="font-weight-bold">Endereço: </strong><?= $loja['rua_loja']?>, <?= $loja['numero_loja']?>, <?= $loja['complemento_loja']?></p>
					</div>
				</div>
			</div>

			<hr>

			<div class="row">
				<h1 class="h1 font-weight-normal text-muted ml-3">Produtos</h1>
			</div>

			<div class="row">

				<?php
					foreach ($produtos as $produto):

						if ($produto['promocao_prod'] > 0):

							$preco_final = $produto['preco_prod'] - $produto['promocao_prod'];
							$preco = $produto['preco_prod'];
						else:

							$preco_final = $produto['preco_prod'];
							$preco = '';
						endif;
				?>

				<div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 text-center p-3">
					<a href="produto.php?produto=<?= $produto['id_prod'] ?>">
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-white rounded shadow-sm produto position-relative">

								<div class="imagem rounded">
									<img class="img miniatura" alt="Responsive image" src="../imagens/<?= $produto['arquivo_imag'] ?>">
								</div>

								<div class="titulo">
									<h3 class="mt-3 mb-0 text-muted"><?= $produto['nome_prod'] ?></h3>
								</div>

								<div class="d-none d-lg-block text-right">
									<h5><span class="badge botao_azul my-2"><?= $produto['nome_loja'] ?></span></h5>
								</div>

								<hr class="my-0 py-0">

								<div class="d-inline-block mt-auto align-bottom">
									<h5 class="mt-2 mb-0 text-dark">R$: <?php echo number_format($preco_final, 2, ",", "."); ?></h5>
									<h6 class="text-right text-muted font-weight-normal"><s><?= $preco ?></s></h6>
								</div>

							</div>
						</div>
					</a>
				</div>
				<?php endforeach; ?>
			</div>

			<hr>

			<div class="row">
				<h1 class="h1 font-weight-normal text-muted ml-3">Melhores Ofertas</h1>
			</div>

			<div class="row">
				<?php
					foreach ($promocao as $produto):

						if ($produto['promocao_prod'] > 0):

							$preco_final = $produto['preco_prod'] - $produto['promocao_prod'];
							$preco = $produto['preco_prod'];
						else:

							$preco_final = $produto['preco_prod'];
							$preco = '';
						endif;
				?>
				<div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 text-center p-3">
					<a href="produto.php?produto=<?= $produto['id_prod'] ?>">
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-white rounded shadow-sm produto position-relative">

								<div class="imagem rounded">
									<img class="img miniatura" alt="Responsive image" src="../imagens/<?= $produto['arquivo_imag'] ?>">
								</div>

								<div class="titulo">
									<h3 class="mt-3 mb-0 text-muted"><?= $produto['nome_prod'] ?></h3>
								</div>

								<div class="d-none d-lg-block text-right">
									<h5><span class="badge botao_azul my-2"><?= $produto['nome_loja'] ?></span></h5>
								</div>

								<hr class="my-0 py-0">

								<div class="d-inline-block mt-auto align-bottom">
									<h5 class="mt-2 mb-0 text-dark">R$: <?php echo number_format($preco_final, 2, ",", "."); ?></h5>
									<h6 class="text-right text-muted font-weight-normal"><s><?= $preco ?></s></h6>
								</div>

							</div>
						</div>
					</a>
				</div>
				<?php endforeach; ?>
			</div>
		</main>

		<?php require_once('externo/footer.php') ?>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
		<script type="text/javascript" src="jquery/navbar.js"></script> <!-- jQuery NavBar -->
	</body>
</html>
