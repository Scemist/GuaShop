<?php

	require_once('conexao/conexao.php'); // Conexão com banco de dados

	require_once('externo/verificar.php'); // Confere a sessão

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> <!-- CSS Bootstrap -->

		<title>GuaShop ADM - Cadastro</title>
	</head>

	<body class="bg-light">

		<?php // require_once('externo/navbar.php') ?>

		<main class="container">

			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
          <a href="index.php">
            <button class="btn btn-primary m-3">
              Início
            </button>
          </a>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 pt-2">
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
			<hr>

      <form action="externo/cadastrar_loja.php" method="POST" enctype="multipart/form-data">
        <div class="form-row">
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-row">

              <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 form-group">
                <label for="nome">Nome</label>
                <input class="form-control" id="nome" type="text" name="nome" placeholder="Nome da loja">
              </div>

              <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2"></div>

              <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 form-group">
                <label for="sobre">Sobre</label>
                <textarea class="form-control" id="sobre" type="textarea" name="sobre" placeholder="Escreva uma breve apresentação sobre a loja, será exibido para todos os clientes"></textarea>
              </div>

            </div>
          </div>

          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <hr>
            <h3 class="text-muted mb-4">Endereço</h3>

            <div class="form-row">
              <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1"></div>

              <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 form-group">
                <label for="estado">Estado</label>
                <input class="form-control" id="estado" type="text" name="estado" placeholder="São Paulo">
              </div>

              <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 form-group">
                <label for="cidade">Cidade</label>
                <input class="form-control" id="cidade" type="text" name="cidade" placeholder="Guararapes">
              </div>

              <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 form-group">
                <label for="bairro">Bairro</label>
                <input class="form-control" id="bairro" type="text" name="bairro" placeholder="Medeiros">
              </div>

              <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 form-group">
                <label for="rua">Rua</label>
                <input class="form-control" id="rua" type="text" name="rua" placeholder="Av. Badi Bacity">
              </div>

              <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 form-group">
                <label for="numero">Número</label>
                <input class="form-control" id="numero" type="number" name="numero" placeholder="1523">
              </div>
            </div>
						<hr>
          </div>

          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
            <div class="row">
              <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 form-group">
                <label for="titulo_imagem">Nome da imagem</label>
                <input class="form-control" id="titulo_imagem" type="text" name="titulo" placeholder="Título ou Tag">
              </div>

              <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 form-group"></div>

							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 input-group mb-3">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="imagem">
									<label class="custom-file-label" for="inputGroupFile01">Clique para escolher</label>
								</div>
							</div>
            </div>
          </div>

          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
            <div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 form-group">
								<label for="rua">Usuario</label>
								<input class="form-control" id="rua" type="text" name="usuario" placeholder="Usuario para login">
							</div>

							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 form-group">
								<label for="exampleFormControlSelect1">Status atual da loja</label>
								<select class="form-control" id="exampleFormControlSelect1" name="ativo">
									<option value="ativado">Ativado</option>
									<option value="desativado">Desativado</option>
								</select>
							</div>

							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 form-group">
								<label for="rua">Senha</label>
								<input class="form-control" id="rua" type="password" name="senha" placeholder="**************">
							</div>

							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 form-group">
								<label for="rua">Confirme a senha</label>
								<input class="form-control" id="rua" type="password" name="confirmacaosenha" placeholder="**************">
							</div>
          	</div>
        	</div>

	        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	          <input class="btn btn-primary float-right m-3" type="submit" value="Cadastrar">
	        </div>

				</div>
      </form>

		</main>

		<script src="../bootstrap/jquery/jquery-3.3.1.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/popper/popper.min.js"></script> <!-- Popper.js -->
		<script src="../bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
	</body>
</html>
