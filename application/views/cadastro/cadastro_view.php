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
            
	<h4>Nova conta</h4>
	<p class="center-align">Primeira vez por aqui? Preencha alguns campos para lembrarmos de você na próxima visita.</p>

<!-- FORMULARIO -->
		<form class="col s12">
			<div class="input-field col s6 cadastro">
			  <input id="nome" type="text" class="validate">
			  <label for="nome" class="inputLabel">Nome</label>
			</div>
			<div class="input-field col s6 cadastro">
			  <input id="email" type="email" class="validate">
			  <label for="email" class="inputLabel">E-mail</label>
			</div>
			<div class="input-field col s6 cadastro">
			  <input id="password" type="password" class="validate">
			  <label for="password" class="inputLabel">Senha</label>
			</div>
			<div class="lblNasc left-align">
			  <span class="grey-text">Data de Nascimento:</span>
			</div>			
		</form>
<!-- /FORMULARIO -->