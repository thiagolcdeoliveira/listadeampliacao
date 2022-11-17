<?php
require_once "InterfaceCrianca.php";
require_once "InterfaceBanco.php";

class CrudCrianca {
	//Atributos
	private $banco;
	private $crianca;

	//Metodos

	//Construtor
	public function __construct (InterfaceBanco $banco, InterfaceCrianca $crianca){
		$this->banco = $banco->connect();
		$this->crianca = $crianca;
	}

    
	public function save(){
		if (!empty($this->crianca->getDataCad())){
			
		$sql = "INSERT INTO `crianca` (`nome`, `sobrenome`,`codigo`,`email`,`telefone`,`endereco`, `data_cad`, `data_nasc`, `cpf`,`nome_responsavel`, `turma`, `periodo`, `cei`, `percapita`, `horario_desejado`,`horario_atual`,`renda`,`membros`,`pagamento_pensao`,`gasto_moradia` ) 
		                        VALUES (:nome, :sobrenome, :codigo, :email, :telefone, :endereco, :data_cad,  :data_nasc,   :cpf, :nome_responsavel,  :turma,  :periodo, :cei,   :percapita,   :horario_desejado, :horario_atual, :renda, :membros, :pagamento_pensao, :gasto_moradia )";

		}else{
		$sql = "INSERT INTO `crianca` (`nome`, `sobrenome`,`codigo`,`email`, `telefone`,`endereco`,  `data_nasc`,`data_cad`, `cpf`,`nome_responsavel`, `turma`, `periodo`, `cei`, `percapita`, `horario_desejado`,`horario_atual`,`renda`,`membros`,`pagamento_pensao`,`gasto_moradia` ) 
		                       VALUES (:nome, :sobrenome,  :codigo, :email, :telefone, :endereco,  :data_nasc, now() ,     :cpf,  :nome_responsavel, :turma,  :periodo,  :cei,  :percapita,  :horario_desejado, :horario_atual,  :renda , :membros, :pagamento_pensao, :gasto_moradia )";
		}
		$stmt = $this->banco->prepare($sql);

		$stmt->bindValue(':nome', $this->crianca->getNome());
		$stmt->bindValue(':sobrenome', $this->crianca->getSobrenome());
		$stmt->bindValue(':codigo', $this->crianca->getCodigo());
		$stmt->bindValue(':telefone', $this->crianca->getTelefone());
		$stmt->bindValue(':email', $this->crianca->getEmail());
		$stmt->bindValue(':endereco', $this->crianca->getEndereco());
		$stmt->bindValue(':data_nasc', $this->crianca->getdataNasc());
		$stmt->bindValue(':cpf', $this->crianca->getCpf());
		$stmt->bindValue(':nome_responsavel', $this->crianca->getNomeResponsavel());
		$stmt->bindValue(':turma', $this->crianca->getTurma());
		$stmt->bindValue(':periodo', serialize($this->crianca->getPeriodo()));
		$stmt->bindValue(':cei', $this->crianca->getCei());
		$stmt->bindValue(':percapita', $this->crianca->getPerCapita());
		$stmt->bindValue(':horario_atual', $this->crianca->getHorarioAtual());
		$stmt->bindValue(':horario_desejado', $this->crianca->getHorarioDesejado());
		$stmt->bindValue(':renda', $this->crianca->getRenda());
		$stmt->bindValue(':membros', $this->crianca->getMembros());
		$stmt->bindValue(':pagamento_pensao', $this->crianca->getPagamentoPensao());
		$stmt->bindValue(':gasto_moradia', $this->crianca->getGastoMoradia());
	//	$stmt->bindValue(':confirmado', 0);
		if (!empty($this->crianca->getDataCad())){

		$stmt->bindValue(':data_cad', $this->crianca->getDataCad());
		}

		//echo $sql;
		//echo $stmt->execute();
		$resultado = $stmt->execute();

		if(!$resultado){
			echo "<pre>";
				print_r($stmt->errorInfo());
			echo "</pre>";
			return false;
		} else {
			return $this->banco->lastInsertId();
		}

	}


	public function delete(int $id){
		//sei que não precisa validar. 
		$id = filter_var($id, FILTER_VALIDATE_INT);

		if($id === 0 && !is_int($id) && $id <= 0 && !$id){
			return false;
		}

		$query = "DELETE FROM `crianca` where id = :id";
		$stmt = $this->banco->prepare($query);
		$stmt->bindValue(':id', $id);
		$resultado = $stmt->execute();
		if(!$resultado){
			echo "<pre>";
				print_r($stmt->errorInfo());
			echo "</pre>";
			return false;
		} else {
			return $stmt->rowCount();
		}
	}


