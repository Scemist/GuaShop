<?php

	// Conexão com banco de dados

	require_once('conexao/conexao.php');

  if ($_SESSION['logado'] != 1) {
    header('Location: login.php');
    exit;
  }

	if (isset($_GET['editar'])) {

		$cartao = $_GET['editar'];
		$sql = $conexao -> prepare('SELECT * FROM cartao WHERE id_cart = :cartao AND id_usua = :usuario');
		$sql -> bindParam(':usuario', $_SESSION['id']);
		$sql -> bindParam(':cartao', $cartao);
		$sql -> execute();
		$cartao = $sql -> fetch();

	}

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="theme-color" content="#6b2278"> <!-- Cor do brownser -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> <!-- CSS Bootstrap -->
		<link rel="stylesheet" type="text/css" href="css/navbar.css"> <!-- CSS NavBar -->
		<link rel="stylesheet" type="text/css" href="css/geral.css"> <!-- CSS Personalizado -->

		<title>Adicionar cartão - GuaShop</title>
	</head>

	<body class="bg-light">

		<?php require_once('externo/navbar.php') ?>

		<main class="container">

		<?php	if (!empty($cartao['id_cart'])) {
			$codigo = $cartao['codigo_cart'];
			$numero = $cartao['numero_cart'];
			$vencimento = $cartao['vencimento_cart'];
			$nascimento = $cartao['nascimento_cart'];
			$nome = $cartao['nome_cart'];
			$botao_cadastrar = 'Atualizar';
			$editar_titulo = 'Editar cartão';
			$editar_subtitulo = 'Edite ou apague este cartão de <spam class="texto_azul">' . $cartao['nome_cart'] . '</spam>';
		} else {
			$botao_cadastrar = 'Cadastrar';
			$editar_titulo = 'Adicionar cartão';
			$editar_subtitulo = 'Adicione seu cartão para adiantar na hora da compra';
		}	?>

			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<h2 class="text-muted mt-4"><?= $editar_titulo ?></h2>
					<h5 class=""><?= $editar_subtitulo ?></h5>
				</div>
			</div>

      <div class="row">

        <div class="col-1 col-lg-2">rfsdf</div>

        <div class="col-10 col-lg-8 mb-5">
          <form class="" action="externo/cartao_ex.php" method="POST">
            <div class="form-row">

              <div class="col-12 col-md-6">
                <div class="row mt-5 input-group mx-0">
                  <div class="input-group-prepend w-50">
                    <span class="input-group-text w-100" id="basic-addon1">Código</span>
                  </div>
                  <input type="number" class="form-control" placeholder="<?php if(isset($codigo)){echo$codigo;}else{echo'000';} ?>" value="<?php if(isset($codigo)){echo$codigo;}else{echo'';} ?>" aria-label="Email" aria-describedby="basic-addon1" name="codigo">
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="row mt-5 input-group mx-0">
                  <div class="input-group-prepend w-50">
                    <span class="input-group-text w-100" id="basic-addon1">Número</span>
                  </div>
                  <input type="number" class="form-control" placeholder="<?php if(isset($numero)){echo$numero;}else{echo'000';} ?>" value="<?php if(isset($numero)){echo$numero;}else{echo'';} ?>" aria-label="Email" aria-describedby="basic-addon1" name="numero">
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="row mt-5 input-group mx-0">
                  <div class="input-group-prepend w-50">
                    <span class="input-group-text w-100" id="basic-addon1">Vencimento</span>
                  </div>
                  <input type="date" class="form-control" value="<?php if(isset($vencimento)){echo$vencimento;}else{echo'';} ?>" aria-label="Email" aria-describedby="basic-addon1" name="vencimento">
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="row mt-5 input-group mx-0">
                  <div class="input-group-prepend w-50">
                    <span class="input-group-text w-100" id="basic-addon1">Nascimento</span>
                  </div>
                  <input type="date" class="form-control" value="<?php if(isset($nascimento)){echo$nascimento;}else{echo'';} ?>" aria-label="Email" aria-describedby="basic-addon1" name="nascimento">
                </div>
              </div>

              <div class="col-12">
                <div class="row mt-5 input-group mx-0">
                  <div class="input-group-prepend w-25">
                    <span class="input-group-text w-100" id="basic-addon1">Proprietário</span>
                  </div>
                  <input type="text" class="form-control" placeholder="<?php if(isset($nome)){echo$nome;}else{echo'Cleiton J. Antônio';} ?>" value="<?php if(isset($nome)){echo$nome;}else{echo'';} ?>" aria-label="Email" aria-describedby="basic-addon1" name="proprietario">
                </div>
                <div class="row">
                  <small class="form-text text-muted">Digíte exatamente como está no cartão</small>
                </div>
              </div>

            </div>

            <div class="row mt-3">
              <div class="col-12">

								<input type="hidden" name="cartao" value="<?= $cartao['id_cart'] ?>">

                <input type="submit" class="btn botao_azul text-white ml-4 float-right" value="<?= $botao_cadastrar ?>" name="submit">
								<?php if(!empty($cartao['id_cart'])){echo'<input type="submit" class="btn btn-danger text-white float-right" value="Excluir" name="submit">';} ?>

              </div>
            </div>
          </form>
        </div>
      </div>


	   </main>

		<?php  require_once('externo/footer.php')  ?>

		<script src="../bootstrap/jquery/jquery-3.3.1.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/popper/popper.min.js"></script> <!-- Popper.js -->
		<script src="../bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
		<script type="text/javascript" src="jquery/navbar.js"></script> <!-- jQuery NavBar -->
	</body>
</html>
