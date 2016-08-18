<?php

require_once("iDao.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/infraestrutura/contexto/conexao.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/infraestrutura/mapeamento/mapeamentoUsuario.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/dominio/entidades/usuario.php");

class DaoUsuario implements IDao
{
	const tabela = "Usuario";
	private $conexao;
	private $mapeamento;

	public function DaoUsuario()
	{
		$this -> conexao = new Conexao();
		$this -> mapeamento = new MapeamentoUsuario();
	}

	public function Cadastrar($entidade)
	{
		$query = "INSERT INTO ".self::tabela." (nome, cpf, dt_nascimento, login, senha) VALUES (?,?,?,?,?)";

		$array = array($entidade -> Nome, $entidade -> CPF, $entidade -> DataNascimento, $entidade -> Login, $entidade -> Senha);

		$this -> conexao -> ExecutarQuery($query, $array, false);
	}

	public function Atualizar($entidade)
	{
		$query = "UPDATE ".self::tabela." SET nome = ?, cpf = ?, dt_nascimento = ?, login = ?, senha = ? WHERE id_usuario = ?";

		$array = array($entidade -> Nome, $entidade -> CPF, $entidade -> DataNascimento, $entidade -> Login, $entidade -> Senha, $entidade -> ID);

		$this -> conexao -> ExecutarQuery($query, $array, false);
	}

	public function Deletar($chave)
	{
		$query = "DELETE FROM ".self::tabela." WHERE id_usuario = ?";

		$array = array($chave);

		$this -> conexao -> ExecutarQuery($query, $array, false);
	}

	public function Listar()
	{
		$query = "SELECT * FROM ".self::tabela;
		$lista = $this -> conexao -> ExecutarQuery($query, null);
		$array = array();
		$contador = 0;


		foreach ($lista as $item) {
			$usuario = new Usuario();

			$this -> mapeamento -> Mapear($usuario, $item);
			
			$array[$contador] = $usuario;

			$contador++;
		}

		return $array;
	}

	public function BuscarPorChave($chave)
	{
		$query = "SELECT * FROM ".self::tabela." WHERE id_usuario = ?";
		$array = array($chave);
		$item = $this -> conexao -> ExecutarQuery($query, $array, true, false);
		$usuario = new Usuario();

		$this -> mapeamento -> Mapear($usuario, $item);

		return $usuario;
	}

	public function BuscarPorLogin($login)
	{
		$query = "SELECT * FROM ".self::tabela." WHERE login = ?";
		$array = array($login);
		$item = $this -> conexao -> ExecutarQuery($query, $array, true, false);
		$usuario = new Usuario();

		$this -> mapeamento -> Mapear($usuario, $item);

		return $usuario;
	}
}

?>			