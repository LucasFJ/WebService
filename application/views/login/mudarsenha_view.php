<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" />
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />

		<link href="<?php echo base_url('src/css/materialize.min.css'); ?>" type="text/css" rel="stylesheet" media="screen,projection" />
		<link href="<?php echo base_url('src/css/login.css'); ?>" type="text/css" rel="stylesheet" media="screen,projection" />

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
	<!-- CARD LOGIN -->
	<div class="section no-pad-bot" id="index-banner">
	<div class="container center">
	<br />
	<h5>Digite sua nova senha.</h5>
        
                                <span class="red-text" id="erro"><?php echo $mensagem_erro; ?></span><br />
        
	<div class="card left-align grey darken-1 z-depth-2">
	<form class="col s12" method="post">
	<div class="card-content center-align white-text">
	<span class="card-title">Recuperar senha</span>
        <!-- FORM LOGIN -->
        <div class="formLogin">
            <div class="input-field login">
                <i class="mdi-social-person prefix"></i>
                <input id="icon_prefix" type="password" class="validate" name="senha" required>
                <label for="icon_prefix" class="inputLabel">Senha</label>
            </div>
            <div class="input-field login">
                <i class="mdi-social-person prefix"></i>
                <input id="icon_prefix" type="password" class="validate" name="senha2" required>
                <label for="icon_prefix" class="inputLabel">Confirmar senha</label>
            </div>
        </div>
	<!-- /FORM LOGIN -->
	<br />
	<!-- BUTTONS -->
	  	<div class="containerBtnInicio container">
                  <button value="Enviar" href="<?php echo base_url('login/mudarsenha'); ?>"  type="submit" class="btnInicio waves-effect waves-light orange darken-2 white-text btn tooltipped" data-position="top" data-delay="200" data-tooltip="Enviar e-mail de recuperação">Enviar</button>
		   <a href="<?php echo base_url('login'); ?>" class="btnInicio waves-effect waves-light orange darken-2 white-text btn tooltipped" data-position="top" data-delay="200" data-tooltip="Voltar para Tela de Login">Voltar</a>
                </div>
	</form>
		
	<!-- /BUTTONS -->	  

	</div>
	</div>
	</div>
	<!-- /CARD LOGIN -->
