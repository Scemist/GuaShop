<?php

	include_once('conexao/conexao.php');

	$total = $_POST['total'];

	for ($controle = 0; $controle <= $total; $controle++) {

		${'produto_' . $controle} = $_POST["produto_$controle"];
		${'produto_quantidade_' . $controle} = $_POST["produto_quantidade_$controle"];
	}

	// Pega os cartoes cadastrados
	$sql = $conexao -> prepare("SELECT * FROM cartao WHERE id_usua = :usuario");
	$sql -> bindParam(':usuario', $_SESSION['id']);
	$sql -> execute();
	$cartoes = $sql -> fetchAll();

	// Pega o enderecço do usuario
	$email = $_SESSION['email'];
	$tabela = 'usuario';

	$sql = $conexao -> prepare("SELECT * FROM usuario WHERE	email_usua = :email");
	$sql -> bindParam(':email', $email);
	$sql -> execute();
	$usuario = $sql -> fetch();

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="theme-color" content="#6b2278"> <!-- Cor do brownser -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> <!-- CSS Bootstrap -->

		<title>GuaShop - Finalizar compra</title>
	</head>

	<body class="bg-light">

		<main class="container pt-5">

			<form class="" action="externo/comprar.php" method="POST">
				<div class="form-row rounded bg-white shadow p-5">

					<div class="col-12 col-md-6 pr-5">
						<h3 class="text-muted mt-4">Forma de pagamento</h3>
						<h5 class="lead">Escolha a forma de pagamento ou selecione o cartão</h5>

						<div class="d-block pt-2 btn-group btn-group-toggle" data-toggle="buttons">
							<?php foreach ($cartoes as $cartao): ?>				
									<label class="mb-3 btn btn-info d-block w-50 rounded">
										<input type="radio" name="cartao" id="option3" autocomplete="off" value="<?= $cartao['id_cart'] ?>">
										<?= $cartao['nome_cart'] ?>
									</label>
							<?php endforeach; ?>

							<div class="d-block w-50">
								<a href="cartao.php" class="w-100 btn btn-outline-info">Adicionar cartão</a>
							</div>
						</div>

						<h3 class="text-muted mt-5">Destinatário</h3>
						<h5 class="lead">Digíte o nome de quem receberá o pedido</h5>

						<input class="form-control w-50" type="text" name="destinatario" value="<?= $usuario['nome_usua'] ?>">
					</div>

					<div class="col-12 col-md-6 pl-5">
						<h3 class="text-muted mt-4">Endereço</h3>
						<h5 class="lead">Pode editar o endereço de entrega aqui, se quiser. :)</h5>

						<p>
							<div class="input-group mb-3">
								<div class="input-group-prepend w-25">
									<span class="input-group-text w-100" id="basic-addon1">Cidade</span>
								</div>

								<input type="text" class="form-control" placeholder="<?= $usuario['cidade_usua'] ?>" value="<?= $usuario['cidade_usua'] ?>" aria-label="Email" aria-describedby="basic-addon1" name="cidade">
								<input type="text" class="form-control" placeholder="<?= $usuario['estado_usua'] ?>" value="<?= $usuario['estado_usua'] ?>" aria-label="Email" aria-describedby="basic-addon1" name="estado">
							</div>
						</p>

						<p>
							<div class="input-group mb-3">
								<div class="input-group-prepend w-25">
									<span class="input-group-text w-100" id="basic-addon1">Bairro</span>
								</div>

								<input type="text" class="form-control" placeholder="<?= $usuario['bairro_usua'] ?>" value="<?= $usuario['bairro_usua'] ?>" aria-label="Email" aria-describedby="basic-addon1" name="bairro">
							</div>
						</p>

						<p>
							<div class="input-group mb-3">
								<div class="input-group-prepend w-25">
									<span class="input-group-text w-100" id="basic-addon1">Rua</span>
								</div>

								<input type="text" class="form-control" placeholder="<?= $usuario['rua_usua'] ?>" value="<?= $usuario['rua_usua'] ?>" aria-label="Email" aria-describedby="basic-addon1" name="rua">
							</div>
						</p>

						<p>
							<div class="input-group mb-3">
								<div class="input-group-prepend w-25">
									<span class="input-group-text w-100" id="basic-addon1">Número</span>
								</div>

								<input type="text" class="form-control" placeholder="<?= $usuario['numero_usua'] ?>" value="<?= $usuario['numero_usua'] ?>" aria-label="Email" aria-describedby="basic-addon1" name="numero">
							</div>
						</p>

						<?php for ($controle = 0; $controle <= $total; $controle++):
							${'produto_' . $controle} = $_POST["produto_$controle"];
							${'produto_quantidade_' . $controle} = $_POST["produto_quantidade_$controle"];?>

							<input type="hidden" name="<?= 'produto_' . $controle ?>" value="<?= ${'produto_' . $controle} ?>">
							<input type="hidden" name="produto_quantidade_<?= $controle ?>" value="<?= ${'produto_quantidade_' . $controle} ?>">
						<?php endfor; ?>

						<input type="hidden" name="total" value="<?= $total ?>">

						<div class="row">
							<div class="col-6">
								<a href="carrinho.php" class="btn float-left btn-outline-warning w-100 mt-5">Voltar</a>
							</div>
							<div class="col-6">
								<input class="btn btn-success float-left w-100 mt-5" type="submit" name="" value="Concluir compra">
							</div>
						</div>
					</div>
				</div>
			</form>
		</main>

		<script src="../bootstrap/jquery/jquery-3.3.1.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/popper/popper.min.js"></script> <!-- Popper.js -->
		<script src="../bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
	<script type="text/javascript" src="jquery/navbar.js"></script> <!-- jQuery NavBar -->
	</body>
</html>
