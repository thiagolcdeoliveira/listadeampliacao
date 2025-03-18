<?php require_once "header.php" ?>





<div class="ui vertical stripe segment">
    <div class="ui grid container  ">


        <?php 
$conn = Container::getBanco();
require_once "envia_email.php";

if (!empty($_POST)){
      if( array_key_exists('turma', $_POST ) == 1 and 
           array_key_exists('cei', $_POST ) == 1  and 
           array_key_exists('nome', $_POST ) == 1  and 
           array_key_exists('horarioAtual', $_POST ) == 1  and 
           array_key_exists('horarioDesejado', $_POST ) == 1  and 
           array_key_exists('renda', $_POST ) == 1  and 
           array_key_exists('membros', $_POST ) == 1  and 
           array_key_exists('pagamento_pensao', $_POST ) == 1  and 
           array_key_exists('gasto_moradia', $_POST ) == 1  and 
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
          $pagamento_pensao = $_POST["pagamento_pensao"];
          $gasto_moradia = $_POST["gasto_moradia"];
          $membros = $_POST["membros"];
          $horario_atual = $_POST["horarioAtual"];
          $horario_desejado = $_POST["horarioDesejado"];
          
          $renda_considerada = $renda  -   ($gasto_moradia + $pagamento_pensao);   
          if ($renda_considerada < 0) {
            $renda_considerada = 0;
          }
          $percapita = $renda_considerada /  $membros;
         // $email = $_POST["email"];
          $endereco = $_POST["endereco"];
          $nome_resposanvel = $_POST["nome_responsavel"];
      if (!empty($nome) and !empty($sobrenome) and !empty($turma) and !empty($cei) and  !empty($cpf)) {
          $crianca1 = new Crianca;
          $crianca1->setNome($nome)->setSobrenome($sobrenome)->setTurma($turma)->setCei($cei)->
          setCpf($cpf)->setPagamentoPensao($pagamento_pensao)->setGastoMoradia($gasto_moradia)->setRenda($renda)->setMembros($membros)->setDataNasc($data_nasc)->setNomeResponsavel($nome_resposanvel)->
          setEndereco($endereco)->setHorarioAtual($horario_atual)->setHorarioDesejado($horario_desejado)->setPerCapita($percapita)->
          setCodigoGerar();
          $crianca = new CrudCrianca($conn, $crianca1);
          $id = $crianca->save();
         // EnviaEmail($crianca1);  
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
                  <p class="">Por segurança e para manter a privacidade da sua criança, o nome de nenhuma criança consta
                      na lista de espera pública.
                      Para identificar a posição da sua criança procure pelo código <span class="negrito">
                          <?php echo $crianca1->getCodigo();?>

                          <a href="/?cei=<?php echo $cei_cod; ?>">Clique aqui para consultar a lista</a>
              </ul>
          </div>
        <?php   } 
        
        else { if (!empty($erro)){?>
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
   


        <form class="ui form" id="formID" action="register.php?cei=<?php echo $cei_cod; ?>" method="POST">
            <h3> Ampliação de Tempo de Atendimento na Educação Infantil</h3>
            <h4 class="ui dividing header"> <?php echo $cei_nome;  ?></h4>
            <div class="field">
                <label>Nome</label>
                <div class="two fields">
                    <div class="field">
                        <input type="text" name="nome" placeholder="Nome da Criança" required>
                    </div>
                    <div class="field">
                        <input type="text" name="sobrenome" placeholder="Sobrenome da Criança" required>
                    </div>
                </div>
            </div>
            <div class="field">
                <div class="two fields">
                    <div class="field">
                        <label>Data Nascimento</label>
                        <input type="Date" name="data_nasc" oninput="mascaradata(this)" placeholder="Data de Nascimento"
                            required>
                    </div>
                    <div class="field">
                        <label>CPF</label>
                        <input type="text" name="cpf" oninput="mascara(this)" required
                            title="O formato do seu CPF está incorreto. Por favor, corriga seguindo o padrão com os pontos e traços."
                            pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" minlength="14" maxlength="14"
                            placeholder="CPF da Criança" required>
                    </div>
                </div>
            </div>
            <div class="field">
                <div class="two fields">
                    <div class="field">
                        <label>Responsavel</label>
                        <input type="text" name="nome_responsavel" oninput="mascaradata(this)"
                            placeholder="Nome do Responsavel" required>
                    </div>
                    <div class="field">
                        <label>Endereço</label>
                        <div class="field">
                            <input type="text" name="endereco" placeholder="Endereço">
                        </div>
                    </div>
                </div>
            </div>

            <hr class="ui dividing header">

            <div class="field" id="turma">
                <div class="two fields">
                    <div class=" field">
                        <label>Turma em criança está matriculada atualmente*</label>
                        <div class="two fields">
                            <div class=" field">
                                <div class="ui radio ">
                                    <input type="radio" name="turma" value="5" id="turma1">
                                    <label for="turma1"> Berçário 1 (4 meses a 11 meses)</label>
                                </div>
                                <div class="ui radio ">
                                    <input type="radio" name="turma" value="1" id="turma2">
                                    <label for="turma2"> Berçário 2 (1 ano a 1 ano e 11 meses) </label>
                                </div>
                               
                            </div>
                           
                            <div class=" field">
                            <div class="ui radio ">
                                    <input type="radio" name="turma" value="2" id="turma3">
                                    <label for="turma3"> Maternal (2 anos a 2 anos e 11 meses)</label>
                                </div>
                                <div class="ui radio ">
                                    <input type="radio" name="turma" value="3" id="turma4">
                                    <label for="turma4">Jardim ( 3 anos a 3 anos e 11 meses)</label>
                                </div>
                               <!-- <div class="ui radio ">
                                    <input type="radio" name="turma" value="4" id="turma5">
                                    <label for="turma5"> Pré 1 (4 anos a 4 anos e 11 meses)</label>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="field">
                    <div class="two fields">
                    <div class="field" id="turma">
                        <label>Horário Atual</label>
                        <div class="item">
                            <div class="ui  radio ">
                                <input type="radio" name="horarioAtual" id="hoararioAtual2" value="1" required>
                                <label for="hoararioAtual2">7h às 13h</label>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ui  radio ">
                                <input type="radio" name="horarioAtual" id="hoararioAtual3" value="2" required>
                                <label for="hoararioAtual3">12h às 18h</label>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>Horário Desejado</label>
                        <div class="item">
                            <div class="ui  radio ">
                                <input type="radio" name="horarioDesejado" id="hoararioDesejado2" value="1" required>
                                <label for="hoararioDesejado2">7h às 15h</label>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ui  radio ">
                                <input type="radio" name="horarioDesejado" id="hoararioDesejado3" value="2" required>
                                <label for="hoararioDesejado3">8h às 16h</label>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ui  radio ">
                                <input type="radio" name="horarioDesejado" id="hoararioDesejado4" value="3" required>
                                <label for="hoararioDesejado4">9h às 17h</label>
                            </div>
                        </div>

                    </div>

                </div>
                    </div>
                </div>
            </div>


       
          <?php if($cei_cod!=0) { ?>
            <hr class="ui dividing header">

            <div class="field" id="turma">
                <div class="three fields">
                    <div class="field" id="turma">
                        <label>CEI</label>
                        <div class="item">
                            <div class="ui  radio ">
                                <input type="radio" name="cei" id="cei2" value="<?php echo $cei_cod; ?>" checked>
                                <label for="cei2"> <?php echo $cei_nome; ?></label>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <?php } else { ?>
            <hr class="ui dividing header">                           

            <div class="field" id="turma" >
            <label>CEI</label>
            <div class="two fields">
                <div class="field">
                <div class="two fields">
                    <div class="field">
                    <div class="ui relaxed divided list">
                        <div class="item">
                        <div class="ui  ">
                            <input type="radio"  name="cei" id="cei2" value="1">
                            <label for="cei2" > Antenor Sprotte - Centro </label>
                        </div>
                        </div>
                        <div class="item">
                        <div class="ui radio ">
                            <input type="radio" name="cei" id="cei3"   value="2">
                            <label for="cei3" >Branca de Neve - Itinga (próx. Mercado Albino) </label>
                        </div>
                        </div>
                        <div class="item">
                        <div class="ui radio ">
                            <input type="radio" name="cei"  id="cei4"  value="3" >
                            <label for="cei4">Bruno de Magalhães - Itinga </label>
                        </div>
                        </div>
                        <div class="item">
                        <div class="ui radio ">
                            <input type="radio" name="cei"  id="cei5"   value="4" >
                            <label for="cei5">Cantinho da Vovó Justina - Itinga (próx. Hipermais)</label>
                        </div>
                        </div>
                        <div class="item">
                        <div class="ui radio ">
                            <input type="radio" name="cei"   id="cei6"  value="5">
                            <label for="cei6">Cinderela - Centro </label>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class=" field">
                    <div class="ui relaxed divided list">
                        <div class="item">
                            <div class="ui radio ">
                            <input type="radio" name="cei"  id="cei7"  value="6" >
                            <label for="cei7" >Criança Bela - Itinga (próx. restaurante Gil)</label>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ui radio ">
                            <input type="radio" name="cei"  id="cei8"  value="7">
                            <label for="cei8" >Heley de Abreu - Itinga (próx. Escola São Benedito)</label>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ui radio ">
                            <input type="radio" name="cei"  id="cei9"  value="8">
                            <label for="cei9">João Geraldo Correa - Itapocu</label>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ui radio ">
                            <input type="radio" name="cei"  id="cei10"   value="9" >
                            <label for="cei10">João Ignácio Filho - Rainha</label>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ui radio ">
                            <input type="radio" name="cei"  id="cei12"  value="11" >
                            <label for="cei12">João Luiz do Rosário - Corveta</label>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                
                <div class="field">
                <div class="two fields">
                    <div class="field">
                    <div class="ui relaxed divided list">
                        <div class="item">
                            <div class="ui radio ">
                            <input type="radio" name="cei"   id="cei13"  value="12">
                            <label for="cei13" >João Serafim -Barra do Itapocu</label>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ui radio ">
                            <input type="radio" name="cei" id="cei14"  value="13">
                            <label for="cei14" >Lindolpho José da Silva - Porto Grande</label>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ui radio ">
                            <input type="radio" name="cei" id="cei15"  value="14">
                            <label for="cei15">Pequeno Anjo - Rainha</label>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ui radio ">
                            <input type="radio"name="cei" id="cei16"  value="15"   >
                            <label for="cei16">Pequeno Principe - Areias Pequenas</label>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ui radio ">
                            <input type="radio" name="cei" id="cei17"  value="16">
                            <label for="cei17">Professora Janaina - Itinga (próx. Escola São Benedito)</label>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="field">
                    <div class="ui relaxed divided list">
                        <div class="item">
                            <div class="ui radio ">
                            <input type="radio" name="cei" id="cei18"  value="17">
                            <label for="cei18" >Marise Travasso - Itinga (próx. Escola Jablonsky)</label>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ui radio ">
                            <input type="radio" name="cei" id="cei19"  value="18">
                            <label for="cei19" >Santo Antônio - Itinga (próx. Campo do Perna)</label>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ui radio ">
                            <input type="radio" name="cei" id="cei20"  value="19">
                            <label for="cei20"> Vovó Brandina - Centro</label>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ui radio ">
                            <input type="radio" name="cei" id="cei21" value="20" >
                            <label for="cei21"> Vovó Maria de Lurdes Max - Icaraí (próx. IFC)</label>
                            </div>
                        </div>
                        
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>


            <?php }  ?>
            <hr class="ui dividing header">
            
            <div class="ui message">
            <div class="header">
  Atenção!
  </div>
            <ol class="ui list">Nos campos abaixo deve-se preencher os valores totais, utilizando vírgula para separar reais de centavos, conforme exemplos:

   
      <li>Para o valor de seiscentos reais e cinquenta centavos, indicar 600,50</li>
      <li>Para o valor de mil duzentos e doze reais, indicar 1212,00</li>
  


</ol>
            </div>
            <div class="ui alert">  </div>
            <hr class="ui dividing header">

            <div class="field" id="turma">
                <div class="two fields">
                    
                    <div class="field ">
                        <label >Renda Familiar (Soma da renda de todas as pessoas que moram na mesma casa).</label>
                        <input type="text" onkeyup="maskMoney(event)" placeholder="0.000,00"  step="0.01" name="renda" min="0.00"  placeholder="Renda Familiar" required>

                    </div>

                    
                    <div class="field">
                        <label>Quantas Pessoas Moram na Casa? </label>
                        <input type="number" name="membros" value='2' min="2" placeholder="Membros" required>

                    </div>
                   
                   
                </div>
            </div>


          <!--  <hr class="ui dividing header">-->

            <div class="field" id="turma">
                <div class="two fields">
                    
                    
                    <div class="field">
                        <label>Gastos com Moradia (aluguel ou financiamento do primeiro imóvel, onde mora atualmente)</label>
                        <input type="text" onkeyup="maskMoney(event)" placeholder="0.000,00" step="0.01" name="gasto_moradia" min="0" placeholder="Gasto com Moradia" required>

                    </div>
                    <div class="field">
                        <label>Pagamento de Pensão Alimentícia</label>
                        <input type="text" onkeyup="maskMoney(event)" placeholder="0.000,00" step="0.01" name="pagamento_pensao" min="0" placeholder="Pagamento Pensão" required>

                    </div>
                </div>
            </div>



            <hr class="ui dividing header">

            <div class="field">
                <div class="ui checkbox ">
                    <input type="checkbox" name="permitir[]" value="1" id="permitir"
                        title="Desculpa, mas se o compartilhamento dos dados não podemos adicionar a criança a lista de espera."
                        required
                        oninvalid="this.setCustomValidity(\'Desculpa, mas sem o compartilhamento dos dados não podemos adicionar a criança a lista de espera\')">
                    <label for="permitir">
                        Como responsável pela criança, declaro a veracidade e permito o compartilhamento dos dados deste
                        formulário com a Prefeitura Municipal de Araquari.
                    </label>
                </div>
            </div>


            <div class="ui buttons fluid  ">
              <!--  <div class="ui active inverted dimmer segment">
                    <div class="ui medium text loader">Loading</div>
                </div>   -->
                
                <a class="ui button secondary " href="/">
                    Cancelar
                </a>
                <button type="submit" name="send" id="send"  class="ui button ">
                    Salvar
                </button>
            </div>

        </form>
    </div>
</div>

</div>





<script type="text/javascript" >
var formID = document.getElementById("formID");
var send = $("#send");

$(formID).submit(function(event){

  if (formID.checkValidity()) {
    send.attr('disabled', 'disabled');
  }
});


</script>

<?php require_once "footer.php" ?>