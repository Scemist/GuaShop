<?php

  if(isset($_GET['func']) && isset($_GET['id'])) {

    switch ($_GET['func']) {

      case 'novo':
        $instancia = new pedido($_GET['id']);
        echo $instancia -> adicionarNovo();
          header('Location: ../index.php');
        exit;
        break;

      case 'processo':
        $instancia = new pedido($_GET['id']);
        echo $instancia -> adicionarProcesso();
          header('Location: ../index.php');
        exit;
        break;

        case 'entrega':
          $instancia = new pedido($_GET['id']);
          echo $instancia -> adicionarEntrega();
          header('Location: ../index.php');
          exit;
          break;

        case 'finalizar':
          $instancia = new pedido($_GET['id']);
          echo $instancia -> adicionarFinalizado();
          header('Location: ../index.php');
          exit;
          break;

        default:
          header('Location: ../index.php');
          exit;
    }
  }
  else {
    header('Location: ../index.php');
    exit;
  }

  // Pendente, processando, entrega, finalizado

  class pedido {

    private $pedido;
    private $conexao;
    private $loja;

    function __construct($pedido) {
      session_name('loja');
      session_start();
      $this -> conexao = new PDO('mysql:host=localhost;dbname=guashop;charset=utf8', 'root', '');
      $this -> conexao -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this -> pedido = $_GET['id'];
      $this -> loja = $_SESSION['id'];
    }

    function adicionarNovo() {
      $sql = $this -> conexao -> prepare("UPDATE item_pedido i, produto p SET estado_item = 'pendente' WHERE id_pedi = :pedido AND i.id_prod = p.id_prod AND p.id_loja = :loja");
      $sql -> bindParam(':pedido', $this -> pedido);
      $sql -> bindParam(':loja', $_SESSION['id']);
      $sql -> execute();
      return "Olá";
    }

    function adicionarProcesso() {
      $sql = $this -> conexao -> prepare("UPDATE item_pedido i, produto p SET estado_item = 'processando' WHERE id_pedi = :pedido AND i.id_prod = p.id_prod AND p.id_loja = :loja");
      $sql -> bindParam(':pedido', $this -> pedido);
      $sql -> bindParam(':loja', $_SESSION['id']);
      $sql -> execute();
      return "Olá";
    }

    function adicionarEntrega() {
      $sql = $this -> conexao -> prepare("UPDATE item_pedido i, produto p SET estado_item = 'entrega' WHERE id_pedi = :pedido AND i.id_prod = p.id_prod AND p.id_loja = :loja");
      $sql -> bindParam(':pedido', $this -> pedido);
      $sql -> bindParam(':loja', $_SESSION['id']);
      $sql -> execute();
      return "Olá";
    }

    function adicionarFinalizado() {
      $sql = $this -> conexao -> prepare("UPDATE item_pedido i, produto p SET estado_item = 'finalizado' WHERE id_pedi = :pedido AND i.id_prod = p.id_prod AND p.id_loja = :loja");
      $sql -> bindParam(':pedido', $this -> pedido);
      $sql -> bindParam(':loja', $_SESSION['id']);
      $sql -> execute();
      return "Olá";
    }
  }

?>
