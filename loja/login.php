<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="theme-color" content="#e2e6ea"> <!-- Cor do brownser -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/bootstrap-4.5.3.min.css"> <!-- CSS Bootstrap -->
		<link rel="stylesheet" href="css/estilo.css">

		<title>GuaShop - Loja</title>
	</head>

	<body class="bg-light">
		<main class="container-fluid">

			<div class="row">
				<div class="col-12 py-0 py-md-4 py-xl-5">

				</div>
			</div>

			<form action="externo/logar.php" method="POST" enctype="multipart/form-data">
				<div class="row py-4 px-1 px-md-5 mt-5 bg-white mx-auto rounded shadow cartao-login">

					<div class="col-12 text-center">
						<h2 class="my-2 text-black display-4">GuaShop</h2>
						<p class="my-2">Login como loja</p>
					</div>

					<div class="col-12">
						<label for="usuario">Usuário</label>
						<input type="text" class="form-control" id="usuario" name="usuario">
					</div>

					<div class="col-12">
						<label for="senha">Senha</label>
						<input type="password" class="form-control" id="senha" name="senha">
					</div>

					<div class="col-12">
						<input role="button" type="submit" name="enviar" value="Acessar" class="btn btn-outline-info float-right m-3" href="externo/logar.php">
					</div>
				</div>
			</form>

		</main>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
	</body>
</html>
