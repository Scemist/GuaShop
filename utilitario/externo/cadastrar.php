<?php

  $nome = $_POST['nome'];
  $sobrenome = $_POST['sobrenome'];


  $email = $_POST['email'];
  $senha = $_POST['senha'];

  $cpf = $_POST['cpf'];
  $rg = $_POST['rg'];
  $telefone = $_POST['telefone'];
  $nascimento = $_POST['nascimento'];

  $estado = $_POST['estado'];
  $cidade = $_POST['cidade'];
  $bairro = $_POST['bairro'];
  $rua = $_POST['rua'];
  $numero = $_POST['numero'];

  include_once('../conexao/conexao.php');

  $sql = $conexao -> prepare('
    INSERT INTO usuario (
      nome_usua,
      sobrenome_usua,
      email_usua,
      senha_usua,
      telefone_usua,
      cpf_usua,
      rg_usua,
      nascimento_usua,
      estado_usua,
      cidade_usua,
      bairro_usua,
      rua_usua,
      numero_usua
    )
    VALUES (
      :nome,
      :sobrenome,
      :email,
      :senha,
      :telefone,
      :cpf,
      :rg,
      :nascimento,
      :estado,
      :cidade,
      :bairro,
      :rua,
      :numero
    )
  ');

  $sql -> bindParam(':nome', $nome);
  $sql -> bindParam(':sobrenome', $sobrenome);
  $sql -> bindParam(':email', $email);
  $sql -> bindParam(':senha', $senha);
  $sql -> bindParam(':telefone', $telefone);
  $sql -> bindParam(':cpf', $cpf);
  $sql -> bindParam(':rg', $rg);
  $sql -> bindParam(':nascimento', $nascimento);
  $sql -> bindParam(':estado', $estado);
  $sql -> bindParam(':cidade', $cidade);
  $sql -> bindParam(':bairro', $bairro);
  $sql -> bindParam(':rua', $rua);
  $sql -> bindParam(':numero', $numero);

  $sql -> execute();
  $id = $conexao -> lastInsertId();

  $conexao = null;
  $sql = null;

  if ($id > 0) {

    $_SESSION['logado'] = 1;
    $_SESSION['email'] = $email;
    $_SESSION['id'] = $id;

    header("Location: ../minha_conta.php?msg=1");
  }
  else {
    echo "<br> <br> nao cadastrou";
  }

?>
