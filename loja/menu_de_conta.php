<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('loja', true);

	$sql = "SELECT
			*
		FROM
			imagem AS i
		JOIN
			loja AS l
			ON i.referencia_refe = '$_SESSION[id]'
		WHERE
			i.tabela_imag = 'loja'
			AND id_loja = referencia_refe
		";

	$result = $conexao -> query($sql);
	$inf = $result -> fetch();

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

	<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
	<link rel="stylesheet" href="../bootstrap/bootstrap-4.5.3.min.css"> <!-- CSS Bootstrap -->

	<title>Conta da Loja - GuaShop</title>
	</head>

	<body class="bg-light">
		<main class="container">

			<header class="row">
				<div class="col-9 col-md-10">
					<h1 class="mt-4 display-4 text-truncate"><?= $_SESSION['loja'] ?></h1>
					<h4 class="ml-md-4 text-muted d-inline-block mt-4">Conta da loja</h4>
				</div>

				<div class="col-3 col-md-2 mt-5 pl-0">
					<a class="btn btn-info w-100 float-right" href="index.php">Início</a>
				</div>
				
				<div class="col-12">
					<hr>
				</div>
			</header>

			<div class="row">
				<div class="col-md-12 col-lg-12 col-xl-12 mt-3">
					<div class="text-center">
						<p class="lead mb-4 text-muted">
							<?php if(isset($inf['sobre_loja'])) echo $inf['sobre_loja']; ?>
						</p>
					</div>
				</div>

				<div class="col-12 col-md-5 text-center">
					<img src="../imagens/<?php if(isset($inf['arquivo_imag'])) echo $inf['arquivo_imag']; ?>" class="shadow rounded my-2 w-75">
				</div>

				<div class="col-11 col-md-7 mx-auto my-2 px-0 px-md-5">
					<h4 for="disabledTextInput" class="text-capitalize pt-4">Usuário:</h4>
					<input type="text" class="form-control text-center" id="disabledTextInput" value="<?php if(isset($inf['usuario_loja'])) echo $inf['usuario_loja']; ?>" disabled>

					<a role="button" class="btn btn-info float-right mt-5" href="mudar_login.php?id=<?=$inf['id_loja']?>">Mudar login</a>
				</div>

				<div class="list-group col-12 px-3 mt-4">
					<ul class="list-group">
						<li class="list-group-item d-inline-block text-truncate text-muted">
							<h5>Razâo social:</h5><?= $inf['nome_loja']?>
						</li>

						<li class="list-group-item d-inline-block text-truncate text-muted">
							<h5>Sobre: </h5><?= $inf['sobre_loja']?>
						</li>

						<li class="list-group-item d-inline-block text-truncate text-muted">
							<h5>Endereço: </h5><?= $inf['cidade_loja']?>, <?= $inf['estado_loja']?>, <?= $inf['cep_loja']?> - <?= $inf['rua_loja']?>, <?= $inf['numero_loja']?> (<?= $inf['complemento_loja']?>)
						</li>
					</ul>
				</div>

				<div class="col-md-12 my-3">
					<a role="button" class="btn btn-info float-right mx-2" href="loja.php?id=<?=$inf['id_loja']?>">Editar Informações</a>
				</div>
			</div>
		</main>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
	</body>
</html>
