<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('loja', true);

	$sql = $conexao -> prepare("SELECT * FROM pedido WHERE estado_pedi = 'finalizado' ORDER BY id_pedi DESC");
	$sql -> execute();
	$pedidos = $sql -> fetchAll();

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->
		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->

		<link rel="stylesheet" href="../bootstrap/bootstrap-4.5.3.min.css"> <!-- CSS Bootstrap -->
		<link rel="stylesheet" href="css/estilo.css">

		<title>GuaShop - Loja</title>
	</head>
	<body class="bg-light">
		<main class="container">

			<header class="row">
				<div class="col-9 col-md-10">
					<h1 class="mt-4 display-4 text-truncate"><?= $_SESSION['loja'] ?></h1>
					<h4 class="ml-md-4 text-muted d-inline-block mt-4">Pedidos finalizados</h4>
				</div>

				<div class="col-3 col-md-2 mt-5 pl-0">
					<a class="btn btn-info w-100 float-right" href="index.php">Início</a>
				</div>
				
				<div class="col-12">
					<hr>
				</div>
			</header>

		</main>

		<main class="container-lg">
			<section class="row">
				<div class="table-responsive shadow">

					<table class="table table-hover shadow border border-info ml-3 ml-lg-0 bg-white">
						<thead>
							<tr>
								<th>ID</th>
								<th></th>
								<th>Data e hora</th>
								<th>Endereço</th>
								<th>Valor</th>
								<th>Forma de pagamento</th>
								<th>Destinatário</th>
							</tr>
						</thead>
						
						<tbody>
							<?php foreach ($pedidos as $controle => $pedido): ?>
							<tr class="<?php if($controle == 0) echo 'table-info' ?>">
								<td><?= $pedido['id_pedi'] ?></td>
								<td><a href="externo/pedido.php?func=desfinalizar&id=<?= $pedido['id_pedi'] ?>" class="btn btn-info">Voltar aos pedidos</a></td>
								<td><?= $pedido['data_pedi'] ?> <br> <?= $pedido['horario_pedi'] ?></td>
								<td><?= $pedido['endereco_pedi'] ?></td>
								<td><?= $pedido['valor_pedi'] ?></td>
								<td><?= $pedido['formapagamento_pedi'] ?></td>
								<td><?= $pedido['destinatario_pedi'] ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>

				</div>
			</section>
		</main>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
	</body>
</html>