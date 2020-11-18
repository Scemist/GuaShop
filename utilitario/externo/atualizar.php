<?php

  $nascimento = $_POST['nascimento'];
  $telefone = $_POST['telefone'];
  $rg = $_POST['rg'];
  $cpf = $_POST['cpf'];
  $estado = $_POST['estado'];
  $cidade = $_POST['cidade'];
  $cep = $_POST['cep'];
  $rua = $_POST['rua'];
  $numero = $_POST['numero'];
  $complemento = $_POST['complemento'];

  // Conexão e sessão
	require_once('../../funcoes/php/conexao.php');
	$conexao = estabelecerConexao('utilitario', false);

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
        cep_usua = :cep,
        rua_usua = :rua,
        numero_usua = :numero,
        complemento_usua = :complemento
      WHERE
        email_usua = :email
 ');

  $sql -> bindParam(':telefone', $telefone);
  $sql -> bindParam(':rg', $rg);
  $sql -> bindParam(':cpf', $cpf);
  $sql -> bindParam(':nascimento', $nascimento);
  $sql -> bindParam(':estado', $estado);
  $sql -> bindParam(':cidade', $cidade);
  $sql -> bindParam(':cep', $cep);
  $sql -> bindParam(':rua', $rua);
  $sql -> bindParam(':numero', $numero);
  $sql -> bindParam(':complemento', $complemento);
  $sql -> bindParam(':email', $_SESSION['email']);

  $sql -> execute();

  if ($sql -> rowCount() > 0) {

    header('Location: ../minha_conta.php?msg=1');
  }
  else {
    header('Location: ../minha_conta.php?msg=2');
  }

?>
