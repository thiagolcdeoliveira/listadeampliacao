<?php
require_once "InterfaceCrianca.php";

class Crianca implements InterfaceCrianca {

	//Atributos
	private $id;
	private $codigo;
	private $nome;
	private $sobrenome;
	private $telefone;
	private $email;
	private $data_nasc;
	private $data_cad;
	private $cpf;
	private $nome_responsavel;
	private $turma;
	private $periodo;
	private $cei;
	private $motivo_negado;
	private $endereco;
	private $percapita;
	private $renda;
	private $membros;
	private $confirmado;
	private $horario_atual;
	private $horario_desejado;
	private $gasto_moradia;
	private $pagamento_pensao;
	private $status;
	private $motivo;
	private $data_desativacao;





	//Setters
	public function setId(int $id){
		$this->id = $id;
		return $this;

	}
	public function setCodigoGerar(){
		$codigo = strtoupper (substr($this->getNome(), 0,1)); 
		$codigo = $codigo.strtoupper (substr($this->getSobrenome(), 0,1)); 
		$codigo = $codigo.strtoupper (substr($this->getNomeResponsavel(), 0,1)); 
		//$codigo = $codigo.strtoupper (substr($this->getNomeResponsavel(), -1)); 
		$data = date('dmY');
		$codigo = $codigo.$data; 
		$codigo = $codigo.$this->getTurma(); 
		$codigo = str_replace(" ",'',$codigo);
		$this->codigo = strtoupper ($codigo);
		return $this;

	}
	public function setCodigo($codigo){
		$this->codigo = $codigo;
		return $this;

	}

	public function setNome($nome){
		$this->nome = $nome;
		return $this;
	}

	public function setSobrenome($sobrenome){
		$this->sobrenome = $sobrenome;
		return $this;



	}

	
	public function setTelefone($telefone){
		$this->telefone = $telefone;
		return $this;

	}
	public function setEmail($email){
		$this->email = $email;
		return $this;

	}


	public function setDataNasc($data_nasc){
		$this->data_nasc = $data_nasc;
		return $this;


	}
	public function setDataCad($data_cad){
		$this->data_cad = $data_cad;
		return $this;


	}

	public function setCpf($cpf){
		$this->cpf = $cpf;
		return $this;


	}


	public function setNomeResponsavel($nome_responsavel){
		$this->nome_responsavel = $nome_responsavel;
		return $this;


	}


	public function setTurma($turma){
		$this->turma = $turma;
		return $this;


	}


	public function setPeriodo($periodo){
		$this->periodo = $periodo;
		return $this;


	}



	public function setValidade($validade){
		$this->validade = $validade;
		return $this;


	}


	public function setCei($cei){
		$this->cei = $cei;
		return $this;


	}
	public function setMotivoNegado($motivo_negado){
		$this->motivo_negado = $motivo_negado;
		return $this;


	}

	public function setEndereco($endereco){
		$this->endereco = $endereco;
		return $this;


	}
	public function setRenda($renda){
		$this->renda = $renda;
		return $this;


	}
	public function setMembros($membros){
		$this->membros = $membros;
		return $this;


	}

	public function setHorarioAtual($horario_atual){
		$this->horario_atual = $horario_atual;
		return $this;


	}

	public function setHorarioDesejado($horario_desejado){
		$this->horario_desejado = $horario_desejado;
		return $this;


	}


	public function setPerCapita($percapita){
		$this->percapita = $percapita;
		return $this;

	}

	public function setConfirmado($confirmado){
		$this->confirmado = $confirmado;
		return $this;

	}
	public function setStatus(int $status){
		$this->status = $status;
		return $this;

	}


	public function setMotivo($motivo){
		$this->motivo = $motivo;
		return $this;

	}
	public function setUsuario($usuario){
		$this->usuario = $usuario;
		return $this;

	}
	public function setDataDesativacao($data_desativacao){
		$this->data_desativacao = $data_desativacao;
		return $this;

	}




	//Getters

	public function getNome(){

		return $this->nome;
	}


	public function getId(){
		return $this->id;


	}
	public function getCodigo(){
		return $this->codigo;


	}
	public function getSobrenome(){

		return $this->sobrenome;

	}

	public function getEmail(){
		return $this->email;


	}


	public function getTelefone(){
		return $this->telefone;


	}


	public function getDataNasc(){
		return $this->data_nasc;


	}

