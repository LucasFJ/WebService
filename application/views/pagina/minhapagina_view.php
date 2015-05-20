<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
document.getElementById("cabecalho").innerHTML = "Total Saúde SP";
</script>

<!-- Conteúdo da View abaixo -->

<!--CARD SERVICO-->
<div class="conteudo">
<div class="card-panel teal lighten-1 z-depth-1">
    <div class="row cardConteudo valign-wrapper">
    <div class="col s3 right-align cardImagem">
    <img src="<?php echo base_url('src/imagens/pagina/perfil/total.jpg'); ?>" class="circle imgServico z-depth-1"/>
    </div>
    <div class="col s9 center-align cardInfo">
        <div class="row  white-text left-align cardTopo">
            <span class="nomeServico">Total Saúde SP</span><br />
            <h6 class="sloganServico">O conhecimento ao seu alcance</h6>
            <h6 class="enderecoServico">www.totalsaudesp.com.br</h6>
            <h6 class="enderecoServico">(13) 3018-7500</h6>
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
            <a href="#modalInfo" class="modal-trigger btn-floating waves-effect waves-light teal darken-2 btnServico"><i class="mdi-action-info-outline"></i></a>
            <a href="" class="btn-floating waves-effect waves-light  teal darken-2 btnServico"><i class="mdi-maps-place iconeBotao"></i></a>
            <a href="#modalComentar" class="modal-trigger btn-floating waves-effect waves-light  teal darken-2 btnServico"><i class="mdi-communication-comment iconeBotao"></i></a>
            <a href="#modalCompartilhar" class="modal-trigger btn-floating waves-effect waves-light  teal darken-2 btnServico"><i class="mdi-social-share valign-wrapper iconeBotao"></i></a>
        </div>
        </div>
    </div>
    </div>
</div>

<div class="row hide-on-med-and-up btnSite">
    <a class="deep-purple lighten-1 waves-effect waves-light col s12 btn z-depth-1">Acesse o site</a>
</div>
    
<div class="contProdutos">
<div class="row">
    <!-- PRODUTO -->
    <div class="col s12 m4 l4">
    <div class="card">
    <div class="card-image waves-effect waves-block waves-light">
        <img class="activator" src="<?php echo base_url('src/imagens/pagina/produto/PIO.png'); ?>">
    </div>
    <div class="card-content">
        <span class="card-title activator grey-text text-darken-4"><h6 class="truncate">Punção Intraóssea</h6><i class="mdi-navigation-more-vert right"></i></span>
    </div>
    <div class="card-reveal">
        <span class="card-title grey-text text-darken-4">Punção Intraóssea<i class="mdi-navigation-close right"></i></span>
        <p>1. Anatomia e fisiologia óssea<br />
        2. Aspectos éticos e legais<br />
        3. Os tipos de dispositivos<br />
        4. Indicações e contra-indicações<br />
        5. Aula prática em manequim<br /><br />
        <a href="#">totalsaudesp.com.br/pio</a>
        </p>
    </div>
    </div>
    </div>
<!-- PRODUTO -->
    <div class="col s12 m4 l4">
    <div class="card">
    <div class="card-image waves-effect waves-block waves-light">
        <img class="activator" src="<?php echo base_url('src/imagens/pagina/produto/APH.png'); ?>">
    </div>
    <div class="card-content valign-wrapper">
        <span class="card-title activator grey-text text-darken-4"><h6 class="truncate">Atendimento Pré Hospitalar</h6><i class="mdi-navigation-more-vert right"></i></span>
    </div>
    <div class="card-reveal">
       <span class="card-title grey-text text-darken-4">Atendimento Pré Hospitalar<i class="mdi-navigation-close right"></i></span>
       <p>1. Anatomia e fisiologia óssea<br />
        2. Aspectos éticos e legais<br />
        3. Os tipos de dispositivos<br />
        4. Indicações e contra-indicações<br />
        5. Aula prática em manequim<br /><br />
        <a href="#">totalsaudesp.com.br/pio</a>
        </p>
    </div>
    </div>
    </div>
<!-- PRODUTO -->
    <div class="col s12 m4 l4">
    <div class="card">
    <div class="card-image waves-effect waves-block waves-light">
        <img class="activator" src="<?php echo base_url('src/imagens/pagina/produto/ECG.png'); ?>">
    </div>
    <div class="card-content">
        <span class="card-title activator grey-text text-darken-4"><h6 class="truncate">Interpretação de Eletrocardiograma</h6><i class="mdi-navigation-more-vert right"></i></span>
    </div>
    <div class="card-reveal">
        <span class="card-title grey-text text-darken-4">Interpretação de Eletrocardiograma<i class="mdi-navigation-close right"></i></span>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat.</p>
    </div>
    </div>
    </div>
</div>
</div>
</div>

<!--MODAL INFORMAÇÕES-->
<div id="modalInfo" class="modal white center modal-fixed-footer">
	<div class="modal-content grey-text text-darken-4">
            <h4>Informações</h4>
            <p>Informações da página abaixo!</p>
        </div>
        <div class="modal-footer grey lighten-4">
            <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Alguma coisa</a>
        </div>				
</div>

<!--MODAL COMENTAR-->
<div id="modalComentar" class="modal white center modal-fixed-footer">
	<div class="modal-content grey-text text-darken-4">
            <h4>Comentários</h4>
            <p class="center-align">Comentários da página abaixo!</p>
        </div>
        <div class="modal-footer grey lighten-4">
            <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Enviar comentário</a>
        </div>				
</div>

<!--MODAL COMPARTILHAR-->
<div id="modalCompartilhar" class="modal white center modal-fixed-footer">
    <div class="modal-content grey-text text-darken-4">
        <h4>Compartilhar</h4>
        <p class="center-align">Caixa de opções para compartilhamento.</p>
    </div>
    <div class="modal-footer grey lighten-4">
        <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Compartilhar</a>
    </div>				
</div>

