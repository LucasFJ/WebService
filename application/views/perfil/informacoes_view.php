<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
document.getElementById("cabecalho").innerHTML = "Informações";
</script>

<!-- Conteúdo da View abaixo -->
<br/>
<div class="container">
<h6 class="center-align grey-text text-darken-2">Configurar uma imagem faz</h6><br/>
<ul class="collapsible" data-collapsible="accordion">
    
    <!-- Nome -->
    <li>
    <div class="collapsible-header active">
        <i class="mdi-social-person"></i>Nome <span id="erroNome" class="red-text"></span><span id="sucessoNome" class="green-text"></span>
    </div>
    <div class="collapsible-body container"><br/>
        <form class="col s12" method="post">
        <div class="input-field">
            <input id="nome" type="text" value="" required />
            <label for="nome">Nome</label>
        </div>
        <div class="input-field">
            <input id="sobrenome" type="text" value="" required />
            <label for="sobrenome">Sobrenome</label>
        </div><br/>
        <div class="right-align">
            <a class="btn btn-floating orange darken-2"><i class="mdi-navigation-check"></i></a>
            <button class="btn btn-floating orange darken-2" type="reset"><i class="mdi-content-undo"></i></button>
        </div>
        </form>
    </div>
    </li>
    
    <!-- Imagem -->
    <li>
    <div class="collapsible-header">
        <i class="mdi-image-camera-alt"></i>Imagem <span id="erroImagem" class="red-text"></span><span id="sucessoImagem" class="green-text"></span>
    </div>
    <div class="collapsible-body container"><br/>
        <div class="col s12 center-align cardImagem"> 
          <img id="imagem-usuario" src="<?php echo base_url("src/imagens/default/default.png"); ?>" class="circle imgServico z-depth-1"/>
        </div><br/>
        
        <form class="col s12" method="post">
        <div class="file-field input-field left-align col s12">
            <input class="file-path validate" type="text" />
        <div class="btn grey darken-2">
            <span><i class="mdi-image-photo-camera"></i></span>
            <input type="hidden" name="MAX_FILE_SIZE" value="3900000" />
            <input type="hidden" id="imagemantiga" name="imagemantiga" value="">
            <input type="file" id="imagem" name="imagem" required/>
        </div>
        </div>
        <div class="right-align">
            <a class="btn btn-floating orange darken-2"><i class="mdi-navigation-check"></i></a>
            <button class="btn btn-floating orange darken-2" type="reset"><i class="mdi-content-undo"></i></button>
        </div>
        </form>
    </div>
    </li>
    
    <!-- E-mail -->
    <li>
    <div class="collapsible-header">
        <i class="mdi-content-mail"></i>E-mail <span id="erroEmail" class="red-text"></span><span id="sucessoEmail" class="green-text"></span>
    </div>
    <div class="collapsible-body container"><br/>
        <form class="col s12" method="post">
        <div class="input-field">
            <input id="email" type="email" value="<?php echo $_SESSION['user_email']; ?>" required disabled />
            <label for="email">E-mail</label>
        </div><br/>
        <div class="center-align">
            <?php 
                if($_SESSION['is_ativo']){
                    echo "<a id='btn-ativo' class='btn green'>Verificado <i class='mdi-action-done'></i></a>";
                } else {
                    echo "<a id='btn-ativo' class='btn red'>Não verificado</i></a><br/><a href='#'>Enviar novamente</a>";
                }
            ?>
        </div><br/>
        </form>
    </div>
    </li>
    
    <!-- Segurança -->
    <li>
    <div class="collapsible-header">
        <i class="mdi-action-lock"></i>Segurança <span id="erroSeguranca" class="red-text"></span><span id="sucessoSeguranca" class="green-text"></span>
    </div>
    <div class="collapsible-body container"><br/>
        <form class="col s12" method="post">
        <div class="input-field">
            <input id="senha-atual" type="password" placeholder="Digite sua senha atual" value="" required />
            <label for="senha-atual" class="active">Senha Atual</label>
        </div><br/>
        <div class="input-field">
            <input id="senha-nova" type="password" placeholder="Digite sua nova senha" value="" required />
            <label for="senha-nova" class="active">Nova Senha</label>
        </div><br/>
        <div class="input-field">
            <input id="senha-repete" type="password" placeholder="Repita sua nova senha" value="" required />
            <label for="senha-repete" class="active">Digite Novamente</label>
        </div><br/>
        <div class="right-align">
            <a class="btn btn-floating orange darken-2"><i class="mdi-navigation-check"></i></a>
            <button class="btn btn-floating orange darken-2" type="reset"><i class="mdi-content-undo"></i></button>
        </div>
        </form>
    </div>
    </li>
    
    <!-- Nascimento -->
    <li>
    <div class="collapsible-header">
        <i class="mdi-social-cake"></i>Nascimento <span id="erroNascimento" class="red-text"></span><span id="sucessoNascimento" class="green-text"></span>
    </div>
    <div class="collapsible-body container"><br/>
        <form class="col s12" method="post">
        <div class="input-field">
            <input type="date" class="datepicker">
        </div><br/>
        <div class="right-align">
            <a class="btn btn-floating orange darken-2"><i class="mdi-navigation-check"></i></a>
            <button class="btn btn-floating orange darken-2" type="reset"><i class="mdi-content-undo"></i></button>
        </div>
        </form>
    </div>
    </li>
    
</ul>

</div>

<script>
window.onload = function(){
    $('.datepicker').pickadate({
       selectMonths: true, // Creates a dropdown to control month
       selectYears: 15 // Creates a dropdown of 15 years to control year
     });
}
</script>