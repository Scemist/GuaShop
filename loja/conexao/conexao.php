<?php

  try {

    $conexao = new PDO('mysql:host=localhost;dbname=guashop;charset=utf8', 'root', '');
    $conexao -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  	} catch (PDOException $ex) {

      echo "Erro: " . $e -> getMessage();
  	}

  	function make_hash($str) {
    	return sha1(md5($str));
	}

  	function isLoggedIn(){
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        return false;
    }

    return true;
	}
?>
