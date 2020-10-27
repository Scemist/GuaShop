<?php

	// Conexão com banco de dados

	require_once('conexao/conexao.php');

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
		<link rel="stylesheet" type="text/css" href="css/fa/css/all.css"> <!-- CSS Ícones -->
		<link rel="stylesheet" type="text/css" href="css/geral.css"> <!-- CSS Personalizado -->

		<title>Cadastro - GuaShop</title>
	</head>

	<body class="bg-light">

			<?php require_once('externo/navbar.php'); ?>

		<main class="container">

			<div class="row">
				<div class="col-12 col-sm-12 col-md-6 col-lg-5 col-xl-5">
					<h1 class="my-4 text-muted">Cadastro</h1>
				</div>

				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 p-0">
						<?php
							if (isset($_GET['msg'])) { // Se existe aviso
								if ($_GET['msg'] == 1) { // Se o aviso for para fazer login
									echo
									"
										<div class='alert alert-primary alert-dismissible fade show mt-3' role='alert'>
											Faça Login ou Cadastre-se para acessar a <strong>Minha Conta</strong>
											<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
												<span aria-hidden='true'>&times;</span>
											</button>
										</div>
									";
								}
							}
						?>
				</div>
			</div>

			<form action="externo/cadastrar.php" method="POST">
				<div class="form-row">

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-5">
						<p>
							Cadastre-se para poder acessar tudo o que esse site tem de melhor, fazer compras, comentários e perguntas.
						</p>
					</div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1"></div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 form-group">
						<label class="text-muted" for="">Primerio Nome</label>
						<input type="text" class="form-control" id="" placeholder="Cleiton" name="nome">
						<small id="emailHelp" class="form-text text-muted">Seu nome ficará disponível a qualquer um.</small>
					</div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 form-group">
						<label class="text-muted" for="">Segundo Nome</label>
						<input type="text" class="form-control" id="" placeholder="José" name="sobrenome">
					</div>
				</div>

				<div class="form-row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-5 mb-4">
						<hr>
						<h4 class="text-dark mb-0">Dados Pessoais</h4>
						<small class="text-muted">
							Opcional, mas obrigatório para compras, você também pode adicionar depois na página Minha Conta
						</small class="text-muted mb-4 ">
					</div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2"></div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 form-group">
						<label class="text-muted mt-3" for="">CPF</label>
						<input type="text" class="form-control" id="" placeholder="12345678900" name="cpf">
					</div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 form-group">
						<label class="text-muted mt-3" for="">RG</label>
						<input type="text" class="form-control" id="" placeholder="12345678" name="rg">
					</div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 form-group">
						<label class="text-muted mt-3" for="">Data de Nascimento</label>
						<input type="date" class="form-control text-muted" id="" name="nascimento">
					</div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 form-group">
						<label class="text-muted mt-3" for="">Telefone</label>
						<input type="text" class="form-control" id="" placeholder="18 99000-000" name="telefone">
					</div>
				</div>

				<div class="form-row">

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-5 mb-4">
						<hr>
						<h4 class="text-dark mb-0">Endereço</h4>
						<small class="text-muted">
							Também é necessário para compras, mas também pode ser adicionado depois. ^.^
						</small class="text-muted mb-4 ">
					</div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1"></div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 form-group">
						<label class="text-muted mt-3" for="">Estado</label>
						<input type="text" class="form-control" id="" placeholder="Acre" name="estado">
					</div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 form-group">
						<label class="text-muted mt-3" for="">Cidade</label>
						<input type="text" class="form-control" id="" placeholder="Valíria" name="cidade">
					</div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 form-group">
						<label class="text-muted mt-3" for="">Bairro</label>
						<input type="text" class="form-control" id="" placeholder="Maria Brava" name="bairro">
					</div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 form-group">
						<label class="text-muted mt-3" for="">Rua</label>
						<input type="text" class="form-control" id="" placeholder="Nove Milimetros Barbosa" name="rua">
					</div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 form-group">
						<label class="text-muted mt-3" for="">Número</label>
						<input type="text" class="form-control" id="" placeholder="1422" name="numero">
					</div>
				</div>

				<div class="form-row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-5 mb-4">
						<hr>
						<h4 class="text-dark mb-0">Para o login</h4>
						<small class="text-muted">
							Digíte seu email, e sua senha, preferencialmente diferente de outros sites.
						</small class="text-muted mb-4 ">
					</div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="form-row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3"></div>

							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 form-group">
								<label class="text-muted mt-3" for="">Email</label>
								<input type="text" class="form-control" id="" placeholder="arueiramoveis@gmail.com" name="email">
							</div>
						</div>
					</div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="form-row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">	</div>

							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 form-group">
								<label class="text-muted mt-3" for="exampleInputPassword1">Senha</label>
								<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha" name="senha">
							</div>

							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 form-group">
								<label class="text-muted mt-3" for="exampleInputPassword1">Confirme sua Senha</label>
								<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha" name="senha">
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<button type="submit" class="btn btn-primary float-right m-4">Cadastrar</button>
					</div>
				</div>

	    </form>

		</main>

		<?php  require_once('externo/footer.php')  ?>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
		<script type="text/javascript" src="jquery/navbar.js"></script> <!-- jQuery NavBar -->
	</body>
</html>
