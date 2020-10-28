<?php

  $nome = $_POST['nome'];
  $sobrenome = $_POST['sobrenome'];


  $email = $_POST['email'];
  $senha = $_POST['senha'];

  $cpf = $_POST['cpf'];
  $rg = $_POST['rg'];
  $telefone = $_POST['telefone'];
  $nascimento = $_POST['nascimento'];

  $estado = $_POST['uf'];
  $cidade = $_POST['cidade'];
  $cep = $_POST['cep'];
  $rua = $_POST['rua'];
  $numero = $_POST['numero'];
  $complemento = $_POST['complemento'];

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
      cep_usua,
      rua_usua,
      numero_usua,
      complemento_usua
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
      :cep,
      :rua,
      :numero,
      :complemento
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
  $sql -> bindParam(':cep', $cep);
  $sql -> bindParam(':rua', $rua);
  $sql -> bindParam(':numero', $numero);
  $sql -> bindParam(':complemento', $complemento);

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
