<?php

require_once("iMapeamento.php");

class MapeamentoUsuario implements IMapeamento
{
    public function Mapear($entidade, $db_item)
    {
        $entidade -> ID = $db_item["id_usuario"];
        $entidade -> Nome = $db_item["nome"];
        $entidade -> CPF = $db_item["cpf"];
        $entidade -> DataNascimento = $db_item["dt_nascimento"];
        $entidade -> Login = $db_item["login"];
        $entidade -> Senha = $db_item["senha"];

        return $entidade;
    }
}

?>