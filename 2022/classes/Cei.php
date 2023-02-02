<?php

class Cei  {

	//Atributos
	private $id;
	



	//Setters
	public function setId(int $id){
		$this->id = $id;
		return $this;

	}



	public function getId(){
		return $this->id;


	}
	public function getCodCei($value){
		return $value;


	}
	
	public function getNomeCei($value){
            $value = $value;
          
            $cei = "erro";
			switch ($value) {
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
	
}