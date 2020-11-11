<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('adm', true);

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
		<meta name="theme-color" content="#e2e6ea"> <!-- Cor do brownser -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/bootstrap-4.5.3.min.css"> <!-- CSS Bootstrap -->
		<link rel="stylesheet" href="css/estilo.css"> <!-- CSS Personalizado -->

		<title>GuaShop Administração</title>
	</head>

	<body class="bg-light">
		<main class="container">

			<div class="row mt-2">
				<div class="col-md-6">
					<h1 class="my-2 font-weight-normal">Administração GuaShop</h1>
					<p class="text-muted mb-1">Lojas cadastradas no sistema</p>
				</div>

				<div class="col-md-6">	
					<div class="row">
						<div class="col-12 col-sm-6 col-md-12 col-lg-4 pl-lg-0">
							<a href="cadastro_loja.php"><button class="mt-4 btn btn-info w-100">Adicionar loja</button></a>
						</div>

						<div class="col-12 col-sm-6 col-md-12 col-lg-4 px-lg-0">
							<a href="produtos.php"><button class="mt-4 btn btn-info w-100">Produtos</button></a>
						</div>

						<div class="col-12 col-md-12 col-lg-4 pr-lg-0">
							<a href="externo/sair.php"><button class="mt-4 btn btn-outline-warning w-100">Finalizar Sessão</button></a>
						</div>
					</div>
				</div>
			</div>

			<div class="form-row">
				<div class="col-12">
					<hr>
				</div>

				<div class="col-12">
					<h2 class="text-muted my-2 font-weight-normal">Lista de lojas cadastradas</h2>
				</div>

				<div class="col-4 col-lg-6"></div>

				<div class="col-12 col-md-8 col-lg-6 mb-2 mt-3 mt-lg-0">
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
		</main>

		<main class="container-lg">
			<section class="row">
				<div class="table-responsive shadow">

					<?php if (empty($lojas)): ?>

						<div class="alert text-center mx-auto shadow p-3" role="alert">
							Não encontramos nada por aqui para esta busca e filtro. o.O
							<br><a href="index.php" class="btn btn-light text-info mt-1">Limpar tudo</a>
						</div>

					<?php else: ?>

					<table class="table table-hover shadow border border-info ml-3 ml-lg-0 bg-white">

						<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Nome</th>
								<th scope="col">Sobre</th>
								<th scope="col">Endereço</th>
								<th scope="col">Estado</th>
							</tr>
						</thead>

						<tbody>

							<?php foreach ($lojas as $controle => $loja): ?>
							<tr>

								<th><?= $loja['id_loja'] ?></th>
								<td class="titulo">
									<a href="loja.php?id=<?= $loja['id_loja'] ?>" class="text-decoration-none">
										<p class="bg-info text-light rounded-lg text-center p-1">
											<?= $loja['nome_loja'] ?>
										</p>	
									</a>
								</td>
								<td><?= $loja['sobre_loja'] ?></td>
								<td>
									<small>
										<?= $loja['cidade_loja'] ?>,
										<?= $loja['estado_loja'] ?>,
										<spam class="text-muted"><?= $loja['cep_loja'] ?></spam><br>
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
											echo "<p class='bg-danger ronded-lg text-light p-1 rounded'>Desativado</p>";
										endif;
									?>
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
