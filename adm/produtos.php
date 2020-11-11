<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('adm', true);

	// Código PHP da página

	if (isset($_GET['get'])) { // Se o GET é uma pesquisa

		$chave = $_GET['chave'];
		$placeholder = "placeholder='$chave'";
		$chave = '%' . $chave . '%';

		$sql = $conexao -> prepare (
			'SELECT
				id_prod,
				nome_prod,
				descricao_prod,
				preco_prod,
				caracteristicas_prod,
				promocao_prod,
				p.id_loja,
				nome_loja
			FROM
				produto p
				JOIN loja l
				ON p.id_loja = l.id_loja
			WHERE
				nome_prod LIKE :chave
				OR descricao_prod LIKE :chave
				OR preco_prod LIKE :chave
				OR caracteristicas_prod LIKE :chave
				OR promocao_prod LIKE :chave'
		);

		$sql -> bindParam(':chave', $chave);
		$sql -> execute();
		$produtos = $sql -> fetchAll();
	}
	else {

		$placeholder = "placeholder='Palavra Chave'";

		$sql = $conexao -> prepare (
			'SELECT
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
				p.id_loja = l.id_loja'
		);

		$sql -> execute();
		$produtos = $sql -> fetchAll();
	}

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="theme-color" content="#e2e6ea"> <!-- Cor do brownser -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/bootstrap-4.5.3.min.css"> <!-- CSS Bootstrap -->
		<link rel="stylesheet" href="css/estilo.css"> <!-- CSS Personalizado -->

		<title>Produtos - GuaShop Adm</title>
	</head>

	<body class="bg-light">
		<nav class="container-fluid">
			<div class="row">
				<div class="col-12">
					<h2 class="text-light bg-dark py-2 px-5 mt-1 mb-0 text-right font-weight-light rounded">Produtos</h2>
				</div>

				<div class="col-12">
					<a href="index.php">
						<button class="btn btn-info btn-sm mt-1 mb-0">
							Voltar ao início
						</button>
					</a>
					<hr class="mt-4 mb-3">
				</div>
			</div>
		</nav>

		<main class="container">
			<div class="form-row">
				<div class="col-12">
					<h2 class="text-muted font-weight-normal mt-2 mb-0">Lista de produtos cadastrados</h2>
				</div>

				<div class="col-md-4 col-lg-6"></div>

				<div class="col-md-8 col-lg-6 mb-2 mt-2">
					<form action="" method="GET">
						<div class="form-row">
							<div class="col-12">
								<label for="">Pesquisa</label>
							</div>

							<div class="col-8 col-md-6">
								<input class="form-control form-control-sm" id="chave" type="text" name="chave" <?= $placeholder ?>>
							</div>

							<div class="col-4 col-md-3">
								<input class="btn btn-info btn-sm w-100" type="submit" value="Pesquisar">
							</div>

							<div class="col-12 col-md-3 mt-2 mt-md-0">
								<a class="btn btn-outline-warning btn-sm w-100" href="produtos.php">Limpar</a>
							</div>

							<input class="btn btn-secondary" type="hidden" name="get" value="pesquisa">
						</div>
					</form>
				</div>
			</div>
		</main>

		<main class="container-lg">
			<section class="row">
				<div class="table-responsive shadow">

					<?php if (empty($produtos)): ?>

						<div class="alert text-center mx-auto shadow p-3" role="alert">
							Não encontramos nada por aqui para esta busca e filtro. o.O
							<br><a href="produtos.php" class="btn btn-light text-info mt-1">Limpar tudo</a>
						</div>
						
					<?php else: ?>
					
					<table class="table table-hover shadow border border-info ml-3 ml-lg-0 bg-white">
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
							<?php foreach ($produtos as $controle => $produto): ?>

									<tr>
										<th scope="row"><?= $produto['id_prod'] ?></th>
										<td><?= $produto['nome_prod'] ?></td>
										<td><?= $produto['descricao_prod'] ?></td>
										<td><?= $produto['caracteristicas_prod'] ?></td>
										<td><?= $produto['preco_prod'] ?></td>
										<td><?= $produto['promocao_prod'] ?></td>
										<td class="titulo">
										<a href="loja.php?id=<?= $produto['id_loja'] ?>" class="text-decoration-none">
											<p class="bg-info text-light rounded-lg text-center p-1">
												<?= $produto['nome_loja'] ?>
											</p>	
										</a>
									</td>
									</tr>

							<?php endforeach; ?>
						</tbody>
					</table>

				<?php endif; ?>
				</div>
				
			</section>
		</main>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
	</body>
</html>
