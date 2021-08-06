<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('utilitario', false);

	$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

	$res = "SELECT
				*
			FROM
				imagem AS i
			INNER JOIN
				loja AS l
				ON i.referencia_refe = l.id_loja
			WHERE
				i.tabela_imag = 'loja'";

	$result = $conexao -> query($res);
	$lojas = $result -> fetchAll();

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<title>Lojas</title>
		<meta charset="utf-8">
		<meta name="theme-color" content="#6b2278"> <!-- Cor do brownser -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/bootstrap-4.5.3.min.css"> <!-- CSS Bootstrap -->
		<link rel="stylesheet" type="text/css" href="css/navbar.css"> <!-- CSS NavBar -->
		<link rel="stylesheet" type="text/css" href="css/geral.css"> <!-- CSS Personalizado -->
	</head>

	<body class="bg-light">

		<?php require_once('externo/navbar.php'); ?>

		<main class="container">
			<div class="row">
				<div class="col-12">
					<h1 class="my-2 text-muted display-4">Lojas Cadastradas</h1>
					
					<p class="text-truncate text-muted">Lojas que fazem parte</p>
				</div>
			</div>

			<hr>

			<div class="row">
				<?php foreach ($lojas as $loja): ?>
                    <div class="col-6 col-md-4 col-xl-3 text-center p-3">
                        <a href="loja.php?id=<?= $loja['id_loja'] ?>" class="">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-white rounded p-3 shadow-sm loja">
                                    <img class="img imageem card-img-top rounded col-10 px-0" src="../imagens/<?= $loja['arquivo_imag'] ?>">
                                    <hr>

                                    <div class="col-md-12">
                                        <h3 class="mt-3 mb-0 text-muted text-truncate"><?= $loja['nome_loja'] ?></h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
               <?php endforeach; ?>
			</div>
		</main>

		<?php require_once('externo/footer.php') ?>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
		<script type="text/javascript" src="jquery/navbar.js"></script> <!-- jQuery NavBar -->
	</body>
</html>
