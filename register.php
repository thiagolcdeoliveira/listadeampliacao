<?php require_once "header.php" ?>




<div class="ui vertical stripe segment">
    <div class="ui grid container">
 

<?php 
$conn = Container::getBanco();

if (!empty($_POST)){
      if( array_key_exists('turma', $_POST ) == 1 and 
          array_key_exists('periodo', $_POST ) == 1 and
           array_key_exists('cei', $_POST ) == 1  and 
           array_key_exists('nome', $_POST ) == 1  and 
           array_key_exists('horarioAtual', $_POST ) == 1  and 
           array_key_exists('horarioDesejado', $_POST ) == 1  and 
           array_key_exists('renda', $_POST ) == 1  and 
           array_key_exists('membros', $_POST ) == 1  and 
           (array_key_exists('email', $_POST ) == 1  or 
           array_key_exists('telefone', $_POST ) == 1   or 
           array_key_exists('endereco', $_POST ) == 1  
           ) ){
            if($_POST["membros"]>0){
            $nome = $_POST["nome"];
          $sobrenome = $_POST["sobrenome"]; 
          $turma = $_POST["turma"];
          $cei =  $_POST["cei"];
          $cpf = $_POST["cpf"];
          $data_nasc = $_POST["data_nasc"];
          $renda = $_POST["renda"];
          $membros = $_POST["membros"];
          $horario_atual = $_POST["horarioAtual"];
          $horario_desejado = $_POST["horarioDesejado"];
          $percapita = $renda /  $membros;
         // $email = $_POST["email"];
          $endereco = $_POST["endereco"];
          $nome_resposanvel = $_POST["nome_responsavel"];
          $periodo = $_POST["periodo"];
      if (!empty($nome) and !empty($sobrenome) and !empty($turma) and !empty($cei) and  !empty($cpf)) {
          $crianca1 = new Crianca;
          $crianca1->setNome($nome)->setSobrenome($sobrenome)->setTurma($turma)->setCei($cei)->
          setCpf($cpf)->setRenda($renda)->setMembros($membros)->setDataNasc($data_nasc)->setNomeResponsavel($nome_resposanvel)->
          setEndereco($endereco)->setHorarioAtual($horario_atual)->setHorarioDesejado($horario_desejado)->setPerCapita($percapita)->
          setPeriodo($periodo)->setCodigoGerar();
          $crianca = new CrudCrianca($conn, $crianca1);
          $id = $crianca->save();
      }
        }
      
    }else {
    $erro = 1;}
  }
?>
                       
                           <?php   if  (!empty($id)) {?>
                            <div class="ui message success">
                              <div class="header">
                              Cadastro realizado com sucesso.
                              </div>
                              <ul class="list">
                                <p class="">Por segurança e para manter a privacidade da sua criança, o nome de nenhuma criança consta na lista de espera pública. 
                                                          Para identificar a posição da sua criança procure pelo código <span class="negrito"> <?php echo $crianca1->getCodigo();?> 
                                                  
                                 <a href="/?cei=<?php echo $cei_cod; ?>">Clique aqui para consultar a lista</a>
                              </ul>
                            </div>
                            <?php   } else { if (!empty($erro)){?>

                              <div class="ui message danger">
                              <div class="header">
                              Cadastro não realizado
                              </div>
                              <ul class="list">
                              <p class="">Dados Obrigatorios Ficaram Falatando, Por favor preencha todos os campos. </span>

                              </ul>
                            </div>
                          
                           <?php  }
                          }?>




