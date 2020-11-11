<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('adm', false);

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="theme-color" content="#e2e6ea"> <!-- Cor do brownser -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/bootstrap-4.5.3.min.css"> <!-- CSS Bootstrap -->
		<link rel="stylesheet" href="css/login.css"> <!-- CSS Personalizado -->

		<title>Administração GuaShop</title>
	</head>

	<body class="bg-light">

		<main class="container">
			<div class="row my-sm-5">

				<div class="d-none d-md-block col-12 mt-5"></div>
				<div class="d-none d-md-block col-12 col-lg-2"></div>

				<div class="col-12 col-lg-8 py-5 p-sm-3 bg-secondary rounded text-white cartao shadow"> <!-- Abre cartão -->
					<div class="row">
						<div class="col-12 text-center">
							<h1 class="p-3 font-weight-normal">GuaShop</h1>
							<p class="px-3 d-inline-block">Faça login para acessar esta página</p>

							<?php
								if (isset($_GET['men'])):
									echo "<p class='float-right bg-danger rounded px-3 d-inline-block p-1'>Informações de login inexistentes</p>";
								endif;
							?>
						</div>
					</div>

					<form action="externo/logar.php" method="POST">
						<div class="row">
							<div class="col-12 col-xl-1"></div>

							<div class="col-12 col-xl-10">
								<hr class="bg-white my-5 my-md-2">

								<div class="row">
									<div class="col-12 form-group">
										<label for="">Usuário</label>
										<input class="form-control text-center" type="text" name="usuario" value="">
									</div>

									<div class="col-12 form-group">
										<label for="">Senha</label>
										<input class="form-control text-center" type="password" name="senha" value="">
									</div>
								</div>
							</div>

						</div>

						<div class="row">
							<div class="col-12">
								<input class="btn btn-light m-3 float-right" type="submit" value="Entrar">
							</div>
						</div>
					</form>
				</div> <!-- Fecha cartão -->

			</div>
		</main>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
	</body>
</html>
