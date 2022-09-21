<?php
require_once "InterfaceUsuario.php";
require_once "InterfaceBanco.php";

class CrudUsuario {
	//Atributos
	private $banco;
	private $usuario;

	//Metodos

	//Construtor
	public function __construct (InterfaceBanco $banco, InterfaceUsuario $usuario){
		$this->banco = $banco->connect();
		$this->usuario = $usuario;
	}

    
	public function save(){


	}


	public function delete(int $id){
		
	}


	public function update(){
	

	}

    
	public function list(){
	
	}

	public function listAtivos(){
	
	}

	public function find( ){
	

	}

	public function validalogin($email,$senha){
		//echo $email;
		//echo $senha;
		$sql = "select * from usuario where  email = '". $email . "' and senha = '".$senha."'";
		//echo $sql;
		$stmt = $this->banco->prepare($sql);
		$stmt->execute();

		$value = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$usuario = new Usuario();
		if (!empty($value )){
		$value = $value[0];
		//print_r ($value);
		$value["id"] = intval($value["id"]);
		$usuario->setId($value["id"])->setNome($value["nome"])->setSobrenome($value["sobrenome"])->setCpf($value["cpf"])->setStatus($value["status"]);
		}
		return $usuario;
	}

}