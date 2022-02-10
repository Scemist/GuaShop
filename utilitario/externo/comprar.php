<?php

// Conexão e sessão
require_once '../../funcoes/php/conexao.php';
$conexao = estabelecerConexao('utilitario', false);

date_default_timezone_set('America/Sao_Paulo');

echo $total = $_POST['total'];
$horario = date('H:i:s');
$data = date('Y-m-d');
$estado = 'entregue'; // entregue, finalizado.

// Pega os dados do usuario
$sql = $conexao->prepare("SELECT * FROM	usuario	WHERE email_usua = :email");
$sql->bindParam(':email', $_SESSION['email']);
$sql->execute();
$usuario = $sql->fetch();
$endereco = $_POST['cidade'] . ', ' . $_POST['estado'] . ', ' . $_POST['cep'] . ' - ' . $_POST['rua'] . ', ' . $_POST['numero'] . ' (' . $_POST['complemento'] . ')';

// Cria o pedido
$sql = $conexao->prepare('INSERT INTO pedido (horario_pedi, data_pedi, endereco_pedi, formapagamento_pedi, destinatario_pedi, estado_pedi, id_cart, id_usua) VALUES (:horario, :data, :endereco, :pagamento, :destinatario, :estado, :cartao, :usuario)');
$sql->bindParam(':horario', $horario);
$sql->bindParam(':data', $data);
$sql->bindParam(':estado', $estado);
$sql->bindParam(':endereco', $endereco);
$sql->bindParam(':usuario', $usuario['id_usua']);
$sql->bindParam(':destinatario', $_POST['destinatario']);
if (isset($_POST['cartao'])):
	$cartao = 'cartao';
	$sql->bindParam(':pagamento', $cartao);
	$sql->bindParam(':cartao', $_POST['cartao']);
else:
	$nada = null;
	$sql->bindParam(':pagamento', $null);
	$sql->bindParam(':cartao', $null);
endif;
$sql->execute();
$pedido = $conexao->lastInsertId();

// Cria as intancias de cada pedido
for ($controle = 0; $controle <= $total; $controle++):

	${'produto_' . $controle} = $_POST["produto_$controle"];
	${'produto_quantidade_' . $controle} = $_POST["produto_quantidade_$controle"];

	// Pega as informacoes do produto
	$sql = $conexao->prepare("SELECT * FROM produto p	WHERE p.id_prod = :produto");
	$sql->bindParam(':produto', ${'produto_' . $controle});
	$sql->execute();
	$produto = $sql->fetch();

	$valorfinal = ($produto['preco_prod'] - $produto['promocao_prod']) * ${'produto_quantidade_' . $controle};

	// Cria uma instancia para cada item na tabela item_pedido
	$sql = $conexao->prepare('INSERT INTO item_pedido (quantidade_item, promocao_item, valor_item, valorfinal_item, estado_item, id_prod, id_pedi)
	VALUES (:quantidade, :promocao, :valor, :valorfinal, "pendente", :produto, :pedido)');

	$sql->bindParam(':quantidade', ${'produto_quantidade_' . $controle});
	$sql->bindParam(':promocao', $produto['promocao_prod']);
	$sql->bindParam(':valor', $produto['preco_prod']);
	$sql->bindParam(':valorfinal', $valorfinal);
	$sql->bindParam(':produto', $produto['id_prod']);
	$sql->bindParam(':pedido', $pedido);
	$sql->execute();
endfor;

// Insere os ultimos dados no pedido
$sql = $conexao->prepare('UPDATE pedido SET valor_pedi = (SELECT SUM(valorfinal_item) FROM item_pedido WHERE id_pedi = :pedido) WHERE id_pedi = :pedido');
$sql->bindParam(':pedido', $pedido);
$sql->execute();

// Limpa o carrinho
$tipo = 'carrinho';
$sql = $conexao->prepare('DELETE FROM salvo_produto WHERE id_usua = :usuario AND tipo_salv = :tipo');
$sql->bindParam(':usuario', $usuario['id_usua']);
$sql->bindParam(':tipo', $tipo);
$sql->execute();

// Manda um email de cofirmação

// Redireciona o usuario para a página de finalizado
header('Location: ../carrinho.php?msg=2');