<?php
class Contato {

	private $pdo;

	//Conecção com banco
	public function __construct() {
		$this->pdo = new PDO("mysql:dbname=crud_oo;host=localhost", "root", "");

	}

	public function adiconar($email, $nome = '') {//Nome é opcional
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

	public function getNome($email) {
		$sql = "SELECT nome FROM contatos WHERE email = :email";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":email", $email);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$info = $sql->fetch();

			return $info['nome'];
		} else {
			return '';
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

	public function editar($nome, $email) {
		//Veririficar se o email existe
		if($this->existeEmail($email) == true) {
			$sql = "UPDATE contatos SET nome = :nome WHERE email = :email";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(":email", $email);
			$sql->bindValue(":nome", $nome);
			$sql->execute();

			return true;
		} else {
			return false;
		}
	}

	public function excluir($email) {
		if($this->existeEmail($email)) {
			$sql = "DELETE FROM contatos WHERE email = :email";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(":email", $email);
			$sql->execute();

			return true;
		} else {
			return false;
		}
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