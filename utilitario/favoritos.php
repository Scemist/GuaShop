<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('utilitario', true);

	// Código PHP da página

	if ($_SESSION['logado'] == 0):

		header('Location: login.php?msg=4');
    endif;

	$usuario = $_SESSION['id'];
	$tabela = 'produto';
	$tipo = 'favorito';

	$sql = $conexao -> prepare
	('SELECT
			*
		FROM
			salvo_produto s
			JOIN produto p ON p.id_prod = s.id_prod
			JOIN imagem i ON i.referencia_refe = p.id_prod
			JOIN loja l ON (l.id_loja = p.id_loja)
		WHERE
			s.id_usua = :usuario
			AND s.tipo_salv = :tipo
			AND i.tabela_imag = :tabela
	');
	$sql -> bindParam(':usuario', $usuario);
	$sql -> bindParam(':tipo', $tipo);
	$sql -> bindParam(':tabela', $tabela);
	$sql -> execute();
	$produtos = $sql -> fetchAll();

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

		<title>Favoritos - GuaShop</title>
	</head>

	<body class="bg-light">

		<?php require_once('externo/navbar.php') ?>

		<main class="container">

			<div class="row">
				<div class="col-12 col-sm-12 col-md-6 col-lg-12 col-xl-12">
					<h2 class="text-muted mt-4">Seus Favoritos</h2>
					<h5 class="">Aqui estão os produtos que você marcou como <strong>Favoritos</strong></h5>
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

                <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 text-center p-3 position-relative">

                    <a class="position-absolute remover" href="externo/produtos.php?func=removerFavorito&prod=<?= $produto['id_prod'] ?>">
                        <svg width="2em" viewBox="0 0 16 16" class="acoes bi bi-x-circle-fill" fill="#000" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z"/>
                        </svg>
                    </a>

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
                                    <h5><span class="badge badge-info"><?= $produto['nome_loja'] ?></span></h5>
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
