<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" />
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />

		<link href="<?php echo base_url('src/css/materialize.min.css'); ?>" type="text/css" rel="stylesheet" media="screen,projection" />
		<link href="<?php echo base_url('src/css/cadastro.css'); ?>" type="text/css" rel="stylesheet" media="screen,projection" />

		<title>Service</title>
	</head>

	<body>
          <header>
            <nav class="grey lighten-3">
              <div class="nav-wrapper container">
                <span unselectable="on" class="brand-logo center orange-text text-darken-2">Service</span>
                <a href="<?php echo base_url('login'); ?>" class="left-align"><i class="mdi-navigation-arrow-back orange-text"></i></a>
              </div>
            </nav>
          </header> 

	<main>
            
	<div class="no-pad-bot">
	<div class="container center">
	<br />
	<br />
            <!-- CARD SUCESSO -->
            <div class="card center-align orange z-depth-2">
                <br />
                <span class="card-title">Cadastro realizado com sucesso!</span>
                <br /><br/>
                <span class="white-text">Enviamos um e-mail para a ativação de sua conta.
                    <br/> Contudo, você já pode realizar login utilizando-a. 
                <br/>Aproveite nossos serviços de busca por empresas de diversos
                ramos da sua região e encontre informações detalhadas sobre elas
                como quais produtos e serviços ela oferece de maneira prática e
                elegante.</span><br/><br/>
                <a href="<?php echo base_url('login'); ?>" class="waves-effect waves-light white orange-text text-darken-4 btn">Voltar</a>
            </div>
            <!-- /CARD SUCESSO -->
	</div>
	<br /><br />
	</div>
            <br/><br/><br/><br/><br/><br/>