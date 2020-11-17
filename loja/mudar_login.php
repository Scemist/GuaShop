<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('loja', true);

	$id = $_SESSION['id'];

	$sql = "SELECT
			usuario_loja,
			senha_loja
		FROM
			loja
		WHERE
			id_loja = '$id'";

	$result = $conexao -> query($sql);
	$login = $result -> fetch();

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/bootstrap-4.5.3.min.css"> <!-- CSS Bootstrap -->

		<title>Novo Login</title>
	</head>

	<body class="bg-light">
		<main class="container">

			<header class="row">
				<div class="col-10">
					<h1 class="mt-4 display-4 d-inline-block"><?= $_SESSION['loja'] ?></h1>
					<h4 class="ml-4 text-muted d-inline-block mt-4">Editar informações de login</h4>
				</div>

				<div class="col-2 mt-5">
					<a class="btn btn-info w-100" href="index.php">Início</a>
				</div>
				
				<div class="col-12">
					<hr>
				</div>
			</header>

			<form action="externo/atualizar_login.php" method="POST">
				<div class="form-row bg-white rounded shadow-lg py-5 mt-5">
					<div class="col-1"></div>
					<div class="form-group col-5">
						<label class="col-form-label" for="usuario">Usuário</label>
						<input type="text" class="form-control" placeholder="Insira um nome de usuário" id="usuario" name="usuario" value="<?php if(isset($login['usuario_loja'])) echo $login['usuario_loja']; ?>">
					</div>

					<div class="form-group col-5">
						<label class="col-form-label" for="senha">Senha</label>
						<input type="password" class="form-control" id="senha" name="senha">
					</div>

					<div class="col-1 mt-4"></div>
					<div class="col-1 mt-4"></div>

					<div class="form-group col-5 mt-4 text-center">
						<div class="row">
							<div class="col-1 mt-4"></div>
							<div class="col-5">
								<a role="button" class="btn btn-outline-warning w-100" href="menu_de_conta.php">Cancelar</a>
							</div>
							<div class="col-5">
								<input type="submit" role="button" class="btn btn-info w-100" name="enviar" value="Mudar">
							</div>
						</div>

						<input type="hidden" name="id" value="<?php echo $id ?>">
					</div>

					<div class="form-group col-5">
						<label class="col-form-label" for="csenha">Confirmar Senha</label>
						<input type="password" class="form-control" id="csenha" name="csenha">
					</div>
				</div>
			</form>
		</main>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
	</body>
</html>