	public function update(){
		//sei que não precisa validar. 		
		$id = filter_var($this->crianca->getId(), FILTER_VALIDATE_INT);
		if($id === 0 && !is_int($id) && $id <= 0 && !$id){
			return false;
		}

		$sql = "UPDATE crianca set motivo_desativado = "."'".$this->crianca->getMotivo()."'"." , usuario = ".$this->crianca->getUsuario()." , data_desativado = now() , ativo = 0 
		where id = '".$this->crianca->getId()."'" ;

		$stmt = $this->banco->prepare($sql);
		//echo $sql;
	
         
		$resultado = $stmt->execute();
		//echo $resultado;
		if(!$resultado){
			echo "<pre>";
				print_r($stmt->errorInfo());
			echo "</pre>";
			return false;		
		} else {
			return $resultado;
		}

	}
	public function updateStatus(){
		//sei que não precisa validar. 		
		$id = filter_var($this->crianca->getId(), FILTER_VALIDATE_INT);
		if($id === 0 && !is_int($id) && $id <= 0 && !$id){
			return false;
		}

		$sql = "UPDATE crianca set confirmado = ".$this->crianca->getConfirmado().
		",  renda = ".$this->crianca->getRenda().
		",  percapita = ".$this->crianca->getPerCapita().
		",  pagamento_pensao = ".$this->crianca->getPagamentoPensao().
		",  gasto_moradia = ".$this->crianca->getGastoMoradia().
		",  membros = ".$this->crianca->getMembros().
		",  motivo_negado = '".$this->crianca->getMotivoNegado().
		"' , usuario = ".$this->crianca->getUsuario()."  
		where id = '".$this->crianca->getId()."'" ;

		$stmt = $this->banco->prepare($sql);
		//echo $sql;
	
         
		$resultado = $stmt->execute();
		//echo $resultado;
		if(!$resultado){
			echo "<pre>";
				print_r($stmt->errorInfo());
			echo "</pre>";
			return false;		
		} else {
			return $resultado;
		}

	}


    
	public function list($value=0,$data_inicio=0,$data_fim=0){
		$filtro='';
		if ($value > 0 ) {
           $filtro = " and cei=".$value;
		   if ($data_inicio != 0){
			
			//$data_inicio = DateTime::createFromFormat('Y-m-d', $data_inicio);
		   
			
			//$filtro = $filtro. " and data_cad >= DATE(". $data_inicio->format('d-m-Y').")";
			$filtro = $filtro. " and data_cad >= '". $data_inicio." 00:00:00'";
		}
			if ($data_fim != 0){
				//$data_fim = DateTime::createFromFormat('Y-m-d', $data_fim);
				//$filtro = $filtro. " and data_cad <= DATE(". $data_fim->format('d-m-Y').")";
				$filtro = $filtro. " and data_cad <= '". $data_fim."  59:59:59'";
				
		 }
		}
		$sql = "SELECT * FROM `crianca` ";
		$sql = "select *, CASE turma
		WHEN '5'     THEN     'Berçário 1'
		WHEN '1'     THEN     'Berçário 2'
		WHEN '2'     THEN     'Maternal'
		WHEN '3'     THEN     'Jardim'
		WHEN '4'     THEN     'Pré 1'
		WHEN '0'     THEN     'Berçário 1'
		ELSE 'erro' END as turma
        from crianca where ativo = 1 
		 $filtro order by percapita";
		echo $sql;
		$stmt = $this->banco->prepare($sql);
		$stmt->execute();
		$arraycrianca = array();

		foreach ( $stmt->fetchAll(PDO::FETCH_ASSOC) as $value){
			$crianca = new Crianca();
			$crianca->setId($value["id"])->setNome($value["nome"])->setSobrenome($value["sobrenome"])->setTurma($value["turma"])->
			setCei($value["cei"])->setHorarioAtual($value["horario_atual"])->setHorarioDesejado($value["horario_desejado"])->
			setPagamentoPensao($value["pagamento_pensao"])->setGastoMoradia($value["gasto_moradia"])->setConfirmado($value["confirmado"])->setPerCapita($value["percapita"])->setCpf($value["cpf"])->setDataNasc($value["data_nasc"])->setEmail($value["endereco"])->
			setMotivoNegado($value["motivo_negado"])->setNomeResponsavel($value["nome_responsavel"])->setPeriodo(unserialize($value["periodo"]))->setTelefone($value["telefone"])->
			setCodigo($value["codigo"])->setDataCad($value["data_cad"])->setStatus($value["ativo"]);
			array_push($arraycrianca,$crianca);
	    }
		return $arraycrianca;
	}

