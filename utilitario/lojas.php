<?php

	include_once('conexao/conexao.php');

	$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

	$res = "SELECT
				*
			FROM
				imagem AS i
			INNER JOIN
				loja AS l
				ON i.referencia_refe = l.id_loja
			WHERE
				i.tabela_imag = 'loja'";

	$result = $conexao -> query($res);
	$lojas = $result -> fetchAll();

?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Lojas</title>
		<meta charset="utf-8">
		<meta name="theme-color" content="#6b2278"> <!-- Cor do brownser -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> <!-- CSS Bootstrap -->
		<link rel="stylesheet" type="text/css" href="css/navbar.css"> <!-- CSS NavBar -->
		<link rel="stylesheet" type="text/css" href="css/geral.css"> <!-- CSS Personalizado -->
	</head>
	<body class="bg-light">

		<?php require_once('externo/navbar.php'); ?>

		<main class="container">
			<div class="row col-md-6">
				<h1 class="my-2 text-muted display-4">Lojas Cadastradas</h1>

				<p class="text-truncate text-muted">Lojas que fazem parte</p>
			</div>

			<hr>

			<div class="row featurette">
				<?php foreach ($lojas as $loja) { ?>
			  			<div class="col-6 text-center p-3">
							<a href="loja.php?id=<?= $loja['id_loja'] ?>" class="">
					  			<div class="row">
									<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-white rounded p-3 shadow-sm loja">
										<img class="img imageem card-img-top rounded col-10 px-0" style="width:100%;" src="../imagens/<?= $loja['arquivo_imag'] ?>">
										<hr>

										<div class="col-md-12">
											<h3 class="mt-3 mb-0 text-muted text-truncate"><?= $loja['nome_loja'] ?></h3>
										</div>
									</div>
								</div>
							</a>
						</div>
				<?php } ?>
			</div>
		</main>

		<?php  require_once('externo/footer.php')  ?>

		<script src="../bootstrap/jquery/jquery-3.3.1.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/popper/popper.min.js"></script> <!-- Popper.js -->
		<script src="../bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
		<script type="text/javascript" src="jquery/navbar.js"></script> <!-- jQuery NavBar -->
	</body>
</html>
