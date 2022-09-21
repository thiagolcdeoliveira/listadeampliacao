<?php
require_once "InterfaceUsuario.php";

class Usuario implements InterfaceUsuario {

	//Atributos
	private $id;
	private $nome;
	private $sobrenome;
	private $email;
	private $senha;
	private $cpf;
	private $status;





	//Setters
	public function setId(int $id){
		$this->id = $id;
		return $this;

	}


	public function setNome($nome){
		$this->nome = $nome;
		return $this;
	}
	public function setSenha($senha){
		$this->senha = $senha;
		return $this;
	}

	public function setSobrenome($sobrenome){
		$this->sobrenome = $sobrenome;
		return $this;



	}

	
	public function setEmail($email){
		$this->email = $email;
		return $this;

	}



	public function setCpf($cpf){
		$this->cpf = $cpf;
		return $this;


	}




	public function setStatus($status){
		$this->status = $status;
		return $this;

	}








	//Getters

	public function getNome(){

		return $this->nome;
	}


	public function getId(){
		return $this->id;


	}
	public function getSobrenome(){

		return $this->sobrenome;

	}
	public function getSenha(){

		return $this->senha;

	}
	public function getEmail(){
		return $this->email;


	}


	public function getCpf(){
		return $this->cpf;


	}



	
	public function getStatus(){
		return $this->status;

	}
}