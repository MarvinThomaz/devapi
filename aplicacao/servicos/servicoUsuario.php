<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/dominio/servicos/iServicoUsuario.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/dominio/entidades/usuario.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/infraestrutura/dao/daoUsuario.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/utilitarios/geraSenha.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/utilitarios/resultado.php");

class ServicoUsuario implements IServicoUsuario
{
    public function Cadastrar($nome, $dataNascimento, $login, $senha, $confirmacao, $cpf)
    {
        if($senha == $confirmacao)
        {
            $usuario = new Usuario();
            $dao = new DaoUsuario();

            $usuario -> Nome = $nome;
            $usuario -> DataNascimento = $dataNascimento;
            $usuario -> Login = $login;
            $usuario -> Senha = $senha;
            $usuario -> CPF = $cpf;

            $dao -> Cadastrar($usuario);

            return new Resultado(true);
        }
        else
        {
            return new Resultado(false, "Senha deve ser igual a confirmação.");    
        }
    }

    public function Logar($login, $senha)
    {
        $dao = new DaoUsuario();
        $usuario = $dao -> BuscarPorLogin($login);

        if($usuario != null && $usuario -> GetSenha() == $senha)
        {
            $model -> Login = $usuario -> Login;
            $model -> Nome = $usuario -> Nome;
            $model -> DataNascimento = $usuario -> DataNascimento;
            $model -> CPF = $usuario -> CPF;

            return new Resultado(true, "", $model);
        }
        else 
        {
            return new Resultado(false, "Usuário ou senha inválidos");
        }

    }

    public function AlterarSenha($login, $senha, $novaSenha, $confirmacao)
    {
        $dao = new DaoUsuario();
        $usuario = $dao -> BuscarPorLogin($login);

        if($usuario != null && $usuario -> Senha == $senha)
        {
            if($novaSenha == $confirmacao)
            {
                $usuario -> Senha = $senha;
                $dao -> Atualizar($usuario);

                return new Resultado(true);
            }
            else 
            {
                return new Resultado(false, "Nova senha e confirmação da senha devem ser iguais");
            }
        }
        else 
        {
            return new Resultado(false, "Usuário não encontrado");
        }
    }

    public function EnviarCodigoRedefinicao($login, $email)
    {
        $dao = new DaoUsuario();
        $usuario = $dao -> BuscarPorLogin($login);

        if($usuario != null)
        {
            $codigo = GeraSenha::Gerar(5);
            $email = new EnvioEmail();

            $email -> Enviar($email, "Redefinição de Senha", "Codigo: ".$codigo);

            return new Resultado(true);
        }
        else 
        {
            return new Resultado(false, "Usuário não encontrado");
        }
    }

    public function RedefinirSenha($login, $codigo, $senha, $confirmacao, $clientecodigo)
    {

        $dao = new DaoUsuario();
        $usuario = $dao -> BuscarPorLogin($login);

        if($usuario != null)
        {
            if($codigo == $clientecodigo)
            {
                if($senha == $confirmacao)
                {
                    $usuario -> Senha = $senha;
                    $dao -> Atualizar($usuario);

                    return new Resultado(true);
                }
                else 
                {
                    return new Resultado(false, "Senha e confirmação devem ser iguais");
                }
            }
            else 
            {
                return new Resultado(false, "Codigo de confirmação inválido");
            }
        }
        else 
        {
            return new Resultado(false, "Usuário não encontrado");
        }
    }

    public function AlterarDados($login, $nome, $dataNascimento, $cpf)
    {

        $dao = new DaoUsuario();
        $usuario = $dao -> BuscarPorLogin($login);

        if($usuario != null)
        {
            $usuario -> Nome = $nome;
            $usuario -> DataNascimento = $dataNascimento;
            $usuario -> CPF = $cpf;

            $dao -> Atualizar($usuario);

            return new Resultado(true);
        }
        else 
        {
            return new Resultado(false, "Usuário não econtrado");
        }
    }

    public function ExcluirConta($login, $senha)
    {

        $dao = new DaoUsuario();
        $usuario = $dao -> BuscarPorLogin($login);

        if($usuario != null && $usuario -> Senha == $senha)
        {
            $dao -> Deletar($usuario -> ID);

            return new Resultado(true);
        }
        else 
        {
            return new Resultado(false, "Usuário ou senha inválidos");
        }
    }

    public function Listar()
    {
        $dao = new DaoUsuario();
        $usuarios = $dao -> Listar();

        return new Resultado(true, "", $usuarios);
    }
}

?>				