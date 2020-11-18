<?php

  session_name('utilitario');
  session_start();

  if ($_SESSION['logado'] != true) {

    header('Location: ../login.php');
    exit;
  }

  $funcao = $_GET['func'];
  $produto = $_GET['prod'];
  $quantidade = 1;

  switch ($funcao) {

    case 'adicionarCarrinho':
      $instancia = new produtos($produto);
      $instancia -> adicionarCarrinho($quantidade);
      header('Location: ../carrinho.php');
      exit;
      break;

    case 'removerCarrinho':
      $instancia = new produtos($produto);
      echo $instancia -> removerCarrinho();
      header('Location: ../carrinho.php');
      exit;
      break;

    case 'adicionarFavorito':
      $instancia = new produtos($produto);
      echo $instancia -> adicionarFavorito();
      header("Location: ../produto.php?produto=$produto");
      exit;
      break;

    case 'removerFavorito':
      $instancia = new produtos($produto);
      echo $instancia -> removerFavoritos();
      header('Location: ../favoritos.php');
      exit;
      break;

    default:

      break;
  }

  class produtos
  {
    private $usuario;
    private $produto;
    private $salvar_tipo;
    private $quantidade;
    private $conexao;

    public function __construct($produto) {
      try {
        $this -> conexao = new PDO('mysql:host=localhost;dbname=guashop;charset=utf8', 'root', '');
        $this -> conexao -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (!isset($_SESSION['logado'])) {
          $_SESSION['logado'] = 0;
        }
      } catch (PDOException $ex) {
          echo "Erro: " . $e -> getMessage();
      }

      $this -> usuario = $_SESSION['id'];
      $this -> produto = $produto;
    }

    public function adicionarCarrinho($quantidade) {
      // Instancía as variáveis
      $this -> quantidade = $quantidade;
      $this -> salvar_tipo = 'carrinho';

      // Verifica se já existe
    	$sql = $this -> conexao -> prepare('SELECT
    			id_salv
    		FROM
    			salvo_produto s
    		WHERE
    			s.id_usua = :usuario
    			AND s.tipo_salv = :tipo
          AND s.id_prod = :produto');
    	$sql -> bindParam(':usuario', $this -> usuario);
    	$sql -> bindParam(':tipo', $this -> salvar_tipo);
    	$sql -> bindParam(':produto', $this -> produto);
    	$sql -> execute();
      $salvo_produto = $sql -> fetch();

      if (isset($salvo_produto['id_salv'])) {

        header("Location: ../carrinho.php?msg=1.php");
        exit;
      }

      // Insere caso não exista
      $sql = $this -> conexao -> prepare('INSERT INTO salvo_produto(tipo_salv, quantidade_salv, id_usua, id_prod) VALUES (:tipo, :quantidade, :usuario, :produto)');
      $sql -> bindParam(':tipo', $this -> salvar_tipo);
      $sql -> bindParam(':quantidade', $this -> quantidade);
      $sql -> bindParam(':usuario', $this -> usuario);
      $sql -> bindParam(':produto', $this -> produto);
      $sql -> execute();
      $confirmacao = $sql -> rowCount();

      if ($confirmacao > 0) {
        return "Adicionado com sucesso!";
      }
      else {
        return "Erro ao adicionar!";
      }
    }

    public function removerCarrinho() {
      $this -> salvar_tipo = 'carrinho';

      $sql = $this -> conexao -> prepare('DELETE FROM salvo_produto WHERE id_prod = :produto AND id_usua = :usuario AND tipo_salv = :tipo');
      $sql -> bindParam(':produto', $this -> produto);
      $sql -> bindParam(':tipo', $this -> salvar_tipo);
      $sql -> bindParam(':usuario', $this -> usuario);
      $sql -> execute();
      $confirmacao = $sql -> rowCount();

      if ($confirmacao > 0) {
        return "Removido com sucesso!";
      }
      else {
        return "Erro ao Remover!";
      }
    }

    public function adicionarFavorito() {
      $this -> salvar_tipo = 'favorito';

      $sql = $this -> conexao -> prepare('INSERT INTO salvo_produto(tipo_salv, id_usua, id_prod) VALUES (:tipo, :usuario, :produto)');
      $sql -> bindParam(':tipo', $this -> salvar_tipo);
      $sql -> bindParam(':usuario', $this -> usuario);
      $sql -> bindParam(':produto', $this -> produto);
      $sql -> execute();
      $confirmacao = $sql -> rowCount();

      if ($confirmacao > 0) {
        return "Adicionado com sucesso!";
      }
      else {
        return "Erro ao adicionar!";
      }
    }

    public function removerFavoritos() {
      $this -> salvar_tipo = 'favorito';

      $sql = $this -> conexao -> prepare('DELETE FROM salvo_produto WHERE id_prod = :produto AND id_usua = :usuario AND tipo_salv = :tipo');
      $sql -> bindParam(':produto', $this -> produto);
      $sql -> bindParam(':tipo', $this -> salvar_tipo);
      $sql -> bindParam(':usuario', $this -> usuario);
      $sql -> execute();
      $confirmacao = $sql -> rowCount();

      if ($confirmacao > 0) {
        return "Removido com sucesso!";
      }
      else {
        return "Erro ao Remover!";
      }
    }
  }

?>
