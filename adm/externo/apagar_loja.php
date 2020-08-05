<?php

  require_once('../conexao/conexao.php');

  $id = $_GET['id'];

  $sql = $conexao -> prepare ('DELETE FROM loja WHERE id_loja = :id');
  $sql -> bindParam(':id', $id);

  $sql -> execute();

  header('Location: ../index.php');
?>
