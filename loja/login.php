<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->
		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->

		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> <!-- CSS Bootstrap -->

		<title>GuaShop - Loja</title>
	</head>
	<body class="bg-light">
		<main class="container">

			<div class="row my-5 py-4"></div>

			<form action="externo/logar.php" method="POST" enctype="multipart/form-data">
				<div class="row py-4 px-5 mt-5 bg-white mx-auto rounded shadow" style="width: 60%;">
					<div class="col-12 text-center">
						<h2 class="my-2 text-black display-4">GuaShop</h2>
						<p class="my-2">Lojas Login</p>
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
						<input role="button" type="submit" name="enviar" value="Acessar" class="btn btn-outline-primary float-right m-3" href="externo/logar.php">
					</div>
				</div>
			</form>

		</main>

		<script src="../bootstrap/jquery/jquery-3.3.1.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/popper/popper.min.js"></script> <!-- Popper.js -->
		<script src="../bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
	</body>
</html>
