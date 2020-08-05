<?php

  try {

    $conexao = new PDO('mysql:host=localhost;dbname=guashop;charset=utf8', 'root', '');
    $conexao -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    session_start();
    if (!isset($_SESSION['logado'])) {

      $_SESSION['logado'] = 0;
    }

  } catch (PDOException $ex) {

      echo "Erro: " . $e -> getMessage();
  }

  // Valores da sessão no sistema
  // $_SESSION['logado'] = 1; ou 0
  // $_SESSION['email'] = $email;
  // $_SESSION['id'] = id_usua;

?>
