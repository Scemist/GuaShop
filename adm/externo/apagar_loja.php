<?php

// Conexão e sessão
require_once('../../funcoes/php/conexao.php');
$conexao = estabelecerConexao('adm', true);

$id = $_GET['id'];

$sql = $conexao->prepare("SELECT arquivo_imag, id_imag FROM imagem i JOIN produto p WHERE i.referencia_refe = p.id_prod AND i.tabela_imag = 'produto' AND p.id_loja = :id");
$sql->bindParam(':id', $id);
$sql->execute();
$imagens = $sql->fetchAll(PDO::FETCH_COLUMN);

foreach ($imagens as $controle => $imagem) {
	
	$sql = $conexao->prepare("DELETE FROM imagem WHERE arquivo_imag = :imagem");
	$sql->bindParam(':imagem', $imagem);
	$sql->execute();

	unlink("../../imagens/$imagem");
}

$sql = $conexao->prepare ('DELETE FROM loja WHERE id_loja = :id');
$sql->bindParam(':id', $id);
$sql->execute();

$sql = $conexao->prepare("SELECT arquivo_imag FROM imagem WHERE tabela_imag = 'loja' AND referencia_refe = :id");
$sql->bindParam(':id', $id);
$sql->execute();
$imagem = $sql->fetch();

$imagem = $imagem['arquivo_imag'];

unlink("../../imagens/$imagem");

$sql = $conexao->prepare("DELETE FROM	imagem WHERE referencia_refe = :id AND tabela_imag = 'loja'");
$sql->bindParam(':id', $id);
$sql->execute();

header('Location: ../index.php');
exit;