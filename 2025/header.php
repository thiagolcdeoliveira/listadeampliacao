<?php 
require_once "classes/Banco.php";
require_once "classes/Crianca.php";
require_once "classes/CrudCrianca.php";
require_once "classes/Container.php";
session_start();
if (!empty($_GET) and !empty($_GET["cei"])) {
  $cei = $_GET["cei"];
  require_once "classes/Cei.php";
  $cei_object = new Cei;
  $cei_cod = $cei_object->getCodCei($cei);
  $cei_nome = $cei_object->getNomeCei($cei);
}else{
  $cei_cod = 0;
  $cei_nome = "Todos os Ceis";

}


?>


<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Thiago L C de Oliveira">
  <title>Lista de Aplicação: <?php $cei_nome?></title>
  <!-- Site Properties -->
 
  <link rel="stylesheet" type="text/css" href="semantiu/semantic.min.css">
  <link rel="stylesheet" type="text/css" href="css/base.css">
  <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />


  <style type="text/css">

    .hidden.menu {
      display: none;
    }

    .masthead.segment {
      min-height: 700px;
      padding: 1em 0em;
    }
    .masthead .logo.item img {
      margin-right: 1em;
    }
    .masthead .ui.menu .ui.button {
      margin-left: 0.5em;
    }
    .masthead h1.ui.header {
      margin-top: 3em;
      margin-bottom: 0em;
      font-size: 4em;
      font-weight: normal;
    }
    .masthead h2 {
      font-size: 1.7em;
      font-weight: normal;
    }

    .ui.vertical.stripe {
      padding: 8em 0em;
    }
    .ui.vertical.stripe h3 {
      font-size: 2em;
    }
    .ui.vertical.stripe .button + h3,
    .ui.vertical.stripe p + h3 {
      margin-top: 3em;
    }
    .ui.vertical.stripe .floated.image {
      clear: both;
    }
    .ui.vertical.stripe p {
      font-size: 1.33em;
    }
    .ui.vertical.stripe .horizontal.divider {
      margin: 3em 0em;
    }

    .quote.stripe.segment {
      padding: 0em;
    }
    .quote.stripe.segment .grid .column {
      padding-top: 5em;
      padding-bottom: 5em;
    }

    .footer.segment {
      padding: 5em 0em;
    }

    .secondary.pointing.menu .toc.item {
      display: none;
    }

    @media only screen and (max-width: 700px) {
      .ui.fixed.menu {
        display: none !important;
      }
      .secondary.pointing.menu .item,
      .secondary.pointing.menu .menu {
        display: none;
      }
      .secondary.pointing.menu .toc.item {
        display: block;
      }
      .masthead.segment {
        min-height: 350px;
      }
      .masthead h1.ui.header {
        font-size: 2em;
        margin-top: 1.5em;
      }
      .masthead h2 {
        margin-top: 0.5em;
        font-size: 1.5em;
      }
    }


  </style>

  <script src="jquery/jquery.min.js"></script>
  <script src="semantiu/components/visibility.js"></script>
  <script src="semantiu/components/sidebar.js"></script>
  <script src="semantiu/components/transition.js"></script>
  <script src="semantiu/semantic.js"></script>
  <script>
  $(document)
    .ready(function() {

      // fix menu when passed
      $('.masthead')
        .visibility({
          once: false,
          onBottomPassed: function() {
            $('.fixed.menu').transition('fade in');
          },
          onBottomPassedReverse: function() {
            $('.fixed.menu').transition('fade out');
          }
        })
      ;

      // create sidebar and attach to menu open
      $('.ui.sidebar')
        .sidebar('attach events', '.toc.item')
      ;

    })
  ;
  </script>
</head>
<body>

<!-- Following Menu -->
<div class="ui large top fixed hidden menu ">
  <div class="ui container">
    <a class="item">Home</a>
    <a class="item">Cadastro</a>
    <!--<a class="item" href="2022/">Consulta 2022</a>
    <a class="item" href="2023/">Consulta 2023</a>
  -->
    <a class="item">Portal da Educação</a>
    

   <!-- <div class="right menu">
            <div class="item">
                <a class="ui button">Log in</a>
            </div>
            <div class="item">
                <a class="ui primary button">Sign Up</a>
            </div>
         </div>-->
  </div>
</div>

<!-- Sidebar Menu -->
<div class="ui vertical inverted sidebar menu">
<a class="item">Home</a>
    <a class="item" href="register.php?cei=<?php echo $cei_cod ?>">Cadastro</a>
   <!-- <a class="item" href="/2022/">Consulta 2022</a>-->

    <a class="item">Portal da Educação</a>
</div>


<!-- Page Contents -->
<div class="pusher ">
  <div class="ui inverted vertical masthead center aligned segment backgroud-banner ">

    <div class="ui container">
      <div class="ui large secondary menu" style="opacity : 0.8; font-size: 18px;">
        <a class="toc item">
          <i class="sidebar icon"></i>
        </a>
        <a href="?cei=<?php echo $cei_cod ?>" class="item active">Home</a>
        <a href="register.php?cei=<?php echo $cei_cod ?>" class="item">Cadastro</a>
       <?php  if  (isset($_SESSION['u'])){ ?>
        <a href="lista_coordenacao.php?cei=<?php echo $cei_cod ?>" class="item">Lista Detalhada</a>

       <?php } ?>
       <a class="item" href="/2022/">Consulta 2022</a>

        <a href="http://educacao.araquari.sc.gov.br" class="item">Portal da Educação</a>
       <!-- <div class="right item">
          <a class="ui inverted button">Log in</a>
          <a class="ui inverted button">Sign Up</a>
        </div>-->
      </div>
    </div>

    <div class="ui text container ">
      <h1 class="ui inverted header sem-top">
        Lista de Ampliação 
        <?php if  (isset($_SESSION['u']) and isset($_SESSION['c'])){ 
          require_once "classes/Cei.php";
          $cei_object = new Cei;
        
          $cei_nome = $cei_object->getNomeCei($_SESSION['c']);
          
          echo $cei_nome 
          ?>		
          
          <?php } else { ?>		
            <?php echo $cei_nome ?>
            <?php }  ?>		
        
      </h1>
      <h2 class="ui text-banner " ></h2>
      <a href="register.php?cei=<?php echo $cei_cod ?>" class="ui huge  button">Cadastre sua criança<i class="right arrow icon"></i></a>
    </div>

  </div>

  