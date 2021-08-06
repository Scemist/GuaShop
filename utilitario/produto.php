<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('utilitario', false);

	// Código PHP da página

	$id = $_GET['produto'];
	$tabela = 'produto';

	// Informações sobre o produto

    $sql = $conexao -> prepare (
        'SELECT
            *
        FROM
            imagem i
            JOIN produto p ON (i.referencia_refe = p.id_prod)
        WHERE
            i.tabela_imag = :tabela
            AND p.id_prod = :produto'
    );
    $sql -> bindParam (':produto', $id);
    $sql -> bindParam (':tabela', $tabela);
    $sql -> execute ();
    $produto = $sql -> fetch ();

	$preco_bruto = $produto['preco_prod'] - $produto['promocao_prod'];
	$preco = number_format($preco_bruto, 2, ",", ".");

	$desconto = number_format(($produto['promocao_prod'] * 100) / $produto['preco_prod'], 2);

	// Informações sobre os setores

	$sql = $conexao -> prepare (
        'SELECT
            *
        FROM
            setor s
        WHERE
            s.id_seto LIKE :setor1
            OR s.id_seto LIKE :setor2
            OR s.id_seto LIKE :setor3
            OR s.id_seto LIKE :setor4
            OR s.id_seto LIKE :setor5
            OR s.id_seto LIKE :setor6
            OR s.id_seto LIKE :setor7
            OR s.id_seto LIKE :setor8
            OR s.id_seto LIKE :setor9');

	$setores = explode(",", $produto['id_seto']);
	$total = 0;

	while(!empty($setores[$total])):

		$sql -> bindParam(':setor' . ($total + 1), $setores[$total]);
		$total++;
    endwhile;

	if ($total < 9):

		for ($i = 1; $i <= 9; $i++):

			if (!isset($setores[$i])):

				$setores[$i] = 0;
				$sql -> bindParam(':setor' . $i, $setores[$i]);
            endif;
		endfor;
	endif;

    $sql -> execute ();
    $setores = $sql -> fetchAll();

	// Informações sobre a loja

	$tabela = 'loja';

	$sql = $conexao -> prepare (
        'SELECT
            *
        FROM
            imagem i
            JOIN loja l ON (i.referencia_refe = l.id_loja)
        WHERE
            i.tabela_imag = :tabela
            AND l.id_loja = :loja'
    );
    $sql -> bindParam(':tabela', $tabela);
    $sql -> bindParam(':loja', $produto['id_loja']);
    $sql -> execute();
    $loja = $sql -> fetch();

	// Informações sobre o usuário

	if (isset($_SESSION['id'])):

		$tipo = 'favorito';

		$sql = $conexao -> prepare (
            'SELECT
                *
            FROM
                salvo_produto s
            WHERE
                s.id_prod = :produto
                AND s.id_usua = :usuario
                AND s.tipo_salv = :tipo'
        );
        $sql -> bindParam (':produto', $id);
        $sql -> bindParam (':usuario', $_SESSION['id']);
        $sql -> bindParam (':tipo', $tipo);
        $sql -> execute ();
    	$usuario = $sql -> fetch ();

		if ($usuario > 0): // Está favoritado

			$favoritar = "
			<a class='btn botao_azul float-right' href='externo/produtos.php?prod=$id&func=removerFavorito'>
				<svg height='1.7em' viewBox='0 0 16 16' class='bi bi-heart-fill float-right ml-2' fill='#250f55'>
					<path fill-rule='evenodd' d='M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z'/>
				</svg>
				<h4 class='legenda_favorito btn hd-inline-block float-right text-white p-0 m-0'>Desfavoritar</h4>
			</a>";
        else: // Não está favoritado

			$favoritar = "
			<a class='btn botao_azul float-right' href='externo/produtos.php?prod=$id&func=adicionarFavorito'>
				<svg height='1.7em' viewBox='0 0 16 16' class='bi bi-heart-fill float-right ml-2' fill='#fff'>
					<path fill-rule='evenodd' d='M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z'/>
				</svg>
				<h4 class='legenda_favorito btn hd-inline-block float-right text-white p-0 m-0'>Favoritar</h4>
			</a>";
		endif;

	else: // Nem login tem

		$favoritar = "
		<a class='btn botao_azul float-right' href='externo/produtos.php?prod=$id&func=adicionarFavorito'>
			<svg height='1.7em' viewBox='0 0 16 16' class='bi bi-heart-fill float-right ml-2' fill='#fff'>
				<path fill-rule='evenodd' d='M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z'/>
			</svg>
			<h4 class='legenda_favorito btn hd-inline-block float-right text-white p-0 m-0'>Favoritar</h4>
		</a>";
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

		<title>Produto - GuaShop</title>

		<style media="screen">

		</style>
	</head>

	<body class="bg-light">

		<?php require_once('externo/navbar.php') ?>

		<main class="container">
			<div class="row mt-3">
				<div class="col-12 col-lg-4 p-0 m-0">
					<img class="m-0 p-0 imagem_principal" src="../imagens/<?= $produto['arquivo_imag'] ?>" width="100%;">
				</div>

				<div class="col-12 col-lg-4 informacoes">
					<h2 class="text-muted mt-3"><?= $produto['nome_prod'] ?></h2>
					<h5 class="font-weight-light text-secondary mt-5"><s>R$ <?= $produto['preco_prod'] ?></s></h5>
					<h1 class="mb-3 py-0">R$: <?= $preco ?></h1>
					<h5 class="font-weight-light texto_azul"><?= $desconto ?>% de desconto</h5>
				</div>

				<div class="col-12 col-lg-4">
					<div class="row">

						<div class="col-12 col-lg-12">
							<hr>
							<div class="row">
								<div class="col-5 my-2">
									<a class="btn botao_azul" href="externo/produtos.php?func=adicionarCarrinho&prod=<?= $produto['id_prod'] ?>">Comprar</a>
								</div>

								<div class="col-7 my-2">
									<?= $favoritar ?>
								</div>
							</div>
							<hr>
						</div>

						<div class="col-12">
							<div class="row">
							<?php
                                foreach ($setores as $setor):

                                    $id_setor = $setor['id_seto'];
                                    $nome_setor = $setor['nome_seto'];

                                    echo
                                        "<div class='col-6 mt-0'>
											<a href='setor.php?id=$id_setor'>
												<svg width='1.4em' viewBox='0 0 16 16' class='bi bi-tag-fill float-right ml-2' fill='#250f55'>
													<path fill-rule='evenodd' d='M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1H2zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z'/>
												</svg>
												<p class='legenda d-inline-block float-right'><strong>$nome_setor</strong></p>
											</a>
										</div>";
								endforeach;
							?>
						    </div>
						</div>

						<div class="col-12 order-lg-first">
							<a class="" href="loja.php?id=<?= $loja['id_loja'] ?>">
								<div class="row shadow-sm bg-white loja">
									<div class="col-12">
										<p class="text-muted lead mb-0">Loja</p>
									</div>

									<div class="col-8">
										<h4 class="text-right texto_azul pt-4"><?= $loja['nome_loja'] ?></h4>
									</div>

									<div class="col-4">
										<img class="logo_loja mb-3" src="../imagens/<?= $loja['arquivo_imag'] ?>">
									</div>

								</div>
							</a>
						</div>
					</div>

				</div>
			</div>

			<div class="row mt-1">

				<div class="col-12 col-md-6 p-3">
					<hr>
					<p class="text-muted">Descrição</p>
					<p class="lead"><?= $produto['descricao_prod'] ?></p>
				</div>

				<div class="col-12 col-md-6 p-3">
					<hr>
					<p class="text-muted">Características</p>
					<p class="lead"><?= $produto['caracteristicas_prod'] ?></p>
				</div>
			</div>

		</main>

		<?php require_once('externo/footer.php') ?>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
		<script type="text/javascript" src="jquery/navbar.js"></script> <!-- jQuery NavBar -->
	</body>
</html>
