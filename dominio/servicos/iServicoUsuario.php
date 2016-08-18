<?php

interface IServicoUsuario
{
    function Cadastrar($nome, $dataNascimento, $login, $senha, $confirmacao, $cpf);
    function Logar($login, $senha);
    function AlterarSenha($login, $senha, $novaSenha, $confirmacao);
    function EnviarCodigoRedefinicao($login, $email);
    function RedefinirSenha($login, $codigo, $senha, $confirmacao, $clientecodigo);
    function AlterarDados($login, $nome, $dataNascimento, $cpf);
    function ExcluirConta($login, $senha);
    function Listar();
}

?>			