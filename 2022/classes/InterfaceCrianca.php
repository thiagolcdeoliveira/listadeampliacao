<?php

interface InterfaceCrianca {

	//metodos	

	//Setters
	public function setId(int $id);
	public function setNome($nome);
	public function setSobrenome($sobrenome);
	public function setCodigo($codigo);
	public function setDataNasc($data_nasc);
	public function setCpf($cpf);
	public function setEmail($email);
	public function setTelefone($telefone);
	public function setNomeResponsavel($nome_reponsavel);
	public function setTurma($turma);
	public function setPeriodo($periodo);
	public function setCei($cei);
	public function setStatus(int $status);
	public function setMotivo($motivo);
	public function setUsuario($usuario);


	//Getters
	public function getId();
	public function getNome();
	public function getSobrenome();
	public function getCodigo();
	public function getDataNasc();
	public function getCpf();
	public function getEmail();
	public function getTelefone();
	public function getNomeResponsavel();
	public function getTurma();
	public function getPeriodo();
	public function getCei();
	public function getStatus();
	public function getMotivo();
	public function getUsuario();

}