<?php require_once "header.php" ?>
<?php if  (isset($_SESSION['u'])){  $id_usuario=$_SESSION['u']; ?>



<div class="ui vertical stripe segment">
    <div class="ui  container">
 

<?php 


$conn = Container::getBanco();
if (!empty($_GET)){
      if( array_key_exists('id', $_GET ) == 1 ){
          $id = $_GET["id"];
          if( array_key_exists('motivo', $_POST ) == 1 and 
          array_key_exists('id', $_POST ) == 1){
          $motivo =  $_POST["motivo"];
          $id =  $_POST["id"];
          $crianca1 = new Crianca;
          $crianca1->setId($id)->setMotivo($motivo)->setUsuario($id_usuario);
          $crianca = new CrudCrianca($conn, $crianca1);
          $crianca->update();
          $sucesso="1";
          }

        
        }
      }else {
    $erro = 1;
  }
?>
                       
                           <?php   if  (!empty($sucesso)) {?>
                            <div class="ui message">
                              <div class="header">
                              Exclusão realizada com sucesso.
                              </div>
                              <ul class="list">
                                <li> 
                                <li>  <a href="/">Clique aqui para consultar a lista</a></li>
                              </ul>
                            </div>

                   
                            <?php   } else { if (!empty($erro)){?>
                              <div class="ui message">
                              <div class="header">
                              Exclusão realizada com sucesso.
                              </div>
                            <p class="">Dados Obrigatorios Ficaram Falatando, Por favor preencha todos os campos. </span>
                            </h1>
                            </div>
                           
                           <?php  }
                          }?>




                    <form class="ui form" action="delete.php?id=<?php if  (!empty($id)) { echo $id;}?>" method="POST">
                    <h3 class="ui dividing header">Exclusão Na Lista de Espera</h4>
                      <div class="field">
                        <label>Motivo da Exclusão</label>
                          <div class="field">
                            <textarea type="text"  name="motivo" placeholder="Motivo da Exclusão" required></textarea>
                          </div>
                          <div class="field">
                            <input type="text"  hidden name="id" value="<?php if  (!empty($id)) {echo $id;}?>" placeholder="Motivo da Exclusão" >
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
                        
                            
              
        <?php require_once "footer.php" ?>
<?php }?>