	public function listAtivos(){
		$sql = "SELECT * FROM `crianca` ";
		$sql = "select *, CASE turma
		WHEN '5'     THEN     'Berçário 1'
		WHEN '1'     THEN     'Berçário 2'
		WHEN '2'     THEN     'Maternal'
		WHEN '3'     THEN     'Jardim'
		WHEN '4'     THEN     'Pré 1'
		WHEN '0'     THEN     'Berçário 1'
		ELSE 'erro' END as turma
        from crianca where ativo = 1 order by id";
		$stmt = $this->banco->prepare($sql);
		$stmt->execute();
		$arraycrianca = array();

		foreach ( $stmt->fetchAll(PDO::FETCH_ASSOC) as $value){
			$crianca = new Crianca();
			$crianca->setId($value["id"])->setNome($value["nome"])->setSobrenome($value["sobrenome"])->setTurma($value["turma"])->
			setCei($value["cei"])->setCpf($value["cpf"])->setDataNasc($value["data_nasc"])->setEmail($value["endereco"])->
			setPagamentoPensao($value["pagamento_pensao"])->setGastoMoradia($value["gasto_moradia"])->setNomeResponsavel($value["nome_responsavel"])->setPeriodo(unserialize($value["periodo"]))->setTelefone($value["telefone"])->
			setCodigo($value["codigo"])->setDataCad($value["data_cad"])->setStatus($value["ativo"]);
			array_push($arraycrianca,$crianca);
	    }
		return $arraycrianca;
	}
	public function listAtivosPorCei($value=0){
		$filtro='';
		if ($value > 0 ) {
           $filtro = " and cei=".$value;
		}
		$sql = "SELECT * FROM `crianca` ";
		$sql = "select *, CASE turma
		WHEN '5'     THEN     'Berçário 1'
		WHEN '1'     THEN     'Berçário 2'
		WHEN '2'     THEN     'Maternal'
		WHEN '3'     THEN     'Jardim'
		WHEN '4'     THEN     'Pré 1'
		WHEN '0'     THEN     'Berçário 1'
		ELSE 'erro' END as turma
        from crianca where ativo = 1 
		 $filtro order by percapita";
		//echo $sql;
		$stmt = $this->banco->prepare($sql);
		$stmt->execute();
		$arraycrianca = array();

		foreach ( $stmt->fetchAll(PDO::FETCH_ASSOC) as $value){
			$crianca = new Crianca();
			$crianca->setId($value["id"])->setNome($value["nome"])->setSobrenome($value["sobrenome"])->setTurma($value["turma"])->
			setCei($value["cei"])->setHorarioAtual($value["horario_atual"])->setHorarioDesejado($value["horario_desejado"])->
			setConfirmado($value["confirmado"])->setPagamentoPensao($value["pagamento_pensao"])->setGastoMoradia($value["gasto_moradia"])->setPerCapita($value["percapita"])->setCpf($value["cpf"])->setDataNasc($value["data_nasc"])->setEmail($value["endereco"])->
			setMotivoNegado($value["motivo_negado"])->setNomeResponsavel($value["nome_responsavel"])->setPeriodo(unserialize($value["periodo"]))->setTelefone($value["telefone"])->
			setCodigo($value["codigo"])->setDataCad($value["data_cad"])->setStatus($value["ativo"]);
			array_push($arraycrianca,$crianca);
	    }
		return $arraycrianca;
	}
	public function find(int $id){
		//sei que não precisa validar. 
		$id = filter_var($id, FILTER_VALIDATE_INT);
		$sql = "SELECT * FROM `crianca` where id = :id";
		$crianca = new Crianca();
		$stmt = $this->banco->prepare($sql);
		$stmt->bindValue(':id', $id);
		$resultado = $stmt->execute();
		if(!$resultado){
			echo "<pre>";
				print_r($stmt->errorInfo());
			echo "<;pre>";
			return false;
		} else {
			foreach ( $stmt->fetchAll(PDO::FETCH_ASSOC) as $value){
				$crianca = new Crianca();
				$crianca->setId($value["id"])->setNome($value["nome"])->setSobrenome($value["sobrenome"])->setTurma($value["turma"])->
				setCei($value["cei"])->setRenda($value["renda"])->setMembros($value["membros"])->setHorarioAtual($value["horario_atual"])->setHorarioDesejado($value["horario_desejado"])->
				setPagamentoPensao($value["pagamento_pensao"])->setGastoMoradia($value["gasto_moradia"])->setMotivoNegado($value["motivo_negado"])->setConfirmado($value["confirmado"])->setPerCapita($value["percapita"])->setCpf($value["cpf"])->setDataNasc($value["data_nasc"])->setEmail($value["endereco"])->
				setNomeResponsavel($value["nome_responsavel"])->setPeriodo(unserialize($value["periodo"]))->setTelefone($value["telefone"])->
				setCodigo($value["codigo"])->setDataCad($value["data_cad"])->setStatus($value["ativo"]);
			}
			return $crianca;
		}

	}

}