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
                            $membros =  $_POST["membros"];
                            if ($_POST["confirmado"] != 2  or ($_POST["confirmado"] == 2 and  !empty($_POST['motivo_negado']))) {
                                $pagamento_pensao = $_POST["pagamento_pensao"];
                                $gasto_moradia = $_POST["gasto_moradia"];
                                $renda_considerada = $renda -   ($gasto_moradia + $pagamento_pensao);   
                                $percapita =  $renda_considerada / $membros;
                                $motivo_negado = "";
                                $motivo_negado =  $_POST["motivo_negado"];
                                $confirmado =  $_POST["confirmado"];
                                $id =  $_POST["id"];
                                $crianca1 = new Crianca;
                                $crianca1->setId($id)->setConfirmado($confirmado)->setMotivoNegado($motivo_negado)->setMembros($membros)->setPerCapita($percapita)->setRenda($renda)->setUsuario($id_usuario);
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
                        Exclusão realizada com sucesso.
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
                                    Exclusão realizada com sucesso.
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
                <h3 class="ui dividing header"><?php echo $crianca->getNome() . " " . $crianca->getSobreNome(); ?> -
                    <?php echo $crianca->getAllCeis(); ?></h4>
                    <div class="field">
                        <label></label>
                        <div class="field" id="turma">
                            <div class="three fields">
                            <div class=" field">
                                            

                                        </div>

                                <div class="field">
                                    <label>*Decisão:  Aprovado ou Não</label>
                                    <div class="two fields">
                                        
                                    
                                         <div class=" field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="confirmado" value="1" <?php if ($crianca->getConfirmado() == 1) { ?> checked <?php   } ?> id="turma1">
                                                <label for="confirmado">Aprovado</label>
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
                                <div class=" field">
                                          

                                        </div>
                                
                            </div>
                        </div>



            <hr class="ui dividing header">

            <div class="field" id="turma">
                <div class="two fields">
                    
                    <div class="field">
                        <label>Renda Familiar (Soma da renda de todas as pessoas que moram na mesma casa)</label>
                        <input type="number" step="0.01" <?php if (!empty($crianca->getRenda())) { ?> value="<?php echo $crianca->getRenda();
                                                                                                                    } ?>" name="renda" min="0.01" placeholder="Renda Familiar" required>

                    </div>
                    <div class="field">
                        <label>Quantas Pessoas Moram na Casa? </label>
                        <input type="number" name="membros" min="2"  <?php if (!empty($crianca->getMembros())) { ?> min=1 value="<?php echo $crianca->getMembros();
                                                                                                                                }else{ echo " value='2'"; } ?>" placeholder="Membros" required>

                    </div>
                   
                   
                </div>
            </div>


          <!--  <hr class="ui dividing header">-->

            <div class="field" id="turma">
                <div class="two fields">
                    
                    
                    <div class="field">
                        <label>Gastos com Moradia (aluguel ou financiamento do primeiro imóvel, onde mora atualmente)</label>
                        <input type="number" step="0.01" <?php if (!empty($crianca->getGastoMoradia())) { ?> value="<?php echo $crianca->getRenda();
                                                                                                                    }else { echo "value=0";} ?>"  name="gasto_moradia" min="0.0" placeholder="Gasto com Moradia" required>

                    </div>
                    <div class="field">
                        <label>Pagamento de Pensão Alimentícia</label>
                        <input type="number" step="0.01" <?php if (!empty($crianca->getGastoMoradia())) { ?> value="<?php echo $crianca->getRenda();
                                                                                                                    }else { echo "value=0";} ?>" name="pagamento_pensao" min="0.0" placeholder="Pagamento Pensão" required>

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



    <?php require_once "footer.php" ?>
<?php } ?>