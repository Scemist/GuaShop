<?php

	require_once('conexao/conexao.php'); // Conexão com banco de dados
	require_once('externo/verificar.php'); // Confere a sessão

	// Código PHP da página

	$selectedTodos = $selectedAtivado = $selectedDesativado = "";
	$placeholder = "placeholder='Palavra Chave'";

	if (isset($_GET['filtro'])) { // Se existe o GET (algum valor do filtro sempre é enviado)

		$chave = $_GET['chave'];
		$filtro = $_GET['filtro'];

		if (!empty($chave)) {

			$placeholder = "value='$chave' placeholder='$chave'";
		}

		function filtroRefinado ($valor, $chave) {
			
			global $conexao;
			$chave = '%' . $chave . '%';

			$sql = $conexao -> prepare (
				'SELECT
					*
				FROM
					loja
				WHERE
					ativo_loja = :valor
					AND (nome_loja LIKE :chave
					OR sobre_loja LIKE :chave
					OR cidade_loja LIKE :chave)'
			);
			$sql -> bindParam(':valor', $valor);
			$sql -> bindParam(':chave', $chave);

			return $sql;
		}

		function filtroTodos ($chave) {

			global $conexao;
			$chave = '%' . $chave . '%';

			$sql = $conexao -> prepare (
				'SELECT
					*
				FROM
					loja
				WHERE
					nome_loja LIKE :chave
					OR sobre_loja LIKE :chave
					OR cidade_loja LIKE :chave'
			);
			$sql -> bindParam(':chave', $chave);
			return $sql;
		}

		switch ($filtro) {
			case 'todos':
				$selectedTodos = 'selected';
				$sql = filtroTodos($chave);
			break;

			case 'ativado':
				$valor = 1;
				$selectedAtivado = 'selected';
				$sql = filtroRefinado($valor, $chave);
			break;

			case 'desativado':
				$valor = 0;
				$selectedDesativado = 'selected';
				$sql = filtroRefinado($valor, $chave);
			break;
			
			default:
				header ('index.php');
				exit;
			break;
		}

		if (isset($sql)) {

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
		<meta name="theme-color" content="#343a40"> <!-- Cor do brownser -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/bootstrap-4.5.3.min.css"> <!-- CSS Bootstrap -->
		<link rel="stylesheet" href="css/estilo.css">

		<style>
			table {
				min-width: 800px;
			}
		</style>

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

			<div class="row mt-3">
				<div class="col-0 col-md-3 col-xl-6"></div>
				<div class="col-12 col-sm-4 col-md-3 col-xl-2 mt-3 mt-sm-0">
					<a href="cadastro_loja.php"><button class="btn btn-info w-100">Adicionar loja</button></a>
				</div>
				<div class="col-12 col-sm-4 col-md-3 col-xl-2 mt-3 mt-sm-0">
					<a href="produtos.php"><button class="btn btn-info w-100">Produtos</button></a>
				</div>
				<div class="col-12 col-sm-4 col-md-3 col-xl-2 mt-3 mt-sm-0">
					<a href="externo/sair.php"><button class="btn btn-outline-warning w-100">Finalizar Sessão</button></a>
				</div>
			</div>

			<div class="form-row">
				<div class="col-12">
					<hr>
				</div>

				<div class="col-12 col-lg-6">
					<h2 class="text-muted my-2">Lista de lojas cadastradas</h2>
				</div>

				<div class="col-12 col-lg-6 mb-2 mt-4">
					<form action="" method="GET">
						<div class="form-row">

							<div class="col-6 col-md-5">
								<label for="">Pesquisa</label>
								<input class="form-control form-control-sm" id="chave" type="text" name="chave" <?= $placeholder ?>>
							</div>
						
							<div class="col-6 col-md-5">
								<label for="exampleFormControlSelect1">Filtros</label>
								<select class="form-control form-control-sm" id="exampleFormControlSelect1" name="filtro">
									<option value="todos" <?= $selectedTodos ?>>Todas as lojas</option>
									<option value="ativado" <?= $selectedAtivado ?>>Somente lojas ativas</option>
									<option value="desativado" <?= $selectedDesativado ?>>Somente lojas não ativas</option>
								</select>
							</div>

							<div class="col-12 col-md-2">
								<input class="btn btn-sm btn-outline-info w-100 float-right position-absolute fixed-bottom atualizar" type="submit" value="Atualizar">
							</div>

						</div>
					</form>
				</div>
			</div>

			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 my-5"></div>

			<section class="row">
				<div class="table-responsive">
					<table class="table table-hover shadow border border-info ml-3 ml-sm-0">

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
								foreach ($lojas as $controle => $loja):
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
											<small>
												<?= $loja['cidade_loja'] ?>,
												<?= $loja['estado_loja'] ?>,
												<?= $loja['cep_loja'] ?> -
												<?= $loja['rua_loja'] ?>,
												<?= $loja['numero_loja'] ?>
												<?php
													if (!empty($loja['complemento_loja'])):
														echo '(' . $loja['complemento_loja'] . ')';
													endif;
												?>
											</small>
										</td>

										<td>
											<?php
												if ($loja['ativo_loja'] == 1):
													echo "Ativado";
												else:
													echo "Desativado";
												endif;
											?>
										</td>

									</tr>

							<?php
								endforeach;
							?>

						</tbody>
					</table>
				</div>

				<?php
					if (empty($lojas)) {
						echo
							'<div class="alert alert-secondary mx-auto" role="alert">
								Não há resultados para essa busca com ess filtro. o.O
					  		</div>';
					}
				?>
			</section>

		</main>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
	</body>
</html>
