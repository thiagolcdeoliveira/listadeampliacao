<?php

function getAllCeisInverso($ceisArray){
  $ceis=[];
  foreach ($ceisArray as $key => $value){
    $value = str_replace(" ", "", $value); 

    $cei="";
    echo ($value);
      switch ($value) {
        case "AntenorSprotte":
          $cei = 1;
          break;
        case "BrancadeNeve":
          $cei =  2;
          break;
        case "BrunodeMagalhães":
          $cei =  3;
          break;
        case "CantinhodaVovóJustina":
          $cei =  4;
          break;
        case "Cinderela":
          $cei = 5 ;
          break;
        case "CriançaBela":
          $cei =  6;
          break;
        case "HeleydeAbreu":
          $cei = 7 ;
          break;
        case "JoãoGeraldoCorrea":
          $cei = 8 ;
          break;
        case "JoãoIgnácioFilho":
          $cei =  9;
          break;
        case "JoãoLuizdoRosário":
          $cei =  11;
          break;
        case "JoãoSerafim":
          $cei =  12;
          break;
        case "LindolphoJosédaSilva":
          $cei =  13;
          break;
        case "PequenoAnjo":
          $cei =  14;
          break;
        case "PequenoPrincipe":
          $cei =  15;
          break;
        case "ProfessoraJanaina":
          $cei =  16;
          break;
        case "ProfessoraMariseTravasso":
          $cei =  17;
          break;
        case "SantoAntônio":
          $cei =  18;
          break;
        case  "VovóBrandina":
          $cei =  19;
          break;
        case "VovóMariadeLurdesMax":
          $cei =  20;
          break;
          default:
          $cei =  21;
          break;

          }
          array_push ($ceis,$cei);

     }
     print_r($ceis);
    return $ceis;


}

function getAllPeriodoInverso($periodoArray){
  $periodos=[];
  //var_dump($periodoArray);
  foreach ($periodoArray as $key => $value){
    echo ($value);
    $value = str_replace(" ", "", $value); 

          switch ($value) {
            case "Matutino":
              $periodo = 1;
              echo "- 1";
              break;
            case "Vespertino":
              $periodo =  2;
              echo "- 2";

              break;
              case "Integral":
                $periodo =  3 ;
                echo "- 3";

                break; 
              default:
                  $periodo =  4 ;
                  echo "- 4";

                  break;

          }
          echo("</br>");
          array_push ($periodos,$periodo);
    
   
    
      //echo $periodo;
     // array_push ($periodos,$periodos1);
     // $periodos1=[];

}
echo("</br>");
    print_r($periodos);
    return $periodos;


}

function getAllTurmaInverso($turmaString){
  $truma="";
  //var_dump($periodoArray);
    echo($turmaString);
    $turmaString = str_replace(" ", "", $turmaString); 

          switch ($turmaString) {
            case "Berçário1(4mesesa11meses)":
              $periodo = 0;
              echo "- 0";
              break;
            case "Berçário2(1anoa1anoe11meses)":
              $periodo =  1;
              echo "- 1";

              break;
              case "Maternal(2anosa2anose11meses)":
                $periodo =  2 ;
                echo "- 2";

                break; 
              
              case "Jardim(3anosa3anose11meses)":
                $periodo =  3 ;
                echo "- 3";

              break; 
                
              case "Pré1(4anosa4anose11meses)":
                $periodo =  4 ;
                echo "- 4";

              break; 
              default:
                  $periodo =  5 ;
                  echo "- 5";

                  break;

          }
          echo("</br>");
  echo ($periodo);
    return $periodo;


}

require_once "../classes/Banco.php";
require_once "../classes/Crianca.php";
require_once "../classes/CrudCrianca.php";
require_once "../classes/Container.php";

$conn = Container::getBanco();

$handle = fopen("people.csv", "r");
$row = 0;
while ($line = fgetcsv($handle, 1000, ",")) {
	if ($row++ == 0) {
		continue;
	}
	
	$people[] = [
		'data' => $line[0],
		'nome' => explode(" ",$line[1])[0],
		'sobrenome' => explode(explode(" ",$line[1])[0],$line[1])[1],
		'data_nasc' => $line[2],
    'cpf' => $line[3],
    'nome_responsavel' => $line[4],
    'telefone' => $line[5],
    'turma' =>  $line[6],
    'periodo' => explode(",",$line[7]),
    'cei' =>  explode(",",$line[8]),  
	];
}

//print_r($people);
//var_dump($people);


foreach ($people as $result) {


$nome = $result["nome"];
$sobrenome = $result["sobrenome"]; 
$turma = getAllTurmaInverso($result["turma"]);
$cei = getAllCeisInverso($result["cei"]);
$cpf = $result["cpf"];
$data_nasc = $result["data_nasc"];
$nome_resposanvel = $result["nome_responsavel"];
$periodo = getAllPeriodoInverso($result["periodo"]);
$data_cad = $result["data"];
$data_cad = DateTime::createFromFormat('d/m/Y H:i:s', $data_cad ); 
$data_cad = $data_cad->format('Y-m-d H:i:s');
$telefone = $result["telefone"];
$email = $telefone;
echo $data_cad;
//26/03/2021 10:35:21
//'Y-m-d H:i:s'
//echo $result['data'] ; 
//print_r($result);
echo "<br>";
//var_dump($result);

$crianca1 = new Crianca;
$crianca1->setNome($nome)->setSobrenome($sobrenome)->setTurma($turma)->setCei($cei)->
setCpf($cpf)->setDataNasc($data_nasc)->setNomeResponsavel($nome_resposanvel)->
setPeriodo($periodo)->setDataCad($data_cad)->setCodigoGerar();

if (strstr($email, '@')){
  $crianca1->setEmail($email);
}else{
  $crianca1->setTelefone($telefone);
  //echo $telefone;
}



$crianca = new CrudCrianca($conn, $crianca1);
$id = $crianca->save();
echo "Usuario"." ".$id."Adiconado com Sucesso";


}







