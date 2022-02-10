<?php

// Instanciar
if($_POST):

    // Conexão e Sessão
    require_once('../../funcoes/php/conexao.php');
    $conexao = estabelecerConexao('utilitario', false);

    switch ($_POST['metodo']):

        case 'pegarUsuario':
            $instacia = new usuario($conexao);
            $instacia->pegarUsuario();
        break;

        case 'criarUsuario':
            $instacia = new usuario($conexao);
            $instacia->criarUsuario();
        break;

        case 'atualizarUsuario':
            $instacia = new usuario($conexao);
            $instacia->atualizarUsuario();
        break;

        case 'apagarUsuario':
            $instacia = new usuario($conexao);
            $instacia->criarUsuario();
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

        $this->conexao = $conexao;
    }

    public function pegarUsuario() {

        if ($_SESSION['logado'] == true):
    
            $this->email = $_SESSION['email'];
    
            $sql = $this->conexao->prepare("SELECT * FROM usuario WHERE	email_usua = :email");
            $sql->bindParam(':email', $this->email);
            $sql->execute();
            $usuario = $sql->fetch();

            return $usuario;
        else:
    
            header("Location: login.php?msg=1");
            exit;
        endif;
    }

    public function criarUsuario() {

        $this->nome = $_POST['nome'];
        $this->sobrenome = $_POST['sobrenome'];
        
        $this->cpf = $_POST['cpf'];
        $this->rg = $_POST['rg'];
        $this->telefone = $_POST['telefone'];
        $this->nascimento = $_POST['nascimento'];

        $this->cep = $_POST['cep'];
        $this->cidade = $_POST['cidade'];
        $this->uf = $_POST['uf'];
        $this->rua = $_POST['rua'];
        $this->numero = $_POST['numero'];
        $this->complemento = $_POST['complemento'];

        $this->email = $_POST['email'];
        $this->senha = $_POST['senha'];

        if (empty($this->nascimento)) $this->nascimento = '00/00/0000';
        if (empty($this->cep)) $this->cep = '0';

        if (empty($this->nome) || empty($this->email) || empty($this->senha)):

            header('Location: ../cadastro.php?men=1');
            exit;
        else:
    
            $this->senha = md5($this->senha);
        endif;

        $sql = $this->conexao->prepare(
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
    
        $sql->bindParam(':nome', $this->nome);
        $sql->bindParam(':sobrenome', $this->sobrenome);
        $sql->bindParam(':email', $this->email);
        $sql->bindParam(':senha', $this->senha);
        $sql->bindParam(':telefone', $this->telefone);
        $sql->bindParam(':cpf', $this->cpf);
        $sql->bindParam(':rg', $this->rg);
        $sql->bindParam(':nascimento', $this->nascimento);
        $sql->bindParam(':estado', $this->uf);
        $sql->bindParam(':cidade', $this->cidade);
        $sql->bindParam(':cep', $this->cep);
        $sql->bindParam(':rua', $this->rua);
        $sql->bindParam(':numero', $this->numero);
        $sql->bindParam(':complemento', $this->complemento);
    
        $sql->execute();
        $id = $this->conexao->lastInsertId();
    
        $conexao = null;
        $sql = null;
    
        if (!empty($id)):
    
            $_SESSION['logado'] = true;
            $_SESSION['email'] = $this->email;
            $_SESSION['id'] = $id;
    
            header("Location: ../minha_conta.php");
            exit;
        else:
    
            header("Location: ../login.php?men=2");
            exit;
        endif;
    }

    public function atualizarUsuario() {

        $this->nascimento = $_POST['nascimento'];
        $this->telefone = $_POST['telefone'];
        $this->rg = $_POST['rg'];
        $this->cpf = $_POST['cpf'];
        $this->uf = $_POST['uf'];
        $this->cidade = $_POST['cidade'];
        $this->cep = $_POST['cep'];
        $this->rua = $_POST['rua'];
        $this->numero = $_POST['numero'];
        $this->complemento = $_POST['complemento'];

        if (empty($this->nascimento)) $this->nascimento = '00/00/0000';
        if (empty($this->cep)) $this->cep = '0';

        $sql = $this->conexao->prepare (
            'UPDATE
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
                email_usua = :email'
        );

        $sql->bindParam(':telefone', $this->telefone);
        $sql->bindParam(':rg', $this->rg);
        $sql->bindParam(':cpf', $this->cpf);
        $sql->bindParam(':nascimento', $this->nascimento);
        $sql->bindParam(':estado', $this->uf);
        $sql->bindParam(':cidade', $this->cidade);
        $sql->bindParam(':cep', $this->cep);
        $sql->bindParam(':rua', $this->rua);
        $sql->bindParam(':numero', $this->numero);
        $sql->bindParam(':complemento', $this->complemento);
        $sql->bindParam(':email', $_SESSION['email']);

        $sql->execute();

        if ($sql->rowCount() > 0):

            header('Location: ../minha_conta.php?msg=1');
            exit;
        else:

            header('Location: ../minha_conta.php?msg=2');
            exit;
        endif;

        return true;
    }  

    function deletarUsuario() {

        return true;
    }
}