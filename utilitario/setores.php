<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('utilitario', false);

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="theme-color" content="#6b2278"> <!-- Cor do brownser -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/bootstrap-4.5.3.min.css"> <!-- CSS Bootstrap -->
		<link rel="stylesheet" type="text/css" href="css/navbar.css"> <!-- CSS NavBar -->
		<link rel="stylesheet" type="text/css" href="css/geral.css"> <!-- CSS Personalizado -->

		<title>Setores - GuaShop</title>
	</head>

	<body class="bg-light">

		<?php require_once('externo/navbar.php'); ?>

		<main class="container">
			<div class="row">

				<section class="col-12 mb-4"> <!-- FAST FOOD -->
					<hr>
					<h2 class="mt-4"><a class="text-muted" href="setor.php?id=1">Fast Food</a></h2>
					<h6 class="">Comida pronta na sua casa em alguns minutos.</h6>

			  	    <div class="row">
						<?php $setor = 1; $tamanho = 4; include('externo/setores.php') ?>
					</div>
				</section>

				<section class="col-12 col-xl-6 mb-4 pr-4"> <!-- VESTUARIO -->
					<hr>
					<h2 class="mt-4"><a class="text-muted" href="setor.php?id=4">Vestuário</a></h2>
					<h6 class="">Roupas e acessórios.</h6>

					<div class="row">
						<?php $setor = 4; $tamanho = 2; include('externo/setores.php') ?>
					</div>
				</section>

				<section class="col-12 col-xl-6 mb-4 pl-4"> <!-- FARMACIA -->
					<hr>
					<h2 class="mt-4"><a class="text-muted" href="setor.php?id=3">Farmácia</a></h2>
					<h6 class="">Então você precisa de ítens de farmácia...</h6>

					<div class="row">
						<?php $setor = 3; $tamanho = 2; include('externo/setores.php') ?>
					</div>
				</section>

				<section class="col-12 col-xl-6 mb-4 pr-4"> <!-- ALIMENTAÇÃO -->
					<hr>
					<h2 class="mt-4"><a class="text-muted" href="setor.php?id=2">Alimentação</a></a></h2>
					<h6 class="">Ohh, comida, mas nada pronto como no Fast Food.</h6>

					<div class="row">
						<?php $setor = 2; $tamanho = 2; include('externo/setores.php') ?>
					</div>
				</section>

				<section class="col-12 col-xl-6 mb-4 pl-4"> <!-- PETSHOP -->
					<hr>
					<h2 class="mt-4"><a class="text-muted" href="setor.php?id=6">PetShop</a></h2>
					<h6 class="">Qualquer coisa que possa achar para seu pet.</h6>

					<div class="row">
						<?php $setor = 6; $tamanho = 2; include('externo/setores.php') ?>
					</div>
				</section>

				<section class="col-12 col-xl-12 mb-4"> <!-- PERFUMARIA -->
					<hr>
					<h2 class="mt-4"><a class="text-muted" href="setor.php?id=5">Perfumaria</a></h2>
					<h6 class="">Humm, perfumaria e cosméticos aqui.</h6>

					<div class="row">
						<?php $setor = 5; $tamanho = 4; include('externo/setores.php') ?>
					</div>
				</section>

				<section class="col-12 col-xl-6 mb-4 pr-4"> <!-- MOVEIS -->
					<hr>
					<h2 class="mt-4"><a class="text-muted" href="setor.php?id=7">Móveis</a></h2>
					<h6 class="">Móveis para sua casa ou negócio?</h6>

					<div class="row">
						<?php $setor = 7; $tamanho = 2; include('externo/setores.php') ?>
					</div>
				</section>

				<section class="col-12 col-xl-6 mb-4 pl-4"> <!-- ELETRODOMESTICOS -->
					<hr>
					<h2 class="mt-4"><a class="text-muted" href="setor.php?id=8">Eletrodomésticos</a></h2>
					<h6 class="">A se visitar após uma tempestade.</h6>

					<div class="row">
						<?php $setor = 8; $tamanho = 2; include('externo/setores.php') ?>
					</div>
				</section>

				<section class="col-12 col-xl-12 mb-4"> <!-- DIVERSOS -->
					<hr>
					<h2 class="mt-4"><a class="text-muted" href="setor.php?id=9">Diversos</a></h2>
					<h6 class="">Será que há algum solitário produto sem setor?</h6>

					<div class="row">
						<?php $setor = 9; $tamanho = 4; include('externo/setores.php') ?>
					</div>
				</section>

			</div>
		</main>

		<?php require_once('externo/footer.php'); ?>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
		<script type="text/javascript" src="jquery/navbar.js"></script> <!-- jQuery NavBar -->
	</body>
</html>
