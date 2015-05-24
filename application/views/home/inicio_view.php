<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
document.getElementById("cabecalho").innerHTML = "Início";
</script>
<!-- Conteúdo da View abaixo -->

 <!--CARD SERVICO-->
 <div id="container-cartoes">
        <div class="card-panel deep-purple lighten-2 z-depth-1">
          <div class="row  cardConteudo valign-wrapper">
		    <div class="col s3 right-align  cardImagem">
			  <img src="<?php echo base_url('src/imagens/pagina/perfil/harry-square.png'); ?>" class="circle imgServico z-depth-1"/>
			</div>
		    <div class="col s9 center-align cardInfo">
				  <div class="row  white-text left-align cardTopo">
				  <span class="nomeServico">Harry Potter</span><br />
				  <h6 class="sloganServico">Harry Potter e o Prisioneiro de Azkaban</h6>
				  <h6 class="enderecoServico">O Armário Sob a Escada Rua dos Alfineiros 4 </h6>
				  </div>
				  <div class="row  cardRodape valign-wrapper">
				  <div class="col s4 left-align  valign-wrapper cardRate">
				  <i class="mdi-action-star-rate white-text rateServico"></i>
				  <i class="mdi-action-star-rate white-text rateServico"></i>
				  <i class="mdi-action-star-rate white-text rateServico"></i>
				  <i class="mdi-action-star-rate white-text rateServico"></i>
				  <i class="mdi-action-star-rate white-text rateServico"></i>
				  </div>
				  <div class="col s8 right-align  cardBotoes">
				  <a class="btn-floating waves-effect waves-light deep-purple btnServico"><i class="mdi-action-info-outline"></i></a>
				  <a class="btn-floating waves-effect waves-light deep-purple btnServico"><i class="mdi-maps-place iconeBotao"></i></a>
				  <a class="btn-floating waves-effect waves-light deep-purple btnServico"><i class="mdi-communication-comment iconeBotao"></i></a>
				  <a class="btn-floating waves-effect waves-light deep-purple btnServico"><i class="mdi-social-share valign-wrapper iconeBotao"></i></a>
				  </div>
				  </div>
			</div>
		  </div>
        </div>
 </div>
 <?php  $acao = isset($acao) ? $acao : "CarregarCartoes(0,0,0,0,0,0)"; ?>
 <div class="container right-align">
     <a class="btn-floating btn-med orange darken-2 waves-effect waves-light red fixed" onclick="<?php echo $acao;?>"><i class="mdi-content-add"></i></a>
 </div>
 
 <div class="container center-align">
 <br/><span id="msgErro" class="grey-text"></span>
 </div>