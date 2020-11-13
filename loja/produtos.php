<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('loja', true);

	$sql = $conexao -> prepare(
		'SELECT
			*
		FROM
			imagem i
			JOIN produto p ON i.referencia_refe = p.id_prod
			JOIN loja l ON p.id_loja = l.id_loja
		WHERE
			p.id_loja = :loja
			AND i.tabela_imag = "produto"
		ORDER BY
			p.id_prod ASC');

	$sql -> bindParam(':loja', $_SESSION['id']);
	$sql -> execute();
	$produtos = $sql -> fetchAll();

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->
		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->

		<link rel="stylesheet" href="../bootstrap/bootstrap-4.5.3.min.css"> <!-- CSS Bootstrap -->
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
				<?php foreach ($produtos as $produto): ?>

				<div class="col-3 p-1">
					<div class="bg-white rounded shadow-sm produto p-3 position-relative">

						<div class="imagem rounded">
							<img class="img miniatura" alt="Responsive image"
								src="../imagens/<?= $produto['arquivo_imag'] ?>">
						</div>

						<div class="titulo">
							<h5 class="text-muted px-2 py-2"><?= $produto['nome_prod'] ?></h5>
						</div>

						<ul class="list-group lista w-100">
							<li class="list-group-item py-2 d-inline-block text-truncate">
								Preço: <?= $produto['preco_prod'] ?>
							</li>

							<?php if ($produto['promocao_prod'] > 0): $promocao = $produto['preco_prod'] - $produto['promocao_prod']; ?>
							<li class="list-group-item py-2 d-inline-block text-truncate">
								Promoção: <?= $promocao ?>
							</li>
							<?php endif; ?>

							<a class="list-group-item list-group-item-info py-2 list-group-item-action active" href="produto.php?id=<?=$produto['id_prod']?>">Editar</a>
						</ul>
					</div>
				</div>

				<?php endforeach; ?>
			</div>

		</main>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
	</body>
</html>
