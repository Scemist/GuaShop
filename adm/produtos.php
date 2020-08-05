<?php

	require_once('conexao/conexao.php'); // Conexão com banco de dados

	require_once('externo/verificar.php'); // Confere a sessão

	// Código PHP da página

	if (isset($_GET['get'])) { // Se o GET é uma pesquisa

		$chave = $_GET['chave'];
		$placeholder = "placeholder='$chave'";
		$chave = '%' . $chave . '%';

		$sql = $conexao -> prepare ('SELECT
				id_prod,
				nome_prod,
				descricao_prod,
				preco_prod,
				caracteristicas_prod,
				promocao_prod,
				p.id_loja,
				nome_loja
			FROM
				produto AS p
				INNER JOIN loja AS l
				ON p.id_loja = l.id_loja
			WHERE
				nome_prod LIKE :chave
				OR descricao_prod LIKE :chave
				OR preco_prod LIKE :chave
				OR caracteristicas_prod LIKE :chave
				OR promocao_prod LIKE :chave
		');

		$sql -> bindParam(':chave', $chave);
		$sql -> execute();
		$produtos = $sql -> fetchAll();

	}
	else {

		$placeholder = "placeholder='Palavra Chave'";

		$sql = $conexao -> prepare ('
			SELECT
				id_prod,
				nome_prod,
				descricao_prod,
				preco_prod,
				caracteristicas_prod,
				promocao_prod,
				p.id_loja,
				nome_loja
			FROM
				produto p,
				loja l
			WHERE
				p.id_loja = l.id_loja
		');

		$sql -> execute();
		$produtos = $sql -> fetchAll();
	}


?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> <!-- CSS Bootstrap -->

		<title>GuaShop ADM - Produtos</title>
	</head>

	<body class="bg-light">

		<main class="container">

			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <a href="index.php">
            <button class="btn btn-primary m-3">
              Início
            </button>
          </a>
          <hr>
				</div>
			</div>

			<div class="form-row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-7">
					<h2 class="text-muted mb-4 mt-4">Lista de produtos cadastradas</h2>
				</div>

				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 mb-3 mt-5">
					<form action="" method="GET">
						<div class="form-row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<label for="">Pesquisa</label>
							</div>

							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8">
								<input class="form-control form-control-sm" id="chave" type="text" name="chave" <?= $placeholder ?>>
							</div>

							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2">
								<input class="btn btn-secondary btn-sm" type="submit" value="Pesquisar">
							</div>

							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2">
								<a class="btn btn-warning btn-sm ml-4" href="produtos.php">Limpar</a>
							</div>

							<input class="btn btn-secondary" type="hidden" name="get" value="pesquisa">
						</div>

					</form>
				</div>

				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1"></div>
			</div>

			<section class="row">

				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Nome</th>
							<th scope="col">Descrição</th>
							<th scope="col">Caracteristicas</th>
							<th scope="col">Preço</th>
							<th scope="col">Promoção</th>
							<th scope="col">Loja</th>
						</tr>
					</thead>

					<tbody>
						<?php
							foreach ($produtos as $controle => $produto) {
						?>

								<tr>
									<th scope="row"><?= $produto['id_prod'] ?></th>
									<td><?= $produto['nome_prod'] ?></td>
									<td><?= $produto['descricao_prod'] ?></td>
									<td><?= $produto['caracteristicas_prod'] ?></td>
									<td><?= $produto['preco_prod'] ?></td>
									<td><?= $produto['promocao_prod'] ?></td>
									<td>
										<a href="loja.php?id=<?= $produto['id_loja'] ?>">
											<?= $produto['nome_loja'] ?>
										</a>
									</td>
								</tr>

						<?php
							}
						?>
					</tbody>
				</table>
			</section>

		</main>

		<script src="../bootstrap/jquery/jquery-3.3.1.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/popper/popper.min.js"></script> <!-- Popper.js -->
		<script src="../bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
	</body>
</html>
