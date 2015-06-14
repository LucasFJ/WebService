<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
document.getElementById("cabecalho").innerHTML = "Fale conosco";
</script>

<!-- Conteúdo da View abaixo -->
<br/>
<div class="container">
<h6 class="center-align grey-text text-darken-2">Alguma dúvida, erro ou dica? Envie-nos um e-mail e estaremos lhe respondendo em breve!</h6><br/>

<div class="row">
<form class="col s12" method="post" action="mailto:suporte@sniffoo.com.br">
    <div class="row">
    <div class="input-field col s6">
        <input placeholder="Digite seu nome" id="nome" type="text" class="validate" maxlength="20" required>
        <label for="nome" class="active">Nome *</label>
    </div>
      <div class="input-field col s6">
        <input placeholder="Digite seu e-mail" id="email" type="email" class="validate" maxlength="45" required>
        <label for="email" class="active">E-mail *</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input placeholder="Assunto da mensagem" id="assunto" type="text" maxlength="50" class="validate" required>
        <label for="assunto" class="active">Assunto *</label>
      </div>
    </div>
    <div class="row">
    <div class="input-field col s12">
        <textarea id="mensagem" class="materialize-textarea" maxlength="500" required></textarea>
        <label for="mensagem">Mensagem *</label>
    </div>
    </div>
    
    <div class="row center-align">
        <input class="btn orange darken-2" type="submit" value="Enviar" id="enviar" name="enviar" />
        <input class="btn orange darken-2" type="reset" value="Limpar" />
    </div>  
</form>
</div>

</div>