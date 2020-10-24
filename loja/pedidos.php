<?php

	session_name('loja');
	session_start();
	require('externo/checar.php');

	$sql = $conexao -> prepare("SELECT * FROM pedido WHERE estado_pedi = 'finalizado' ORDER BY id_pedi DESC");
	$sql -> execute();
	$pedidos = $sql -> fetchAll()

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> <!-- CSS Bootstrap -->

		<title>GuaShop - Loja</title>
	</head>

	<body class="bg-light">
		<main class="container">

			<div class="row">
				<div class="col-10">
					<h1 class="mt-4 display-4 d-inline-block"><?= $_SESSION['loja'] ?></h1>
					<h4 class="lead px-4 d-inline-block">Pedidos finalizados</h4>
				</div>

				<div class="col-2 form-group mt-5">
					<a role="button" class="btn btn-info w-100 mx-2" href="index.php">Início</a>
				</div>
			</div>

			<div class="table-responsive mt-3">
				<table class="table table-hover">					
					<thead>
						<tr>
							<th>ID</th>
							<th></th>
							<th>Data e hora</th>
							<th>Endereço</th>
							<th>Valor</th>
							<th>Forma de pagamento</th>
						</tr>
					</thead>

					<tbody>
					<?php foreach ($pedidos as $controle => $pedido): ?>
						<tr class="<?php if($controle == 0) echo 'table-info' ?>">
							<td><?= $pedido['id_pedi'] ?></td>
							<td><a href="" class="btn btn-info">Voltar aos pedidos</a></td>
							<td><?= $pedido['data_pedi'] ?> <br> <?= $pedido['horario_pedi'] ?></td>
							<td><?= $pedido['endereco_pedi'] ?></td>
							<td><?= $pedido['valor_pedi'] ?></td>
							<td><?= $pedido['formapagamento_pedi'] ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>

		</main>

		<script src="../bootstrap/jquery/jquery-3.3.1.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/popper/popper.min.js"></script> <!-- Popper.js -->
		<script src="../bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
	</body>
</html>
