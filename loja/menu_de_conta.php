<?php

	session_name('loja');
	session_start();

	require('conexao/conexao.php');

	$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

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
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> <!-- CSS Bootstrap -->

	<title>GuaShop - Conta</title>
	</head>

	<body class="bg-light">

		<main class="container">
			<div class="row mx-auto" style="width: 90%;">
				<div class="col-md-12 col-lg-12 col-xl-12 mt-3">
					<div class="form-group">
						<a role="button" class="btn btn-primary my-2" href="index.php">Início</a>
					</div>

					<hr>

					<h1 class="pl-4 display-4">
						<?php
							if(isset($inf['nome_loja'])){
								echo $inf['nome_loja'];
							}
						?>
					</h1>

		<div class="text-center">
					<p class="text-truncate text-muted">
						<?php if(isset($inf['sobre_loja'])){
						echo $inf['sobre_loja'];}?>
					</p>
		</div>
				</div>

				<div class="col-12 text-center">
					<img src="../imagens/<?php
						if(isset($inf['arquivo_imag'])){
							echo $inf['arquivo_imag'];
						}
					?>" class="img-fluid rounded my-2 w-50">
				</div>

				<div class="col-md-12 mx-auto my-2 px-5">
					<h3 for="disabledTextInput" class="text-capitalize">Usuário:</h3>
					<input type="text" class="form-control text-center" id="disabledTextInput" value="<?php
							if(isset($inf['usuario_loja'])){
								echo $inf['usuario_loja'];
							}
						?>"disabled>
				</div>

				<div class="col-md-12 mx-auto my-2 px-5">
					<h3 for="disabledTextInput" class="text-capitalize">Senha:</h3>
					<input type="text" class="form-control text-center" id="disabledTextInput" value="<?php
							if(isset($inf['senha_loja'])){
								echo $inf['senha_loja'];
							}
						?>"disabled>
				</div>

				<div class="col-md-12 mx-auto">
					<a role="button" class="btn btn-primary float-right my-4" href="mudar_login.php?id=<?=$inf['id_loja']?>">Mudar login</a>
				</div>

				<div class="list-group col-md-12">
					<ul class="list-group">
						<li class="list-group-item d-inline-block text-truncate text-muted">
							<h4>Nome:</h4><?= $inf['nome_loja']?>
						</li>

						<li class="list-group-item d-inline-block text-truncate text-muted">
							<h4>Sobre: </h4><?= $inf['sobre_loja']?>
						</li>

						<li class="list-group-item d-inline-block text-truncate text-muted">
							<h4>Estado: </h4><?= $inf['estado_loja']?>
						</li>

						<li class="list-group-item d-inline-block text-truncate text-muted">
							<h4>Cidade: </h4><?= $inf['cidade_loja']?>
						</li>

						<li class="list-group-item d-inline-block text-truncate text-muted">
							<h4>Rua: </h4><?= $inf['rua_loja']?>
						</li>
					</ul>
				</div>

				<div class="col-md-12 my-3">
						<a role="button" class="btn btn-primary float-right mx-2" href="loja.php?id=<?=$inf['id_loja']?>">Editar Informações</a>

						<a role="button" class="btn btn-outline-primary float-right mx-2" href="externo/logout.php">Finalizar Sessão</a>
				</div>
			</div>
		</main>

		<script src="../bootstrap/jquery/jquery-3.3.1.min.js"></script> <!-- jQuery -->
	<script src="../bootstrap/popper/popper.min.js"></script> <!-- Popper.js -->
	<script src="../bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
	</body>
</html>
