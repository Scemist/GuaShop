<?php

// Conexão e sessão
require_once('../../funcoes/php/conexao.php');
$conexao = estabelecerConexao('loja', true);

if(isset($_GET['func']) && isset($_GET['id'])) {

	switch ($_GET['func']) {

	case 'novo':
		$instancia = new pedido($_GET['id'], $conexao);
		$instancia->adicionarNovo();
		header('Location: ../index.php');
		exit;
	break;

	case 'processo':
		$instancia = new pedido($_GET['id'], $conexao);
		$instancia->adicionarProcesso();
		header('Location: ../index.php');
		exit;
	break;

	case 'entrega':
		$instancia = new pedido($_GET['id'], $conexao);
		$instancia->adicionarEntrega();
		header('Location: ../index.php');
		exit;
	break;

	case 'finalizar':
		$instancia = new pedido($_GET['id'], $conexao);
		$instancia->adicionarFinalizado();
		header('Location: ../index.php');
		exit;
	break;

	case 'desfinalizar':
		$instancia = new pedido($_GET['id'], $conexao);
		$instancia->removerFinalizado();
		header('Location: ../index.php');
		exit;
	break;

	default:
		header('Location: ../index.php');
	exit;
	}
}
else {
	header('Location: ../index.php');
	exit;
}

// Pendente, processando, entrega, finalizado

class pedido {

	private $pedido;
	private $conexao;
	private $loja;

	function __construct($pedido, $conexao) {
		
		$this->conexao = $conexao;
		$this->pedido = $_GET['id'];
		$this->loja = $_SESSION['id'];
	}

	function adicionarNovo() {
		$sql = $this->conexao->prepare("UPDATE item_pedido i, produto p SET estado_item = 'pendente' WHERE id_pedi = :pedido AND i.id_prod = p.id_prod AND p.id_loja = :loja");
		$sql->bindParam(':pedido', $this->pedido);
		$sql->bindParam(':loja', $_SESSION['id']);
		$sql->execute();
	}

	function adicionarProcesso() {
		$sql = $this->conexao->prepare("UPDATE item_pedido i, produto p SET estado_item = 'processando' WHERE id_pedi = :pedido AND i.id_prod = p.id_prod AND p.id_loja = :loja");
		$sql->bindParam(':pedido', $this->pedido);
		$sql->bindParam(':loja', $_SESSION['id']);
		$sql->execute();
	}

	function adicionarEntrega() {
		$sql = $this->conexao->prepare("UPDATE item_pedido i, produto p SET estado_item = 'entrega' WHERE id_pedi = :pedido AND i.id_prod = p.id_prod AND p.id_loja = :loja");
		$sql->bindParam(':pedido', $this->pedido);
		$sql->bindParam(':loja', $_SESSION['id']);
		$sql->execute();
	}

	function adicionarFinalizado() {
		$sql = $this->conexao->prepare(
			"UPDATE
				item_pedido i, produto p, pedido d
			SET
				i.estado_item = 'finalizado', d.estado_pedi = 'finalizado'
			WHERE
				i.id_pedi = :pedido
				AND i.id_prod = p.id_prod
				AND p.id_loja = :loja
				AND d.id_pedi = :pedido");

		$sql->bindParam(':pedido', $this->pedido);
		$sql->bindParam(':loja', $_SESSION['id']);
		$sql->execute();
	}

	function removerFinalizado() {
		$sql = $this->conexao->prepare("UPDATE pedido p, item_pedido i SET p.estado_pedi = 'pendente', i.estado_item = 'entrega' WHERE p.id_pedi = :pedido AND i.id_pedi = p.id_pedi");
		$sql->bindParam(':pedido', $this->pedido);
		$sql->execute();
	}
}