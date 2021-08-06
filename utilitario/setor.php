<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('utilitario', false);

	// Código PHP da página

    if (isset($_GET['id'])):

        $setor = $_GET['id'];
        $sql = $conexao -> prepare('SELECT * FROM setor WHERE id_seto = :setor');
        $sql -> bindParam(':setor', $setor);
        $sql -> execute();
        $setor = $sql -> fetch();
    else:

        header('Location: setores.php');
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

		<title><?= $setor['nome_seto'] ?> - GuaShop</title>
	</head>

	<body class="bg-light">

		<?php require_once('externo/navbar.php'); ?>

		<main class="container">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-6 col-lg-12 col-xl-12">
					<h2 class="text-muted mt-4"><?= $setor['nome_seto'] ?></h2>
					<h5 class="">Aqui estão produtos marcados com o setor <strong><?= $setor['nome_seto'] ?></strong></h5>
				</div>
			</div>

			<section class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4 pr-4">
				<hr>

				<div class="row">
					<?php $setor = $setor['id_seto']; $tamanho = 4; include('externo/setores.php') ?>
				</div>
			</section>
		</main>

		<?php require_once('externo/footer.php') ?>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
		<script type="text/javascript" src="jquery/navbar.js"></script> <!-- jQuery NavBar -->
	</body>
</html>
