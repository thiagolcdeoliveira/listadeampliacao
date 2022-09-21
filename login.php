
<?php 
require_once "classes/Banco.php";
require_once "classes/Usuario.php";
require_once "classes/CrudUsuario.php";
require_once "classes/Container.php";
session_start();

?>

<?php 

$conn = Container::getBanco();
if (!empty($_POST)){
      if( array_key_exists('email', $_POST ) == 1 and 
          array_key_exists('senha', $_POST ) == 1    ){
          $email = $_POST["email"];
          $options = [
            'cost' => 12,
          ];
          
          $senha = md5($_POST["senha"]."42");
          $senha = hash('ripemd160', $senha."42");
         // echo $senha;
      if (!empty($email) and !empty($senha) ){
        $usuario = new Usuario;
        $usuariocrud = new CrudUsuario($conn, $usuario);

        $login = $usuariocrud->validalogin($email,$senha);
        //print_r($usuario);
        if (!empty($login->getId())){
        $_SESSION['u'] = $login->getId();
        header('Location: lista_coordenacao.php');
        }else{
         
        $erro =  "erro!";
        }
        }
      }else {
    $erro = 1;
  }
}


?>


<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title>Login - Fila</title>
  <link rel="stylesheet" type="text/css" href="semantiu/semantic.min.css">
  <link rel="stylesheet" type="text/css" href="css/base.css">
  <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
  <script src="jquery/jquery.min.js"></script>
  <script src="semantiu/components/visibility.js"></script>
  <script src="semantiu/components/sidebar.js"></script>
  <script src="semantiu/components/transition.js"></script>

  <style type="text/css">
    body {
    /*  background-color: #DADADA; */
    }
    body > .grid {
      height: 100%;
    }
    .image {
      margin-top: -100px;
    }
    .column {
      max-width: 450px;
    }
  </style>
  <script>
  $(document)
    .ready(function() {
      $('.ui.form')
        .form({
          fields: {
            email: {
              identifier  : 'email',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your e-mail'
                },
                {
                  type   : 'email',
                  prompt : 'Please enter a valid e-mail'
                }
              ]
            },
            password: {
              identifier  : 'password',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your password'
                },
                {
                  type   : 'length[6]',
                  prompt : 'Your password must be at least 6 characters'
                }
              ]
            }
          }
        })
      ;
    })
  ;
  </script>
</head>
<body>

<div class="ui middle aligned center aligned grid">
  <div class="column">
 
    <h2 class="ui teal image header">
      <img src="img/logo.png" class="image">
      <div class="content">
      Login 
      </div>
    </h2>
    <?php if (!empty($erro)){ ?>
    <div class="ui message">
      <i class="close icon"></i>
      <div class="header">
        Erro!
      </div>
      <p>Dados Incorretos.</p>
    </div>
    <?php } ?>
    <form class="ui large form" method="POST" action="">
      <div class="ui stacked segment">
        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input type="text" name="email" placeholder="E-mail address">
          </div>
        </div>
        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" name="senha" placeholder="Password">
          </div>
        </div>
        <input type="submit" class="ui fluid large blue submit button" value="Login">
     </div>
    </form>
  </div>
</div>

</body>

</html>
