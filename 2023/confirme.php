<?php require_once "header.php" ?>
<?php if (isset($_SESSION['u']) and isset($_SESSION['c'])) {
    $id_usuario = $_SESSION['u'];
    $cei_cod = $_SESSION['c'];

?>



    <div class="ui vertical stripe segment">
        <div class="ui  container">


            <?php


            $conn = Container::getBanco();
            if (!empty($_GET)) {
                if (array_key_exists('id', $_GET) == 1) {
                    $id = $_GET["id"];
                    $crianca1 = new Crianca;
                    $crianca = new CrudCrianca($conn, $crianca1);
                    $crianca = $crianca->find($id);


                    if (
                        array_key_exists('renda', $_POST) == 1 and
                        array_key_exists('membros', $_POST) == 1 and
                        array_key_exists('confirmado', $_POST) == 1 and
                        array_key_exists('pagamento_pensao', $_POST ) == 1  and 
                        array_key_exists('gasto_moradia', $_POST ) == 1  and 
                        array_key_exists('id', $_POST) == 1
                    ) {
                        if ($_POST["membros"] > 0) {
                            $renda =  $_POST["renda"];
                            if ($renda < 0 or $renda=="" ) {
                                $renda = 0;
                              }
                            
                            $membros =  $_POST["membros"];
                            if ($_POST["confirmado"] != 2  or ($_POST["confirmado"] == 2 and  !empty($_POST['motivo_negado']))) {
                                $pagamento_pensao = $_POST["pagamento_pensao"];
                                $gasto_moradia = $_POST["gasto_moradia"];
                                
                                $renda_considerada = $renda -   ($gasto_moradia + $pagamento_pensao);   
                                if ($renda_considerada < 0) {
                                    $renda_considerada = 0;
                                  }
                                 
                                $percapita =  $renda_considerada / $membros;
                                $motivo_negado = "";
                                $motivo_negado =  $_POST["motivo_negado"];
                                $confirmado =  $_POST["confirmado"];
                                $id =  $_POST["id"];
                                $crianca1 = new Crianca;
                                $crianca1->setId($id)->setConfirmado($confirmado)->setPagamentoPensao($pagamento_pensao)->setGastoMoradia($gasto_moradia)->setMotivoNegado($motivo_negado)->setMembros($membros)->setPerCapita($percapita)->setRenda($renda)->setUsuario($id_usuario);
                                $crianca = new CrudCrianca($conn, $crianca1);
                                $crianca->updateStatus();
                                $crianca1 = new Crianca;
                                $crianca = new CrudCrianca($conn, $crianca1);
                                $crianca = $crianca->find($id);
                                $sucesso = "1";
                            }
                        }
                    }
                }
            } else {
                $erro = 1;
            }
            ?>

            <?php if (!empty($sucesso)) { ?>
                <div class="ui message">
                    <div class="header">
                        Decisão realizada com sucesso.
                    </div>
                    <ul class="list">
                        <li>
                        <li> <a href="lista_coordenacao.php?cei=<?php echo $cei_cod; ?>"" >Clique aqui para consultar a lista</a></li>
                              </ul>
                            </div>

                   
                            <?php   } else {
                            if (!empty($erro) and  (empty($sucesso))) { ?>
                              <div class=" ui message">
                                <div class="header">
                                    Decisão não realizada.
                                </div>
                                <p class="">Dados Obrigatorios Ficaram Falatando, Por favor preencha todos os campos. </span>
                                    </h1>
                </div>

        <?php  }
                        } ?>


        <?php
        if ((!empty($crianca->getId()))) { ?>

            <form class="ui form" action="confirme.php?id=<?php if (!empty($id)) {
                                                                echo $id;
                                                            } ?>" method="POST">

<div class="ui accordion">
  <div class="title active">

                <h3 class="ui dividing header"><?php echo $crianca->getNome() . " " . $crianca->getSobreNome(); ?> -
                    <?php echo $crianca->getAllCeis(); ?>    <i class="dropdown icon"></i>
</h4>
                    </div>
  <div class="content">
                    <table class="ui unstackable  table" style="margin-bottom: 2em;">
  <thead>
    <tr><th>Nome </th>
    <th>Horário Atual</th>
    <th>Horário Desejado</th>
  </tr></thead>
  <tbody>
    <tr>
      <td data-label="Name"><?php echo $crianca->getNome() . " " . $crianca->getSobreNome(); ?></td>
      <td data-label="Atual">
            <?php if ($crianca->getHorarioAtual() == 1) {  ?>
					Matutino
			<?php } else {
					    if ($crianca->getHorarioAtual() == 2) { ?>
							Vespetino
						<?php } else {?>
									erro
								<?php	}
                                 } ?>
       </td>
      <td data-label="Desejado">
      <?php if ($crianca->getHorarioDesejado() == 1) {  ?>
					7h às 15h
			<?php } else {
					    if ($crianca->getHorarioDesejado() == 2) { ?>
							8h às 16h
						<?php } else {   
                            if ($crianca->getHorarioDesejado() == 3) { ?>
                            
                            9h às 17h
                            <?php }else{?>
                                    erro
                           


								<?php	 	}
                                }
                                 } ?>

      
      <?php //echo $crianca->getHorarioDesejado(); ?></td>
    </tr>
   
  </tbody>
  <thead>
    <tr><th>CEI </th>
    <th>Turma</th>
    <th>Responsavel</th>
  </tr></thead>
  <tbody>
    <tr>
      <td data-label="Name"> <?php echo $crianca->getAllCeis(); ?></td>
      <td data-label="Atual"><?php echo $crianca->getTurma(); ?></td>
      <td data-label="Desejado"><?php echo $crianca->getNomeResponsavel(); ?></td>
    </tr>
   
  </tbody>
</table>
  </div></div>

                    <div class="field">
                        <label></label>
                        <div class="field" id="turma">
                          
                                <div class="field">
                                    
                                    <div class="five fields">
                                        <div class=" field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="confirmado" value="5" <?php if ($crianca->getConfirmado() == 5) { ?> checked <?php } ?>" id="turma4">
                                                <label for="confirmado">Desistência</label>
                                            </div>

                                        </div>
                                        <div class=" field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="confirmado" value="0" <?php if ($crianca->getConfirmado() == 0) { ?> checked <?php } ?>" id="turma4">
                                                <label for="confirmado">Aguardando Análise</label>
                                            </div>

                                        </div>
                                         <div class=" field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="confirmado" value="1" <?php if ($crianca->getConfirmado() == 1) { ?> checked <?php   } ?> id="turma1">
                                                <label for="confirmado"> Aprovado na 1° Fase </label>
                                            </div>

                                        </div>
                                        <div class=" field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="confirmado" value="4" <?php if ($crianca->getConfirmado() == 4) { ?> checked <?php } ?>" id="turma4">
                                                <label for="confirmado">Refazer Cadastro</label>
                                            </div>

                                        </div>
                                        <div class=" field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="confirmado" value="3" <?php if ($crianca->getConfirmado() == 3) { ?> checked <?php   } ?> id="turma1">
                                                <label for="confirmado"> Aprovado na 2° Fase </label>
                                            </div>

                                        </div>
                                        <div class=" field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="confirmado" value="2" <?php if ($crianca->getConfirmado() == 2) { ?> checked <?php } ?>" id="turma4">
                                                <label for="confirmado">Negado</label>
                                            </div>

                                        </div>
                                    </div>
                              
                                
                            </div>
                        </div>



            <hr class="ui dividing header">

            <div class="field" id="turma">
                <div class="two fields">
                    
                    <div class="field">
                        <label>Renda Familiar (Soma da renda de todas as pessoas que moram na mesma casa)</label>
                        <input type="number" step="0.01" <?php if (!empty($crianca->getRenda())) { ?> value="<?php echo $crianca->getRenda();
                                                                                                                    } ?>" name="renda" min="0.01" placeholder="Renda Familiar" >

                    </div>
                    <div class="field">
                        <label>Quantas Pessoas Moram na Casa? </label>
                        <input type="number" name="membros" min="2"  <?php if (!empty($crianca->getMembros())) { ?> min=1 value="<?php echo $crianca->getMembros();
                                                                                                                                }else{ echo " value='2'"; } ?>" placeholder="Membros" >

                    </div>
                   
                   
                </div>
            </div>


          <!--  <hr class="ui dividing header">-->

            <div class="field" id="turma">
                <div class="two fields">
                    
                    
                    <div class="field">
                        <label>Gastos com Moradia (aluguel ou financiamento do primeiro imóvel, onde mora atualmente)</label>
                        <input type="number" step="0.01" <?php if (!empty($crianca->getGastoMoradia())  and $crianca->getGastoMoradia() >= 0  ) { ?> value="<?php echo $crianca->getGastoMoradia();
                                                                                                                    }else { echo "value='0'";} ?>"  name="gasto_moradia" min="0.0" placeholder="Gasto com Moradia" >

                    </div>
                    <div class="field">
                        <label>Pagamento de Pensão Alimentícia</label>
                        <input type="number" step="0.01" <?php if (!empty($crianca->getPagamentoPensao()) and $crianca->getPagamentoPensao() >= 0  ) { ?> value="<?php echo $crianca->getPagamentoPensao();
                                                                                                                    }else { echo "value='0'";} ?>" name="pagamento_pensao" min="0.0" placeholder="Pagamento Pensão" >

                    </div>
                </div>
            </div>

          








                        
                        <div class="field">
                            <label>Motivo da Negado</label>
                            <div class="field">
                                <textarea type="text" name="motivo_negado" placeholder="Motivo da Negado"> <?php if (!empty($crianca->getMotivoNegado())) {
                                                                                                                echo $crianca->getMotivoNegado();
                                                                                                            } ?></textarea>
                            </div>

                        </div>

                        <div class="field">
                            <input type="text" hidden name="id" value="<?php if (!empty($id)) {
                                                                            echo $id;
                                                                        } ?>" placeholder="Alteração">
                        </div>
                    </div>


                    <div class="ui buttons fluid">
                        <a class="ui button secondary " href="/">
                            Cancelar
                        </a>
                        <button type="submit" class="ui button ">
                            Salvar
                        </button>
                    </div>

            </form>



        <?php
        } ?>
        </div>
    </div>

    




<script>
    $('.ui.accordion')
  .accordion()
;

</script>

    <?php require_once "footer.php" ?>
<?php } ?>