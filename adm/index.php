<?php

	require_once('conexao/conexao.php'); // Conexão com banco de dados

	require_once('externo/verificar.php'); // Confere a sessão

	// Código PHP da página

	$selectedTodos = $selectedAtivado = $selectedDesativado = "";
	$placeholder = "placeholder='Palavra Chave'";

	if (isset($_GET['get'])) { // Se existe o GET

		if ($_GET['get'] == 'filtro') { // Se o GET é um filtro

			if ($_GET['filtro'] != 'todos') { // Se o filtro é diferente de todos

				$filtro = $_GET['filtro'];

				if ($filtro == 'ativado') {
					$valor = 1;
					$selectedAtivado = 'selected';
				}

				else if ($filtro == 'desativado') {
					$valor = 0;
					$selectedDesativado = 'selected';
				}

				$sql = $conexao -> prepare ('SELECT * FROM loja WHERE ativo_loja = :valor');
				$sql -> bindParam(':valor', $valor);
				$sql -> execute();
				$lojas = $sql -> fetchAll();
			}
			else { // O filtro é igual a todos

				$selectedTodos = 'selected';

				$sql = $conexao -> prepare ('SELECT * FROM loja');
				$sql -> execute();
				$lojas = $sql -> fetchAll();

			}

		}
		else if ($_GET['get'] == 'pesquisa') { // Se o GET é uma pesquisa

			$chave = $_GET['chave'];
			$placeholder = "placeholder='$chave'";
			$chave = '%' . $chave . '%';

			$sql = $conexao -> prepare ('SELECT *
				FROM loja
				WHERE
					nome_loja LIKE :chave
					OR sobre_loja LIKE :chave
					OR cidade_loja LIKE :chave
					OR bairro_loja LIKE :chave
					OR rua_loja LIKE :chave
					OR numero_loja LIKE :chave
				');

			$sql -> bindParam(':chave', $chave);
			$sql -> execute();
			$lojas = $sql -> fetchAll();

		}

	}
	else { // Se não tem GET

		$selectedTodos = 'selected';

		$sql = $conexao -> prepare ('SELECT * FROM loja');
		$sql -> execute();
		$lojas = $sql -> fetchAll();
	}


?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> <!-- CSS Bootstrap -->

		<title>GuaShop Administração</title>
	</head>

	<body class="bg-light">

		<main class="container">

			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<h1 class="my-2">Página de Administração</h1>
					<p class="text-muted">Lojas cadastradas no sistema GuaShop</p>
				</div>
			</div>

			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
					<a href="externo/sair.php"><button class="btn btn-warning float-right ml-3">Finalizar Sessão</button></a>
					<a href="cadastro_loja.php"><button class="btn btn-primary float-right ml-3">Adicionar loja</button></a>
					<a href="produtos.php"><button class="btn btn-primary float-right">Produtos</button></a>
				</div>
			</div>

			<div class="form-row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"><hr></div>

				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
					<h2 class="text-muted mb-4 mt-4">Lista de lojas cadastradas</h2>
				</div>

				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 mb-3 mt-5">
					<form action="" method="GET">
						<div class="form-row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<label for="">Pesquisa</label>
							</div>

							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8">
								<input class="form-control form-control-sm" id="chave" type="text" name="chave" <?= $placeholder ?>>
							</div>

							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">
								<input class="btn btn-secondary btn-sm" type="submit" value="Pesquisar">
							</div>

							<input class="btn btn-secondary" type="hidden" name="get" value="pesquisa">
						</div>
					</form>
				</div>

				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 mb-3 mt-5">
					<form action="" method="GET">
						<div class="form-row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<label for="exampleFormControlSelect1">Filtros</label>
							</div>

							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8">
								<select class="form-control form-control-sm" id="exampleFormControlSelect1" name="filtro">
									<option value="todos" <?= $selectedTodos ?>>Todas as lojas</option>
									<option value="ativado" <?= $selectedAtivado ?>>Somente lojas ativas</option>
									<option value="desativado" <?= $selectedDesativado ?>>Somente lojas não ativas</option>
								</select>
							</div>

							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">
								<input type="hidden" name="get" value="filtro">
								<input class="btn btn-sm btn-secondary" type="submit" value="Atualizar">
							</div>
						</div>
					</form>
				</div>

				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1"></div>
			</div>

			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 my-5"></div>

			<section class="row">
				<table class="table table-hover">

					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col"></th>
							<th scope="col">Nome</th>
							<th scope="col">Sobre</th>
							<th scope="col">Endereço</th>
							<th scope="col">Estado</th>
						</tr>
					</thead>

					<tbody>

						<?php
							foreach ($lojas as $controle => $loja) {
						?>

								<tr>

									<th><?= $loja['id_loja'] ?></th>
									<td>
										<a href="loja.php?id=<?= $loja['id_loja'] ?>">
											<button class="btn btn-warning btn-sm">Editar</button>
										</a>
									</td>
									<td><?= $loja['nome_loja'] ?></td>
									<td><?= $loja['sobre_loja'] ?></td>
									<td>
										<?= $loja['estado_loja'] . ','?>
										<?= $loja['cidade_loja'] . ','?>
										<?= $loja['bairro_loja'] . ','?>
										<?= $loja['rua_loja'] . ','?>
										<?= $loja['numero_loja'] ?>
									</td>

									<td>
										<?php
											if ($loja['ativo_loja'] == 1) {
												echo "Ativado";
											} else {
												echo "Desativado";
											}
										?>
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
