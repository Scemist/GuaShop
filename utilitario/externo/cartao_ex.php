<?php

// Conexão e sessão
require_once('../../funcoes/php/conexao.php');
$conexao = estabelecerConexao('utilitario', false);

if ($_SESSION['logado'] != 1):
	
	header('Location: ../login.php');
	exit;
endif;

$codigo = $_POST['codigo'];
$numero = $_POST['numero'];
$nascimento = $_POST['nascimento'];
$vencimento = $_POST['vencimento'];
$proprietario = $_POST['proprietario'];
$cartao = $_POST['cartao'];

switch ($_POST['submit']):

	case 'Cadastrar':
		$sql = $conexao->prepare('INSERT INTO cartao(codigo_cart, numero_cart, nome_cart, vencimento_cart, nascimento_cart, id_usua) VALUES (:codigo, :numero, :proprietario, :vencimento, :nascimento, :usuario)');
		$sql->bindParam(':codigo', $codigo);
		$sql->bindParam(':numero', $numero);
		$sql->bindParam(':proprietario', $proprietario);
		$sql->bindParam('vencimento', $vencimento);
		$sql->bindParam(':nascimento', $nascimento);
	break;

	case 'Atualizar':
		$sql = $conexao->prepare(
			'UPDATE
				cartao
			SET
				codigo_cart = :codigo,
				numero_cart = :numero,
				nome_cart = :proprietario,
				vencimento_cart = :vencimento,
				nascimento_cart = :nascimento,
				id_usua = :usuario
			WHERE
				id_cart = :cartao
				AND id_usua = :usuario'
		);
		$sql->bindParam(':codigo', $codigo);
		$sql->bindParam(':numero', $numero);
		$sql->bindParam(':proprietario', $proprietario);
		$sql->bindParam('vencimento', $vencimento);
		$sql->bindParam(':nascimento', $nascimento);
		$sql->bindParam(':cartao', $cartao);
	break;

	case 'Excluir':
		$sql = $conexao->prepare('DELETE FROM cartao WHERE id_cart = :cartao AND id_usua = :usuario');
		$sql->bindParam(':cartao', $cartao);
	break;
endswitch;

$sql->bindParam(':usuario', $_SESSION['id']);
$sql->execute();

header('Location: ../minha_conta.php');