<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
document.getElementById("cabecalho").innerHTML = "Sobre nós";
</script>

<!-- Conteúdo da View abaixo -->
<div class="container">
<br/>

<h3 class="hide-on-med-and-up grey-text text-darken-2 center-align">Quem Somos</h3>
<h3 class="hide-on-small-only grey-text text-darken-2 left-align">Quem Somos</h3>
<p align="justify" class="grey-text text-darken-1">
    Cursando o terceiro módulo do Técnico de Informática pela Instituição Centro Paula Souza, 
    o sistema foi criado em 2015 para ser apresentado no semestre final de conclusão 
    do curso. A fictícia <strong>DLI Sistemas Ltda</strong> (Desenvolvimento, Liderança e Inovação) 
    foi criada em outubro de 2014 com a funcionalidade primária de atuar no setor
    de <strong>Desenvolvimento de Softwares Comerciais</strong>, tendo como foco principal qualquer 
    tipo de comércio ligado ao terceiro setor. A equipe atual da DLI Sistemas Ltda 
    conta com cerca de quatro jovens empreendedores que se juntaram para formar uma sociedade acadêmica.
    O software <strong>Sniffoo</strong> foi criado para facilitar aos usuários o sistema de busca de pequena e micro 
    empresas da região, ampliando a clientela para estas que estão cadastradas.</p>

<h3 class="hide-on-med-and-up grey-text text-darken-2 center-align">Missão</h3>
<h3 class="hide-on-small-only grey-text text-darken-2 left-align">Missão</h3>
<p align="justify" class="grey-text text-darken-1">
    Nossa missão é permitir que todos os comerciantes tenham a chance de acompanhar as tendências atuais, 
    informatizando sua empresa de forma simples, segura, planejada e em conta.</p>

<h3 class="hide-on-med-and-up grey-text text-darken-2 center-align">Valores</h3>
<h3 class="hide-on-small-only grey-text text-darken-2 left-align">Valores</h3>
<p align="justify" class="grey-text text-darken-1">
    <strong>Ética:</strong> Buscar sempre um padrão de qualidade dentro de nossa empresa para assim manter a boa visão 
    de nossos clientes perante a nossa marca. Sem esquecer-se dos valores éticos e morais.<br/><br/>
    <strong>Qualidade:</strong> Nossos administradores proprietários estão comprometidos com um alto 
    padrão de atendimento, mantendo a qualidade do sistema.<br/><br/>
    <strong>Visão:</strong> A DLI Sistemas pretende tornar-se uma das melhores empresas de Desenvolvimento de Softwares 
    do Brasil, mantendo sempre a qualidade e confiança de nossos clientes.<br/><br/></p>

<h3 class="hide-on-med-and-up grey-text text-darken-2 center-align">Equipe</h3>
<h3 class="hide-on-small-only grey-text text-darken-2 left-align">Equipe</h3>
<div class="row valign-wrapper">
    <div class="col s3">
        <img src="<?php echo base_url('src/imagens/default/agda.jpg'); ?>" alt="" class="materialboxed circle responsive-img">  
    </div>
    <div class="col s9">
        <h5>Agda Luiza</h5>
        <h6>Admin. de Banco de Dados, <?php $idade = date('Y') - 1995; echo $idade; ?> anos, Praia Grande / SP</h6>
        <h6>Contato: <a href="mailto:agdaluiza@gmail.com">agdaluiza@gmail.com</a></h6>
    </div>
</div>

<div class="row valign-wrapper">
    <div class="col s3">
        <img src="<?php echo base_url('src/imagens/default/gabriel.jpg'); ?>" alt="" class="materialboxed circle responsive-img">  
    </div>
    <div class="col s9">
        <h5>Gabriel Van Loon</h5>
        <h6>Programador, <?php $idade = date('Y') - 1997; echo $idade; ?> anos, Praia Grande / SP</h6>
        <h6>Contato: <a href="mailto:gabriel.cientista123@gmail.com">gabriel.rojas@etec.sp.gov.br</a></h6>
    </div>
</div>

<div class="row valign-wrapper">
    <div class="col s3">
        <img src="<?php echo base_url('src/imagens/default/leo.jpg'); ?>" alt="" class="materialboxed circle responsive-img">  
    </div>
    <div class="col s9">
        <h5>Léo Caratin</h5>
        <h6>Analista, <?php $idade = date('Y') - 1999; echo $idade; ?> anos, Praia Grande / SP</h6>
        <h6>Contato: <a href="mailto:leocaratin@gmail.com">leocaratin@gmail.com</a></h6>
    </div>
</div>

<div class="row valign-wrapper">
    <div class="col s3">
        <img src="<?php echo base_url('src/imagens/default/lucas.jpg'); ?>" alt="" class="materialboxed circle responsive-img">  
    </div>
    <div class="col s9">
        <h5>Lucas Figueiredo</h5>
        <h6>Designer, <?php $idade = date('Y') - 1994; echo $idade; ?> anos, São Vicente / SP</h6>
        <h6>Contato: <a href="mailto:luucasfj@gmail.com">luucasfj@gmail.com</a></h6>
    </div>
</div>



</div>
