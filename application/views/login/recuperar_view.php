<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
document.getElementById("cabecalho").innerHTML = "Recuperar";
</script>

	<!-- CARD LOGIN -->
	<div class="section no-pad-bot" id="index-banner">
	<div class="container center">
	<br />
	<h5>Preencha o formulário e enviaremos um e-mail para a recuperação de sua senha.</h5>
        
                                <span class="red-text" id="erro"><?php echo $mensagem_erro; ?></span><br />
        
	<div class="card left-align grey darken-1 z-depth-2">
            <form action="<?php echo base_url("login/POSTrecuperar")?>" class="col s12" method="post">
	<div class="card-content center-align white-text">
	<span class="card-title">Recuperar senha</span>
        <!-- FORM LOGIN -->
        <div class="formLogin">
	<div class="input-field login">
	<i class="mdi-social-person prefix"></i>
	<input id="icon_prefix" type="email" class="validate" name="email" required />
	<label for="icon_prefix" class="inputLabel">E-mail *</label>
	</div>
        </div>
	<!-- /FORM LOGIN -->
	<br />
	<!-- BUTTONS -->
	  	<div class="contAction container">
                  <button name="RecuperarSenha" value="Enviar" type="submit" class="btnAction waves-effect waves-light orange darken-2 white-text btn tooltipped" data-position="top" data-delay="200" data-tooltip="Enviar e-mail de recuperação">Enviar</button>
		   <a href="<?php echo base_url('login'); ?>" class="btnAction waves-effect waves-light orange darken-2 white-text btn tooltipped" data-position="top" data-delay="200" data-tooltip="Voltar para Tela de Login">Voltar</a>
                </div>
	</form>
		
	<!-- /BUTTONS -->	  

	</div>
	</div><br/>
        <br />
	</div>
	<!-- /CARD LOGIN -->