	public function getDataCad(){
		return $this->data_cad;


	}

	public function getCpf(){
		return $this->cpf;


	}


	public function getNomeResponsavel(){
		return $this->nome_responsavel;


	}
	public function getNomeResponsavelMask(){
		$codigo = strtoupper (substr($this->getNomeResponsavel(), 0,1)); 
		$codigo = strtoupper ($codigo."***".substr($this->getNomeResponsavel(), -1)); 
		return $codigo;


	}

	public function getTurma(){
		return $this->turma;


	}


	public function getPeriodo(){
		return $this->periodo;


	}


	public function getPesoBruto(){
		return $this->pesoBruto;


	}


	public function getValidade(){
		return $this->validade;


	}


	public function getCei(){
		return $this->cei;


	}

	public function getMotivoNegado(){
		return $this->motivo_negado;


	}


	public function getEndereco(){
		return $this->endereco;


	}

	public function getRenda(){
		return $this->renda;


	}



	public function getPagamentoPensao(){
		return $this->pagamento_pensao;
	}

	public function getGastoMoradia(){
		return $this->gasto_moradia;
	}




	public function getMembros(){
		return $this->membros;


	}

	public function getAllCeis(){
		$ceis="";
		
				switch ($this->cei) {
					case 1:
						$cei = "Antenor Sprotte";
						break;
					case 2:
						$cei =  "Branca de Neve";
						break;
					case 3:
						$cei =  "Bruno de Magalhães";
						break;
					case 4:
						$cei =  "Cantinho da Vovó Justina";
						break;
					case 5:
						$cei =  "Cinderela";
						break;
					case 6:
						$cei =  "Criança Bela";
						break;
					case 7:
						$cei =  "Heley de Abreu";
						break;
					case 8:
						$cei =  "João Geraldo Correa";
						break;
					case 9:
						$cei =  "João Ignácio Filho";
						break;
					case 11:
						$cei =  "João Luiz do Rosário";
						break;
					case 12:
						$cei =  "João Serafim";
						break;
					case 13:
						$cei =  "Lindolpho José da Silva";
						break;
					case 14:
						$cei =  "Pequeno Anjo";
						break;
					case 15:
						$cei =  "Pequeno Principe";
						break;
					case 16:
						$cei =  "Professora Janaina";
						break;
					case 17:
						$cei =  "Marise Travasso";
						break;
					case 18:
						$cei =  "Santo Antônio";
						break;
					case 19:
						$cei =  "Vovó Brandina";
						break;
					case 20:
						$cei =  "Vovó Maria de Lurdes Max";
						break;
				}
		
  		return $cei;


	}

	public function getHorarioAtual(){


		

		return $this->horario_atual;


	}

	public function getHorarioAtualDescricao(){


		switch ($this->horario_atual) {
			case 1:
				$horario_atual = "7h às 13h";
				break;
			case 2:
				$horario_atual =  "12h às 18h";
				break;
			default:
				$horario_atual =  "---";
				break;
	
		}


		return $horario_atual;


	}

	public function getHorarioDesejado(){

	//	$this->horario_desejado
	
	return $this->horario_desejado;


}
	public function getHorarioDesejadoDescricao(){

			switch ($this->horario_desejado) {
					case 1:
						$horario_desejado = "7h às 15h";
						break;
					case 2:
						$horario_desejado =  "8h às 16h";
						break;
					case 3:
						$horario_desejado =  "9h às 17h";
						break;
					default :
						$horario_desejado =  "---";
						break;
			
				}
		
		return $horario_desejado;


	}
	public function getPerCapita(){
		return $this->percapita;


	}
	public function getConfirmado(){
		return $this->confirmado;


	}
	public function getAllPeriodo(){
		$periodos="";
		foreach ($this->periodo as $key => $value){
				switch ($value) {
					case 1:
						$periodo = "Matutino";
						break;
					case 2:
						$periodo =  "Vespetino";
						break;
					case 3:
						$periodo =  "Integral";
						break;
					
				}
				$periodos= $periodos." *".$periodo;
	}
  		return $periodos;


	}
	public function getStatus(){
		return $this->status;

	}
	public function getMotivo(){
		return $this->motivo;

	}
	public function getUsuario(){
		return $this->usuario;

	}
	public function getDataDesativacao(){
		return $this->data_desativacao;

	}
}