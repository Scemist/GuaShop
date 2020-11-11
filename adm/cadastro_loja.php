<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('adm', true);

?>

<!DOCTYPE html>

<html lang="pt-br">

	<head>
		<meta charset="utf-8">
		<meta name="theme-color" content="#e2e6ea"> <!-- Cor do brownser -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/bootstrap-4.5.3.min.css"> <!-- CSS Bootstrap -->
		<link rel="stylesheet" href="css/estilo.css"> <!-- CSS Personalizado -->

		<title>Cadastro - GuaShop Adm</title>
	</head>

	<body class="bg-light">

		<nav class="container-fluid">
			<div class="row">
				<div class="col-12">
					<h2 class="text-light bg-dark py-2 px-5 mt-1 mb-0 text-right font-weight-light rounded">Cadastro de loja</h2>
				</div>

				<div class="col-12">
					<a href="index.php">
						<button class="btn btn-info btn-sm mt-1 mb-0">
							Voltar ao início
						</button>
					</a>
					<hr class="mt-4 mb-0">
				</div>
			</div>
		</nav>

		<main class="container">
			<div class="row">
				<div class="col-7 pt-2"></div>
				<div class="col-5 pt-2">

					<?php if (isset($_GET['msg'])): ?>
						<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
							As senhas não estão iguais.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php endif; ?>

				</div>
			</div>

			<form action="externo/cadastrar_loja.php" method="POST" enctype="multipart/form-data">
				<div class="form-row">
					<div class="col-12">
						<h3 class="font-weight-normal text-muted mb-4">Apresentação</h3>
					</div>

					<div class="col-0 col-lg-1"></div>

					<div class="col-12 col-lg-5 form-group">
						<label for="nome">Nome</label>
						<input class="form-control" id="nome" type="text" name="nome" placeholder="Nome da loja">
					</div>
					
					<div class="col-12 col-lg-5 form-group">
						<label for="sobre">Sobre</label>
						<textarea class="form-control" id="sobre" type="textarea" name="sobre" placeholder="Escreva uma breve apresentação sobre a loja, será exibido para todos os clientes"></textarea>
					</div>
				</div>

				<div class="form-row">
					<div class="col-12">
						<hr>
						<h3 class="font-weight-normal text-muted mb-4">Endereço</h3>
					</div>

					<div class="col-0 col-xl-1"></div>

					<div class="col-12 col-md-5 col-xl-4">
						<label for="estado">CEP</label>
						<div class="input-group mb-3">
							<input id="cep" type="input" class="form-control w-75" name="cep" placeholder="00000 000" aria-label="Recipient's username" aria-describedby="basic-addon2">
							<div class="input-group-append w-25">
								<button id="adicionar" class="btn btn-outline-info w-100" type="button">Buscar</button>
							</div>
						</div>

						<label for="estado">Cidade e UF</label>	
						<div class="input-group mb-3">
							<input type="text" class="form-control w-75" id="localidade" type="text" name="cidade" placeholder="Preenchido com o CEP" readonly="readonly">
							<input type="text" class="form-control w-25" id="uf" type="text" name="uf" readonly="readonly">
						</div>
					</div>

					<div class="col-12 col-md-7 col-xl-6">
						<div class="form-row">
							<div class="col-12 form-group">
								<label for="rua">Rua</label>
								<input class="form-control" id="rua" type="text" name="rua" placeholder="Av. Badi Bacity">
							</div>

							<div class="col-6 form-group">
								<label for="numero">Número</label>
								<input class="form-control" id="numero" type="number" name="numero" placeholder="1524">
							</div>
				
							<div class="col-6 form-group">
								<label for="numero">Complemento</label>
								<input class="form-control" id="complemento" type="text" name="complemento" placeholder="67 ab">
							</div>
						</div>
					</div>
				</div>

				<div class="form-row">
					<div class="col-12">
						<hr>
						<h3 class="font-weight-normal text-muted mb-4">Dados de Login</h3>
					</div>

					<div class="col-0 col-xl-1"></div>

					<div class="col-12 col-md-6 col-lg-4 col-xl-3">
						<label for="titulo_imagem">Imagem ou logo para a loja</label>
						<div class="custom-file pointer">
							<input type="file" class="custom-file-input form-control-file" id="arquivoImagem" name="imagem" >
							<label class="custom-file-label" for="inputGroupFile01">Clique para escolher</label>
						</div>

						<img class="img-thumbnail mb-1 w-100">
					</div>

					<div class="d-none d-xl-block col-1"></div>

					<div class="col-12 col-md-6 col-lg-8 col-xl-6">
						<div class="form-row">
							<div class="col-12 col-lg-6 form-group">
								<label for="rua">Usuario</label>
								<input class="form-control" id="usuario" type="text" name="usuario" placeholder="Usuario para login">
							</div>

							<div class="col-12 col-lg-6 form-group">
								<label for="exampleFormControlSelect1">Status atual da loja</label>
								<select class="form-control" id="exampleFormControlSelect1" name="ativo">
									<option value="ativado">Ativado</option>
									<option value="desativado">Desativado</option>
								</select>
							</div>

							<div class="col-12 col-lg-6 form-group">
								<label for="rua">Senha</label>
								<input class="form-control" id="senha" type="password" name="senha">
							</div>

							<div class="col-12 col-lg-6 form-group">
								<label for="rua">Confirme a senha</label>
								<input class="form-control" id="senha-confirmacao" type="password" name="confirmacaosenha">
							</div>
						</div>
					</div>

					<div class="col-0 col-sm-9"></div>
					<div class="col-12 col-sm-3">
						<input class="btn btn-info w-100 my-3" type="submit" value="Cadastrar">
					</div>

				</div>
			</form>

		</main>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
		<script src="../funcoes/js/cep.js"></script> <!-- Funções de CEP -->
		<script src="../funcoes/js/imagem.js"></script> <!-- Funções de imagens -->
	</body>
</html>