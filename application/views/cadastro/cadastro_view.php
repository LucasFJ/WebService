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
                <span unselectable="on" class="brand-logo center orange-text text-darken-2">Nova Conta</span>
                <a href="<?php echo base_url('login'); ?>" class="left-align"><i class="mdi-navigation-arrow-back orange-text"></i></a>
      </div>
            </nav>
          </header> 

	<main>
            
	<div class="no-pad-bot">
	<div class="container center">
	<br />
	<h5 class="center-align">Primeira vez por aqui? Preencha alguns campos para lembrarmos de você na próxima visita.</h5>
	<br />
        <span class='red-text' id='erro'><?php echo $mensagem_erro;?></span><br/>
            <!-- CARD LOGIN -->
            <div class="card center-align orange z-depth-2">
                <br /><span class="card-title">Cadastro</span>
                <form action="<?php echo base_url("cadastro/POSTcadastro");?>" class="col s12" method="post">
            <div class="card-content center-align contForm">
                <!--FORM--->
                
                <div class="row">
                <div class="input-field col l6 s12">
                    <input maxlength="20" id="nome" name="nome" type="text" class="validate" required value=""/>
		  <label for="nome" class="inputLabel">Nome *</label>
		</div>
                <div class="input-field col l6 s12">
                    <input maxlength="20" id="sobrenome" name="sobrenome" type="text" class="validate" required  value=""/>
                <label for="last_name">Sobrenome *</label>
                </div>
                </div>
                
                <div class="row">
                <div class="input-field col l6 s12">
                    <input maxlength="50" id="email" name="email" type="email" class="validate" required value=""/>
                    <label for="first_name">E-mail *</label>
                </div>
                <div class="input-field col l6 s12 genero">
                  <select name="genero" required>
                    <option value="0" disabled selected>Gênero *</option>
                    <option value="1">Feminino</option>
                    <option value="2">Masculino</option>
                  </select>
                </div>
                </div>
                
                <div class="row">
                <div class="input-field col l6 s12">
                    <input maxlength="40" id="senha" name="senha" type="password" class="validate" required />
                <label for="first_name">Senha *</label>
                </div>
                <div class="input-field col l6 s12">
                    <input maxlength="40" id="repeteSenha" name="repeteSenha" type="password" class="validate" required />
                <label for="last_name">Senha Novamente *</label>
                </div>
                </div>
                
                <div class="row">
                <div class="input-field col l6 s12">
                    <input id="nascimento" name="nascimento" type="date" class="datepicker" required />
                <label for="first_name">Data de Nascimento *</label>
                </div>
                <div class="input-field col l6 s12">
                    <p>
                        <input name="concorda" type="checkbox" class="filled-in white" id="filled-in-box" required />
                        <label for="filled-in-box">Li e estou de acordo com os Termos de Uso do usuário. *</label>
                    </p>
                </div>
                </div>
                <br />
                
                
                <!--/FORM-->
                
                <!-- BUTTONS -->
                <div class="container containerBtnCadastro">
                    <button name="CadastroUsuario" value="Enviar" type="submit" class="btnCadastro waves-effect waves-light white orange-text text-darken-4 btn tooltipped" data-position="top" data-delay="200" data-tooltip="Cadastrar-se">Cadastrar</button>
                    <button href="" type="reset" class="btnCadastro waves-effect waves-light white orange-text text-darken-4 btn tooltipped" data-position="top" data-delay="200" data-tooltip="Limpar dados inseridos">Limpar</button>
                    </div>
                <!-- /BUTTONS -->
            </form>
            </div>
            <!-- /CARD LOGIN -->
	</div>
	<br /><br />
	</div>