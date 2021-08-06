<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('utilitario', true);

	$total = $_POST['total'];

	for ($controle = 0; $controle <= $total; $controle++):

		${'produto_' . $controle} = $_POST["produto_$controle"];
		${'produto_quantidade_' . $controle} = $_POST["produto_quantidade_$controle"];
    endfor;

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
		<link rel="stylesheet" href="../bootstrap/bootstrap-4.5.3.min.css"> <!-- CSS Bootstrap -->

		<title>GuaShop - Finalizar compra</title>

		<style>
			@media screen and (max-width: 991px) {
				.botao {
					width: 100%;
				}
			}

			@media screen and (min-width: 992px) {
				.botao {
					width: 50%;
				}
			}

		</style>
	</head>

	<body class="bg-light">

		<main class="container py-3 py-lg-4">

			<form class="" action="externo/comprar.php" method="POST">
				<div class="form-row rounded bg-white shadow px-3 px-sm-5 py-4">

					<div class="col-12 col-lg-6 pr-lg-5">
						<h4 class="text-muted mt-4">Forma de pagamento</h4>
						<h5 class="lead">Escolha a forma de pagamento ou selecione o cartão</h5>

						<div class="d-block pt-2 btn-group btn-group-toggle" data-toggle="buttons">
							<?php foreach ($cartoes as $cartao): ?>				
									<label class="mb-3 btn btn-info d-block w-50 rounded">
										<input type="radio" name="cartao" id="option3" autocomplete="off" value="<?= $cartao['id_cart'] ?>">
										<?= $cartao['nome_cart'] ?>
									</label>
							<?php endforeach; ?>

							<div class="d-block botao">
								<a href="cartao.php" class="w-100 btn btn-outline-info">Adicionar cartão</a>
							</div>
						</div>

						<h4 class="text-muted mt-5">Destinatário</h4>
						<h5 class="lead">Digíte o nome de quem receberá o pedido</h5>

						<input class="form-control botao" type="text" name="destinatario" value="<?= $usuario['nome_usua'] ?>">
					</div>

					<div class="col-12 col-lg-6 pl-lg-5">
						<h4 class="text-muted mt-5 mt-md-4">Endereço</h4>
						<h5 class="lead">Pode editar o endereço de entrega aqui, se quiser. :)</h5>

						<p>
							<div class="input-group mb-3">
								<div class="input-group-prepend w-25">
									<span class="input-group-text w-100" id="basic-addon1">CEP</span>
								</div>

								<input type="text" id="cep" class="form-control w-50" placeholder="<?= $usuario['cep_usua'] ?>" value="<?= $usuario['cep_usua'] ?>" aria-describedby="basic-addon1" name="cep">

								<div class="input-group-append w-25">
									<button id="adicionar" class="btn btn-outline-info w-100" type="button">Buscar</button>
								</div>
							</div>
						</p>

						<p>
							<div class="input-group mb-3">
								<input type="text" id="localidade" class="form-control w-75" placeholder="<?= $usuario['cidade_usua'] ?>" value="<?= $usuario['cidade_usua'] ?>" readonly="readonly" aria-describedby="basic-addon1" name="cidade">
								<input type="text" id="uf" class="form-control w-25" placeholder="<?= $usuario['estado_usua'] ?>" value="<?= $usuario['estado_usua'] ?>" readonly="readonly" aria-describedby="basic-addon1" name="estado">
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
								<div class="input-group-prepend w-50">
									<span class="input-group-text w-100" id="basic-addon1">Número</span>
								</div>

								<input type="text" class="form-control" placeholder="<?= $usuario['numero_usua'] ?>" value="<?= $usuario['numero_usua'] ?>" aria-label="Email" aria-describedby="basic-addon1" name="numero">
							</div>
						</p>

						<p>
							<div class="input-group mb-3">
								<div class="input-group-prepend w-50">
									<span class="input-group-text w-100" id="basic-addon1">Complemento</span>
								</div>

								<input type="text" class="form-control" placeholder="<?= $usuario['complemento_usua'] ?>" value="<?= $usuario['complemento_usua'] ?>" aria-label="Email" aria-describedby="basic-addon1" name="complemento">
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
							<div class="col-12 col-md-6">
								<a href="carrinho.php" class="btn float-left btn-outline-warning w-100 mt-5">Voltar</a>
							</div>
							<div class="col-12 col-md-6">
								<input class="btn btn-success float-left w-100 mt-2 mt-md-5" type="submit" name="" value="Concluir compra">
							</div>
						</div>
					</div>
				</div>
			</form>
		</main>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
		<script type="text/javascript" src="jquery/navbar.js"></script> <!-- jQuery NavBar -->

		<script>

			function cep() {
				
				const adicionar = window.document.querySelector('#adicionar')
				
				function pegarCep(){
					
					var resposta
					var cep = window.document.querySelector('#cep').value
					const localidade = window.document.querySelector('#localidade')
					const uf = window.document.querySelector('#uf')
					const xhr = new XMLHttpRequest()

					xhr.responseType = 'json'
					xhr.onreadystatechange = function (){

						if (xhr.readyState == 4 && xhr.status == 200) {

							resposta  = xhr.response
							localidade.value = resposta['localidade']
							uf.value = resposta['uf']
						}
					}
					xhr.open('GET', 'https://viacep.com.br/ws/' + cep + '/json/')
					xhr.send()
				}
				
				adicionar.addEventListener('click', pegarCep)
			}
			
			cep()

		</script>
	</body>
</html>
