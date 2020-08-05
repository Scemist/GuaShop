<?php

	session_start();
	include_once('conexao/conexao.php');

	$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> <!-- CSS Bootstrap -->

		<title>Novo Login</title>
	</head>
	<body class="bg-light">
		<?php
			if (isset($_SESSION['msg'])) {
              echo $_SESSION ['msg'];
              unset($_SESSION['msg']);
            }

			$sql = "SELECT
                    	usuario_loja,
                    	senha_loja
                  	FROM
                  		loja
                  	WHERE
                    	id_loja = '$id'
                    ";

			$result = $conexao -> query($sql);
			$login = $result -> fetch();

		?>
		<main class="container">
			<form action="externo/atualizar_login.php" method="POST" enctype="multipart/form-data">
				<h1 class="my-5">Editar login</h1>
				<div class="form-row bg-white rounded shadow-lg py-5">
					<div class="col-1"></div>
					<div class="form-group col-5">
						<label class="col-form-label" for="usuario">Usuário</label>
						<input type="text" class="form-control" placeholder="Insira um nome de usuário" id="usuario" name="usuario" value="<?php
										if(isset($login['usuario_loja'])){
											echo $login['usuario_loja'];
										}
									?>">
					</div>

					<div class="form-group col-5">
						<label class="col-form-label" for="senha">Senha</label>
						<input type="password" class="form-control" placeholder="Insira uma senha" id="senha" name="senha" value="<?php
										if(isset($login['senha_loja'])){
											echo $login['senha_loja'];
										}
									?>">
					</div>

					<div class="col-1 mt-4"></div>
					<div class="col-1 mt-4"></div>

					<div class="form-group col-5 mt-4 text-center">
						<div class="row">
							<div class="col-1 mt-4"></div>
							<div class="col-5">
								<a role="button" class="btn btn-primary w-100" href="menu_de_conta.php">Cancelar</a>
							</div>
							<div class="col-5">
								<input type="submit" role="button" class="btn btn-outline-primary w-100" name="enviar" value="Mudar">
							</div>


						</div>
							<input type="hidden" name="id" value="<?php echo $id ?>">

					</div>

					<div class="form-group col-5">
						<label class="col-form-label" for="csenha">Confirmar Senha</label>
						<input type="password" class="form-control" placeholder="Insira uma senha" id="csenha" name="csenha" value="<?php
										if(isset($login['senha_loja'])){
											echo $login['senha_loja'];
										}
									?>">
					</div>
				</div>
			</form>
		</main>

		<script src="../bootstrap/jquery/jquery-3.3.1.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/popper/popper.min.js"></script> <!-- Popper.js -->
		<script src="../bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
	</body>
</html>
