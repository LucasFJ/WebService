<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
document.getElementById("cabecalho").innerHTML = "TO DO NOME_PAGINA";
</script>

<!-- Conteúdo da View abaixo -->

<!--CARD SERVICO-->
<div class="card-panel deep-purple lighten-2 z-depth-1">
    <div class="row cardConteudo valign-wrapper">
            <div class="col s3 right-align cardImagem">
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

<!-- PRODUTO -->
<div class="cardConteudo">
<div class="row">
<div class="col s6 m7">
  <div class="card">
    <div class="card-image">
      <img src="<?php echo base_url('src/imagens/pagina/produto/harry-kit.jpg'); ?>">
    </div>
    <div class="card-content">
    <span class="card-title activator grey-text text-darken-4">Kit de Poções (Felix Felicius)</span>
    </div>
  </div>
</div>
</div>