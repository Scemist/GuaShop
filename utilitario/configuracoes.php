<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('utilitario', true);

	// Código PHP da página

	if ($_SESSION['logado'] == 0):

		header('Location: login.php?msg=5');
    endif;

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

		<title>Configurações da Conta - GuaShop</title>
	</head>

	<body class="bg-light">

		<?php require_once('externo/navbar.php') ?>

		<main class="container">

            <div class="row mb-3">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 my-4">
                    <h2 class="text-muted">Configurações da Conta</h2>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <hr class="mt-4">
                        <h3 class="text-dark">Dados da Conta</h3>
                        <a class="text-secondary w-100 text-left" href="#"><h5>Alterar o nome</h5></a>
                        <a class="text-secondary w-100 text-left" href="#"><h5>Alterar o email</h5></a>
                        <a class="text-secondary w-100 text-left" href="#"><h5>Alterar a senha</h5></a>
                    <hr class="mt-4">

                    <h3 class="text-dark">Dados Pessoais</h3>
                    <a class="text-secondary w-100 text-left" href="#"><h5>Alterar dados do cartão</h5></a>

                    <hr class="mt-4">
                    <h3 class="text-dark">Procedimentos</h3>
                    <a class="text-secondary w-100 text-left" href="#"><h5>Apagar conta GuaShop</h5></a>
                </div>
            </div>
		</main>

		<?php require_once('externo/footer.php') ?>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
		<script type="text/javascript" src="jquery/navbar.js"></script> <!-- jQuery NavBar -->
	</body>
</html>
