<?php
 
	require('conexao/conexao.php');
 
	if (!isLoggedIn()) {
	    header('Location: login.php');
	}

?>