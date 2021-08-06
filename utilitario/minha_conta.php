<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('utilitario', true);

	// Código PHP da página
	require_once('externo/usuario.php');
	$instacia = new usuario($conexao);
	$usuario = $instacia -> pegarUsuario();

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

		<title>Minha Conta - GuaShop</title>
	</head>

	<body class="bg-light">

		<?php require_once('externo/navbar.php') ?>

		<main class="container">

			<div class="row mb-2">

				<div class="col-12 col-md-8 mt-4 mb-4">
					<h2 class="text-muted">Minha Conta</h2>
				</div>

				<div class="col-8 col-md-3 mt-4">
					<h3 class="text-dark"><?= $usuario['nome_usua'] . ' ' . $usuario['sobrenome_usua'] ?></h3>
				</div>

				<div class="col-4 col-md-1 p-0 text-center">
					<a href="externo/sair.php">
						<button class="btn btn-warning ml-auto my-4 px-4">Sair</button>
					</a>
				</div>

				<div class="col-8 col-md-11 pt-2">
					<label for="staticEmail" class="d-inline text-muted h6"><?= $usuario['email_usua'] ?></label>
				</div>

				<div class="col-4 col-md-1 col-lg-1 col-xl-1 text-center">
					<a class="" href="configuracoes.php">
						<svg width="2em" viewBox="0 0 16 16" class="bi bi-gear-fill" fill="#250f55" xmlns="http://www.w3.org/2000/svg">
						    <path fill-rule="evenodd" d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 0 0-5.86 2.929 2.929 0 0 0 0 5.858z"/>
						</svg>
					</a>
				</div>
			</div>

			<form class="" action="externo/usuario.php" method="POST">
				<input type="hidden" name="metodo" value="atualizarUsuario">

				<hr>

				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 mt-5 mt-5">
						<h4>Dados Pessoais</h4>

						<p>
							<div class="input-group mb-3">
								<div class="input-group-prepend w-50">
									<span class="input-group-text w-100" id="basic-addon1">Nascimento</span>
								</div>

								<input type="date" class="form-control" value="<?= $usuario['nascimento_usua'] ?>" aria-describedby="basic-addon1" name="nascimento">
							</div>
						</p>

						<p>
							<div class="input-group mb-3">
								<div class="input-group-prepend w-25">
									<span class="input-group-text w-100" id="basic-addon1">Telefone</span>
								</div>

								<input type="text" class="form-control" placeholder="<?= $usuario['telefone_usua'] ?>" value="<?= $usuario['telefone_usua'] ?>" aria-describedby="basic-addon1" name="telefone">
							</div>
						</p>

						<p>
							<div class="input-group mb-3">
								<div class="input-group-prepend w-25">
									<span class="input-group-text w-100" id="basic-addon1">RG</span>
								</div>

								<input type="text" class="form-control" placeholder="<?= $usuario['rg_usua'] ?>" value="<?= $usuario['rg_usua'] ?>" aria-describedby="basic-addon1" name="rg">
							</div>
						</p>

						<p>
							<div class="input-group mb-3">
								<div class="input-group-prepend w-25">
									<span class="input-group-text w-100" id="basic-addon1">CPF</span>
								</div>

								<input type="text" class="form-control" placeholder="<?= $usuario['cpf_usua'] ?>" value="<?= $usuario['cpf_usua'] ?>" aria-describedby="basic-addon1" name="cpf">
							</div>
						</p>

					</div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 mt-5">
						<h4>Endereço</h4>

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
								<input type="text" id="localidade" class="form-control w-75" placeholder="<?= $usuario['cidade_usua'] ?>" value="<?= $usuario['cidade_usua'] ?>" aria-describedby="basic-addon1" name="cidade" readonly="readonly">
								<input type="text" id="uf" class="form-control w-25" placeholder="<?= $usuario['estado_usua'] ?>" value="<?= $usuario['estado_usua'] ?>" aria-describedby="basic-addon1" name="uf" readonly="readonly">
							</div>
						</p>

						<p>
							<div class="input-group mb-3">
								<div class="input-group-prepend w-25">
									<span class="input-group-text w-100" id="basic-addon1">Rua</span>
								</div>

								<input type="text" class="form-control" placeholder="<?= $usuario['rua_usua'] ?>" value="<?= $usuario['rua_usua'] ?>" aria-describedby="basic-addon1" name="rua">
							</div>
						</p>

						<p>
							<div class="input-group mb-3">
								<div class="input-group-prepend w-50">
									<span class="input-group-text w-100" id="basic-addon1">Número</span>
								</div>

								<input type="text" class="form-control" placeholder="<?= $usuario['numero_usua'] ?>" value="<?= $usuario['numero_usua'] ?>" aria-describedby="basic-addon1" name="numero">
							</div>
						</p>

						<p>
							<div class="input-group mb-3">
								<div class="input-group-prepend w-50">
									<span class="input-group-text w-100" id="basic-addon1">Complemento</span>
								</div>

								<input type="text" class="form-control" placeholder="<?= $usuario['complemento_usua'] ?>" value="<?= $usuario['complemento_usua'] ?>" aria-describedby="basic-addon1" name="complemento">
							</div>
						</p>
					</div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 mt-5">
						<h4>Cartões</h4>

						<?php
							$sql = $conexao -> prepare("SELECT * FROM	cartao WHERE id_usua = :usuario");
							$sql -> bindParam(':usuario', $_SESSION['id']);
							$sql -> execute();
							$cartoes = $sql -> fetchAll();


							foreach($cartoes AS $cartao):
						?>

						<p>
							<div class="input-group mb-3">
								<div class="input-group-prepend w-25">

									<span class="input-group-text w-100" id="basic-addon1">Nome</span>
								</div>

								<a href="cartao.php?editar=<?= $cartao['id_cart'] ?>" type="button" class="form-control text-left" aria-describedby="basic-addon1" name="estado">
									<?= $cartao['nome_cart'] ?>
								</a>
							</div>
						</p>

						<?php endforeach; ?>

						<p>
							<a class="texto_azul" href="cartao.php">
							<h5>
								Adicionar cartão
							</h5>
						</a>
						</p>
					</div>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<input class="btn botao_azul float-right m-3" type="submit" name="" value="Atualizar dados">
					</div>
				</div>
			</form>

		</main>

		<?php require_once('externo/footer.php') ?>

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