<form class="ui form" action="register.php?cei=<?php echo $cei_cod; ?>" method="POST">
<h3 class="ui dividing header">Ampliação de Caraga Horaria Para CEI: <?php echo $cei_nome;  ?></h4>
  <div class="field">
    <label>Name</label>
    <div class="two fields">
      <div class="field">
        <input type="text"  name="nome" placeholder="Nome da Criança" required>
      </div>
      <div class="field">
        <input type="text"  name="sobrenome" placeholder="Sobrenome da Criança" required>
      </div>
    </div>
  </div>
 
  <div class="field">
    
    <div class="two fields">
      <div class="field">
      <label>Data Nascimento</label>
        <input type="Date"   name="data_nasc"   oninput="mascaradata(this)" 
                                        placeholder="Data de Nascimento" required>
      </div>
      <div class="field">
      <label>CPF</label>
        <input type="text"  name="cpf" oninput="mascara(this)" 
                                         
                required title="O formato do seu CPF está incorreto. Por favor, corriga seguindo o padrão com os pontos e traços."
                pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"  minlength="14"   maxlength="14"    placeholder="CPF da Criança" required>
      </div>
    </div>
  </div>                  
  <div class="field">
    <label>Responsavel</label>
    <div class="two fields">     

      <div class="field">
        <input type="text"   name="nome_responsavel"   oninput="mascaradata(this)" 
                                        placeholder="Nome do Responsavel" required>
      </div>
      <div class="field">
      <div class="ui checkbox ">
              <input type="checkbox" name="permitir[]" value="1" id="permitir"   title="Desculpa, mas se o compartilhamento dos dados não podemos adicionar a criança a lista de espera." required oninvalid="this.setCustomValidity(\'Desculpa, mas se o compartilhamento dos dados não podemos adicionar a criança a lista de espera\')">
              <label for="permitir" >Se você (o responsavel pela criança) permite o compartilhamento dos seus dados e dos dados da criança com a Prefeitura Municpal de Araquari, marque essa opção. </label>
            </div>
      </div>       </div>
   
  </div>                              

  <div class="field">
    <label>Endereço</label>
      <div class="field">
          <input type="text"   name="endereco"  placeholder="Endereço" >
      </div>
  </div>       
  
  
  <hr class="ui dividing header"> 

  <div class="field" id="turma" >
    <div class="two fields">
        <div class=" field">
            <label>Turma em deseja vaga*</label>
            <div class="two fields">
              <div class=" field">
                  <div class="ui radio checkbox">
                    <input type="radio" name="turma" value="5" id="turma1">
                    <label  for="turma1" > Berçário 1 (4 meses a 11 meses)</label>
                </div>
                <div class="ui radio checkbox">
                    <input type="radio" name="turma" value="1" id="turma2">
                    <label  for="turma2" > Berçário 2 (1 ano a 1 ano e 11 meses) </label>
                </div>
                <div class="ui radio checkbox">
                    <input type="radio" name="turma" value="2" id="turma3">
                    <label  for="turma3"> Maternal (2 anos a 2 anos e 11 meses)</label>
                </div>
              </div>
              <div class=" field">
                <div class="ui radio checkbox">
                    <input type="radio" name="turma" value="3" id="turma4">
                    <label  for="turma4">Jardim ( 3 anos a 3 anos e 11 meses)</label>
                </div>
                <div class="ui radio checkbox">
                    <input type="radio" name="turma" value="4" id="turma5">
                    <label  for="turma5"> Pré  1 (4 anos a 4 anos e 11 meses)</label>
                </div> 
              </div> 
              </div> 
              </div> 
            <div class="field">
            <label >Período Desejado*</label>
            <div class="ui relaxed divided list">
              <div class="item">
                <div class="ui checkbox ">
                  <input type="checkbox" name="periodo[]" value="1" id="periodo1">
                  <label for="periodo1" >Matutino</label>
                </div>
              </div>
              <div class="item">
                <div class="ui checkbox ">
                  <input type="checkbox" name="periodo[]" value="2" id="periodo2">
                  <label for="periodo2" >Vespertino</label>
                </div>
              </div>
              <!--<div class="item">
                <div class="ui checkbox ">
                  <input type="checkbox" name="periodo[]" value="3" id="periodo3">
                  <label for="periodo3">Integral</label>
                </div>
              </div>-->
            </div>
          </div>
        </div>
       </div>
 

       <hr class="ui dividing header"> 

<div class="field" id="horarioAtual" >
  <div class="two fields">
    <div class="field" id="turma" >
        <label>Horário Atual</label>
        <div class="item">
            <div class="ui  radio checkbox">
              <input type="radio"  name="horarioAtual" id="hoararioAtual2" value="1" >
              <label for="hoararioAtual2">7h às 13h</label>
            </div>
        </div>
        <div class="item">
            <div class="ui  radio checkbox">
              <input type="radio"  name="horarioAtual" id="hoararioAtual3" value="2" >
              <label for="hoararioAtual3">12h às 18h</label>
            </div>
        </div>
      </div>
      <div class="field">
          <label >Horário Desejado</label>
          <div class="item">
            <div class="ui  radio checkbox">
              <input type="radio"  name="horarioDesejado" id="hoararioDesejado2" value="1" >
              <label for="hoararioDesejado2">7h às 15h</label>
            </div>
        </div>
        <div class="item">
            <div class="ui  radio checkbox">
              <input type="radio"  name="horarioDesejado" id="hoararioDesejado3" value="2" >
              <label for="hoararioDesejado3">8h às 16h</label>
            </div>
        </div>
        <div class="item">
            <div class="ui  radio checkbox">
              <input type="radio"  name="horarioDesejado" id="hoararioDesejado4" value="3" >
              <label for="hoararioDesejado4">9h às 17h</label>
            </div>
        </div>

          </div>
         
        </div>
      </div>

        <hr class="ui dividing header"> 

<div class="field" id="turma" >
  <div class="three fields">
    <div class="field" id="turma" >
        <label>CEIs Desejados</label>
        <div class="item">
            <div class="ui  radio checkbox">
              <input type="radio"  name="cei" id="cei2" value="<?php echo $cei_cod; ?>" checked>
              <label for="cei2"> <?php echo $cei_nome; ?></label>
            </div>
        </div>
                        </div>
          <div class="field">
          <label >Renda Familiar</label>
          <input type="number" step="0.01" name="renda" min="0.01" placeholder="Renda Familiar" required>

          </div>
          <div class="field">
          <label >Quantas Pessoas Moram na Casa? </label>
          <input type="number"  name="membros" placeholder="Membros" required>

          </div>
        </div>
      </div>
    
                        
                          
                        <div class="ui buttons fluid">
                                <a  class="ui button secondary " href="/">
                                   Cancelar
                                </a>
                                <button type="submit" class="ui button ">
                                   Salvar
                                </button>
                        </div>
                              
                            </form>
                        </div>
                        </div>
                        
                        </div>
              
        <?php require_once "footer.php" ?>
