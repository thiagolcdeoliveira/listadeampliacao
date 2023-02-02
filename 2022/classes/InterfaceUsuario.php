<?php

interface InterfaceUsuario {

	//metodos	

	//Setters
	public function setId(int $id);
	public function setNome($nome);
	public function setSenha($senha);
	public function setSobrenome($sobrenome);
	public function setCpf($cpf);
	public function setEmail($email);
	public function setStatus($status);
	



	//Getters
	public function getId();
	public function getNome();
	public function getSenha();
	public function getSobrenome();
	public function getCpf();
	public function getEmail();
	public function getStatus();
	


}