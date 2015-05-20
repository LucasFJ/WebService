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
                <span unselectable="on" class="brand-logo center orange-text text-darken-2">Nova Conta</span>
              </div>
            </nav>
          </header> 

	<main>
            
	<div class="no-pad-bot">
	<div class="container center">
	<br />
	<h5 class="center-align">Primeira vez por aqui? Preencha alguns campos para lembrarmos de você na próxima visita.</h5>
	<br />
            <!-- CARD LOGIN -->
            <div class="card center-align orange lighten-2 z-depth-2">
                <br /><span class="card-title">Cadastro</span>
            <form class="col s12" method="post">
            <div class="card-content center-align contForm">
                <!--FORM--->
                
                <div class="row">
                <div class="input-field col l6 s12">
                    <input id="nome" name="nome" type="text" class="validate" required value="<?php echo $conteudo_nome;?>"/>
		  <label for="nome" class="inputLabel">Nome</label>
		</div>
                <div class="input-field col l6 s12">
                    <input id="sobrenome" name="sobrenome" type="text" class="validate" required  value="<?php echo $conteudo_sobrenome;?>"/>
                <label for="last_name">Sobrenome</label>
                </div>
                </div>
                
                <div class="row">
                <div class="input-field col l6 s12">
                    <input id="email" name="email" type="email" class="validate" required value="<?php echo $conteudo_email;?>"/>
                    <label for="first_name">E-mail</label>
                </div>
                <div class="input-field col l6 s12 genero">
                  <select name="genero">
                    <option value="0" disabled selected>Gênero</option>
                    <option value="1">Feminino</option>
                    <option value="2">Masculino</option>
                  </select>
                </div>
                </div>
                
                <div class="row">
                <div class="input-field col l6 s12">
                    <input id="senha" name="senha" type="password" class="validate" required />
                <label for="first_name">Senha</label>
                </div>
                <div class="input-field col l6 s12">
                    <input id="repeteSenha" name="repeteSenha" type="password" class="validate" required />
                <label for="last_name">Senha Novamente</label>
                </div>
                </div>
                
                <div class="row">
                <div class="input-field col l6 s12">
                    <input id="nascimento" name="nascimento" type="date" class="datepicker" required />
                <label for="first_name">Data de Nascimento</label>
                </div>
                <div class="input-field col l6 s12">
                    <p>
                        <input name="concorda" type="checkbox" class="filled-in white" id="filled-in-box" required />
                        <label for="filled-in-box">Li e estou de acordo com os Termos de Uso do usuário.</label>
                    </p>
                </div>
                </div>
                <br />
                
                
                <!--/FORM-->
                
                <!-- BUTTONS -->
                <div class="container containerBtnCadastro">
                    <button href="<?php base_url('cadastro')?>" type="submit" class="btnCadastro waves-effect waves-light white orange-text text-darken-4 btn tooltipped" data-position="top" data-delay="200" data-tooltip="Cadastrar-se">Cadastrar</button>
                <button href="" type="reset" class="btnCadastro waves-effect waves-light white orange-text text-darken-4 btn tooltipped" data-position="top" data-delay="200" data-tooltip="Limpar dados inseridos">Limpar</button>
                </div>
                <!-- /BUTTONS -->
            </form>
            </div>
            <!-- /CARD LOGIN -->
	</div>
	<br /><br />
	</div>