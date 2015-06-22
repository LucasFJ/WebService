<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
document.getElementById("cabecalho").innerHTML = "Excluir Página";
</script>

	<!-- CARD LOGIN -->
	<div class="section no-pad-bot" id="index-banner">
	<div class="container center">
	<br />
	<h5>Confirme abaixo se você pretende excluir os dados de sua página permanentemente</h5>
        
        <span class="red-text" id="erro"><?php echo $mensagem_erro; ?></span><br />
        
	<div class="card left-align grey darken-1 z-depth-2">
	<form class="col s12" method="post">
	<div class="card-content center-align white-text">
	<span class="card-title">Excluir Página</span>
        <!-- FORM LOGIN -->
        <div class="formLogin">
            <div class="input-field login">             
                <input name="excluir" type="radio" id="excluir1" value="1"/>
                <label for="excluir1">Sim, pretendo excluir minha página.</label>                
            </div>
            <div class="input-field login">               
                <input name="excluir" type="radio" id="excluir2" value="0" checked/>
                <label for="excluir2">Não, desejo manter minha página.</label>              
            </div>
        </div>
	<!-- /FORM LOGIN -->
	<br/>
	<!-- BUTTONS -->
	  	<div class="contAction container">
                  <button value="Enviar"  type="submit" class="btnAction waves-effect waves-light orange darken-2 white-text btn tooltipped" data-position="top" data-delay="200" data-tooltip="Confirmar processo">Enviar</button>
		  <a href="<?php echo base_url('login'); ?>" class="btnAction waves-effect waves-light orange darken-2 white-text btn tooltipped" data-position="top" data-delay="200" data-tooltip="Voltar para Tela de Login">Voltar</a>
                </div>
	</form>
		
	<!-- /BUTTONS -->	  

	</div>
	</div>
	</div>
	<!-- /CARD LOGIN -->

