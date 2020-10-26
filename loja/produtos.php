<?php

	session_name('loja');
	session_start();
	require('externo/checar.php');

	$sql = $conexao -> prepare(
		'SELECT
			*
		FROM
			imagem i
			JOIN produto p ON i.referencia_refe = p.id_prod
			JOIN  loja l
			ON p.id_loja = l.id_loja
		WHERE
			p.id_loja = :loja
			AND i.tabela_imag = "produto"
		ORDER BY
			p.id_prod ASC');

	$sql -> bindParam(':loja', $_SESSION['id']);
	$sql -> execute();
	$colunas_id = $sql -> fetchAll();

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->
		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->

		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> <!-- CSS Bootstrap -->
		<link rel="stylesheet" href="css/estilo.css">

		<title>GuaShop - Loja</title>
	</head>
	<body class="bg-light">
		<main class="container">

			<header class="row">
				<div class="col-10">
					<h1 class="mt-4 display-4 d-inline-block"><?= $_SESSION['loja'] ?></h1>
					<h4 class="ml-4 text-muted d-inline-block mt-4">Produtos da loja</h4>
				</div>

				<div class="col-2 mt-5">
					<a class="btn btn-info w-100" href="index.php">Início</a>
				</div>
				
				<div class="col-12">
					<hr>
				</div>
			</header>

			<div class="row mb-0">
				<div class="col-10">
					<h5 class="lead">Aqui estão os produtos cadastrados em sua loja</h5>
				</div>

				<div class="col-2 form-group">
					<a role="button" class="btn btn-success w-100" href="cadastro_produtos.php">+ Novo Produto</a>
				</div>
			</div>

			<div class="row">
				<?php foreach ($colunas_id as $coluna_id): ?>

				<div class="col-3 p-1">
					<div class="bg-white rounded shadow-sm produto p-3 position-relative">

						<div class="imagem rounded">
							<img class="img miniatura" alt="Responsive image"
								src="../imagens/<?= $coluna_id['arquivo_imag']?>">
						</div>

						<div class="titulo">
							<h5 class="text-muted px-2 py-2"><?= $coluna_id['nome_prod']?></h5>
						</div>

						<ul class="list-group lista w-100">
							<li class="list-group-item py-2 d-inline-block text-truncate">
								Preço: <?=$coluna_id['preco_prod']?>"
							</li>

							<li class="list-group-item py-2 d-inline-block text-truncate">
								Promoção: <?= $coluna_id['promocao_prod']?>
							</li>

							<a class="list-group-item list-group-item-info py-2 list-group-item-action active" href="produto.php?id=<?=$coluna_id['id_prod']?>">Editar</a>
						</ul>
					</div>
				</div>

				<?php endforeach; ?>
			</div>

		</main>

		<script src="../bootstrap/jquery/jquery-3.3.1.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/popper/popper.min.js"></script> <!-- Popper.js -->
		<script src="../bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
	</body>
</html>
