<?php

  $nascimento = $_POST['nascimento'];
  $telefone = $_POST['telefone'];
  $rg = $_POST['rg'];
  $cpf = $_POST['cpf'];
  $estado = $_POST['estado'];
  $cidade = $_POST['cidade'];
  $bairro = $_POST['bairro'];
  $rua = $_POST['rua'];
  $numero = $_POST['numero'];

  require_once('../conexao/conexao.php');

  $sql = $conexao -> prepare
  ('
      UPDATE
        usuario
      SET
        telefone_usua = :telefone,
        rg_usua = :rg,
        cpf_usua = :cpf,
        nascimento_usua = :nascimento,
        estado_usua = :estado,
        cidade_usua = :cidade,
        bairro_usua = :bairro,
        rua_usua = :rua,
        numero_usua = :numero
      WHERE
        email_usua = :email
 ');

  $sql -> bindParam(':telefone', $telefone);
  $sql -> bindParam(':rg', $rg);
  $sql -> bindParam(':cpf', $cpf);
  $sql -> bindParam(':nascimento', $nascimento);
  $sql -> bindParam(':estado', $estado);
  $sql -> bindParam(':cidade', $cidade);
  $sql -> bindParam(':bairro', $bairro);
  $sql -> bindParam(':rua', $rua);
  $sql -> bindParam(':numero', $numero);
  $sql -> bindParam(':email', $_SESSION['email']);

  $sql -> execute();

  if ($sql -> rowCount() > 0) {

    header('Location: ../minha_conta.php?msg=1');
  }
  else {
    header('Location: ../minha_conta.php?msg=2');
  }

?>
