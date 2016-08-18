<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/aplicacao/servicos/servicoUsuario.php");

class ControllerUsuario
{
    private $servico;

    public function ControllerUsuario()
    {
        $this -> servico = new ServicoUsuario();
    }

    public function Cadastrar($request)
    {
        $nome = $request -> params("nome");
        $dataNascimento = $request -> params("datanascimento");
        $cpf = $request -> params("cpf");
        $login = $request -> params("login");
        $senha = $request -> params("senha");
        $confirmacao = $request -> params("confirmacao");

        $resultado = $this -> servico -> Cadastrar($nome, $dataNascimento, $login, $senha, $confirmacao, $cpf);

        echo json_encode($resultado);
    }

    public function Logar()
    {
        $login = $request -> getAttribute('login');
        $senha = $request -> getAttribute('senha');

        $resultado = $this -> servico -> Logar($login, $senha);

        echo json_encode($resultado);
    }

    public function AlterarSenha()
    {
        $login = $request -> getAttribute('login');
        $senha = $request -> getAttribute('senha');
        $novaSenha = $request -> getAttribute('novaSenha');
        $confirmacao = $request -> getAttribute('confirmacao');

        $resultado = $this -> servico -> AlterarSenha($login, $senha, $novaSenha, $confirmacao);

        echo json_encode($resultado);
    }

    public function EnviarCodigoRedefinicao()
    {
        $login = $request -> getAttribute('login');
        $email = $request -> getAttribute('email');

        $resultado = $this -> servico -> EnviarCodigoRedefinicao($login, $email);

        echo json_encode($resultado);
    }

    public function RedefinirSenha()
    {
        $login = $request -> getAttribute('login');
        $codigo = $request -> getAttribute('codigo');
        $senha = $request -> getAttribute('senha');
        $confirmacao = $request -> getAttribute('confirmacao');
        $clientecodigo = $request -> getAttribute('clientecodigo');

        $resultado = $this -> servico -> RedefinirSenha($login, $codigo, $senha, $confirmacao, $clientecodigo);

        echo json_encode($resultado);
    }

    public function AlterarDados()
    {
        $objeto = json_decode($request);

        $nome = $objeto -> nome;
        $dataNascimento = $objeto -> data-nascimento;
        $cpf = $objeto -> CPF;
        $login = $objeto -> login;

        $resultado = $this -> servico -> AlterarDados($login, $nome, $dataNascimento, $cpf);

        echo json_encode($resultado);
    }

    public function ExcluirConta()
    {
        $login = $request -> getAttribute('login');
        $senha = $request -> getAttribute('senha');

        $resultado = $this -> servico -> ExcluirConta($login, $senha);

        echo json_encode($resultado);
    }

    public function Listar()
    {
        $resultado = $this -> servico -> Listar();

        echo json_encode($resultado);
    }
}

?>		