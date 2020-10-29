<?php

	// Conexão com banco de dados

	require_once('conexao/conexao.php');

	// Código PHP da página

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

		<title>Junte-se a nós - GuaShop</title>
	</head>

	<body class="bg-light">

		<?php require_once('externo/navbar.php') ?>

		<main class="container-fluid">

		<div class="row faixa mb-5">
			<div class="col-12">
				<h1 class="text-muted mt-4 mb-2 ml-2 px-4 d-inline-block">Junte-se a nós</h1>
				<h4 class="lead mb-5 text-light px-5">O GuaShop foi desenvolvido especialmente para você comerciante de <strong>Guararapes SP</strong></h4>
			</div>
		</div>

		<section class="container">
			<div class="row">
				<div class="col-0 col-md-1"></div>

				<div class="col-12 col-md-10">
					<h4 class="text-dark mt-4">Trabalhe com a gente, aqui seus produtos podem ter muito mais visibilidade. </h4>
					<h4>Ajudamos você a alcançar seus clientes de maneira fácil e simples.<h4>
					<h4>Venha fazer parte dessa equipe! ;)</h4>
					<hr>
				</div>
			</div>
		</section>

		<div class="row faixa mb-5 mx-2 rounded">
			<div class="col-12">
				<hr class="m-1">
			</div>
		</div>

		<section class="container">
			<div class="col-12">
				<h1 class="text-muted mt-4 mb-3 ml-2 px-0 d-inline-block">Quem pode fazer parte?</h1>
				<h4 class="paragrafo lead mb-3 text-dark px-3">Sua loja tem possibilidadae delivery? Então você tem tudo que precisa para fazer parte. ^.^</h4>
			</div>
		</section>

		<div class="row mb-5">
			<div class="col-12">
				<hr class="m-1">
			</div>
		</div>

		<section class="container">
			<div class="col-12">
				<h1 class="text-muted mt-4 mb-3 ml-2 px-0 d-inline-block">Como funciona?</h1>
				<h4 class="paragrafo lead mb-3 text-dark px-3">Ao fazer parte a loja tem acesso a sua própria página de administração onde poderá cadastrar seus produtos e promoções. Esses produtos ficam disponíveis no site para os usuários, onde podem fazer suas compras e avaliações. Ao comprarem seus produtos, o pedido é enviado junto ao pagamento para que a loja realize a entrega.</h4>
			</div>
		</section>

		<div class="row mb-5">
			<div class="col-12 col-sm-12 col-md-6 col-lg-12 col-xl-12">
				<hr class="m-1">
			</div>
		</div>

		<section class="container">
			<div class="col-12">
				<h1 class="text-muted mt-4 mb-3 ml-2 px-0 d-inline-block">Por quê se juntar?</h1>
				<h4 class="paragrafo lead mb-3 text-dark px-3">Através do nosso intermédio seu produto ganha propaganda e visibilidade.</h4>
			</div>
		</section>

		<div class="row mb-5">
			<div class="col-12 col-sm-12 col-md-6 col-lg-12 col-xl-12">
				<hr class="m-1">
			</div>
		</div>

	</main>

		<?php  require_once('externo/footer.php')  ?>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
		<script type="text/javascript" src="jquery/navbar.js"></script> <!-- jQuery NavBar -->
	</body>
</html>
