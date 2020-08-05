<?php

	session_start();
	include_once('conexao/conexao.php');

	$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->
		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->

		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> <!-- CSS Bootstrap -->

    <script>
    	function previewFile() {
				var preview = document.querySelector('img');
				var file = document.querySelector('input[type=file]').files[0];
				var reader = new FileReader();

				reader.onloadend = function () {
					preview.src = reader.result;
				}

				if (file) {

				reader.readAsDataURL(file);
				} else {

				preview.src = "";
				}
			}
    </script>

		<title>Conta</title>
	</head>
	<body>
		<main class="container">
			<?php
				if (isset($_SESSION['msg'])) {
	              echo $_SESSION ['msg'];
	              unset($_SESSION['msg']);
	            }

				$sql = "SELECT
	                    	*
	                  	FROM
	                  		imagem AS i
	                  	JOIN
	                   		loja AS l
	                    	ON i.referencia_refe = '$_SESSION[id]'
	                  	WHERE
	                    	i.tabela_imag = 'loja'
	                    	AND id_loja = referencia_refe
	                    ";

				$result = $conexao -> query($sql);
				$inf = $result -> fetch();
			?>
			<form action="externo/atualizar_loja.php" method="POST" enctype="multipart/form-data">
				<h1 class="my-3">Editar Conta</h1>
				<div>
					<div class="form-group">
						<label class="col-form-label" for="nome">Nome da Loja:</label>
						<input type="text" class="form-control" placeholder="insira o nome da loja" id="nome" name="nome" value="<?php
							if(isset($inf['nome_loja'])){
								echo $inf['nome_loja'];
							}
						?>" disabled>
					</div>

					<div class="form-group">
						<label class="col-form-label" for="sobre">Sobre:</label>
						<textarea name="sobre" id="sobre" class="form-control" placeholder="Dê uma descrição para a sua loja" cols="20" rows="6"><?php
							if(isset($inf['sobre_loja'])){
								echo $inf['sobre_loja'];
							}
						?></textarea>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6">
							<label class="col-form-label" for="cidade">Cidade:</label>
							<input type="text" class="form-control" id="cidade" placeholder="Diga-nos a sua localização" name="cidade" value="<?php
								if(isset($inf['cidade_loja'])){
									echo $inf['cidade_loja'];
								}
							?>">
						</div>

						<div class="form-group col-md-6">
							<label class="col-form-label" for="estado">Estado:</label>
							<input type="text" class="form-control" id="estado" placeholder="O seu estado do País" name="estado" value="<?php
								if(isset($inf['estado_loja'])){
									echo $inf['estado_loja'];
								}
							?>">
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6">
							<label class="col-form-label" for="rua">Rua:</label>
							<input type="text" class="form-control" id="rua" placeholder="A rua ode se encontra a sua loja" name="rua" value="<?php
								if(isset($inf['rua_loja'])){
									echo $inf['rua_loja'];
								}
							?>">
						</div>

						<div class="form-group col-md-4">
							<label class="col-form-label" for="bairro">Bairro:</label>
							<input type="text" class="form-control" id="bairro" placeholder="O bairro ode se encontra a sua loja" name="bairro" value="<?php
								if(isset($inf['bairro_loja'])){
									echo $inf['bairro_loja'];
								}
							?>">
						</div>

						<div class="form-group col-md-2">
							<label class="col-form-label" for="numero">Número:</label>
							<input type="text" class="form-control" id="numero" placeholder="O número da sua loja" name="numero" value="<?php
								if(isset($inf['numero_loja'])){
									echo $inf['numero_loja'];
								}
							?>">
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6">
							<label class="col-form-label">Insira uma Logo:</label>
							<input type="file" class="form-control-file" name="imagem" onchange="previewFile()">
						</div>

						<div class="form-group col-md-6">
							<label class="col-form-label">Nome da Logo:</label>
							<input type="text" placeholder="Nome da logo" class="form-control" name="titulo" value="<?php
								if(isset($inf['titulo_imag'])){
									echo $inf['titulo_imag'];
								}
						?>">
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6">
							<img src="../imagens/<?php
								if(isset($inf['arquivo_imag'])){
									echo $inf['arquivo_imag'];
								}
							?>" style="width: 400px;" class="img-thumbnail img-fluid">
						</div>

						<div class="form-group col-md-6" style="margin-top: 5rem;">
							<input type="submit" name="Send" class="btn btn-outline-primary btn-lg" value="Salvar">

							<a href="menu_de_conta.php" class="btn btn-outline-primary btn-lg" style="margin-left: 50px; ">Cancelar</a>

							<input type="hidden" name="id" value="<?= $id ?>">
						</div>
					</div>
				</div>
			</form>
		</main>

		<script src="../bootstrap/jquery/jquery-3.3.1.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/popper/popper.min.js"></script> <!-- Popper.js -->
		<script src="../bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
	</body>
</html>
