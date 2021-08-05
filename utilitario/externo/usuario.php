<?php

// Conexão e Sessão
require_once('../../funcoes/php/conexao.php');
$conexao = estabelecerConexao('utilitario', false);

// Instanciar
if($_POST):

    switch ($_POST['metodo']):

        case 'pegarUsuario':
            $instacia = new usuario($conexao);
            $instacia -> criarUsuario();
        break;

        case 'criarUsuario':
            $instacia = new usuario($conexao);
            $instacia -> criarUsuario();
        break;

        case 'atualizarUsuario':
            $instacia = new usuario($conexao);
            $instacia -> criarUsuario();
        break;

        case 'apagarUsuario':
            $instacia = new usuario($conexao);
            $instacia -> criarUsuario();
        break;

        default:
            header('Location: ../');
        break;
    endswitch;
endif;

// Classe
class usuario {

    private $conexao;

    private $nome;
    private $sobrenome;

    private $cpf;
    private $rg;
    private $nascimento;
    private $telefone;

    private $cep;
    private $cidade;
    private $uf;
    private $rua;
    private $numero;
    private $complemento;

    private $email;
    private $senha;

    public function __construct($conexao) {

        $this -> conexao = $conexao;
    }

    public function pegarUsuario() {

        return true;
    }

    public function criarUsuario() {

        $this -> nome = $_POST['nome'];
        $this -> sobrenome = $_POST['sobrenome'];
        
        $this -> cpf = $_POST['cpf'];
        $this -> rg = $_POST['rg'];
        $this -> telefone = $_POST['telefone'];
        $this -> nascimento = $_POST['nascimento'];

        $this -> cep = $_POST['cep'];
        $this -> cidade = $_POST['cidade'];
        $this -> uf = $_POST['uf'];
        $this -> rua = $_POST['rua'];
        $this -> numero = $_POST['numero'];
        $this -> complemento = $_POST['complemento'];

        $this -> email = $_POST['email'];
        $this -> senha = $_POST['senha'];

        if (empty($this -> nome) || empty($this -> email) || empty($this -> senha)):

            header('Location: ../cadastro.php?men=1');
            exit;
        else:
    
            $this -> senha = md5($this -> senha);
        endif;

        $sql = $this -> conexao -> prepare(
            'INSERT INTO usuario (
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
                complemento_usua)
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
                :complemento)'
        );
    
        $sql -> bindParam(':nome', $this -> nome);
        $sql -> bindParam(':sobrenome', $this -> sobrenome);
        $sql -> bindParam(':email', $this -> email);
        $sql -> bindParam(':senha', $this -> senha);
        $sql -> bindParam(':telefone', $this -> telefone);
        $sql -> bindParam(':cpf', $this -> cpf);
        $sql -> bindParam(':rg', $this -> rg);
        $sql -> bindParam(':nascimento', $this -> nascimento);
        $sql -> bindParam(':estado', $this -> uf);
        $sql -> bindParam(':cidade', $this -> cidade);
        $sql -> bindParam(':cep', $this -> cep);
        $sql -> bindParam(':rua', $this -> rua);
        $sql -> bindParam(':numero', $this -> numero);
        $sql -> bindParam(':complemento', $this -> complemento);
    
        $sql -> execute();
        $id = $this -> conexao -> lastInsertId();
    
        $conexao = null;
        $sql = null;
    
        if (!empty($id)):
    
            $_SESSION['logado'] = true;
            $_SESSION['email'] = $this -> email;
            $_SESSION['id'] = $id;
    
            header("Location: ../minha_conta.php");
            exit;
        else:
    
            header("Location: ../login.php?men=2");
            exit;
        endif;
    }

    public function editarUsuario() {

        return true;
    }

    function deletarUsuario() {

        return true;
    }
}