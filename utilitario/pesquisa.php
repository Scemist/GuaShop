<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('utilitario', false);

	// Código PHP da página

	$pesquisa = $_GET['pesquisa'];
    $chave = "%" . $_GET['pesquisa'] . "%";
	$tabela = 'produto';

    $sql = $conexao -> prepare ('SELECT
            p.nome_prod,
            p.preco_prod,
            p.promocao_prod,
            p.id_prod,
            i.arquivo_imag,
            l.nome_loja
        FROM
            produto p
            JOIN imagem i ON (i.referencia_refe = p.id_prod AND i.tabela_imag = "produto")
            JOIN loja l ON (l.id_loja = p.id_loja)
        WHERE
            p.nome_prod LIKE :chave
            OR p.descricao_prod LIKE :chave
            OR p.caracteristicas_prod LIKE :chave
    ');

    $sql -> bindParam (':chave', $chave);
    $sql -> execute ();
    $produtos = $sql -> fetchAll ();

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

		<title>Pesquisa: <?= $pesquisa ?> - GuaShop</title>
	</head>

	<body class="bg-light">

		<?php require_once('externo/navbar.php'); ?>

		<main class="container">

			<div class="row">
				<div class="col-12 col-sm-12 col-md-6 col-lg-12 col-xl-12">
					<h5 class="mt-4">Resultados encontrados para</h5>
					<h2 class="text-muted"><?= $pesquisa ?></h2>
				</div>
			</div>

			<div class="row">
				<?php
                    foreach ($produtos as $produto):

                        if ($produto['promocao_prod'] > 0):

                            $preco_final = $produto['preco_prod'] - $produto['promocao_prod'];
                            $preco = $produto['preco_prod'];

                        else:

                            $preco_final = $produto['preco_prod'];
                            $preco = '';
                        endif;
				?>
					<div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 text-center p-3">
						<a href="produto.php?produto=<?= $produto['id_prod'] ?>">
							<div class="row">
								<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-white rounded shadow-sm produto position-relative">

									<div class="imagem rounded">
										<img class="img miniatura" alt="Responsive image" src="../imagens/<?= $produto['arquivo_imag'] ?>">
									</div>

									<div class="titulo">
										<h3 class="mt-3 mb-0 text-muted"><?= $produto['nome_prod'] ?></h3>
									</div>

									<div class="d-none d-lg-block text-right">
										<h5><span class="badge botao_azul my-2"><?= $produto['nome_loja'] ?></span></h5>
									</div>

									<hr class="my-0 py-0">

									<div class="d-inline-block mt-auto align-bottom">
										<h5 class="mt-2 mb-0 text-dark">R$: <?php echo number_format($preco_final, 2, ",", "."); ?></h5>
										<h6 class="text-right text-muted font-weight-normal"><s><?= $preco ?></s></h6>
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
