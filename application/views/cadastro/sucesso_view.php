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
              <div class="nav-wrapper">
                <span unselectable="on" class="brand-logo center orange-text text-darken-2">Service</span>
              </div>
            </nav>
          </header> 

	<main>
            
	<div class="no-pad-bot">
	<div class="container center">
	<br />
	<br />
            <!-- CARD SUCESSO -->
            <div class="card center-align orange lighten-2 z-depth-2">
                <br />
                <span class="card-title">Cadastro realizado com sucesso!</span>
                <br /><br/>
                <span class="white-text">Enviamos um e-mail para a ativação de sua conta.</span><br/><br/>
                <a href="<?php echo base_url('login'); ?>" class="waves-effect waves-light white orange-text text-darken-4 btn tooltipped">Voltar</a>
            </div>
            <!-- /CARD SUCESSO -->
	</div>
	<br /><br />
	</div>