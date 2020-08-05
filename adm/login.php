<?php

	require_once('conexao/conexao.php'); // Conexão com banco de dados

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> <!-- CSS Bootstrap -->
		<link rel="stylesheet" href="css/login.css"> <!-- CSS Personalizado -->

		<title>Guararapes Compras</title>
	</head>

	<body class="bg-light">

		<main class="container">
			<div class="row mt-5">

				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-5"></div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2"></div>

				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8 p-3 bg-secondary rounded text-white cartao"> <!-- Abre cartão -->
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
              <h1 class="p-3">GuaShop Login</h1>
              <p class="px-3">Faça login para acessar esta página</p>
            </div>
          </div>

          <form action="externo/logar.php" method="POST">
            <div class="row">
              <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1"></div>

              <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-10">
                <hr class="bg-white">

                <div class="row">
                  <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                    <label for="">Usuário</label>
                    <input class="form-control" type="text" name="usuario" value="" placeholder="Romanov">
                  </div>

                  <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                    <label for="">Senha</label>
                    <input class="form-control" type="password" name="senha" value="" placeholder="***********************************************">
                  </div>
                </div>

              </div>

            </div>

            <div class="row">
              <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <input class="btn btn-primary m-3 float-right" type="submit" value="Entrar">
              </div>
            </div>

          </form>
        </div> <!-- Fecha cartão -->

			</div>
		</main>

		<script src="../bootstrap/jquery/jquery-3.3.1.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/popper/popper.min.js"></script> <!-- Popper.js -->
		<script src="../bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
	</body>
</html>
