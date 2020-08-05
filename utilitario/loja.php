<?php

	include_once('conexao/conexao.php');

	$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>GuaShop - Loja</title>
		<meta charset="utf-8">
		<meta name="theme-color" content="#6b2278"> <!-- Cor do brownser -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> <!-- CSS Bootstrap -->
		<link rel="stylesheet" type="text/css" href="css/navbar.css"> <!-- CSS NavBar -->
		<link rel="stylesheet" type="text/css" href="css/fa/css/all.css"> <!-- CSS Ícones -->
		<link rel="stylesheet" type="text/css" href="css/geral.css"> <!-- CSS Personalizado -->
	</head>
	<body>

		<?php require_once('externo/navbar.php');

			$sql = "SELECT
            			*
          			FROM
          				imagem i
          				JOIN loja l	ON (i.referencia_refe = '$id')
          			WHERE
            			i.tabela_imag = 'loja'
            			AND id_loja = '$id'
            ";
			$result = $conexao -> query($sql);
			$loja = $result -> fetch();

			$sql_2 = "SELECT
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

			$sql_3 = "SELECT
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
		<main class="container">
			<div class="row">
				<div class="col-md-7">
					<img src="../imagens/<?php
						if(isset($loja['arquivo_imag'])){
							echo $loja['arquivo_imag'];
						}
					?>"style=" height: 100%; width: 100%;" class="img-fluid rounded my-2">
				</div>

				<div class="col-md-5">
					<h1 class="mt-4 ml-2 display-4">
						<?php
							if(isset($loja['nome_loja'])){
								echo $loja['nome_loja'];
							}
						?>
					</h1>

					<p class="text-truncate text-muted mx-auto" style="width: 90%;">
						<?php
							if(isset($loja['sobre_loja'])){
								echo $loja['sobre_loja'];
							}
						?>
					</p>

					<hr class="featurette-divider">

					<div class="col-md-12">
						<div class="text-truncate">
							<h4 class="d-inline-block text-secondary">Estado: </h4>
							<p class="d-inline-block text-dark"><?= $loja['estado_loja']?></p>
						</div>

						<div class="text-truncate">
							<h4 class="d-inline-block text-secondary">Cidade: </h4>
							<p class="d-inline-block text-dark"><?= $loja['cidade_loja']?></p>
						</div>

						<div class="text-truncate">
							<h4 class="d-inline-block text-secondary">Bairro: </h4>
							<p class="d-inline-block text-dark"><?= $loja['bairro_loja']?></p>
						</div>

						<div class="text-truncate">
							<h4 class="d-inline-block text-secondary">Rua: </h4>
							<p class="d-inline-block text-dark"><?= $loja['rua_loja']?></p>
						</div>

						<div class="text-truncate">
							<h4 class="d-inline-block text-secondary">Número: </h4>
							<p class="d-inline-block text-dark"><?= $loja['numero_loja']?></p>
						</div>
					</div>
				</div>

				<div class="col-md-12">
					<a href="estoque.php?id=<?= $loja['id_loja']?>" class="btn btn-outline-primary my-3 float-right">Ver Estoque</a>
				</div>
			</div>

			<hr class="featurette-divider">

				<div class="row">
					<h1 class="display-4 text-muted ml-3">Produtos</h1>
				</div>

				<div class="row">

				<?php	foreach ($produtos as $produto) {
					if ($produto['promocao_prod'] > 0) {
						$preco_final = $produto['preco_prod'] - $produto['promocao_prod'];
						$preco = $produto['preco_prod'];
					}
					else {
						$preco_final = $produto['preco_prod'];
						$preco = '';
					}
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
				<?php	} ?>
			</div>

			<hr class="featurette-divider">

			<div class="row">
				<h1 class="display-4 text-muted ml-3">Melhores Ofertas</h1>
			</div>

			<div class="row">
				<?php	foreach ($promocao as $produto) {
					if ($produto['promocao_prod'] > 0) {
						$preco_final = $produto['preco_prod'] - $produto['promocao_prod'];
						$preco = $produto['preco_prod'];
					}
					else {
						$preco_final = $produto['preco_prod'];
						$preco = '';
					}
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
				<?php	} ?>
			</div>
		</main>

		<?php  require_once('externo/footer.php')  ?>

		<script src="../bootstrap/jquery/jquery-3.3.1.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/popper/popper.min.js"></script> <!-- Popper.js -->
		<script src="../bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
		<script type="text/javascript" src="jquery/navbar.js"></script> <!-- jQuery NavBar -->
	</body>
</html>
