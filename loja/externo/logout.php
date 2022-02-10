<?php

// Conexão e sessão
require_once('../../funcoes/php/conexao.php');
$conexao = estabelecerConexao('loja', false);
	
// muda o valor de logged_in para false
$_SESSION['logado'] = false;
	
// finaliza a sessão
session_destroy();
	
// retorna para a index.php
header('Location: ../index.php');