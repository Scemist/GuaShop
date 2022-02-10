<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('utilitario', true);

    if ($_SESSION['logado'] == 0):

		header('Location: login.php?msg=3');
	endif;

	$usuario = $_SESSION['id'];
	$tabela = 'produto';
	$tipo = 'carrinho';

	$sql = $conexao->prepare('
		SELECT
			*
		FROM
			salvo_produto s
			JOIN produto p ON (p.id_prod = s.id_prod)
			JOIN imagem i ON (i.referencia_refe = p.id_prod)
			JOIN loja l ON (l.id_loja = p.id_loja)
		WHERE
			s.id_usua = :usuario
			AND s.tipo_salv = :tipo
			AND i.tabela_imag = :tabela
	');
	$sql->bindParam(':usuario', $usuario);
	$sql->bindParam(':tabela', $tabela);
	$sql->bindParam(':tipo', $tipo);
	$sql->execute();
	$produtos = $sql->fetchAll();

	$prod_quantidade = $sql->rowCount();

	// Ferifica se tem mensagem

	$quantidade_msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
		<strong>Atenção.</strong> A quantidade não será salva se você sair da página. u.u
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>';

	$exibir_msg = '';


	if (isset($_GET['msg'])):

		switch ($_GET['msg']):
			case 1:
				$msg =
					"<div class='alert alert-primary alert-dismissible fade show mt-3' role='alert'>
						Este ítem já estava adicionado ao seu carrinho! ^^ Pode mudar a quantidade aqui, se quiser.
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
						</button>
					</div>";
			break;

            case 2:
                $msg =
                    "<div class='alert alert-success alert-dismissible fade show mt-3' role='alert'>
                        Sua compra foi efetuada com sucesso. O pedido foi enviado para a loja, você receberá um email com o código do pedido. ^.^
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
            break;

            default:
                $msg = '';
            break;
        endswitch;
	else:

		$msg = '';
		$exibir_msg = $quantidade_msg;
    endif;

	$vazio_msgem = '<div class="alert alert-success" role="alert">
	<h4 class="alert-heading">Oii!</h4>
	<p>Seu carrinho está vazio. :/</p>
	<hr>
	<p class="mb-0">Produtos virão pra cá ao clicar em comprar. Se quiser, pode ver seus favoritos salvos. :D</p>
	</div>';

	$vazio_msg = '';

	if ($prod_quantidade == 0):

		if (isset($_GET['msg'])):

			if ($_GET['msg'] != 2):

				$vazio_msg = $vazio_msgem;
            endif;

		else:

			$vazio_msg = $vazio_msgem;
        endif;
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

		<title>Carrinho - GuaShop</title>
	</head>

	<body class="bg-light">

		<?php require_once('externo/navbar.php') ?>

		<main class="container">

			<div class="row">
				<div class="col-12">
					<h2 class="text-muted mt-4">Finalizar Pedido</h2>
					<h5 class="">Aqui estão os produtos do seu <strong>Carrinho</strong></h5>
				</div>
			</div>

			<form class="" action="finalizacao.php" method="POST">

			<div class="row">

				<div class="col-12 col-lg-6">
					<?= $msg ?>

					<?php
                        if ($prod_quantidade > 0):

                            echo $exibir_msg;
                        else:

                            echo $vazio_msg;
                        endif;
					?>

				</div>

				<div class="col-12 col-lg-6 order-lg-first">

					<?php foreach ($produtos as $controle => $produto): ?>
					<div class="row bg-white rounded py-2 shadow-sm produto_carrinho m-3">

						<div class="col-6 col-lg-3 py-4">
							<a href="produto.php?produto=<?= $produto['id_prod'] ?>" class="">
								<img class="img card-img-top rounded" style="width:100%;" src="../imagens/<?= $produto['arquivo_imag'] ?>">
								<h5><span class="badge botao_azul text-wrap my-2"><?= $produto['nome_loja'] ?></span></h5>
							</a>
						</div>

						<div class="col-6 col-lg-6">
							<div class="row">

								<div class="col-12 col-lg-12">
									<h4 class="text-muted"><?= $produto['nome_prod'] ?></h4>
									<h5 class="py-2 text-primary">R$: <?php echo number_format($produto['preco_prod'] - $produto['promocao_prod'], 2, ",", "."); ?></h5>
								</div>

								<div class="col-12 col-lg-12">
									<p class="text-muted"><?php echo substr($produto['descricao_prod'], 0, 55) ?>...</p>
								</div>

							</div>
						</div>

						<div class="col-4 col-lg-3 py-2 ml-auto mr-auto text-center">
							<input class="form-control text-center" type="number" name="produto_quantidade_<?= $controle ?>" value="1">
							<small class="text-muted">Quantidade</small>
							<input type="hidden" name="produto_<?= $controle ?>" value="<?= $produto['id_prod'] ?>">

							<a class="" href="externo/produtos.php?func=removerCarrinho&prod=<?= $produto['id_prod'] ?>">
								<div class="float-right	mt-5">
									<svg width="2em" viewBox="0 0 16 16" class="acoes_carrinho bi bi-x-circle-fill" fill="red" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z"/>
									</svg>
								</div>
							</a>
						</div>

					</div> <?php endforeach; ?>
				</div>
			</div>

			<div class="row">
				<div class="col-12 pb-4">
					<input type="hidden" name="total" value="<?= $controle ?>">

					<?php
						if ($prod_quantidade > 0):
							echo '<input class="btn botao_azul float-right m-3 mt-0" type="submit" name="" value="Finalizar compra">';
                        endif;
					 ?>

				</div>
			</div>

			</form>

		</main>

		<?php require_once('externo/footer.php') ?>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
		<script type="text/javascript" src="jquery/navbar.js"></script> <!-- jQuery NavBar -->
	</body>
</html>