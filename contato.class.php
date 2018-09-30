<?php
class Contato {

	private $pdo;

	//Conecção com banco
	public function __construct() {
		$this->pdo = new PDO("mysql:dbname=crud_oo;host=localhost", "root", "");

	}

	public function adicionar($email, $nome = '') {//Nome é opcional
		//Verificando se o email já existe
		if($this->existeEmail($email) == false) {
			//Se igula a false é porque não existe
			$sql = "INSERT INTO contatos (nome, email) VALUES (:nome, :email)";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(":nome", $nome);
			$sql->bindValue(":email", $email);
			$sql->execute();

			return true;

		} else {
			return false;
		}	
	}

	public function getInfo($id) {
		$sql = "SELECT * FROM contatos WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			return $sql->fetch();
		} else {
			return array();
		}
	}

	public function getAll() {
		$sql = "SELECT * FROM contatos";
		$sql = $this->pdo->query($sql);

		if($sql->rowCount() > 0) {
			return $sql->fetchAll();//Array()
		} else {
			return array();
		}
	}

	public function editar($nome, $email, $id) {
		//Só atualiza o email se ele não existir
		if($this->existeEmail($email) == false) { 
			$sql = "UPDATE contatos SET nome = :nome, email = :email WHERE id = :id";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(":id", $id);
			$sql->bindValue(":nome", $nome);
			$sql->bindValue(":email", $email);
			$sql->execute();

			return true;
		} else {
			return false;
		}
	}

	public function excluirPeloId($id) {
		$sql = "DELETE FROM contatos WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();
	}

	public function excluirEmail($email) {
		$sql = "DELETE FROM contatos WHERE email = :email";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":email", $email);
		$sql->execute();
	}

	private function existeEmail($email) {
		$sql = "SELECT * FROM contatos WHERE email = :email";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":email", $email);
		$sql->execute();

		if($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}
}