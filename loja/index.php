<?php

	// Conexão e sessão
	require_once('../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('loja', true);

	$sql = $conexao -> prepare('SELECT * FROM loja WHERE id_loja = :loja');
	$sql -> bindParam(':loja', $_SESSION['id']);
	$sql -> execute();
	$loja = $sql -> fetch();
	
	$_SESSION['loja'] = $loja['nome_loja'];

    function buscarPedidos($estado) {

        global $conexao;
        global $pedidos;
        global $total;
        global $pedidos_id;
        
        $sql = $conexao -> prepare(
            'SELECT DISTINCT
                p.id_pedi, p.endereco_pedi, p.id_usua, p.horario_pedi, p.data_pedi, p.destinatario_pedi
            FROM
                pedido p
                JOIN item_pedido i ON (p.id_pedi = i.id_pedi)
                JOIN produto u ON (u.id_prod = i.id_prod)
            WHERE
                i.estado_item = :estado
                AND u.id_loja = :loja
            ORDER BY
                p.data_pedi ASC, p.horario_pedi ASC');
            
        $sql -> bindParam(':loja', $_SESSION['id']);
        $sql -> bindParam(':estado', $estado);
        $sql -> execute();

        $pedidos = $sql -> fetchAll(PDO::FETCH_ASSOC);
        $total = $sql -> rowCount();
        $pedidos_id = array();
    }
    
    function montarPedidos($estado) {

        global $conexao;
        global $pedidos;
        global $total;
        global $pedidos_id;

        buscarPedidos($estado);

        switch ($estado) {

            case 'pendente':
                $cor = 'success';
                break;
            
            case 'processando':
                $cor = 'warning';
				break;
				
			case 'entrega';
				$cor = 'primary';
				break;
        }

        foreach ($pedidos as $controle => $pedido){

            $um = $pedido['id_pedi'];
            $dois = $pedido['id_pedi'];
            $tres = substr($pedido['horario_pedi'], 0, 5);
            $quatro = date('d.m.y', (strtotime($pedido['data_pedi'])));

            echo "
                <a class='list-group-item list-group-item-$cor list-group-item-action' data-toggle='list' href='#list-$um' role='tab' aria-controls=''>
                    Cód: $dois <small class='float-right'>$tres | $quatro</small>
                </a>";

            $pedidos_id[$controle] = $pedido['id_pedi'];
        }
    }

?>


<!DOCTYPE html>

<html lang="pt-br">

	<head>
		<meta charset="utf-8">
		<meta name="theme-color" content="#e2e6ea"> <!-- Cor do brownser -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/bootstrap-4.5.3.min.css"> <!-- CSS Bootstrap -->
		<link rel="stylesheet" href="css/estilo.css">

		<title><?= $loja['nome_loja'] ?> - GuaShop</title>
	</head>

	<body class="bg-light">
		<main class="container">

			<header class="form-row">
				<div class="col-md-12 col-lg-6">
					<h1 class="mt-4 display-4 d-inline-block"><?= $_SESSION['loja'] ?></h1>
					<h4 class="ml-4 text-muted d-inline-block mt-4">Pedidos</h4>
				</div>

				<div class="col-md-4 col-lg-2 mt-4 mt-lg-5">
					<a class="btn btn-info w-100 px-0" href="produtos.php">Produtos</a>
				</div>

				<div class="col-md-4 col-lg-2 mt-4 mt-lg-5">
					<a class="btn btn-secondary w-100 px-0" href="menu_de_conta.php">Gerenciar Conta</a>
				</div>

				<div class="col-md-4 col-lg-2 mt-4 mt-lg-5">
					<a class="btn btn-outline-warning w-100 px-0" href="externo/logout.php">Finalizar Sessão</a>
				</div>
				
				<div class="col-lg-12 col-xl-12">
					<hr>
				</div>
			</header>

			<!-- Novos Pedidos: --------------------------------------------------------------------------------------------------------------------------------------------->

			<section class="bg-white rounded shadow p-4 my-4">
				<div class="row mx-3 mb-2">
					<h4 class="text-success">Novos Pedidos</h4>
				</div>
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="list-group" id="list-tab" role="tablist">
							<a class="list-group-item list-group-item-success list-group-item-action active text-center" id="list-home-list" data-toggle="list" href="#list-clean" role="tab" aria-controls="home">. . .</a>
							<?php
								$pedidos;
								$total;
								$pedidos_id;
								montarPedidos('pendente');
							?>
						</div>
					</div>
					<div class="co-12 col-md-8">
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade show active" id="list-clean" role="tabpanel" aria-labelledby="list-home-list">
								<p class="lead p-2">Aqui estão os novos pedidos, que ainda não começaram a ser processados.</p>
							</div>
							<?php
								foreach ($pedidos as $controle => $pedido):
									$sql = $conexao -> prepare('SELECT nome_prod, quantidade_item FROM item_pedido i JOIN produto p ON (i.id_prod = p.id_prod) WHERE i.id_pedi = :pedido AND p.id_loja = :loja');
									$sql -> bindParam(':pedido', $pedidos_id[$controle]);
									$sql -> bindParam(':loja', $_SESSION['id']);
									$sql -> execute();
									$produtos = $sql -> fetchAll();
									$control = $pedidos_id[$controle];
									$sql = $conexao -> prepare('SELECT * FROM usuario WHERE id_usua = :usuario');
									$sql -> bindParam(':usuario', $pedido['id_usua']);
									$sql -> execute();
									$usuario = $sql -> fetch();
							?>
							<div class="tab-pane fade py-3" id="list-<?= $control ?>" role="tabpanel" aria-labelledby="list-profile-list">
								<p class="lead"><?= $pedido['endereco_pedi'] ?></p>
								<?php foreach ($produtos as $controle => $produto): ?>
								<div class="list-group">
									<button type="button" class="list-group-item list-group-item-action">
										<div class="w-75 d-inline-block">
											<?= $produto['nome_prod'] ?>
										</div>
										<div class="w-25 d-inline">
											<small class="text-muted">Quantidade:</small> <?= $produto['quantidade_item'] ?>
										</div>
									</button>
								</div>
								<?php endforeach; ?>
								<a class="btn mt-3 btn-success float-right" href="externo/pedido.php?func=processo&id=<?= $pedido['id_pedi'] ?>">Em processo</a>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</section>

			<!-- Pedidos em processamento: --------------------------------------------------------------------------------------------------------------------------------------------->

			<section class="bg-white rounded shadow p-4 my-4">
				<div class="row mx-3 mb-2">
					<h4 class="text-warning">Pedidos em processamento</h4>
				</div>
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="list-group" id="list-tab" role="tablist">
							<a class="list-group-item list-group-item-warning list-group-item-action active text-center" id="list-home-list" data-toggle="list" href="#list-clean2" role="tab" aria-controls="home">. . .</a>
							<?php
								$pedidos;
								$total;
								$pedidos_id;
								montarPedidos('processando');
							?>
						</div>
					</div>
					<div class="col-12 col-md-8">
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade show active" id="list-clean2" role="tabpanel" aria-labelledby="list-home-list">
								<p class="lead p-2">Aqui estão os pedidos que já estão em andamento de preparação.</p>
							</div>
							<?php
								foreach ($pedidos as $controle => $pedido):
									$sql = $conexao -> prepare('SELECT nome_prod, quantidade_item FROM item_pedido i JOIN produto p ON (i.id_prod = p.id_prod) WHERE i.id_pedi = :pedido AND p.id_loja = :loja');
									$sql -> bindParam(':pedido', $pedidos_id[$controle]);
									$sql -> bindParam(':loja', $_SESSION['id']);
									$sql -> execute();
									$produtos = $sql -> fetchAll();
									$control = $pedidos_id[$controle];
									$sql = $conexao -> prepare('SELECT * FROM usuario WHERE id_usua = :usuario');
									$sql -> bindParam(':usuario', $pedido['id_usua']);
									$sql -> execute();
									$usuario = $sql -> fetch();
								?>
							<div class="tab-pane fade py-3" id="list-<?= $control ?>" role="tabpanel" aria-labelledby="list-profile-list">
								<p class="lead"><?= $pedido['endereco_pedi'] ?></p>
								<?php foreach ($produtos as $controle => $produto): ?>
								<div class="list-group">
									<button type="button" class="list-group-item list-group-item-action">
										<div class="w-75 d-inline-block">
											<?= $produto['nome_prod'] ?>
										</div>
										<div class="w-25 d-inline">
											<small class="text-muted">Quantidade:</small> <?= $produto['quantidade_item'] ?>
										</div>
									</button>
								</div>
								<?php endforeach; ?>
								<a class="btn mt-3 btn-warning float-right" href="externo/pedido.php?func=entrega&id=<?= $pedido['id_pedi'] ?>">Em entrega</a>
								<a class="btn mt-3 btn-sucess btn-sm mx-3 float-right" href="externo/pedido.php?func=novo&id=<?= $pedido['id_pedi'] ?>">Voltar aos novos</a>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</section>

			<!-- Pedidos para entrega: --------------------------------------------------------------------------------------------------------------------------------------------->

			<section class="bg-white rounded shadow p-4 my-4">
				<div class="row mx-3 mb-2">
					<h4 class="text-primary">Pedidos para entrega</h4>
				</div>
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="list-group" id="list-tab" role="tablist">
							<a class="list-group-item list-group-item-primary list-group-item-action active text-center" id="list-home-list" data-toggle="list" href="#list-clean3" role="tab" aria-controls="home">. . .</a>
							<?php
								$pedidos;
								$total;
								$pedidos_id;
								montarPedidos('entrega');
							?>
						</div>
					</div>
					<div class="col-12 col-md-8">
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade show active" id="list-clean3" role="tabpanel" aria-labelledby="list-home-list">
								<p class="lead p-2">Aqui estão os pedidos esperando para entrega. Após a entrega de todos os produtos do pedido serem feita, o pedido pode ser finalizado.</p>
							</div>
							<?php
								foreach ($pedidos as $controle => $pedido):
									$sql = $conexao -> prepare('SELECT nome_prod, quantidade_item FROM item_pedido i JOIN produto p ON (i.id_prod = p.id_prod) WHERE i.id_pedi = :pedido AND p.id_loja = :loja');
									$sql -> bindParam(':pedido', $pedidos_id[$controle]);
									$sql -> bindParam(':loja', $_SESSION['id']);
									$sql -> execute();
									$produtos = $sql -> fetchAll();
									$control = $pedidos_id[$controle];
									$sql = $conexao -> prepare('SELECT * FROM usuario WHERE id_usua = :usuario');
									$sql -> bindParam(':usuario', $pedido['id_usua']);
									$sql -> execute();
									$usuario = $sql -> fetch();
							?>
							<div class="tab-pane fade py-3" id="list-<?= $control ?>" role="tabpanel" aria-labelledby="list-profile-list">
								<p class="lead"><?= $pedido['endereco_pedi'] ?></p>
								<p>Destinatário: <strong class="lead"><?= $pedido['destinatario_pedi'] ?></strong></p>
								<?php foreach ($produtos as $controle => $produto): ?>
								<div class="list-group">
									<button type="button" class="list-group-item list-group-item-action">
										<div class="w-75 d-inline-block">
											<?= $produto['nome_prod'] ?>
										</div>
										<div class="w-25 d-inline">
											<small class="text-muted">Quantidade:</small> <?= $produto['quantidade_item'] ?>
										</div>
									</button>
								</div>
								<?php endforeach; ?>
								<a class="btn mt-3 btn-primary float-right" href="externo/pedido.php?func=finalizar&id=<?= $pedido['id_pedi'] ?>">Finalizar</a>
								<a class="btn mt-3 btn-sucess btn-sm mx-3 float-right" href="externo/pedido.php?func=processo&id=<?= $pedido['id_pedi'] ?>">Voltar processo</a>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</section>

			<div class="row">
				<div class="col-0 col-md-6"></div>
				<div class="col-12 col-md-6">
					<a href="pedidos.php" class="float-right w-100 p-3 btn btn-outline-info mb-4">Pedidos finalizados</a>
				</div>
			</div>

			<!----------------------------------------------------------------------------------------------------------------------------------------------->

		</main>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
	</body>

</html>