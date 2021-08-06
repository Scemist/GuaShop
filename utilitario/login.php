<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('utilitario', false);

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="theme-color" content="#6b2278"> <!-- Cor do brownser -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/bootstrap-4.5.3.min.css"> <!-- CSS Bootstrap -->
		<link rel="stylesheet" type="text/css" href="css/navbar.css"> <!-- CSS NavBar -->
		<link rel="stylesheet" type="text/css" href="css/geral.css"> <!-- CSS Personalizado -->

		<title>Login - GuaShop</title>

		<style media="screen">

			.login {
				background-image: linear-gradient(to right, #111d48, #541a6f);
			}

			.lado .btn {
				background-color: #541a6f;
				color: #fff;
				padding: 0.6em;
			}

		</style>
	</head>

	<body class="bg-light">

		<?php require_once('externo/navbar.php'); ?>

		<main class="container">

			<div class="row">
				<div class="col-12 col-sm-12 col-md-6 col-lg-5 col-xl-5">
					<h1 class="my-4 text-muted">Login</h1>
				</div>

				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 p-0">
                    <?php
                        if (isset($_GET['msg'])): // Se existe aviso

                            switch ($_GET['msg']):

                                case 1: // minha_conta
                                    $msg = "Faça Login ou Cadastre-se para acessar a <strong>Minha Conta</strong>";
                                break;

                                case 2: // senha ou email errado
                                    $msg = "Senha ou email <strong>errados</strong>";
                                break;

                                case 3: // carrinho
                                    $msg = "Faça Login ou Cadastre-se para acessar seu <strong>Carrinho</strong>";
                                break;

                                case 4: // favoritos
                                    $msg = "Faça Login ou Cadastre-se para acessar seus <strong>Favoritos</strong>";
                                break;
                            endswitch;

                            echo
                                "<div class='alert alert-primary alert-dismissible fade show mt-3' role='alert'>
                                        $msg
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>";
                        endif;
                    ?>
				</div>
			</div>

			<div class="row">
				<div class="col-0 col-sm-0 col-md-0 col-lg-3 col-xl-4 lado">
					<p>Faça login para usar o site, fazer comentários, compras e tudo o que tem direito.</p><br>

					<h4>Caso ainda não tenha uma conta.</h4>

					<div class="text-center">
						<a href="cadastro.php">
							<button class="btn mb-5">Cadastre-se aqui</button>
						</a>
					</div>
				</div>

				<div class="col-0 col-sm-0 col-md-0 col-lg-1 col-xl-1"></div>

				<div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-6 m-0 p-0">
					<div class="row p-0 m-0">
						<div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-12 login p-5 text-white">
							<form action="externo/logar.php" method="POST">
								<div class="form-group">
									<label for="exampleInputEmail1">Endereço de email</label>
									<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu email" name="email">
								</div>

								<div class="form-group">
									<label for="exampleInputPassword1">Senha</label>
									<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha" name="senha">
								</div>

								<button type="submit" class="btn botao_azul float-right">Enviar</button>
							</form>
						</div>
					</div>

					<div class="row mx-0">
						<div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-12	text-center mt-2 mb-5">
							<small class="text-muted">Nos preocupamos com seus dados. :D</small>
						</div>
					</div>


				</div>

			</div>

		</main>

		<?php require_once('externo/footer.php'); ?>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
		<script type="text/javascript" src="jquery/navbar.js"></script> <!-- jQuery NavBar -->
	</body>
</html>
